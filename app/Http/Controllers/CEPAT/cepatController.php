<?php


namespace App\Http\Controllers\CEPAT;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Classes\DiasUteisClass;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\Cepat\MacroProcesso;
use App\Models\Cepat\MicroProcesso;
use App\Models\Cepat\AtividadeDaMicro;
use App\Exports\criaExcelCepatUnidade;

class cepatController extends Controller
{
    public function index()
    {

        $codigoUnidadeUsuarioSessao = '7077';
        try {
        $listaProcesso = DB::table('TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS')->where('CGC_UNIDADE', $codigoUnidadeUsuarioSessao)->first();
        $unidadeCGC = $listaProcesso->CGC_UNIDADE;
        $unidadeNome = $listaProcesso->NOME_UNIDADE;
        return view('portal.produtividade-cepat.index', [
             'unidadeCGC' => $unidadeCGC
            ,'unidadeNome' => $unidadeNome
        ]);
        }catch (\Throwable $th) {
            $codigoUnidadeUsuarioSessao = str_pad($codigoUnidadeUsuarioSessao, 4, '0', STR_PAD_LEFT);
            $listaProcesso = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $codigoUnidadeUsuarioSessao)->first();
            $unidadeCGC =  $codigoUnidadeUsuarioSessao;
            $unidadeNome = $listaProcesso->nomeAgencia;
            return view('portal.produtividade-cepat.index', [
                 'unidadeCGC' => $unidadeCGC
                ,'unidadeNome' => $unidadeNome
            ]);
        }

    }

    public function indexCepat($cgc, Request $request)
    {
        try {
            $listaProcesso = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', $cgc)->first();
            $unidadeCGC =  $cgc;
            $unidadeNome = $listaProcesso->nomeAgencia;
            return view('portal.produtividade-cepat.index', [
                 'unidadeCGC' => $unidadeCGC
                ,'unidadeNome' => $unidadeNome
            ]);
        }catch (\Throwable $th) {
            
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Unidade inexistente!!!");
            return redirect ('produtividade-cepat/');
        }
    }

    public function dashboard()
    {

        return view('portal.produtividade-cepat.dashboard');
        
    }
        
    public function viewMicroatividade($idMacro)
    {
        $listaProcesso = DB::table('TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS')->where('IdMacro', $idMacro)->first();
        $unidadeCGC         = $listaProcesso->CGC_UNIDADE;
        $unidadeNome        = $listaProcesso->NOME_UNIDADE;
        $nomeMacroAtividade = $listaProcesso->NOME_MACROATIVIDADE;
        $IdMacro            = $idMacro;
        return view('portal.produtividade-cepat.microatividades', [
            'unidadeCGC' => $unidadeCGC
           ,'unidadeNome' => $unidadeNome
           ,'nomeMacroAtividade' => $nomeMacroAtividade
           ,'idMacro' => $IdMacro
       ]);
    }

    public function viewListaUnidades()
    {

        return view('portal.produtividade-cepat.lista-unidades');
    }

    public function viewUploadEmLote()
    {

        return view('portal.produtividade-cepat.upload-de-atividade');
    }

    public function listaMacroProcesso($cgc)
    {
        $listaProcesso = MacroProcesso::with('microAtividades','microAtividades.atividadeDaMicro')->where('CGC_UNIDADE', $cgc)
        ->where('EXCLUIDO_USUARIO', 'N')
        ->orderBy('NOME_MACROATIVIDADE', 'ASC')->get();
        return response()->json($listaProcesso, 200);
    }

    public function listaAreasComMacroAtividade()
    {
        $listaAreasComMacroAtividade = DB::select("SELECT distinct 
        CGC_UNIDADE,NOME_UNIDADE 
	   ,Sigla
		FROM [TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS]
		INNER JOIN TB_CAPTURA_UNIDADES_ATT  ON TB_CAPTURA_UNIDADES_ATT.codigoAgencia = TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS.CGC_UNIDADE
		where TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS.EXCLUIDO_USUARIO = 'N'
        order by CGC_UNIDADE ASC");
        return json_encode($listaAreasComMacroAtividade);
        
    }


    public function createMacroProcessoCepat(Request $request)
    {
        try {
            DB::beginTransaction();
            $novaMacroAtividadeCepat = new MacroProcesso;
            $novaMacroAtividadeCepat->CGC_UNIDADE                       = $request->cgcUnidade;
            $novaMacroAtividadeCepat->NOME_UNIDADE                      = $request->nomeUnidade;
            $novaMacroAtividadeCepat->NOME_MACROATIVIDADE               = $request->nomeMacroAtividade;
            $novaMacroAtividadeCepat->EXCLUIDO_USUARIO                  = 'N';
            $novaMacroAtividadeCepat->MATRICULA_RESPONSAVEL_RESPOSTA    = session('matricula');
            $novaMacroAtividadeCepat->DATA_RESPOSTA                     = date("Y-m-d H:i:s", time());
            $novaMacroAtividadeCepat->save();

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

    public function createMicroProcessoCepat($idMacro, Request $request)
    {
          
        try {
            DB::beginTransaction();

            $novaMicroAtividadeCepat = new MicroProcesso;
            $novaMicroAtividadeCepat->NOME_MICROATIVIDADE             = $request->nomeMicroAtividade;
            $novaMicroAtividadeCepat->IdMacroProcesso                 = $idMacro;
            $novaMicroAtividadeCepat->MENSURAVEL                      = $request->mensuravel;
            if (isset($request->volumeTotalDemanda)){
                $novaMicroAtividadeCepat->VOLUME_TOTAL_DEMANDA        = $request->volumeTotalDemanda;
            }else{
                $novaMicroAtividadeCepat->VOLUME_TOTAL_DEMANDA        = 0;
            }
            if (isset($request->volumeTotalTratada)){
                $novaMicroAtividadeCepat->VOLUME_TOTAL_TRATADA        = $request->volumeTotalTratada;
            }else{
                $novaMicroAtividadeCepat->VOLUME_TOTAL_TRATADA        = 0;
            }
            if (isset($request->periodoTratadoDe)){
                $periodoTratadoDe  = str_replace("/", '-', $request->periodoTratadoDe);
                $novaMicroAtividadeCepat->PERIODO_TRATADO_DE         =date("Y-m-d", strtotime($periodoTratadoDe));
            }
            if (isset($request->periodoTratadoate)){
                $periodoTratadoate = str_replace("/", '-', $request->periodoTratadoate);
                $novaMicroAtividadeCepat->PERIODO_TRATADO_ATE        =date("Y-m-d", strtotime($periodoTratadoate));
            }
            if (isset($request->mediaDia)){
                $novaMicroAtividadeCepat->MEDIA_DIA                  = $request->mediaDia;
            }else{
                $novaMicroAtividadeCepat->MEDIA_DIA                  = 0;
            }
            if (isset($request->tempoEmMinutos)){
                $novaMicroAtividadeCepat->TEMPO_EM_MINUTOS           = $request->tempoEmMinutos;
            }else{
                $novaMicroAtividadeCepat->TEMPO_EM_MINUTOS           = 0;
            }

            $novaMicroAtividadeCepat->NIVEL_COMPLEXIDADE              = $request->nivelComplexidade;
            $novaMicroAtividadeCepat->NIVEL_AUTOMACAO                 = $request->nivelAutomacao;
            $novaMicroAtividadeCepat->GRAU_CRITICIDADE                = $request->grauCriticidade;
            $novaMicroAtividadeCepat->GRAU_PADRONIZACAO               = $request->grauPadronizacao;
            $novaMicroAtividadeCepat->GRAU_AUTONOMIA                  = $request->grauAutonomia;
            $novaMicroAtividadeCepat->SISTEMA_ORIGEM_INFORMACAO       = $request->sistemaOrigemInformacao;
            $novaMicroAtividadeCepat->EXCLUIDO_USUARIO                = 'N';
            $novaMicroAtividadeCepat->QTDE_PESSOAS_ALOCADAS           = $request->quantidadePessoasAlocadas;
            $novaMicroAtividadeCepat->RESPONSAVEL_CADASTRO_MICROATIVIDADE   = session('matricula');
            $novaMicroAtividadeCepat->save();
            
            $getMicro = DB::table('TBL_PRODUTIVIDADE_CEPAT_TBL_MICROPROCESSOS')->where('NOME_MICROATIVIDADE', $request->nomeMicroAtividade)
            ->where('IdMacroProcesso', $idMacro)
            ->first();
            $idMicro = $getMicro->idMicro;
            if (isset($request->atividade1)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade1;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade2)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade2;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade3)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade3;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade4)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade4;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade5)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade5;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade6)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade6;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade7)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade7;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade8)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade8;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade9)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade9;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade10)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade10;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade11)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade11;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }
            if (isset($request->atividade12)){
                $novaAtividade = new AtividadeDaMicro;
                $novaAtividade->NOME_ATIVIDADE = $request->atividade12;
                $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
                $novaAtividade->idMicro = $idMicro;
                $novaAtividade->save();
            }


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
        return redirect("/produtividade-cepat/$request->unidadeCGC");  
    }

    public function updateMicroProcessoCepat($IdMicro, Request $request)
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

    public function deleteMacroProcessoCepat($IdMacro, Request $request)
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

    public function criaPlanilhaExcelCepatGeral()
    {
        return Excel::download(new criaExcelCepat, 'Produtividade_Cepat_Geral.xlsx');
    }

    public function criaPlanilhaExcelCepatUnidade($unidade)
    {
        return Excel::download(new criaExcelCepatUnidade($unidade), 'Produtividade_Cepat_Unidade.xlsx');
    }

    public function import(Request $request) 
    {
        try {
            
            $pathtofile = ($_FILES['arquivo']['name']);
           
            $info = pathinfo($pathtofile);
            if ($info["extension"] == "xlsx" || $info["extension"] == "xls"){
            Excel::import(new produtividadeCepatImport,request()->file('arquivo'));

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
    FROM [TBL_PRODUTIVIDADE_CEPAT_TBL_MICROPROCESSOS]
    inner join TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS ON TBL_PRODUTIVIDADE_CEPAT_TBL_MACROPROCESSOS.IdMacro = TBL_PRODUTIVIDADE_CEPAT_TBL_MICROPROCESSOS.IdMacroProcesso
    where DATA_UPLOAD IS NOT NULL
    order by DATA_UPLOAD ASC");
    
    return json_encode($listaAreasComMacroAtividade);      
    }

    public function novaAtividade($idMicro, Request $request)
    {
        try {
        $novaAtividade = new AtividadeDaMicro;
        $novaAtividade->NOME_ATIVIDADE = $request->nomeAtividade;
        $novaAtividade->RESPONSAVEL_CADASTRO_ATIVIDADE = session('matricula');
        $novaAtividade->idMicro = $idMicro;
        $novaAtividade->save();
        
        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Alteração realizada!");
        $request->session()->flash('corpoMensagem', "A alteração foi realizada com sucesso.");
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();

            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "ERRO");
            $request->session()->flash('corpoMensagem', "Não foi gravar, tente mais tarde!!!!");
    }
    return back();
        
    }
        
         
}

