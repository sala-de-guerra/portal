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

class produtividadeVilopController extends Controller
{
    public function index()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        try {
        $listaProcesso = DB::table('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS')->where('CGC_UNIDADE', $codigoUnidadeUsuarioSessao)->first();
        $unidadeCGC = $listaProcesso->CGC_UNIDADE;
        $unidadeNome = $listaProcesso->NOME_UNIDADE;
        return view('portal.produtividade-vilop.index', [
             'unidadeCGC' => $unidadeCGC
            ,'unidadeNome' => $unidadeNome
        ]);
        }catch (\Throwable $th) {
            $codigoUnidadeUsuarioSessao = str_pad($codigoUnidadeUsuarioSessao, 4, '0', STR_PAD_LEFT);
            $listaProcesso = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $codigoUnidadeUsuarioSessao)->first();
            $unidadeCGC =  $codigoUnidadeUsuarioSessao;
            $unidadeNome = $listaProcesso->nomeAgencia;
            return view('portal.produtividade-vilop.index', [
                 'unidadeCGC' => $unidadeCGC
                ,'unidadeNome' => $unidadeNome
            ]);
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

    public function dashboard()
    {

        return view('portal.produtividade-vilop.dashboard');
        
    }

    public function viewMicroatividade($idMacro)
    {
        $listaProcesso = DB::table('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS')->where('IdMacro', $idMacro)->first();
        $unidadeCGC         = $listaProcesso->CGC_UNIDADE;
        $unidadeNome        = $listaProcesso->NOME_UNIDADE;
        $nomeMacroAtividade = $listaProcesso->NOME_MACROATIVIDADE;
        $IdMacro            = $idMacro;
        return view('portal.produtividade-vilop.microatividades', [
            'unidadeCGC' => $unidadeCGC
           ,'unidadeNome' => $unidadeNome
           ,'nomeMacroAtividade' => $nomeMacroAtividade
           ,'idMacro' => $IdMacro
       ]);
    }

    public function viewListaUnidades()
    {

        return view('portal.produtividade-vilop.lista-unidades');
    }

    public function viewUploadEmLote()
    {

        return view('portal.produtividade-vilop.upload-de-atividade');
    }

    public function listaMacroProcesso($cgc)
    {
        $listaProcesso = MacroProcesso::with('microAtividades')->where('CGC_UNIDADE', $cgc)
        ->where('EXCLUIDO_USUARIO', 'N')
        ->orderBy('NOME_MACROATIVIDADE', 'ASC')->get();
        return response()->json($listaProcesso, 200);
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


    public function createMacroProcessoVilop(Request $request)
    {
        try {
            DB::beginTransaction();
            $novaMacroAtividadeVilop = new MacroProcesso;
            $novaMacroAtividadeVilop->CGC_UNIDADE                       = $request->cgcUnidade;
            $novaMacroAtividadeVilop->NOME_UNIDADE                      = $request->nomeUnidade;
            $novaMacroAtividadeVilop->NOME_MACROATIVIDADE               = $request->nomeMacroAtividade;
            $novaMacroAtividadeVilop->EXCLUIDO_USUARIO                  = 'N';
            $novaMacroAtividadeVilop->MATRICULA_RESPONSAVEL_RESPOSTA    = session('matricula');
            $novaMacroAtividadeVilop->DATA_RESPOSTA                     = date("Y-m-d H:i:s", time());
            $novaMacroAtividadeVilop->save();

            DB::commit();

            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro realizado!");
            $request->session()->flash('corpoMensagem', "O cadastro foi realizado com sucesso.");
            
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

    public function createMicroProcessoVilop($idMacro, Request $request)
    {
        
        
       
        try {
            DB::beginTransaction();
            $novaMicroAtividadeVilop = new MicroProcesso;
            $novaMicroAtividadeVilop->NOME_MICROATIVIDADE             = $request->nomeMicroAtividade;
            $novaMicroAtividadeVilop->IdMacroProcesso                 = $idMacro;
            $novaMicroAtividadeVilop->MENSURAVEL                      = $request->mensuravel;
            if (isset($request->volumeTotalDemanda)){
                $novaMicroAtividadeVilop->VOLUME_TOTAL_DEMANDA        = $request->volumeTotalDemanda;
            }else{
                $novaMicroAtividadeVilop->VOLUME_TOTAL_DEMANDA        = 0;
            }
            if (isset($request->volumeTotalTratada)){
                $novaMicroAtividadeVilop->VOLUME_TOTAL_TRATADA        = $request->volumeTotalTratada;
            }else{
                $novaMicroAtividadeVilop->VOLUME_TOTAL_TRATADA        = 0;
            }
            if (isset($request->periodoTratadoDe)){
                $periodoTratadoDe  = str_replace("/", '-', $request->periodoTratadoDe);
                $novaMicroAtividadeVilop->PERIODO_TRATADO_DE         =date("Y-m-d", strtotime($periodoTratadoDe));
            }
            if (isset($request->periodoTratadoate)){
                $periodoTratadoate = str_replace("/", '-', $request->periodoTratadoate);
                $novaMicroAtividadeVilop->PERIODO_TRATADO_ATE        =date("Y-m-d", strtotime($periodoTratadoate));
            }
            if (isset($request->mediaDia)){
                $novaMicroAtividadeVilop->MEDIA_DIA                  = $request->mediaDia;
            }else{
                $novaMicroAtividadeVilop->MEDIA_DIA                  = 0;
            }
            if (isset($request->tempoEmMinutos)){
                $novaMicroAtividadeVilop->TEMPO_EM_MINUTOS           = $request->tempoEmMinutos;
            }else{
                $novaMicroAtividadeVilop->TEMPO_EM_MINUTOS           = 0;
            }

            $novaMicroAtividadeVilop->NIVEL_COMPLEXIDADE              = $request->nivelComplexidade;
            $novaMicroAtividadeVilop->NIVEL_AUTOMACAO                 = $request->nivelAutomacao;
            $novaMicroAtividadeVilop->GRAU_CRITICIDADE                = $request->grauCriticidade;
            $novaMicroAtividadeVilop->GRAU_PADRONIZACAO               = $request->grauPadronizacao;
            $novaMicroAtividadeVilop->GRAU_AUTONOMIA                  = $request->grauAutonomia;
            $novaMicroAtividadeVilop->SISTEMA_ORIGEM_INFORMACAO       = $request->sistemaOrigemInformacao;
            $novaMicroAtividadeVilop->EXCLUIDO_USUARIO                = 'N';
            $novaMicroAtividadeVilop->QTDE_PESSOAS_ALOCADAS           = $request->quantidadePessoasAlocadas;
            $novaMicroAtividadeVilop->RESPONSAVEL_CADASTRO_MICROATIVIDADE   = session('matricula');
            $novaMicroAtividadeVilop->save();

            DB::commit();

            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro realizado!");
            $request->session()->flash('corpoMensagem', "O cadastro foi realizado com sucesso.");
            
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Não foi possivel gravar, tente mais tarde!!!!");
        }
        return redirect("/produtividade-vilop/$request->unidadeCGC");  
    }

    public function updateMicroProcessoVilop($IdMicro, Request $request)
    {
        try {
            
            DB::beginTransaction();
            $updateMicroProcesso = MicroProcesso::find($IdMicro);
    
            if (isset($request->nomeMicroAtividade)){
                $updateMicroProcesso->NOME_MICROATIVIDADE  = $request->nomeMicroAtividade;
            }
            if ($request->excluirMicroAtividade == 'excluir'){
                $updateMicroProcesso->EXCLUIDO_USUARIO  = 'S';
                $updateMicroProcesso->MATRICULA_RESPONSAVEL_EXCLUSAO  =  session('matricula');       
            }
            if (isset($request->mensuravel)){
                $updateMicroProcesso->MENSURAVEL      = $request->mensuravel;
            }
            if (isset($request->volumeTotalDemanda)){
                $updateMicroProcesso->VOLUME_TOTAL_DEMANDA        = $request->volumeTotalDemanda;
            }
            if (isset($request->volumeTotalTratada)){
                $updateMicroProcesso->VOLUME_TOTAL_TRATADA        = $request->volumeTotalTratada;
            }
            if (isset($request->periodoTratadoDe)){
                $periodoTratadoDe  = str_replace("/", '-', $request->periodoTratadoDe);
                $updateMicroProcesso->PERIODO_TRATADO_DE        = date("Y-m-d", strtotime($periodoTratadoDe));
            }
            if (isset($request->periodoTratadoate)){
                $periodoTratadoate = str_replace("/", '-', $request->periodoTratadoate);
                $updateMicroProcesso->PERIODO_TRATADO_ATE        = date("Y-m-d", strtotime($periodoTratadoate));
            }
            if (isset($request->mediaDia)){
                $updateMicroProcesso->MEDIA_DIA                  = $request->mediaDia;
            }
            if (isset($request->tempoEmMinutos)){
                $updateMicroProcesso->TEMPO_EM_MINUTOS           = $request->tempoEmMinutos;
            }
            if (isset($request->nivelComplexidade)){
                $updateMicroProcesso->NIVEL_COMPLEXIDADE         = $request->nivelComplexidade;
            }
            if (isset($request->nivelAutomacao)){
                $updateMicroProcesso->NIVEL_AUTOMACAO            = $request->nivelAutomacao;
            }
            if (isset($request->grauCriticidade)){
                $updateMicroProcesso->GRAU_CRITICIDADE           = $request->grauCriticidade;
            }
            if (isset($request->grauPadronizacao)){
                $updateMicroProcesso->GRAU_PADRONIZACAO          = $request->grauPadronizacao;
            }
            if (isset($request->grauAutonomia)){
                $updateMicroProcesso->GRAU_AUTONOMIA             = $request->grauAutonomia;
            }
            if (isset($request->sistemaOrigemInformacao)){
                $updateMicroProcesso->SISTEMA_ORIGEM_INFORMACAO  = $request->sistemaOrigemInformacao;
            }
            if (isset($request->quantidadePessoasAlocadas)){
                $updateMicroProcesso->QTDE_PESSOAS_ALOCADAS  = $request->quantidadePessoasAlocadas;
            }

            $updateMicroProcesso->save();

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

    public function deleteMacroProcessoVilop($IdMacro, Request $request)
    {
        try {
            DB::beginTransaction();
            $updateMacroProcesso = MacroProcesso::find($IdMacro);
            $updateMacroProcesso->EXCLUIDO_USUARIO  = 'S';
            $updateMacroProcesso->MATRICULA_RESPONSAVEL_EXCLUSAO  =  session('matricula'); 
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
        return back();
    }

    public function criaPlanilhaExcelVilopGeral()
    {
        return Excel::download(new criaExcelVilop, 'Produtividade_Vilop_Geral.xlsx');
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
            Excel::import(new produtividadeVilopImport,request()->file('arquivo'));

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
        
        return back();
    }

    public function listaDadosDeUpload()
    {
    $listaAreasComMacroAtividade = DB::select("SELECT distinct
        [CGC_UNIDADE]
       ,[NOME_UNIDADE]
       ,[MATRICULA_RESPONSAVEL_UPLOAD]
       ,[DATA_UPLOAD]
    FROM [TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS]
    inner join TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso
    where DATA_UPLOAD IS NOT NULL
    order by DATA_UPLOAD ASC");
    
    return json_encode($listaAreasComMacroAtividade);      
    }

    public function listaDadosMacroatividade()
    {
    $listaDadosMacroatividade = DB::select("SELECT 
    [CGC_UNIDADE]
    ,[NOME_UNIDADE]
    ,[NOME_MACROATIVIDADE]
    ,[MATRICULA_RESPONSAVEL_RESPOSTA]
    ,[DATA_RESPOSTA]
    FROM [7257_DES].[dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS]
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
    FROM [7257_DES].[dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS]
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
    FROM [7257_DES].[dbo].[TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS] 
    inner join TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso
    where [TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS].CGC_UNIDADE = $unidade");
    
    return json_encode($dadosIndicadoresMicro);      
    }
       
         
}
