<?php


namespace App\Http\Controllers\VILOP;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\Vilop\MacroProcessoNovo;
use App\Models\Vilop\TabelaRelacionamento;
use App\Models\Vilop\CargaMensal;
use App\Models\Vilop\ControleProcesso;
use App\Models\Vilop\MicroProcessoNovo;
use App\Exports\criaExcelVilop;
use App\Exports\criaExcelVilopUnidade;
use App\Imports\produtividadeVilopImportNovo;

class produtividadeVilopController extends Controller
{
    public function index()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        try {
            $codigoUnidadeUsuarioSessao = str_pad($codigoUnidadeUsuarioSessao, 4, '0', STR_PAD_LEFT);
            $listaProcesso = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $codigoUnidadeUsuarioSessao)->first();
            $unidadeCGC =  $codigoUnidadeUsuarioSessao;
            $unidadeNome = $listaProcesso->nomeAgencia;
            return view('portal.produtividade-vilop.index', [
                 'unidadeCGC' => $unidadeCGC
                ,'unidadeNome' => $unidadeNome
            ]);
        }catch (\Throwable $th) {
            return redirect ('produtividade-vilop/');
        }
    }

    public function indexVilop($cgc, Request $request)
    {
        try {
            $listaProcesso = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $cgc)->first();
            $unidadeCGC =  $cgc;
            $unidadeNome = $listaProcesso->nomeAgencia;
            return view('portal.produtividade-vilop.index', [
                 'unidadeCGC' => $unidadeCGC
                ,'unidadeNome' => $unidadeNome
            ]);
        }catch (\Throwable $th) {
            
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Unidade inexistente!!!");
            return redirect ('produtividade-vilop/');
        }
    }

    public function viewListaUnidades()
    {

        return view('portal.produtividade-vilop.lista-unidades');
    }

    public function viewUploadEmLote()
    {

        return view('portal.produtividade-vilop.upload-de-atividade');
    }

    public function viewMicroatividade($idMacro)
    {
        $listaProcesso = DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')
        ->join('produtividade.TB_MACROPROCESSOS', DB::raw('CONVERT(VARCHAR, produtividade.TB_MACROPROCESSOS.ID_MACRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MACRO)'))
        ->where('TB_MACROPROCESSOS.ID_MACRO', $idMacro)->first();
        $unidadeCGC         = $listaProcesso->NU_CGC;
        $nomeMacroAtividade = $listaProcesso->DE_MACRO;
        $IdMacro            = $listaProcesso->ID_MACRO;
        return view('portal.produtividade-vilop.microatividades', [
            'unidadeCGC' => $unidadeCGC
           ,'nomeMacroAtividade' => $nomeMacroAtividade
           ,'idMacro' => $IdMacro
       ]);
    }

    public function viewRelatorioVilopUnidade($unidade, Request $request)
    {
    
        try {

            $resultadoFarolUnidade = DB::select("SELECT [NU_CGC]
            ,[PRODUTIVIDADE_G2]
            ,[DESEMPENHO]
            ,[PESSOAS]
            ,[RESULTADO] = CASE 
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'Sobrecarga'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'Limite'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Limite'
                                WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Sobrecarga'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS >= 120 then 'sobrecarga'  
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS < 120 then 'LIMITE'  
                          END 
             ,[COR] = CASE 
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'vermelho'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'amarelo'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'amarelo'
                                WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'vermelho'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS >= 120 then 'vermelho'  
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS < 120 then 'amarelo'  
                          END 
            FROM [produtividade].[TB_SAIDA_MENSAL_INDICADORES]
            where [NU_CGC] = ".$unidade);
            $cor = null;
            $resultado = null;
            if(!empty($resultadoFarolUnidade)){
                foreach ($resultadoFarolUnidade as &$farol) {
                    $cor = $farol->COR;
                    $resultado = $farol->RESULTADO;
                }
            }
            
            $unidade = str_pad($unidade, 4, '0', STR_PAD_LEFT);
            $listaProcesso = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $unidade)->first();
            $unidadeCGC =  $unidade;
            $unidadeNome = $listaProcesso->nomeAgencia;
            return view('portal.produtividade-vilop.relatorio', [
                'unidadeCGC' => $unidadeCGC
                ,'unidadeNome' => $unidadeNome
                ,'cor' => $cor
                ,'resultado' => $resultado
            ]);
        }catch (\Throwable $th) {

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Unidade inexistente!!!");
            return redirect ('/produtividade-vilop/relatorio-geral/relatorio');
    }
}

    public function viewIndicadoresVilop()
    {

        return view('portal.produtividade-vilop.indicadores-vilop');
    }


    public function listaUniversoEmpregados($unidade)
    {
        $listaUniversoEmpregados= DB::select("SELECT 
        cast([unidade] as int) as unidade
        ,base_empregados_funcoes3.[matricula]
        ,cast([dv] as int) as dv
        ,[nome]
        ,[fc_efetiva]
        ,cast([fc_efetiva_codigo] as int) as fc_efetiva_codigo
        ,[RESULTADO]
        FROM [base_empregados_funcoes3]
        join base_empregados_funcoes3_auxiliar 
        on base_empregados_funcoes3.matricula = base_empregados_funcoes3_auxiliar.matricula
        where unidade =" . $unidade);

         return json_encode($listaUniversoEmpregados);
        
    }

    public function editaOperacional($matricula, Request $request)
    {
        try {
            
            DB::beginTransaction();

            DB::table('base_empregados_funcoes3_auxiliar')
            ->where('matricula', $matricula)
            ->update(['RESULTADO' => $request->qualificacao]);

            
            DB::commit();

            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Alteração realizada!");
            $request->session()->flash('corpoMensagem', "A alteração foi realizada com sucesso.");
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Não foi possivel gravar, tente mais tarde!!!!");
        }
        return back();
        
    }


    public function listaAreasComMacroAtividade()
    {
        $listaAreasComMacroAtividade = DB::select("SELECT distinct 
        CGC_UNIDADE,NOME_UNIDADE 
	   ,Sigla
		FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS]
		INNER JOIN TB_CAPTURA_UNIDADES_ATT  ON TB_CAPTURA_UNIDADES_ATT.codigoAgencia = TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.CGC_UNIDADE
		where TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.EXCLUIDO_USUARIO = 'N'
        order by CGC_UNIDADE ASC");
        return json_encode($listaAreasComMacroAtividade);
        
    }

    public function updateMicroProcessoVilop($idMicro, Request $request)
    {
        try {
            
            DB::beginTransaction();

            if ($request->excluirMicroAtividade == 'excluir'){
                $updateMicroProcesso = TabelaRelacionamento::find($request->idMacroMicro);
                $updateMicroProcesso->IC_ATIVO                    =  0; 
                $updateMicroProcesso->CO_RESPONSAVEL_ATUALIZACAO  =  session('matricula');  
                $updateMicroProcesso->DT_ATUALIZACAO              = date("Y-m-d H:i:s", time());
                $updateMicroProcesso->save();     
            }else{
            
                $updateMicroProcesso = MicroProcessoNovo::find($idMicro);
                $updateCargaMensal   = CargaMensal::find($request->idcargaMensal);

                if (isset($request->mesApuracao)){
                $updateCargaMensal->MM_REFERENCIA              = $request->mesApuracao;
                $updateCargaMensal->AA_REFERENCIA              = $request->anoApuracao;
                }
              
                if (isset($request->nomeMicroAtividade)){
                    $updateMicroProcesso->DE_MICRO  = $request->nomeMicroAtividade;
                }
                if (isset($request->mensuravel)){
                    $updateMicroProcesso->IC_MENSURAVEL             = $request->mensuravel;
                }
                if (isset($request->volumeTotalDemanda)){
                    $updateCargaMensal->VOLUME_TOTAL_DEMANDA        = $request->volumeTotalDemanda;
                }
                if (isset($request->volumeTotalTratada)){
                    $updateCargaMensal->VOLUME_TOTAL_TRATADA        = $request->volumeTotalTratada;
                }
   
                if (isset($request->mediaDia)){
                    $updateCargaMensal->MEDIA_DIA                  = $request->mediaDia;
                }
                if (isset($request->tempoEmMinutos)){
                    $updateCargaMensal->TEMPO_EM_MINUTOS           = $request->tempoEmMinutos;
                }
                if (isset($request->nivelComplexidade)){
                    $updateCargaMensal->NIVEL_COMPLEXIDADE         = $request->nivelComplexidade;
                }
                if (isset($request->nivelAutomacao)){
                    $updateCargaMensal->NIVEL_AUTOMACAO            = $request->nivelAutomacao;
                }
                if (isset($request->grauCriticidade)){
                    $updateCargaMensal->GRAU_CRITICIDADE           = $request->grauCriticidade;
                }
                if (isset($request->grauPadronizacao)){
                    $updateCargaMensal->GRAU_PADRONIZACAO          = $request->grauPadronizacao;
                }
                if (isset($request->grauAutonomia)){
                    $updateCargaMensal->GRAU_AUTONOMIA             = $request->grauAutonomia;
                }
                if (isset($request->sistemaOrigemInformacao)){
                    $updateCargaMensal->SISTEMA_ORIGEM_INFORMACAO  = $request->sistemaOrigemInformacao;
                }
                if (isset($request->quantidadePessoasAlocadas)){
                    $updateCargaMensal->QTDE_PESSOAS_ALOCADAS      = $request->quantidadePessoasAlocadas;
                }
                if (isset($request->mesApuracao)){
                    $ControleProcesso   = ControleProcesso::find($request->idcargaMensal);
                    $ControleProcesso->MM_REFERENCIA              = $request->mesApuracao;
                    $ControleProcesso->AA_REFERENCIA              = $request->anoApuracao;
                    $ControleProcesso->save();
                }

                $updateMicroProcesso->save();
                $updateCargaMensal->save();
            }
            DB::commit();


            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Alteração realizada!");
            $request->session()->flash('corpoMensagem', "A alteração foi realizada com sucesso.");
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Não foi possivel gravar, tente mais tarde!!!!");
        }
        // DB::select("EXEC SP_PRODUTIVIDADE_V4");
        return back();
    }

    public function deleteMacroProcessoVilop($IdMacro, Request $request)
    {
        try {
            DB::beginTransaction();
            TabelaRelacionamento::where('ID_MACRO',$IdMacro)
            ->update(['IC_ATIVO'                   => 0,
                      'CO_RESPONSAVEL_ATUALIZACAO' => session('matricula'),
                      'DT_ATUALIZACAO'             => date("Y-m-d H:i:s", time())
            ]);
            
            $updateMacroProcesso = MacroProcessoNovo::find($IdMacro);
            $updateMacroProcesso->IC_ATIVO                    =  0; 
            $updateMacroProcesso->CO_RESPONSAVEL_ATUALIZACAO  =  session('matricula');  
            $updateMacroProcesso->DT_ATUALIZACAO              = date("Y-m-d H:i:s", time());
            $updateMacroProcesso->save();   
            DB::commit();
            

            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Exclusão realizada!");
            $request->session()->flash('corpoMensagem', "A Exclusão foi realizada com sucesso.");
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Não foi Excluir, tente mais tarde!!!!");
        }
        // DB::select("EXEC SP_PRODUTIVIDADE_V4");
        return back();
    }

    public function criaPlanilhaExcelVilopUnidade($unidade)
    {
        return Excel::download(new criaExcelVilopUnidade($unidade), 'Produtividade_Vilop_Unidade.xlsx');
    }

    public function import(Request $request) 
    {
        try {
            
            $pathtofile = ($_FILES['arquivo']['name']);
           
            $info = pathinfo($pathtofile);
            if ($info["extension"] == "xlsx" || $info["extension"] == "xls"){
            Excel::import(new produtividadeVilopImportNovo,request()->file('arquivo'));


            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro realizado!");
            $request->session()->flash('corpoMensagem', "O upload foi realizado com sucesso.");
            }else{
                $request->session()->flash('corMensagem', 'danger');
                $request->session()->flash('tituloMensagem', "Não foi possivel cadatrar!");
                $request->session()->flash('corpoMensagem', "Envie apenas arquivos do Excel (XLS e XLSX)"); 
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
                 foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                foreach($failure->errors() as $key => $message){
                $key = $message;
                }
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Não foi possivel cadatrar!");
            $request->session()->flash('corpoMensagem', $message); 
            }
        }   
        // DB::select("EXEC SP_PRODUTIVIDADE_V4");
        return back();
    }

    public function listaDadosDeUpload()
    {
    $listaDadosDeUpload = DB::select("SELECT distinct [DT_ENVIO_DA_CARGA] as DT_UPLOAD
    ,[CO_MATRICULA_RESPONSAVEL_ENVIO] as MATRICULA_RESPONSAVEL
    ,REPLICATE('0',4-LEN(RTRIM(NU_CGC))) + RTRIM(NU_CGC) as CGC_UNIDADE
    FROM [produtividade].[TB_CONTROLE_PROCESSO]
    order by DT_ENVIO_DA_CARGA asc");
    
    return json_encode($listaDadosDeUpload);      
    }

    public function listaDadosMacroatividade()
    {
    $listaDadosMacroatividade = DB::select("SELECT 
    [CGC_UNIDADE]
    ,[NOME_UNIDADE]
    ,[NOME_MACROATIVIDADE]
    ,[MATRICULA_RESPONSAVEL_RESPOSTA]
    ,[DATA_RESPOSTA]
    FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS]
    where [EXCLUIDO_USUARIO] = 'N'
    order by DATA_RESPOSTA ASC");
    
    return json_encode($listaDadosMacroatividade);      
    }

    public function listaDadosMicroatividade()
    {
    $listaDadosMicroatividade = DB::select("SELECT 
    CGC_UNIDADE
   ,NOME_UNIDADE
   ,NOME_MICROATIVIDADE
   ,RESPONSAVEL_CADASTRO_MICROATIVIDADE
    FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS]
    inner join TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso
    where TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[EXCLUIDO_USUARIO] = 'N'
    order by CGC_UNIDADE ASC");
    
    return json_encode($listaDadosMicroatividade);      
    }

    public function mediaNiveisMicro($unidade)
    {
    $mediaNiveisMicro = DB::select("SELECT 
    [NOME_MICROATIVIDADE]
   ,Average = ([NIVEL_COMPLEXIDADE] + [NIVEL_AUTOMACAO] + [GRAU_CRITICIDADE] + [GRAU_PADRONIZACAO] + [GRAU_AUTONOMIA]) / 5
    FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS]
    inner join TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso
    where [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS].CGC_UNIDADE = $unidade");
    
    return json_encode($mediaNiveisMicro);      
    }

    public function dadosIndicadoresMicro($unidade)
    {
    $dadosIndicadoresMicro = DB::select("SELECT
    [idMicro]
   ,[NOME_MICROATIVIDADE]
   ,[VOLUME_TOTAL_DEMANDA]
   ,[VOLUME_TOTAL_TRATADA]
   ,[MEDIA_DIA]
   ,[TEMPO_EM_MINUTOS]
    FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS] 
    inner join TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso
    where [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS].CGC_UNIDADE = $unidade");
    
    return json_encode($dadosIndicadoresMicro);      
    }
    

public function createMacroProcessoVilopNovo(Request $request)
{
    try {
        DB::beginTransaction();
        $novaMacroAtividadeVilop = new MacroProcessoNovo;
        $novaMacroAtividadeVilop->DE_MACRO                          = $request->nomeMacroAtividade;
        $novaMacroAtividadeVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
        $novaMacroAtividadeVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
        $novaMacroAtividadeVilop->IC_ATIVO                          = 1;
        $novaMacroAtividadeVilop->save();
        
        
        $novaMicroAtividadeVilop = new MicroProcessoNovo();
        $novaMicroAtividadeVilop->DE_MICRO                          = $request->nomeMicroAtividade;
        $novaMicroAtividadeVilop->IC_MENSURAVEL                     = $request->mensuravel;
        $novaMicroAtividadeVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
        $novaMicroAtividadeVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
        $novaMicroAtividadeVilop->save();
        
        
        $dadosMacroAtividadeVilop = DB::table('produtividade.TB_MACROPROCESSOS')->where('DE_MACRO', $request->nomeMacroAtividade)
        ->orderBy('ID_MACRO', 'desc')->first();  

        $dadosMicroAtividadeVilop = DB::table('produtividade.TB_MICROPROCESSO')->where('DE_MICRO', $request->nomeMicroAtividade)
        ->orderBy('ID_MICRO', 'desc')->first(); 
        
        $novoRelVilop = new TabelaRelacionamento;
        $novoRelVilop->NU_CGC                            = str_pad($request->cgcUnidade, 4 , '0' , STR_PAD_LEFT);
        $novoRelVilop->ID_MACRO                          = $dadosMacroAtividadeVilop->ID_MACRO;
        $novoRelVilop->ID_MICRO                          = $dadosMicroAtividadeVilop->ID_MICRO;
        $novoRelVilop->IC_ATIVO                          = 1;
        $novoRelVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
        $novoRelVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
        $novoRelVilop->save();
        
        
        $ControleProcesso = new ControleProcesso();
        
        $ControleProcesso->DT_CADASTRO               = date("Y-m-d H:i:s", time());
        if (isset($request->mesApuracao)){
            $ControleProcesso->MM_REFERENCIA         = $request->mesApuracao;
        }
        if (isset($request->anoApuracao)){
            $ControleProcesso->AA_REFERENCIA        = $request->anoApuracao ;
        }
        $ControleProcesso->DT_ENVIO_DA_CARGA         = NULL;
        $ControleProcesso->DT_PROCESSAMENTO          = NULL;
        $ControleProcesso->NU_CGC                    = str_pad($request->cgcUnidade, 4 , '0' , STR_PAD_LEFT);
        $ControleProcesso->save();

        $dadosCargaMensal= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')->orderBy('ID_AG_MACRO_MICRO', 'desc')->first();
        $idCarga= DB::table('produtividade.TB_CONTROLE_PROCESSO')->orderBy('ID_CARGA', 'desc')->first();  

        $CargaMensal = new CargaMensal();
        $CargaMensal->ID_CARGA                        = $idCarga->ID_CARGA;
        $CargaMensal->ID_AG_MACRO_MICRO               = $dadosCargaMensal->ID_AG_MACRO_MICRO;
        if (isset($request->mesApuracao)){
            $CargaMensal->MM_REFERENCIA         = $request->mesApuracao;
        }
        if (isset($request->anoApuracao)){
            $CargaMensal->AA_REFERENCIA        = $request->anoApuracao ;
        }

        if (isset($request->quantidadePessoasAlocadas)){
            $CargaMensal->QTDE_PESSOAS_ALOCADAS        = $request->quantidadePessoasAlocadas;
        }else{
            $CargaMensal->QTDE_PESSOAS_ALOCADAS        = null;
        }
        
        
        if (isset($request->volumeTotalDemanda)){
            $CargaMensal->VOLUME_TOTAL_DEMANDA        = $request->volumeTotalDemanda;
        }else{
            $CargaMensal->VOLUME_TOTAL_DEMANDA        = null;
        }

        if (isset($request->volumeTotalTratada)){
            $CargaMensal->VOLUME_TOTAL_TRATADA        = $request->volumeTotalTratada;
        }else{
            $CargaMensal->VOLUME_TOTAL_TRATADA        = null;
        }

        $CargaMensal->DIAS_UTEIS                      = null;

        if (isset($request->mediaDia)){
            $CargaMensal->MEDIA_DIA                  = $request->mediaDia;
        }else{
            $CargaMensal->MEDIA_DIA                  = null;
        }
        if (isset($request->tempoEmMinutos)){
            $CargaMensal->TEMPO_EM_MINUTOS           = $request->tempoEmMinutos;
        }else{
            $CargaMensal->TEMPO_EM_MINUTOS           = null;
        }

        if($request->nivelComplexidade == 0){
            $CargaMensal->NIVEL_COMPLEXIDADE              = null;
        }else{
            $CargaMensal->NIVEL_COMPLEXIDADE              = $request->nivelComplexidade;
        }

        if($request->nivelAutomacao == 0){
            $CargaMensal->NIVEL_AUTOMACAO              = null;
        }else{
            $CargaMensal->NIVEL_AUTOMACAO              = $request->nivelAutomacao;
        }

        if($request->grauCriticidade == 0){
            $CargaMensal->GRAU_CRITICIDADE              = null;
        }else{
            $CargaMensal->GRAU_CRITICIDADE              = $request->grauCriticidade;
        }

        if($request->grauPadronizacao == 0){
            $CargaMensal->GRAU_PADRONIZACAO              = null;
        }else{
            $CargaMensal->GRAU_PADRONIZACAO              = $request->grauPadronizacao;
        }

        if($request->grauAutonomia == 0){
            $CargaMensal->GRAU_AUTONOMIA              = null;
        }else{
            $CargaMensal->GRAU_AUTONOMIA              = $request->grauAutonomia;
        }

        if($request->sistemaOrigemInformacao == 0){
            $CargaMensal->SISTEMA_ORIGEM_INFORMACAO              = null;
        }else{
            $CargaMensal->SISTEMA_ORIGEM_INFORMACAO              = $request->sistemaOrigemInformacao;
        }
        $CargaMensal->save();
        DB::commit();



        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Cadastro realizado!");
        $request->session()->flash('corpoMensagem', "O cadastro foi realizado com sucesso.");
        
    } catch (\Throwable $th) {
        AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
        DB::rollback();
        dd($th);
        
        $request->session()->flash('corMensagem', 'danger');
        $request->session()->flash('tituloMensagem', "ERRO");
        $request->session()->flash('corpoMensagem', "Não foi possivel gravar, tente mais tarde!!!!");
    }
    // DB::select("EXEC SP_PRODUTIVIDADE_V4");
    return redirect ('produtividade-vilop/');
}

    public function criaMacroAtividade($cgc)
    {
        return view('portal.produtividade-vilop.cria-macroatividade', [
            'unidadeCGC' => $cgc
       ]);
    }

    public function createMicroProcessoVilopNovo(Request $request)
{
    try {
        DB::beginTransaction();

        $novaMicroAtividadeVilop = new MicroProcessoNovo();
        $novaMicroAtividadeVilop->DE_MICRO                          = $request->nomeMicroAtividade;
        $novaMicroAtividadeVilop->IC_MENSURAVEL                     = $request->mensuravel;
        $novaMicroAtividadeVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
        $novaMicroAtividadeVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
        $novaMicroAtividadeVilop->save();
        

        $dadosMicroAtividadeVilop = DB::table('produtividade.TB_MICROPROCESSO')->where('DE_MICRO', $request->nomeMicroAtividade)
        ->orderBy('ID_MICRO', 'desc')->first(); 
        
        $novoRelVilop = new TabelaRelacionamento;
        $novoRelVilop->NU_CGC                            = str_pad($request->unidadeCGC, 4 , '0' , STR_PAD_LEFT);
        $novoRelVilop->ID_MACRO                          = $request->idMacroatividade;
        $novoRelVilop->ID_MICRO                          = $dadosMicroAtividadeVilop->ID_MICRO;
        $novoRelVilop->IC_ATIVO                          = 1;
        $novoRelVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
        $novoRelVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
        $novoRelVilop->save();
        
        
        $ControleProcesso = new ControleProcesso();
        
        $ControleProcesso->DT_CADASTRO               = date("Y-m-d H:i:s", time());
        if (isset($request->mesApuracao)){
            $ControleProcesso->MM_REFERENCIA         = $request->mesApuracao;
        }
        if (isset($request->anoApuracao)){
            $ControleProcesso->AA_REFERENCIA        = $request->anoApuracao ;
        }
        $ControleProcesso->DT_ENVIO_DA_CARGA         = NULL;
        $ControleProcesso->DT_PROCESSAMENTO          = NULL;
        $ControleProcesso->NU_CGC                    = str_pad($request->cgcUnidade, 4 , '0' , STR_PAD_LEFT);
        $ControleProcesso->save();

        $dadosCargaMensal= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')->orderBy('ID_AG_MACRO_MICRO', 'desc')->first();
        $idCarga= DB::table('produtividade.TB_CONTROLE_PROCESSO')->orderBy('ID_CARGA', 'desc')->first();  

        $CargaMensal = new CargaMensal();
        $CargaMensal->ID_CARGA                        = $idCarga->ID_CARGA;
        $CargaMensal->ID_AG_MACRO_MICRO               = $dadosCargaMensal->ID_AG_MACRO_MICRO;
        $CargaMensal->QTDE_PESSOAS_ALOCADAS           = $request->quantidadePessoasAlocadas;

        if (isset($request->mesApuracao)){
            $CargaMensal->MM_REFERENCIA         = $request->mesApuracao;
        }
        if (isset($request->anoApuracao)){
            $CargaMensal->AA_REFERENCIA        = $request->anoApuracao ;
        }
        
        if (isset($request->volumeTotalDemanda)){
            $CargaMensal->VOLUME_TOTAL_DEMANDA        = $request->volumeTotalDemanda;
        }else{
            $CargaMensal->VOLUME_TOTAL_DEMANDA        = null;
        }

        if (isset($request->volumeTotalTratada)){
            $CargaMensal->VOLUME_TOTAL_TRATADA        = $request->volumeTotalTratada;
        }else{
            $CargaMensal->VOLUME_TOTAL_TRATADA        = null;
        }

        $CargaMensal->DIAS_UTEIS                      = null;

        if (isset($request->mediaDia)){
            $CargaMensal->MEDIA_DIA                  = $request->mediaDia;
        }else{
            $CargaMensal->MEDIA_DIA                  = null;
        }
        if (isset($request->tempoEmMinutos)){
            $CargaMensal->TEMPO_EM_MINUTOS           = $request->tempoEmMinutos;
        }else{
            $CargaMensal->TEMPO_EM_MINUTOS           = null;
        }

        if($request->nivelComplexidade == 0){
            $CargaMensal->NIVEL_COMPLEXIDADE              = null;
        }else{
            $CargaMensal->NIVEL_COMPLEXIDADE              = $request->nivelComplexidade;
        }

        if($request->nivelAutomacao == 0){
            $CargaMensal->NIVEL_AUTOMACAO              = null;
        }else{
            $CargaMensal->NIVEL_AUTOMACAO              = $request->nivelAutomacao;
        }

        if($request->grauCriticidade == 0){
            $CargaMensal->GRAU_CRITICIDADE              = null;
        }else{
            $CargaMensal->GRAU_CRITICIDADE              = $request->grauCriticidade;
        }

        if($request->grauPadronizacao == 0){
            $CargaMensal->GRAU_PADRONIZACAO              = null;
        }else{
            $CargaMensal->GRAU_PADRONIZACAO              = $request->grauPadronizacao;
        }

        if($request->grauAutonomia == 0){
            $CargaMensal->GRAU_AUTONOMIA              = null;
        }else{
            $CargaMensal->GRAU_AUTONOMIA              = $request->grauAutonomia;
        }

        if($request->sistemaOrigemInformacao == 0){
            $CargaMensal->SISTEMA_ORIGEM_INFORMACAO              = null;
        }else{
            $CargaMensal->SISTEMA_ORIGEM_INFORMACAO              = $request->sistemaOrigemInformacao;
        }
        $CargaMensal->save();
        
        
        DB::commit();


        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Cadastro realizado!");
        $request->session()->flash('corpoMensagem', "O cadastro foi realizado com sucesso.");
        
    } catch (\Throwable $th) {
        AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
        DB::rollback();
        dd($th);
        
        $request->session()->flash('corMensagem', 'danger');
        $request->session()->flash('tituloMensagem', "ERRO");
        $request->session()->flash('corpoMensagem', "Não foi possivel gravar, tente mais tarde!!!!");
    }
    // DB::select("EXEC SP_PRODUTIVIDADE_V4");
    return back();
}

public function listaMacroProcessoNovo($cgc)
{
    $listaMacroProcessoNovo= DB::table('produtividade.TB_MACROPROCESSOS')
        ->join('produtividade.TB_RELACAO_CGC_MACRO_MICRO', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MACRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_MACROPROCESSOS.ID_MACRO)'))    
        ->select(DB::raw("
        produtividade.TB_MACROPROCESSOS.[ID_MACRO] as idMacro,
        produtividade.TB_MACROPROCESSOS.[DE_MACRO] as nomeMacroAtividade
        "))
        ->where('NU_CGC', '=', $cgc)
        ->where('TB_MACROPROCESSOS.IC_ATIVO', '=', 1)
        ->distinct('idMacro')
        ->get();

    return json_encode($listaMacroProcessoNovo);
}

public function listaMicroProcessoNovo($cgc)
{
    $listaMicroProcessoNovo= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')
        ->leftjoin('produtividade.TB_MICROPROCESSO', DB::raw('CONVERT(VARCHAR, produtividade.TB_MICROPROCESSO.ID_MICRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MICRO)'))    
        ->leftjoin('produtividade.TB_CARGA_MENSAL', DB::raw('CONVERT(VARCHAR, produtividade.TB_CARGA_MENSAL.ID_AG_MACRO_MICRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_AG_MACRO_MICRO)'))
        ->join('produtividade.TB_CONTROLE_PROCESSO', DB::raw('CONVERT(VARCHAR, produtividade.TB_CONTROLE_PROCESSO.ID_CARGA)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_CARGA_MENSAL.ID_CARGA)'))        
        ->select(DB::raw("
        produtividade.TB_MICROPROCESSO.[DE_MICRO] as nomeMicroatividade,
        produtividade.TB_RELACAO_CGC_MACRO_MICRO.[ID_MACRO] as idMacro,
        produtividade.TB_RELACAO_CGC_MACRO_MICRO.[ID_MICRO] as idMicro,
        produtividade.TB_RELACAO_CGC_MACRO_MICRO.[ID_AG_MACRO_MICRO] as ID_AG_MACRO_MICRO,
        produtividade.TB_CARGA_MENSAL.[ID_CARGA] as ID_CARGA,
        produtividade.TB_MICROPROCESSO.[IC_MENSURAVEL] as MENSURAVEL,
        produtividade.TB_CARGA_MENSAL.[QTDE_PESSOAS_ALOCADAS] as QTDE_PESSOAS_ALOCADAS,
        produtividade.TB_CARGA_MENSAL.[VOLUME_TOTAL_DEMANDA] as VOLUME_TOTAL_DEMANDA,
        produtividade.TB_CARGA_MENSAL.[VOLUME_TOTAL_TRATADA] as VOLUME_TOTAL_TRATADA,
        produtividade.TB_CARGA_MENSAL.[DIAS_UTEIS] as DIAS_UTEIS,
        produtividade.TB_CARGA_MENSAL.[MEDIA_DIA] as MEDIA_DIA,
        produtividade.TB_CARGA_MENSAL.[TEMPO_EM_MINUTOS] as TEMPO_EM_MINUTOS,
        produtividade.TB_CARGA_MENSAL.[NIVEL_COMPLEXIDADE] as NIVEL_COMPLEXIDADE,
        produtividade.TB_CARGA_MENSAL.[NIVEL_AUTOMACAO] as NIVEL_AUTOMACAO,
        produtividade.TB_CARGA_MENSAL.[GRAU_CRITICIDADE] as GRAU_CRITICIDADE,
        produtividade.TB_CARGA_MENSAL.[GRAU_PADRONIZACAO] as GRAU_PADRONIZACAO,
        produtividade.TB_CARGA_MENSAL.[GRAU_AUTONOMIA] as GRAU_AUTONOMIA,
        produtividade.TB_CARGA_MENSAL.[SISTEMA_ORIGEM_INFORMACAO] as SISTEMA_ORIGEM_INFORMACAO,
        produtividade.TB_CONTROLE_PROCESSO.[MM_REFERENCIA] as MM_REFERENCIA
        
        "))
        ->where('TB_RELACAO_CGC_MACRO_MICRO.NU_CGC', '=', $cgc)
        ->where('TB_RELACAO_CGC_MACRO_MICRO.IC_ATIVO', '=',1)
        ->distinct('idMicro')
        ->get();

    return json_encode($listaMicroProcessoNovo);
}

public function listaAreasComMacroAtividadeNovo()
    {
        $listaAreasComMacroAtividade = DB::select("SELECT 
        distinct REPLICATE('0',4-LEN(RTRIM(NU_CGC))) + RTRIM(NU_CGC) as CGC_UNIDADE
        ,Sigla 
        ,nomeAgencia  as NOME_UNIDADE
        FROM produtividade.TB_RELACAO_CGC_MACRO_MICRO
        INNER JOIN TB_CAPTURA_UNIDADES_ATT  ON TB_CAPTURA_UNIDADES_ATT.codigoAgencia = produtividade.TB_RELACAO_CGC_MACRO_MICRO.NU_CGC
        where produtividade.TB_RELACAO_CGC_MACRO_MICRO.IC_ATIVO = 1
        order by CGC_UNIDADE ASC");
        return json_encode($listaAreasComMacroAtividade);
        
    }

public function montaJsonRelatorioMicroAtividades($unidade)

    {
        $montaJsonRelatorioMicroAtividades = DB::select("select
        ID_MACRO AS ID_MACRO,
        DE_MICRO AS DE_MICRO,
        replace(VOLUME_TOTAL_MES, '.', ',') AS volumeTotalMes,
        replace(VOLUME_REALIZADO_MES, '.', ',') AS VolumeRealizadoMes,
        replace(format(TEMPO_MEDIO_REALIZADO, '0.0'), '.', ',') AS tempoMedioRealizado,
        replace(format(isnull(HORAS_ALOCADAS,'0.0'),'0.0'), '.', ',') AS horasAlocadas,
        replace(format(DESEMPENHO, '0.0'), '.', ',') as desempenho,
        replace(format(isnull(PESSOAS, '0.0'), '0.0'), '.', ',') as pessoas,
        replace(format(UPLOP_BASE, '0.0'), '.', ',') as uplopBase,
        replace(format(UPLOP_PRODUZIDA, '0.0'), '.', ',') AS uplopProduzida,
        replace(format(isnull(PRODUTIVIDADE_UPLOP, '0.0'), '0.0'), '.', ',') as produtividadeUplop,
        replace(format(isnull(HH_NECE_REALIZAR_ESTOQUE,'0.0'),'0.0'), '.', ',') AS horaExtraNecessaria,
        replace(format(TEMPO_MEDIO_NECESSARIO, '0.0'), '.', ',') AS tempoMedioNecessario,
        replace(format(isnull(UPLOAD_DEVIDA, '0.0'), '0.0'), '.', ',') as uplopDevida
        from [produtividade].[TB_SAIDA_MENSAL_MACRO_MICRO]
        where [AUTOMATIZADO] < 5
        and [NU_CGC] =".$unidade);
        return json_encode($montaJsonRelatorioMicroAtividades); 
    }

    public function montaJsonRelatorioAutomatizados($unidade)

    {
        $montaJsonRelatorioMicroAtividades = DB::select("select
        ID_MACRO AS ID_MACRO,
        DE_MICRO AS DE_MICRO,
        replace(VOLUME_TOTAL_MES, '.', ',') AS volumeTotalMes,
        replace(VOLUME_REALIZADO_MES, '.', ',') AS VolumeRealizadoMes,
        replace(format(TEMPO_MEDIO_REALIZADO, '0.0'), '.', ',') AS tempoMedioRealizado,
        replace(format(isnull(HORAS_ALOCADAS,'0.0'),'0.0'), '.', ',') AS horasAlocadas,
        replace(format(DESEMPENHO, '0.0'), '.', ',') as desempenho,
        replace(format(isnull(PESSOAS, '0.0'), '0.0'), '.', ',') as pessoas,
        replace(format(UPLOP_BASE, '0.0'), '.', ',') as uplopBase,
        replace(format(UPLOP_PRODUZIDA, '0.0'), '.', ',') AS uplopProduzida,
        replace(format(isnull(PRODUTIVIDADE_UPLOP, '0.0'), '0.0'), '.', ',') as produtividadeUplop,
        replace(format(isnull(HH_NECE_REALIZAR_ESTOQUE,'0.0'),'0.0'), '.', ',') AS horaExtraNecessaria,
        replace(format(TEMPO_MEDIO_NECESSARIO, '0.0'), '.', ',') AS tempoMedioNecessario,
        replace(format(isnull(UPLOAD_DEVIDA, '0.0'), '0.0'), '.', ',') as uplopDevida
        from [produtividade].[TB_SAIDA_MENSAL_MACRO_MICRO]
        where [AUTOMATIZADO] = 5
        and [NU_CGC] =".$unidade);
        return json_encode($montaJsonRelatorioMicroAtividades); 
    }

    public function montaJsonRelatorioTotais($unidade)

    {
        $montaJsonRelatorioMicroAtividades = DB::select("select
        replace(sum(VOLUME_TOTAL_MES),'.',',') AS volumeTotalMes,
        replace(sum(VOLUME_REALIZADO_MES),'.',',') AS VolumeRealizadoMes,
        replace(format(sum(TEMPO_MEDIO_REALIZADO), '0.0'),'.',',') AS tempoMedioRealizado,
        replace(format(sum(HORAS_ALOCADAS),'0.0'),'.',',') AS horasAlocadas,
        replace(format(AVG(DESEMPENHO), '0.0'),'.',',') as desempenho,
        replace(format(AVG(PESSOAS), '0.0'),'.',',') as pessoas,
        replace(format(AVG(UPLOP_BASE), '0.0'),'.',',') as uplopBase,
        replace(format(sum(UPLOP_PRODUZIDA), '0.0'),'.',',') AS uplopProduzida,
        replace(format(AVG(PRODUTIVIDADE_UPLOP), '0.0'),'.',',') as produtividadeUplop,
        replace(format(sum(HH_NECE_REALIZAR_ESTOQUE),'0.0'),'.',',') AS horaExtraNecessaria,
        replace(format(sum(TEMPO_MEDIO_NECESSARIO),'0.0'),'.',',') AS tempoMedioNecessario,
        replace(format(sum(UPLOAD_DEVIDA), '0.0'),'.',',') as uplopDevida
        from [produtividade].[TB_SAIDA_MENSAL_MACRO_MICRO]
        where [AUTOMATIZADO] = 5
        and [NU_CGC] = ".$unidade);
        return json_encode($montaJsonRelatorioMicroAtividades); 
    }

public function montaJsonRelatorioMacroAtividades($unidade)

    {
        $montaJsonRelatorioMacroAtividades = DB::select("select
        ID_MACRO AS ID_MACRO,
        DE_MACRO AS DE_MACRO,
        replace(sum(VOLUME_TOTAL_MES),'.',',') AS volumeTotalMes,
        replace(sum(VOLUME_REALIZADO_MES),'.',',') AS VolumeRealizadoMes,
        replace(format(sum(TEMPO_MEDIO_REALIZADO), '0.0'),'.',',') AS tempoMedioRealizado,
        replace(format(sum(HORAS_ALOCADAS),'0.0'),'.',',') AS horasAlocadas,
        replace(format(AVG(DESEMPENHO), '0.0'),'.',',') as desempenho,
        replace(format(AVG(PESSOAS), '0.0'),'.',',') as pessoas,
        replace(format(AVG(UPLOP_BASE), '0.0'),'.',',') as uplopBase,
        replace(format(sum(UPLOP_PRODUZIDA), '0.0'),'.',',') AS uplopProduzida,
        replace(format(AVG(PRODUTIVIDADE_UPLOP), '0.0'),'.',',') as produtividadeUplop,
        replace(format(sum(HH_NECE_REALIZAR_ESTOQUE),'0.0'),'.',',') AS horaExtraNecessaria,
        replace(format(sum(TEMPO_MEDIO_NECESSARIO),'0.0'),'.',',') AS tempoMedioNecessario,
        replace(format(sum(UPLOAD_DEVIDA), '0.0'),'.',',') as uplopDevida
        from [produtividade].[TB_SAIDA_MENSAL_MACRO_MICRO]
        where [AUTOMATIZADO] < 5
        and [NU_CGC] =".$unidade."
        group by ID_MACRO,DE_MACRO");
        return json_encode($montaJsonRelatorioMacroAtividades);
    }

public function montaJsonRelatorioCards($unidade)

    {
        $montaJsonRelatorioCards = DB::select("select 
        replace(format(PRODUTIVIDADE_G1, '0.0'),'.',',') as PRODUTIVIDADE,
        replace(format(DESEMPENHO, '0.0'),'.',',') as DESEMPENHO,
        replace(FORMAT(PESSOAS, '0.0'),'.',',') AS PESSOAS,
        replace(format(FTE_APURADA, '0.0'),'.',',') as FTE_APURADA,
        replace(format(FTE_APURADA_MENSURAVEL_G1, '0.0'),'.',',') as FTE_APURADA_MENSURAVEL_G1,
        replace(format(FTE_TECNICA_MENSURAVEL_G1, '0.0'),'.',',') as FTE_TECNICA_MENSURAVEL_G1,
        replace(format(FTE_NAO_MENSURAVEL_G1, '0.0'),'.',',') as FTE_NAO_MENSURAVEL_G1,
        replace(format(GESTOTES, '0.0'),'.',',') as GESTOTES,
        replace(AFASTADOS,'.',',') as AFASTADOS,
        replace(LAP_UNIDADE,'.',',') as LAP_UNIDADE,
        replace(QT_MICRO,'.',',') as QT_MICRO,
        replace(QT_MACRO,'.',',') as QT_MACRO,
        replace(format(QT_HORAS_ALOCADAS_G1, '0.0'),'.',',') as QT_HORAS_ALOCADAS_G1,
        replace(format(QT_UPLOP_POR_HORA_G1, '0.0'),'.',',') as QT_UPLOP_POR_HORA_G1,
        replace(QT_UPLOP_DEVIDA_G1,'.',',') as QT_UPLOP_DEVIDA_G1,
        replace(format(QT_UPLOP_PRODUZIDA_G1, '0.0'),'.',',') as QT_UPLOP_PRODUZIDA_G1,
        replace(QT_UPLOP_DEVIDA_EMPREGADO_G1,'.',',') as QT_UPLOP_DEVIDA_EMPREGADO_G1,
        replace(format(QT_UPLOP_PRODUZIDA_EMPREGADO_G1, '0.0'),'.',',') as QT_UPLOP_PRODUZIDA_EMPREGADO_G1,
        replace(LAP_LIQUIDA_G1,'.',',') as LAP_LIQUIDA_G1,
        replace(format(PRODUTIVIDADE_G2, '0.0'),'.',',') as PRODUTIVIDADE_G2,
        replace(format(QT_UPLOP_DEVIDA_G2, '0.0'),'.',',') as QT_UPLOP_DEVIDA_G2,
        replace(format(QT_UPLOP_PRODUZIDA_G2, '0.0'),'.',',') as QT_UPLOP_PRODUZIDA_G2,
        replace(format(QT_UPLOP_DEVIDA_EMPREGADO_G2, '0.0'),'.',',') as QT_UPLOP_DEVIDA_EMPREGADO_G2,
        replace(format(QT_UPOP_PRODUZIDA_EMPREGADO_G2, '0.0'),'.',',') as QT_UPOP_PRODUZIDA_EMPREGADO_G2,
        replace(format(LAP_LIQUIDA_G2, '0.0'),'.',',') as LAP_LIQUIDA_G2
        from [produtividade].[TB_SAIDA_MENSAL_INDICADORES]
        where NU_CGC =" .$unidade);
        return json_encode($montaJsonRelatorioCards);
    }

public function montaJsonRelatorioCardsGeral()

    {
        $montaJsonRelatorioCards = DB::select("select
        NU_CGC,
        nomeAgencia,
        Sigla,
        format(PRODUTIVIDADE_G1, '0.0') as PRODUTIVIDADE,
        replace(format(DESEMPENHO, '0.0'),'.',',') as DESEMPENHO,
        FORMAT(PESSOAS, '0.0') AS PESSOAS,
        FTE_APURADA,
        FTE_APURADA_MENSURAVEL_G1,
        format(FTE_TECNICA_MENSURAVEL_G1, '0.0') as FTE_TECNICA_MENSURAVEL_G1,
        FTE_NAO_MENSURAVEL_G1,
        GESTOTES,
        AFASTADOS,
        LAP_UNIDADE,
        QT_MICRO,
        QT_MACRO,
        QT_HORAS_ALOCADAS_G1,
        format(QT_UPLOP_POR_HORA_G1, '0.0') as QT_UPLOP_POR_HORA_G1,
        QT_UPLOP_DEVIDA_G1,
        format(QT_UPLOP_PRODUZIDA_G1, '0.0') as QT_UPLOP_PRODUZIDA_G1,
        QT_UPLOP_DEVIDA_EMPREGADO_G1,
        format(QT_UPLOP_PRODUZIDA_EMPREGADO_G1, '0.0') as QT_UPLOP_PRODUZIDA_EMPREGADO_G1,
        LAP_LIQUIDA_G1,
        format(PRODUTIVIDADE_G2, '0.0') as PRODUTIVIDADE_G2,
        format(QT_UPLOP_DEVIDA_G2, '0.0') as QT_UPLOP_DEVIDA_G2,
        format(QT_UPLOP_PRODUZIDA_G2, '0.0') as QT_UPLOP_PRODUZIDA_G2,
        QT_UPLOP_DEVIDA_EMPREGADO_G2,
        format(QT_UPOP_PRODUZIDA_EMPREGADO_G2, '0.0') as QT_UPOP_PRODUZIDA_EMPREGADO_G2,
        LAP_LIQUIDA_G2
        from [produtividade].[TB_SAIDA_MENSAL_INDICADORES]
        join TB_CAPTURA_UNIDADES_ATT 
        ON TB_CAPTURA_UNIDADES_ATT.codigoAgencia = TB_SAIDA_MENSAL_INDICADORES.NU_CGC");
        return json_encode($montaJsonRelatorioCards);
    }

public function montaJsonTotalUnidade($unidade)

    {
        $montaJsonTotalUnidade = DB::select("select
        NU_CGC,
        sum(VOLUME_TOTAL_MES) AS volumeTotalMes,
        sum(VOLUME_REALIZADO_MES) AS VolumeRealizadoMes,
        format(sum(TEMPO_MEDIO_REALIZADO), '0.0') AS tempoMedioRealizado,
        format(sum(HORAS_ALOCADAS),'0.0') AS horasAlocadas,
        AVG(DESEMPENHO) as desempenho,
        format(AVG(PESSOAS), '0.0') as pessoas,
        format(AVG(UPLOP_BASE), '0.0') as uplopBase,
        format(sum(UPLOP_PRODUZIDA), '0.0') AS uplopProduzida,
        format(AVG(PRODUTIVIDADE_UPLOP), '0.0') as produtividadeUplop,
        format(sum(HH_NECE_REALIZAR_ESTOQUE),'0.0') AS horaExtraNecessaria,
        format(sum(TEMPO_MEDIO_NECESSARIO),'0.0') AS tempoMedioNecessario,
        format(sum(UPLOAD_DEVIDA), '0.0') as uplopDevida
        from [produtividade].[TB_SAIDA_MENSAL_MACRO_MICRO]
        where [NU_CGC] =" .$unidade."
        group by NU_CGC");
        return json_encode($montaJsonTotalUnidade);
    }

public function montaJsonNaoMensuraveis($unidade)

    {
        $montaJsonNaoMensuraveis = DB::select("SELECT 
        TB_MICROPROCESSO.ID_MICRO,
        DE_MICRO,
        replace(format(isnull(QTDE_PESSOAS_ALOCADAS, '0.0'), '0.0'), '.', ',') as QTDE_PESSOAS_ALOCADAS
        FROM produtividade.TB_MICROPROCESSO
        JOIN produtividade.TB_RELACAO_CGC_MACRO_MICRO 
        ON produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MICRO = produtividade.TB_MICROPROCESSO.ID_MICRO
        JOIN produtividade.TB_CARGA_MENSAL
        on produtividade.TB_CARGA_MENSAL.ID_AG_MACRO_MICRO = produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_AG_MACRO_MICRO
        where IC_MENSURAVEL = 'N' and 
        TB_RELACAO_CGC_MACRO_MICRO.NU_CGC =".$unidade);
        return json_encode($montaJsonNaoMensuraveis);
    }

public function viewRelatorioVilop()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        try {
        $listaProcesso = DB::table('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS')->where('CGC_UNIDADE', $codigoUnidadeUsuarioSessao)->first();
        $unidadeCGC = $listaProcesso->CGC_UNIDADE;
        $unidadeNome = $listaProcesso->NOME_UNIDADE;

        $resultadoFarolUnidade = DB::select("SELECT [NU_CGC]
        ,[PRODUTIVIDADE_G2]
        ,[DESEMPENHO]
        ,[PESSOAS]
        ,[RESULTADO] = CASE 
                            WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'Sobrecarga'
                            WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                            WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                            WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'Limite'
                            WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Limite'
                            WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Sobrecarga'
                            WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                            WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                            WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS >= 120 then 'sobrecarga'  
                            WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS < 120 then 'LIMITE'  
                      END 
         ,[COR] = CASE 
                            WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'vermelho'
                            WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                            WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                            WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'amarelo'
                            WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'amarelo'
                            WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'vermelho'
                            WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                            WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                            WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS >= 120 then 'vermelho'  
                            WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS < 120 then 'amarelo'  
                      END 
        FROM [produtividade].[TB_SAIDA_MENSAL_INDICADORES]
        where [NU_CGC] = ".$unidadeCGC);
        $cor = null;
        $resultado = null;
        if(!empty($resultadoFarolUnidade)){
            foreach ($resultadoFarolUnidade as &$farol) {
                $cor = $farol->COR;
                $resultado = $farol->RESULTADO;
            }
        }
        
        return view('portal.produtividade-vilop.relatorio', [
            'unidadeCGC' => $unidadeCGC
            ,'unidadeNome' => $unidadeNome
            ,'cor' => $cor
            ,'resultado' => $resultado
        ]);
        }catch (\Throwable $th) {
            $codigoUnidadeUsuarioSessao = str_pad($codigoUnidadeUsuarioSessao, 4, '0', STR_PAD_LEFT);
            $listaProcesso = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $codigoUnidadeUsuarioSessao)->first();
            $unidadeCGC =  $codigoUnidadeUsuarioSessao;
            $unidadeNome = $listaProcesso->nomeAgencia;

            $resultadoFarolUnidade = DB::select("      SELECT [NU_CGC]
            ,[PRODUTIVIDADE_G2]
            ,[DESEMPENHO]
            ,[PESSOAS]
            ,[RESULTADO] = CASE 
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'Sobrecarga'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'Limite'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Limite'
                                WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Sobrecarga'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS >= 120 then 'sobrecarga'  
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS < 120 then 'LIMITE'  
                          END 
             ,[COR] = CASE 
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'vermelho'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'amarelo'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'amarelo'
                                WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'vermelho'
                                WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                                WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS >= 120 then 'vermelho'  
                                WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS < 120 then 'amarelo'  
                          END 
            FROM [produtividade].[TB_SAIDA_MENSAL_INDICADORES]
            where [NU_CGC] = ".$unidadeCGC);
            $cor = null;
            $resultado = null;
            if(!empty($resultadoFarolUnidade)){
                foreach ($resultadoFarolUnidade as &$farol) {
                    $cor = $farol->COR;
                    $resultado = $farol->RESULTADO;
                }
            }

            return view('portal.produtividade-vilop.relatorio', [
                'unidadeCGC' => $unidadeCGC
                ,'unidadeNome' => $unidadeNome
                ,'cor' => $cor
                ,'resultado' => $resultado
            ]);

        }
    }

public function resultadoFarolUnidade($unidade)

{
    $resultadoFarolUnidade = DB::select("SELECT [NU_CGC]
    ,[PRODUTIVIDADE_G2]
    ,[DESEMPENHO]
    ,[PESSOAS]
    ,[RESULTADO] = CASE 
                        WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'Sobrecarga'
                        WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                        WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'Sobrecarga'
                        
                        WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'Limite'
                        WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Limite'
                        WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'Sobrecarga'
                        
                        WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                        WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'Receptora de Processos'
                        WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS > 120 then 'LIMITE'  
                  END 

	 ,[COR] = CASE 
                        WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] >= 120 THEN 'vermelho'
                        WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                        WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] >= 120 then 'vermelho'
                        
                        WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120 then 'amarelo'
                        WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'amarelo'
                        WHEN [DESEMPENHO] < 95 and [PRODUTIVIDADE_G2] BETWEEN 95 AND 120  then 'vermelho'
                        
                        WHEN [DESEMPENHO] = 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                        WHEN [DESEMPENHO] BETWEEN 95 AND 100 AND [PRODUTIVIDADE_G2] < 95 then 'verde'
                        WHEN [DESEMPENHO] < 95 AND [PRODUTIVIDADE_G2] < 95 and PESSOAS > 120 then 'amarelo'  
                  END 
    FROM [produtividade].[TB_SAIDA_MENSAL_INDICADORES]
    where [NU_CGC] = ".$unidade);
    return json_encode($resultadoFarolUnidade);
}

    public function TotalNaoMensuraveis($unidade)

    {
        $montaJsonNaoMensuraveis = DB::select("SELECT 
		replace(format(sum(QTDE_PESSOAS_ALOCADAS), '0.0'),'.',',') as totalNaoMensuravel 
        FROM produtividade.TB_MICROPROCESSO
        JOIN produtividade.TB_RELACAO_CGC_MACRO_MICRO 
        ON produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MICRO = produtividade.TB_MICROPROCESSO.ID_MICRO
        JOIN produtividade.TB_CARGA_MENSAL
        on produtividade.TB_CARGA_MENSAL.ID_AG_MACRO_MICRO = produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_AG_MACRO_MICRO
        where IC_MENSURAVEL = 'N' and 
        TB_RELACAO_CGC_MACRO_MICRO.NU_CGC =".$unidade);
        return json_encode($montaJsonNaoMensuraveis);
    }

    public function TotalOrganogramaSN()

    {
        $TotalOrganograma = DB::select("select
        [nomeSr],
        [codigoSr],
        replace(format(avg(PRODUTIVIDADE_G2), '0.0'),'.',',') as PRODUTIVIDADE,
        replace(format(avg(DESEMPENHO), '0.0'),'.',',') as DESEMPENHO,
        replace(FORMAT(avg(PESSOAS), '0.0'),'.',',') AS PESSOAS,
        replace(avg(FTE_APURADA),'.',',') as totalFTEAPURADA,
        sum(LAP_UNIDADE) as totalLAP
        from [produtividade].[TB_SAIDA_MENSAL_INDICADORES]
        join TB_CAPTURA_UNIDADES_ATT 
        ON TB_CAPTURA_UNIDADES_ATT.codigoAgencia = TB_SAIDA_MENSAL_INDICADORES.NU_CGC
        group by [codigoSr],[nomeSr]");

        return json_encode($TotalOrganograma);
    }
        
}
