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
              FROM [7257_DES].[dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS] as macro
              inner join [7257_DES].[dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS] as micro on [IdMacro] = [IdMacroProcesso]
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
    SELECT TOP 1000 [IdMacro]
          ,[CGC_UNIDADE]
          ,[NOME_UNIDADE]
          ,[NOME_MACROATIVIDADE]
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
    FROM    [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS] as macro
            INNER JOIN
            [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS] as micro on [IdMacro] = [IdMacroProcesso]
    WHERE
            CGC_UNIDADE = $cgc
            and micro.EXCLUIDO_USUARIO='N' and macro.[EXCLUIDO_USUARIO]='N'
    ORDER BY NOME_MACROATIVIDADE ASC
        ");
    
    return json_encode($listaMediaDiaUnidade);      
    }
               
}
