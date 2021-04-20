<?php


namespace App\Http\Controllers\VILOP;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\Vilop\MacroProcesso;
use App\Models\Vilop\MicroProcesso;
use App\Exports\criaExcelVilop;
use App\Exports\criaExcelVilopUnidade;
use App\Imports\produtividadeVilopImport;
use App\Classes\DiasUteisClass;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class indicadoresProdutividadeVilop extends Controller
{
    public function viewIndicadoresTabela($cgc)
    {

        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $listaProcesso = DB::table('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS')->where('CGC_UNIDADE', $cgc)->first();
        $unidadeCGC = $listaProcesso->CGC_UNIDADE;
        $unidadeNome = $listaProcesso->NOME_UNIDADE;
        return view('portal.produtividade-vilop.indicadores-tabela', [
             'unidadeCGC' => $unidadeCGC
            ,'unidadeNome' => $unidadeNome
        ]);
    }

    public function listaMediaDiaUnidade($cgc)
    {
    $listaMediaDiaUnidade = DB::select("SELECT distinct top 5 NOME_MACROATIVIDADE 
    ,MEDIA_DIA
    FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS]
      inner join TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso
    where CGC_UNIDADE = $cgc
    ORDER BY  [MEDIA_DIA] DESC");
    
    return json_encode($listaMediaDiaUnidade);      
    }

    public function listaTabelaGeral($cgc)
    {
    $listaMediaDiaUnidade = DB::select("SELECT  distinct NOME_MICROATIVIDADE
    [NOME_MICROATIVIDADE]
    ,[idMicro]
   ,[MEDIA_DIA]
   ,[TEMPO_EM_MINUTOS]
   ,[NIVEL_COMPLEXIDADE]
   ,[NIVEL_AUTOMACAO]
   ,[GRAU_CRITICIDADE]
   ,[GRAU_PADRONIZACAO]
   ,[GRAU_AUTONOMIA]
   FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS]
     inner join TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso
   where CGC_UNIDADE = $cgc");
    
    return json_encode($listaMediaDiaUnidade);      
    }

    public function listaTabelaGeralSQL($cgc)
    {

        $menorMaiorValor = DB::select("declare @MENOR_MAIOR_VALOR int;
        WITH MAIORES_VOLUMES(MEDIA_DIA) AS
        (
            SELECT TOP 5 round([MEDIA_DIA], 0) as MEDIA_DIA
              FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS] as macro
              inner join [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS] as micro on [IdMacro] = [IdMacroProcesso]
              where 
              CGC_UNIDADE ='7723' 
              and micro.EXCLUIDO_USUARIO='N' and macro.[EXCLUIDO_USUARIO]='N'
              order by MEDIA_DIA desc
        ) SELECT
        @MENOR_MAIOR_VALOR = MIN(MEDIA_DIA) 
        FROM MAIORES_VOLUMES
        select @MENOR_MAIOR_VALOR as MENOR_MAIOR_VALOR
            ");

    foreach ($menorMaiorValor as $valor){
        $MENOR_MAIOR_VALOR = $valor->MENOR_MAIOR_VALOR;
    }
        

    $listaMediaDiaUnidade = DB::select("
    SELECT [IdMacro]
      ,[CGC_UNIDADE]
      ,[NOME_UNIDADE]
      ,[NOME_MACROATIVIDADE]
      ,[idMicro]
      ,[NOME_MICROATIVIDADE]
      ,[MATRICULA_RESPONSAVEL_RESPOSTA]
      ,[DATA_RESPOSTA]
      ,macro.[EXCLUIDO_USUARIO]
      ,macro.[MATRICULA_RESPONSAVEL_EXCLUSAO]
      ,micro.[MEDIA_DIA]
      ,CASE 
            WHEN [MEDIA_DIA] >= $MENOR_MAIOR_VALOR  THEN 'VERDADEIRO'
            ELSE 'FALSO'
        END AS MAIOR_VOLUME
      ,CASE 
            WHEN [NIVEL_COMPLEXIDADE] > 4 and [GRAU_CRITICIDADE] > 4  THEN 'VERDADEIRO'
            ELSE 'FALSO'
        END AS COMPLEXO_CRITICO
        ,CASE 
            WHEN [NIVEL_AUTOMACAO] <= 3 and [GRAU_PADRONIZACAO] <= 3  THEN 'VERDADEIRO'
            ELSE 'FALSO'
        END AS BAIXA_AUTOMATIZACAO_PADRONIZACAO
        ,CASE 
            WHEN [NIVEL_AUTOMACAO] <= 3 and [GRAU_PADRONIZACAO] <= 3 AND [NIVEL_COMPLEXIDADE] < 4 and [GRAU_CRITICIDADE] < 4  THEN 'VERDADEIRO'
            ELSE 'FALSO'
        END AS MANUAIS
        ,CASE 
            WHEN [NIVEL_AUTOMACAO] =5  THEN 'VERDADEIRO'
            ELSE 'FALSO'
        END AS AUTOMATIZADOS
        ,CASE
            WHEN [NIVEL_AUTOMACAO] =5  THEN 'AUTOMATIZADOS'
            WHEN [MEDIA_DIA] >= $MENOR_MAIOR_VALOR  THEN 'MAIOR VOLUME'
            WHEN [NIVEL_COMPLEXIDADE] > 4 and [GRAU_CRITICIDADE] > 4  THEN 'COMPLEXOS CRITICOS'
            WHEN [NIVEL_AUTOMACAO] <= 3 and [GRAU_PADRONIZACAO] <= 3 AND [NIVEL_COMPLEXIDADE] < 4 and [GRAU_CRITICIDADE] < 4  THEN 'MANUAIS'
            ELSE 'SECUNDÁRIOS'
        END AS RESULTADO
-- cálculo realizado com base no tempo médio em min da cada atividade e quantidade de pessoas alocadas. 300min/dia, 20 dias úteis.
,MINUTOS_DISPONIVEIS = round([QTDE_PESSOAS_ALOCADAS] * 20 * 300,2)
,MINUTOS_TRABALHADOS = round([TEMPO_EM_MINUTOS] * [VOLUME_TOTAL_TRATADA],1)
FROM    [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS] as macro
        INNER JOIN
        [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS] as micro on [IdMacro] = [IdMacroProcesso]
WHERE
        CGC_UNIDADE ='7723' -- aqui precisa vir pela rota
        and micro.EXCLUIDO_USUARIO='N' and macro.[EXCLUIDO_USUARIO]='N'
ORDER BY RESULTADO ASC
        ");
    
    return json_encode($listaMediaDiaUnidade);      
    }
 
    public function indicadoresPrincipalUnidade ()
    {

    $listaMediaDiaUnidade = DB::select("EXEC SP_PRODUTIVIDADE_V2");
    return json_encode($listaMediaDiaUnidade); 
    
    }
    
    public function indicadoresV3()
    {

    $indicadoresV3 = DB::select("
    declare @MENOR_MAIOR_VALOR int;
    WITH MAIORES_VOLUMES(MEDIA_DIA) AS
    (
        SELECT TOP 5 round([MEDIA_DIA], 0) as MEDIA_DIA
          FROM [7257_DES].[dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS] as macro
          inner join [7257_DES].[dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS] as micro on [IdMacro] = [IdMacroProcesso]
          where 
          CGC_UNIDADE = '7776'
          and micro.EXCLUIDO_USUARIO='N' and macro.[EXCLUIDO_USUARIO]='N'
          order by MEDIA_DIA desc
    ) SELECT
    @MENOR_MAIOR_VALOR = MIN(MEDIA_DIA) 
    FROM MAIORES_VOLUMES
    
    
        
    
            -- ENTRADA MANUAL :
    
            -- Volume Total (mês) ## campo calculado conforme discutudo com Guilherme em 24/03 as 10hrs, media/dia *20 
            -- Volume Realizado (mês)
            -- Tempo médio Histórico (min)
            -- Tempo médio Realizado (min)
            -- Qtd Pessoas Alocadas 
    
    
    
    select  [IdMacroProcesso]
        ,[idMicro]
          ,[RESPONSAVEL_CADASTRO_MICROATIVIDADE]
          ,[NOME_MICROATIVIDADE]
          ,[MENSURAVEL]
          ,[VOLUME_TOTAL_DEMANDA]
          ,[VOLUME_TOTAL_TRATADA]
          ,[PERIODO_TRATADO_DE]
          ,[PERIODO_TRATADO_ATE]
          ,[MEDIA_DIA]
          ,[TEMPO_EM_MINUTOS]
          ,[NIVEL_COMPLEXIDADE]
          ,[NIVEL_AUTOMACAO]
          ,[GRAU_CRITICIDADE]
          ,[GRAU_PADRONIZACAO]
          ,[GRAU_AUTONOMIA]
          ,a.[EXCLUIDO_USUARIO]
          ,a.[MATRICULA_RESPONSAVEL_EXCLUSAO]
          ,[SISTEMA_ORIGEM_INFORMACAO]
          ,[MATRICULA_RESPONSAVEL_UPLOAD]
          ,[DATA_UPLOAD]
          ,[CGC_UNIDADE]
          ,[NOME_UNIDADE]
          ,[NOME_MACROATIVIDADE]
          ,[MATRICULA_RESPONSAVEL_RESPOSTA]
          ,[DATA_RESPOSTA],
    
            datediff(day, [PERIODO_TRATADO_DE], [PERIODO_TRATADO_ATE]) as qtde_dias,
            [dbo].[fncContadorDiasUteis](cast([PERIODO_TRATADO_DE] as date), cast([PERIODO_TRATADO_ATE]as date)) as dias_uteis,
                ([VOLUME_TOTAL_DEMANDA]/[dbo].[fncContadorDiasUteis](cast([PERIODO_TRATADO_DE] as date), cast([PERIODO_TRATADO_ATE]as date)))*20 as 'Vl_total_mes',
                ([VOLUME_TOTAL_TRATADA]/[dbo].[fncContadorDiasUteis](cast([PERIODO_TRATADO_DE] as date), cast([PERIODO_TRATADO_ATE]as date)))*20 as 'Vl_realizado_mes',
                 [TEMPO_EM_MINUTOS] as Tempo_medio_Historico,
                [TEMPO_EM_MINUTOS] as Tempo_medio_Realizado,
                [QTDE_PESSOAS_ALOCADAS]
            
            
        into #tb_dados	from [dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS_teste_fic]as a inner join 
                [dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS_teste_fic] as b on a.IdMacroProcesso=b.IdMacro  
                where b.CGC_UNIDADE= '7776' and [MENSURAVEL]='s' 
    
    
                
    
    
    select *, volume_maximo=case 
             when Tempo_medio_Historico<=Tempo_medio_Realizado  then  (((QTDE_PESSOAS_ALOCADAS * 1440)/Tempo_medio_Historico)* 20) 
             when Tempo_medio_Historico > Tempo_medio_Realizado then (((QTDE_PESSOAS_ALOCADAS * 1440)/Tempo_medio_Realizado) * 20)
             end
    
             , volume_realizar_pessoas_alocadas =case 
             when Tempo_medio_Historico <=Tempo_medio_Realizado  then  (((QTDE_PESSOAS_ALOCADAS * 315)/Tempo_medio_Historico)* 20) 
             when Tempo_medio_Historico > Tempo_medio_Realizado then (((QTDE_PESSOAS_ALOCADAS * 315)/Tempo_medio_Realizado) * 20)
             end into #tbparte1 from #tb_dados where  Tempo_medio_Historico<>0 and Tempo_medio_Realizado<>0
    
    
    select *,volume_realizado_max_calculado   =case 
            when Vl_realizado_mes > volume_maximo  then  0
            when Vl_realizado_mes <= volume_maximo  then Vl_realizado_mes
            end 
             ,qtde_pessoas_estoque     =case 
             when Tempo_medio_Realizado < Tempo_medio_Historico  then  ((((Vl_realizado_mes*Tempo_medio_Realizado)/20)/315) )
             when Tempo_medio_Realizado >= Tempo_medio_Historico  then ((((Vl_realizado_mes*Tempo_medio_Historico)/20)/315))
             end
    
         
              ,volume_realizar_poder_producao      =case 
             when Vl_realizado_mes  < volume_realizar_pessoas_alocadas   then Vl_realizado_mes 
             when Vl_realizado_mes  >= volume_realizar_pessoas_alocadas   then volume_realizar_pessoas_alocadas 
             end into #tbparte2		 from #tbparte1
    
       
            select *,volume_considerado  =case 
             when volume_realizado_max_calculado <= Vl_realizado_mes  then  volume_realizado_max_calculado
             when volume_realizado_max_calculado > Vl_realizado_mes  then 0
             end  into #tbparte3  from #tbparte2
    
    
             select *,volume_considerado/Vl_total_mes as desempenho, 
                  Tempo_medio_Historico/Tempo_medio_Realizado as tempo,
                  volume_considerado/volume_realizar_pessoas_alocadas as capacidade_producao,
                   qtde_pessoas_estoque/[QTDE_PESSOAS_ALOCADAS]  as per_pessoas_real_estoque,
                  ((volume_considerado/Vl_total_mes)+(volume_considerado/volume_realizar_pessoas_alocadas))/2   as produtividade_volu_tempo,
                 apoio_qt_pessoas_necessario_para_realizar_estoque =case 
             when volume_considerado/Vl_total_mes>=0.95 and  volume_considerado/volume_realizar_pessoas_alocadas between 0.9 and 1.2
               then [QTDE_PESSOAS_ALOCADAS]
            else qtde_pessoas_estoque
                end, 
                tempo_medio_necessario =case 
             when Vl_total_mes>Vl_realizado_mes then (([QTDE_PESSOAS_ALOCADAS]*6300)/Vl_total_mes)
            else Tempo_medio_Historico
                end 		 	 
            
            ,ponderada_calculo_prod_vol_tempo = Vl_realizado_mes * Tempo_medio_Realizado
    
            
            
             
            into #tab_parte4 from #tbparte3 where VOLUME_TOTAL_DEMANDA<>0 and volume_realizar_pessoas_alocadas<>0 AND Tempo_medio_Realizado<>0 AND QTDE_PESSOAS_ALOCADAS<>0 AND
                  volume_considerado <>0  AND Tempo_medio_Realizado<>0 AND Tempo_medio_Historico<>0
    
    --select * from #tab_parte4
    
        select *,(apoio_qt_pessoas_necessario_para_realizar_estoque-[QTDE_PESSOAS_ALOCADAS]) as qt_pessoas_necessario_para_realizar_estoque
        
            
         from #tab_parte4
    
         SELECT count(IdMicro) as QTMicro, IdMacroProcesso
         INTO #tab_conta_atividades
         from #tab_parte4
         group by IdMacroProcesso
    
         
                                SELECT 
                                A.IdMacroProcesso as macro, 
                                COUNT(A.IdMacroProcesso) AS QT,
                                sum(Vl_total_mes) as SOMA_Vl_total_mes, 
                                sum(Vl_realizado_mes) AS SOMA_Vl_realizado_mes, 
                                SUM(QTDE_PESSOAS_ALOCADAS) AS SOMA_desempenho,
                                SUM(capacidade_producao) AS  SOMA_capacidade_producao, 
                                SUM(per_pessoas_real_estoque) AS SOMAper_pessoas_real_estoque,
                                SUM(produtividade_volu_tempo) AS SOMAprodutividade_volu_tempo,			
                                CGC_UNIDADE as cgc 
                                ,soma_ponderada_prod_vol_tempo = sum(ponderada_calculo_prod_vol_tempo)
                                                            
                                
    
                                INTO #SOMA1	FROM #tab_parte4 as A
                                left join #tab_conta_atividades  as B on A.IdMacroProcesso = B.IdMacroProcesso
                                group by A.IdMacroProcesso,CGC_UNIDADE 
    
            --select * from 	#SOMA1	
            
            
    
             select cast(((cast(100 as float)/count(macro)))AS DECIMAL(6,2)) as'ponderado',cgc as cgc1
            into #tb_qtmacroprecesso from #SOMA1 group by  cgc 
             
    
            select * ,
            
            
    
            vl_realizado_mes_ponderado				= CAST(Vl_realizado_mes AS float) / CAST(SOMA_Vl_realizado_mes AS float) * ponderado
            ,media_ponderada_calc_desempenho		= CAST(Vl_realizado_mes AS float) / CAST(SOMA_Vl_realizado_mes AS float) * (volume_considerado / Vl_total_mes)
            
            ,media_ponderada_calc_capacidade_prod	= CAST(Vl_realizado_mes AS float) / CAST(SOMA_Vl_realizado_mes AS float) * capacidade_producao
    
            ,media_ponderada_pessoas_real_estoque	= ([QTDE_PESSOAS_ALOCADAS] / SOMA_desempenho ) * per_pessoas_real_estoque
            ,media_ponderada_prd_vol_tempo			=  (ponderada_calculo_prod_vol_tempo / soma_ponderada_prod_vol_tempo)  * produtividade_volu_tempo
                    
    
             ,CASE
                WHEN [NIVEL_AUTOMACAO] =5  THEN 'AUTOMATIZADOS'
                WHEN [MEDIA_DIA] >= @MENOR_MAIOR_VALOR  THEN 'MAIOR VOLUME'
                WHEN [NIVEL_COMPLEXIDADE] > 4 and [GRAU_CRITICIDADE] > 4  THEN 'COMPLEXOS CRITICOS'
                WHEN [NIVEL_AUTOMACAO] <= 3 and [GRAU_PADRONIZACAO] <= 3 AND [NIVEL_COMPLEXIDADE] < 4 and [GRAU_CRITICIDADE] < 4  THEN 'MANUAIS'
                ELSE 'SECUNDÁRIOS'
            END AS RESULTADO
            
            into #tbcal_ponderado_linha from #tab_parte4 as a left join #SOMA1 as b on b.macro=a.IdMacroProcesso left join 
            #tb_qtmacroprecesso as c on a.CGC_UNIDADE=c.cgc1
    
    
    
        --select * from #tbcal_ponderado_linha
    
        select CGC_UNIDADE,
        
            soma_vl_realizado_mes_ponderado				= SUM(vl_realizado_mes_ponderado * ponderado)
            ,soma_media_ponderada_calc_desempenho		= SUM(media_ponderada_calc_desempenho) / count(distinct(macro))
            
            ,soma_media_ponderada_calc_capacidade_prod	= SUM(media_ponderada_calc_capacidade_prod * ponderado) 
    
            ,soma_media_ponderada_pessoas_real_estoque	= SUM(media_ponderada_pessoas_real_estoque * ponderado)
            ,soma_media_ponderada_volume_tempo			= SUM(media_ponderada_prd_vol_tempo * ponderado )
            ,soma_qtde_pessoas_alocadas					= SUM([QTDE_PESSOAS_ALOCADAS])
            into #tb_ponderado_macro
        from #tbcal_ponderado_linha
        group by CGC_UNIDADE
    
        --select * from #tb_ponderado_macro
        
        select 
        produtividade_volume_tempo	= soma_media_ponderada_volume_tempo,
        porcentagem_desempenho		= soma_media_ponderada_calc_desempenho,
        porcentagem_pessoas			= soma_media_ponderada_pessoas_real_estoque,
        fte_tecnica_mensuravel		= soma_qtde_pessoas_alocadas,
        fte_tecnica_nao_mensuravel	= (lip_lap_lts + qt_adm + qt_gestores + div + qt_ti)  - (qt_gestores + lip_lap_lts)
        ,gestores					= qt_gestores 
        ,fte_tecnica_total			= soma_qtde_pessoas_alocadas + (lip_lap_lts + qt_adm + qt_gestores + div + qt_ti)  - (qt_gestores + lip_lap_lts)
        ,lap_unidade				= soma_qtde_pessoas_alocadas + (lip_lap_lts + qt_adm + qt_gestores + div + qt_ti)  - (qt_gestores + lip_lap_lts) + qt_gestores  + lip_lap_lts
    
        ,perc_fte_apurada			= soma_qtde_pessoas_alocadas / (soma_qtde_pessoas_alocadas + (lip_lap_lts + qt_adm + qt_gestores + div + qt_ti)  - (qt_gestores + lip_lap_lts))
    
        from #tb_ponderado_macro as A
        inner join [dbo].[tb_produtividade_qt_pessoas] as B on B.cgc_unidade = A.CGC_UNIDADE
        ");
    return json_encode($indicadoresV3); 
    
    } 
    
     
}
