<?php

namespace App\Http\Controllers;

use App\Classes\DiasUteisClass;
use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\GestaoEquipesAtividadesController;
use App\Models\Atende;
use App\Models\BaseSimov;
use App\Models\GestaoEquipesAtividades;
use App\Models\ModeloMensagem;
use App\Models\GestaoEquipesAtividadesResponsaveis;
use App\Models\GestaoEquipesCelulas;
use App\Models\GestaoEquipesLogHistorico;
use App\Models\HistoricoPortalGilie;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class AtendeDemandasController extends Controller
{
    /**
     *
     * @param  int  $idAtende
     * @return \Illuminate\Http\Response
     */
 
    public function listarDadosDemandaAtende($idAtende)
    {
        $dadosAtende = Atende::find($idAtende);

        return json_encode([
            'idAtende' => $dadosAtende->idAtende,
            'idEquipe' => $dadosAtende->idEquipe,
            'nomeEquipe' => $dadosAtende->gestaoEquipeCelulas->nomeEquipe,
            'idAtividade' => $dadosAtende->idAtividade,
            'nomeAtividade' => $dadosAtende->gestaoEquipesAtividades->nomeAtividade,
            'contratoFormatado' => $dadosAtende->contratoFormatado,
            'numeroContrato' => $dadosAtende->numeroContrato,
            'assuntoAtende' => $dadosAtende->assuntoAtende,
            'descricaoAtende' => $dadosAtende->descricaoAtende,
            'motivoRedirecionamento' => $dadosAtende->motivoRedirecionamento,
        ]);
    }

    public function viewMinhasDemandas()
    {
        return view ('portal.atende.minhas-demandas');
        
    }
    public function viewMinhasDemandasAgencia()
    {
        return view ('portal.atende.minhas-demandas-visualizacao-agencia');
        
    }
    public function viewGerenciarDemandas()
    {
        return view('portal.gerencial.gestao-atende');
        
    }
    public function tratarDemanda($id)
    {
        $listaDemandasAtende = Atende::find($id);
        if (isset($listaDemandasAtende)){
            return view('portal.atende.tratar-atende', compact('listaDemandasAtende'));
        }
        return redirect ('/atende/minhas-demandas'); 
    }
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function listarAtendesDisponiveisResponsavel()
    {
        $listaDemandasAtende = Atende::where('matriculaResponsavelAtividade', session('matricula'))->where('statusAtende', '!=', 'FINALIZADO')->orderBy('prazoAtendimentoAtende')->get();
        $arrayDemandasResponsavel = [];
        if (!$listaDemandasAtende->isEmpty()) {
            foreach ($listaDemandasAtende as $demanda) {
                $dadosMacroAtividade = GestaoEquipesAtividades::find($demanda->gestaoEquipesAtividades->idAtividadeSubordinante);
                array_push($arrayDemandasResponsavel, [
                    'idAtende'                  => $demanda->idAtende,
                    'idEquipe'                  => $demanda->idEquipe,
                    'nomeEquipe'                => $demanda->gestaoEquipeCelulas->nomeEquipe,
                    'idMacroAtividade'          => $demanda->gestaoEquipesAtividades->idAtividadeSubordinante,
                    'nomeMacroAtividade'        => $dadosMacroAtividade !== null ? $dadosMacroAtividade->nomeAtividade : null,
                    'idAtividade'               => $demanda->idAtividade,
                    'nomeAtividade'             => $demanda->gestaoEquipesAtividades->nomeAtividade,
                    'contratoFormatado'         => $demanda->contratoFormatado,
                    'numeroContrato'            => $demanda->numeroContrato,
                    'assuntoAtende'             => $demanda->assuntoAtende,
                    'descricaoAtende'           => $demanda->descricaoAtende,
                    'prazoAtendimentoAtende'    => $demanda->prazoAtendimentoAtende,
                    'motivoRedirecionamento'    => $demanda->motivoRedirecionamento,
                    'emailContatoResposta'      => $demanda->emailContatoResposta,
                    'emailContatoCopia'             => $demanda->emailContatoCopia,
                    'emailContatoNovaCopia'         => $demanda->emailContatoNovaCopia,
                ]);
            }
        }
        return json_encode($arrayDemandasResponsavel);
    }
    public function listarAtendesAbertoAgencia()
    {
        $listaDemandasAtende = Atende::where('matriculaCriadorDemanda', session('matricula'))
        ->where('statusAtende', '!=','FINALIZADO')->get();

        return json_encode($listaDemandasAtende);
    }

    public function listarAtendesFinalizadoAgencia()
    {
        $listaDemandasAtende = Atende::where('matriculaCriadorDemanda', session('matricula'))
        ->where('statusAtende', 'FINALIZADO')->get();

        return json_encode($listaDemandasAtende);
    }

    public function listarEquipesComAtividadesAtende()
    {
        try {
            DB::beginTransaction();
            $arrayEquipesComAtividadesAtende = [];
            $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
            // $unidadeUsuario = '7257';

            // LISTAR EQUIPES
            $listaEquipes = GestaoEquipesCelulas::where('ativa', true)->where('incluirEquipeAtende', true)->get();
            foreach ($listaEquipes as $equipe) {
                // if ($equipe->codigoUnidadeEquipe == '7257'){
                //     $equipe->codigoUnidadeEquipe = 'GILIE/SP';
                // }
                switch ($equipe->codigoUnidadeEquipe){
                    case $equipe->codigoUnidadeEquipe = 7109:
                        $equipe->codigoUnidadeEquipe = "GILIE/BR";
                        break;
                    case $equipe->codigoUnidadeEquipe = 7242:
                        $equipe->codigoUnidadeEquipe = "GILIE/BU";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7243:
                        $equipe->codigoUnidadeEquipe = "GILIE/BE";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7244:
                        $equipe->codigoUnidadeEquipe = "GILIE/BH";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7247:
                        $equipe->codigoUnidadeEquipe = "GILIE/CT";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7248:
                        $equipe->codigoUnidadeEquipe = "GILIE/FO";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7249:
                        $equipe->codigoUnidadeEquipe = "GILIE/GO";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7251:
                        $equipe->codigoUnidadeEquipe = "GILIE/PO";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7253:
                        $equipe->codigoUnidadeEquipe = "GILIE/RE";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7254:
                        $equipe->codigoUnidadeEquipe = "GILIE/RJ";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7255:
                        $equipe->codigoUnidadeEquipe = "GILIE/SA";
                    break;
                    case $equipe->codigoUnidadeEquipe = 7257:
                        $equipe->codigoUnidadeEquipe = "GILIE/SP";
                    break;
                    default:
                    $equipe->codigoUnidadeEquipe = null;                  
                }
                $arrayAtividadesEquipe = [];
                // LISTAR MACROATIVIDADES
                $listaMacroAtividadesEquipe = GestaoEquipesAtividades::where('idEquipe', $equipe->idEquipe)->where('atividadeAtiva', true)->where('incluirAtividadeAtende', true)->get();
                foreach ($listaMacroAtividadesEquipe as $macroAtividade) {
                    if ($macroAtividade->atividadeSubordinada == false) {
                        if ($macroAtividade->idAtividadeSubordinante == null) {
                            // LISTAR MICROATIVIDADES
                            $arrayMicroAtividades = self::listaMicroAtividades($macroAtividade->idAtividade);
                            array_push($arrayAtividadesEquipe, [
                                'idAtividade'               => $macroAtividade->idAtividade,
                                'idEquipe'                  => $macroAtividade->idEquipe,
                                'nomeAtividade'             => $macroAtividade->nomeAtividade,
                                'sinteseAtividade'          => $macroAtividade->sinteseAtividade,
                                'iconeAtividade'            => $macroAtividade->iconeAtividade,
                                'prazoAtendimento'          => $macroAtividade->prazoAtendimento,
                                'microAtividade'            => $arrayMicroAtividades,

                            ]);
                        } else {
                            array_push($arrayAtividadesEquipe, [
                                'idAtividade'               => $macroAtividade->idAtividade,
                                'nomeAtividade'             => $macroAtividade->nomeAtividade,
                                'sinteseAtividade'          => $macroAtividade->sinteseAtividade,
                                'iconeAtividade'            => $macroAtividade->iconeAtividade,
                                'prazoAtendimento'          => $macroAtividade->prazoAtendimento,
                            ]);
                        }
                    }
                }
                $arrayDadosEquipe = [
                    'Unidade'       => $equipe->codigoUnidadeEquipe,
                    'idEquipe'      => $equipe->idEquipe,
                    'nomeEquipe'    => $equipe->nomeEquipe,
                    'iconeEquipe'   => $equipe->iconeEquipe,
                    'prazoAtendimento' => $equipe->prazoAtendimento,
                    'atividades'    => $arrayAtividadesEquipe
                  
                ];
                array_push($arrayEquipesComAtividadesAtende, $arrayDadosEquipe);
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return json_encode($arrayEquipesComAtividadesAtende);
    }

    public static function listaMicroAtividades($idAtividadeSubordinante) {
        $arrayAtividadesSubordinadas = [];
        $listaAtividadesSubordinadas = GestaoEquipesAtividades::where('idAtividadeSubordinante', $idAtividadeSubordinante)->where('atividadeAtiva', true)->where('incluirAtividadeAtende', true)->get();
        foreach ($listaAtividadesSubordinadas as $atividadeSubordinada) {
            array_push($arrayAtividadesSubordinadas, [
                'idAtividade'               => $atividadeSubordinada->idAtividade,
                'idAtividadeSubordinante'   => $atividadeSubordinada->idAtividadeSubordinante,
                'idEquipe'                  => $atividadeSubordinada->GestaoEquipesCelulas->idEquipe,
                'nomeAtividade'             => $atividadeSubordinada->nomeAtividade,
                'sinteseAtividade'          => $atividadeSubordinada->sinteseAtividade,
                'iconeAtividade'            => $atividadeSubordinada->iconeAtividade,
                'prazoAtendimento'          => $atividadeSubordinada->prazoAtendimento,
            ]);
        }
        return $arrayAtividadesSubordinadas;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function contagemAtendesDisponiveisResponsavel()
    {
        $contagemDemandasAtende = Atende::where('matriculaResponsavelAtividade', session('matricula'))->where('statusAtende', '!=', 'FINALIZADO')->count();
        
        return json_encode($contagemDemandasAtende);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarNovaDemandaAtende(Request $request)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $dadosSimov = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();
            $dadosAtividade = GestaoEquipesAtividades::find($request->idAtividade);

            // CRIAR A DEMANDA
            $novaDemandaAtende = new Atende;
            $novaDemandaAtende->contratoFormatado               = $request->contratoFormatado;
            $novaDemandaAtende->codigoUnidade                   = $dadosAtividade->GestaoEquipesCelulas->codigoUnidadeEquipe;
            $novaDemandaAtende->idEquipe                        = $request->idEquipe;
            $novaDemandaAtende->idAtividade                     = $request->idAtividade;
            $novaDemandaAtende->numeroContrato                  = $dadosSimov->NU_BEM;
            $novaDemandaAtende->assuntoAtende                   = $request->assuntoAtende;
            $novaDemandaAtende->descricaoAtende                 = $request->descricaoAtende;
            $novaDemandaAtende->statusAtende                    = 'CADASTRADO';
            $novaDemandaAtende->matriculaCriadorDemanda         = session('matricula');
            if (isset($request->prazoAtendimentoAtende)) {
                $novaDemandaAtende->prazoAtendimentoAtende = $request->prazoAtendimentoAtende;
            }else{
                $novaDemandaAtende->prazoAtendimentoAtende = DiasUteisClass::contadorDiasUteis(date("Y-m-d", time()), $dadosAtividade->prazoAtendimento);
            }
            $novaDemandaAtende->matriculaResponsavelAtividade   = self::defineResponsavelDemandaAtende($request->idAtividade, $dadosAtividade);
            $novaDemandaAtende->dataCadastro                    = date("Y-m-d H:i:s", time());
            $novaDemandaAtende->dataAlteracao                   = date("Y-m-d H:i:s", time());
            if ($request->has('emailContatoResposta')) {
                $novaDemandaAtende->emailContatoResposta        = $request->emailContatoResposta;
            }
            if ($request->has('emailContatoCopia')) {
                $novaDemandaAtende->emailContatoCopia           = $request->emailContatoCopia;
            }
            if ($request->has('emailContatoResposta')) {
                $novaDemandaAtende->emailContatoNovaCopia        = $request->emailContatoNovaCopia;
            }

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $novaDemandaAtende->save();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $request->contratoFormatado;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "CADASTRO DO ATENDE #" . str_pad($novaDemandaAtende->idAtende, 5, '0', STR_PAD_LEFT) . " - ATIVIDADE: " . $dadosAtividade->nomeAtividade . "<br>" .
                "<b>". "Assunto: " . "</b>" . $request->assuntoAtende . "<br>" . "<b>"."Descrição do atende: ". "</b>" . "<br>". $request->descricaoAtende;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            $formataData =  Carbon::parse($novaDemandaAtende->prazoAtendimentoAtende)->format('d/m/Y');
            $mensagem = file_get_contents(("NotificacaoDemandaAtende.php"), dirname(__FILE__));
            $mensagem = str_replace("%Assunto%", $novaDemandaAtende->assuntoAtende, $mensagem);
            $mensagem = str_replace("%quantidade_dias%", $formataData, $mensagem);

            //futuro upload de arquivos
            // if ($request->file('anexoAtende') != null){
            //     $nameFile = date("d_m_Y_His", time()). "_" . session('matricula'). "_". $request->file('anexoAtende')->getClientOriginalName();
            //      $request->file('anexoAtende')->storeAs('PUBLIC/EstoqueImoveis/'.$request->contratoFormatado, $nameFile);
            //  }
            
            $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8'; 
                $mail->isHTML(true);                                         
                $mail->Host = 'sistemas.correiolivre.caixa';  
                $mail->SMTPAuth = false;                                  
                $mail->Port = 25;
                // $mail->SMTPDebug = 2;
                $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mail->addReplyTo('GILIESP01@caixa.gov.br');
                $mail->addAddress($novaDemandaAtende->matriculaResponsavelAtividade . '@corp.caixa.gov.br');
    
                $mail->Subject = 'Você recebeu um direcionamento de atende';
                $mail->Body = $mensagem;
                $mail->send();
            
            $numeroAtende = '#'. str_pad($novaDemandaAtende->idAtende, 5, '0', STR_PAD_LEFT);
            $mensagemAbertura = file_get_contents(("NotificacaoAberturaDemandaAtende.php"), dirname(__FILE__));
            $mensagemAbertura = str_replace("%Assunto%", $novaDemandaAtende->assuntoAtende, $mensagemAbertura);
            $mensagemAbertura = str_replace("%quantidade_dias%", $formataData, $mensagemAbertura);
            $mensagemAbertura = str_replace("%contrato_formatado%", $novaDemandaAtende->contratoFormatado, $mensagemAbertura);
            $mensagemAbertura = str_replace("%numero_atende%", $numeroAtende, $mensagemAbertura);

            $mailAbertura = new PHPMailer(true);
                $mailAbertura->isSMTP();
                $mailAbertura->CharSet = 'UTF-8'; 
                $mailAbertura->isHTML(true);                                         
                $mailAbertura->Host = 'sistemas.correiolivre.caixa';  
                $mailAbertura->SMTPAuth = false;                                  
                $mailAbertura->Port = 25;
                // $mail->SMTPDebug = 2;
                $mailAbertura->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                $mailAbertura->addReplyTo('GILIESP01@caixa.gov.br');
                if ($novaDemandaAtende->emailContatoResposta == "null" || $novaDemandaAtende->emailContatoResposta == null){
                    $mailAbertura->addAddress($novaDemandaAtende->matriculaCriadorDemanda. "@corp.caixa.gov.br");
                    }else {
                    $mailAbertura->addAddress($novaDemandaAtende->emailContatoResposta);
                }
    
                $mailAbertura->Subject = 'Abertura de Atende #'. str_pad($novaDemandaAtende->idAtende, 5, '0', STR_PAD_LEFT);
                $mailAbertura->Body = $mensagemAbertura;
                $mailAbertura->send();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro realizado!");
            $request->session()->flash('corpoMensagem', "O cadastro do Atende foi realizado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Edição não efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a edição dos dados cadastrais do contrato. Tente novamente");
        }
        return redirect("/consulta-bem-imovel/" . $request->contratoFormatado);
    }

    public static function defineResponsavelDemandaAtende($idAtividade, $dadosAtividade) 
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $dadosEquipe = GestaoEquipesCelulas::find($dadosAtividade->idEquipe); 

            // CAPTURA A LISTA DE EMPREGADOS QUE REALIZAM AQUELA ATIVIDADE
            $listaResponsaveisAtividade = GestaoEquipesAtividadesResponsaveis::where('idAtividade', $idAtividade)->where('atuandoAtividade', true)->get();

            // CRIO DUAS VARIÁVEIS DE CONTROLE, UMA DE PRODUÇÃO E OUTRA PARA ATRIBUIR O RESPONSAVEL DA DEMANDA
            $responsavelDemandaAtende = '';
            $quantidadeDemandasControle = 10000;

            /* 
                VALIDO SE EXISTEM RESPONSAVEIS ATIVOS QUE REALIZAM A ATIVIDADE
                CASO POSITIVO FAÇO O LEVANTAMENTO DA QUANTIDADE DE DEMANDAS QUE CADA RESPONSAVEL TEM E ATRIBUO PARA AQUELE COM MENOR NÚMERO DE ATENDES
                CASO NEGATIVO, NÃO EXISTEM RESPONSAVEIS NA ATIVIDADE E A DEMANDA SERÁ ATRIBUIDA PARA O GESTOR RESPONSAVEL DA EQUIPE
            */
            if (!$listaResponsaveisAtividade->isEmpty()) {
                foreach ($listaResponsaveisAtividade as $responsavel) {
                    $quantidadeDemandasAtribuidas = Atende::where('matriculaResponsavelAtividade', $responsavel->matriculaResponsavelAtividade)->where('statusAtende' , "!=", 'FINALIZADO')->count() !== null ? Atende::where('matriculaResponsavelAtividade', $responsavel->matriculaResponsavelAtividade)->count() : null;
                    if (!is_null($quantidadeDemandasAtribuidas)) {
                        if ($quantidadeDemandasAtribuidas < $quantidadeDemandasControle) {
                            $quantidadeDemandasControle = $quantidadeDemandasAtribuidas;
                            $responsavelDemandaAtende = $responsavel->matriculaResponsavelAtividade;
                        }
                    }
                }
            }
            if ($responsavelDemandaAtende == '') {
                $responsavelDemandaAtende = $dadosEquipe->matriculaGestor;
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return $responsavelDemandaAtende;
    }

    /**
     *
     * @param  int  $idAtende
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function responderAtende(Request $request, $idAtende)
    {
        // $arquivo = $_FILES['arquivo'];


        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8'; 
            $mail->isHTML(true);                                         
            $mail->Host = 'sistemas.correiolivre.caixa';  
            $mail->SMTPAuth = false;                                  
            $mail->Port = 25;
            // $mail->SMTPDebug = 2;
            $mail->setFrom('GILIESP01@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
            $mail->addReplyTo('GILIESP01@caixa.gov.br');
            if ($request->emailContatoResposta == "null" || $request->emailContatoResposta == null){
            $mail->addAddress($request->matriculaCriadorDemanda. "@corp.caixa.gov.br");
            }else {
            $mail->addAddress($request->emailContatoResposta);
            }
            if (isset($request->emailContatoCopia)){
                $mail->addCC($request->emailContatoCopia);
            }
            if (isset($request->emailContatoNovaCopia)){
                $mail->addCC($request->emailContatoNovaCopia);
            }
            if (isset($request->emailAnexadoPeloResponsavel)){
                $mail->addCC($request->emailAnexadoPeloResponsavel);
            }
            if (isset($request->emailAnexadoPeloResponsavelCopia)){
                $mail->addCC($request->emailAnexadoPeloResponsavelCopia);
            }
            if (isset($request->emailAnexadoPeloResponsavelTerceiraCopia)){
                $mail->addCC($request->emailAnexadoPeloResponsavelTerceiraCopia);
            }
            $mail->addBCC('GILIESP09@caixa.gov.br');
            if(isset($_FILES['arquivo']['tmp_name']) && $_FILES['arquivo']['tmp_name'] != "") {
                $mail->AddAttachment($_FILES['arquivo']['tmp_name'],
                $_FILES['arquivo']['name']);
              }

            $mail->Subject = 'Resposta Atende #'. str_pad($request->numAtende, 5, '0', STR_PAD_LEFT) . " - Contrato: " . $request->contratoSemFormatacao;
            $mail->Body = "<h3> Você recebeu uma resposta do Atende: #". str_pad($request->numAtende, 5, '0', STR_PAD_LEFT) . "</h3><br>".
            "<b>Resposta Atende </b>: " . "<br><br>" . $request->respostaAtende."<br><br>".
            'Esta demanda foi respondida por: '.  session()->get('nomeCompleto'). '- '  .  session('matricula') . "<br>" .
            "e pode ser consultada no histórico do contrato " . $request->contratoFormatado . " pelo link https://portal.gilie.sp.caixa/consulta-bem-imovel/". $request->contratoFormatado . "<br>" .
            "(link disponivel apenas para funcionários CAIXA)" . "<br>".
            "GILIE - " . session()->get('codigoLotacaoAdministrativa') .
            "<br>".
            "<hr>"."<br><br>".
            "<b>Esta resposta refere-se ao questionamento </b>: ". "<br><br>" . nl2br($request->descricaoAtende); 
            
            $mail->send();
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $responderAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $responderAtende->statusAtende      = 'FINALIZADO';
            $responderAtende->respostaAtende    = nl2br($request->respostaAtende);
            $responderAtende->dataAlteracao     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $responderAtende->contratoFormatado;
            $historico->tipo            = "RESPOSTA";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($responderAtende->idAtende, 5, '0', STR_PAD_LEFT) . " <br>" . nl2br($request->respostaAtende);
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $responderAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende respondido!");
            $request->session()->flash('corpoMensagem', "O Atende foi respondido com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Resposta não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro da resposta do Atende. Tente novamente");
        }
        return redirect("/atende/minhas-demandas");
    }

    /**
     *
     * @param  int  $idAtende
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redirecionarAtende(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $redirecionarAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $redirecionarAtende->statusAtende                   = 'REDIRECIONADO';
            $redirecionarAtende->motivoRedirecionamento         = $request->motivoRedirecionamento;
            $redirecionarAtende->matriculaResponsavelAtividade  = $request->matriculaResponsavelAtividade;
            $redirecionarAtende->dataAlteracao                  = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $redirecionarAtende->contratoFormatado;
            $historico->tipo            = "REDIRECIONADO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($redirecionarAtende->idAtende, 5, '0', STR_PAD_LEFT) . " " . $request->motivoRedirecionamento;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $redirecionarAtende->save();

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8'; 
            $mail->isHTML(true);                                         
            $mail->Host = 'sistemas.correiolivre.caixa';  
            $mail->SMTPAuth = false;                                  
            $mail->Port = 25;
            // $mail->SMTPDebug = 2;
            $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
            $mail->addReplyTo('GILIESP01@caixa.gov.br');
            $mail->addAddress($request->matriculaResponsavelAtividade . '@corp.caixa.gov.br');

            $mail->Subject = 'Você recebeu um redirecionamento de atende';
            $mail->Body = "<B>AVISO DO PORTAL GILIE - Você recebeu um redirecionamento de atende </B>" . "<br><br>".
            session('matricula') . " - redirecionou o atende #". str_pad($redirecionarAtende->idAtende, 5, '0', STR_PAD_LEFT) . " para você" ."<br><br>" .
            "<b>Motivo do redirecionamento: </b>"."<br><br>".
            $request->motivoRedirecionamento;
            $mail->send();


            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende redirecionado!");
            $request->session()->flash('corpoMensagem', "O Atende foi redirecionado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Erro");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o redirecionamento. Tente novamente");
        }
        return redirect("/atende/minhas-demandas");
    }

    public function controlaPrazoAtende()
    {
        try {
            DB::beginTransaction();
            $arrayEquipesComAtividadesAtende = [];
            $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
            $demandasVencidas = 0;
            $demandasVencemHoje = 0;
            $demandasVencemProximoDiaUtil = 0;
            $demandasVencemDoisDiasUteis = 0;
            $demandasVencimentoLongo = 0;

            // CAPTURAR AS QUANTIDADE DE DEMANDAS ATENDE DAQUELA UNIDADE
            $listaEquipesUnidade = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->get();
            foreach ($listaEquipesUnidade as $atende) {
                $diasParaVencerPrazo = Carbon::parse('2020-04-29')->diffInBusinessDays(Carbon::parse('2020-04-28'));
                if ($diasParaVencerPrazo < 0) {
                    $demandasVencidas++;
                } else {
                    switch ($diasParaVencerPrazo) {
                        case 0:
                            $demandasVencemHoje++;
                            break;
                        case 1:
                            $demandasVencemProximoDiaUtil++;
                            break;
                        case 2:
                            $demandasVencemDoisDiasUteis++;
                            break;
                        default:
                            $demandasVencimentoLongo++;
                            break;
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return json_encode([
            'demandasVencidas'              => $demandasVencidas,
            'demandasVencemHoje'            => $demandasVencemHoje,
            'demandasVencemProximoDiaUtil'  => $demandasVencemProximoDiaUtil,
            'demandasVencemDoisDiasUteis'   => $demandasVencemDoisDiasUteis,
            'demandasVencimentoLongo'       => $demandasVencimentoLongo,
        ]);
    }

    public function listarDemandasUnidadePorPrazo($prazo)
    {
        try {
            DB::beginTransaction();
            $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
            $arrayDadosDemandas = [];
            $listaDemandas =[];
            // VERIFICAR QUAL É A DATA DE VENCIMENTO ESCOLHIDA PELO GESTOR
            switch ($prazo) {
                case 'demandasVencidas':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', '<', Carbon::now())->get();
                    break;
                case 'demandasVencemHoje':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', Carbon::now())->get();
                    break;
                case 'demandasVencemProximoDiaUtil':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', DiasUteisClass::contadorDiasUteis(Carbon::now(), 1))->get();
                    break;
                case 'demandasVencemDoisDiasUteis':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', DiasUteisClass::contadorDiasUteis(Carbon::now(), 2))->get();
                    break;
                case 'demandasVencimentoLongo':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', '>=', DiasUteisClass::contadorDiasUteis(Carbon::now(), 3))->get();
                    break;
            }
            foreach ($listaDemandas as $demanda) {
                array_push($arrayDadosDemandas, [
                    'idAtende'                      => $demanda->idAtende,
                    'idEquipe'                      => $demanda->idEquipe,
                    'nomeEquipe'                    => $demanda->gestaoEquipeCelulas->nomeEquipe,
                    'nomeGestor'                    => $demanda->gestaoEquipeCelulas->nomeGestor,
                    'idAtividade'                   => $demanda->idAtividade,
                    'nomeAtividade'                 => $demanda->gestaoEquipesAtividades->nomeAtividade,
                    'contratoFormatado'             => $demanda->contratoFormatado,
                    'numeroContrato'                => $demanda->numeroContrato,
                    'assuntoAtende'                 => $demanda->assuntoAtende,
                    'descricaoAtende'               => $demanda->descricaoAtende,
                    'matriculaResponsavelAtividade' => $demanda->matriculaResponsavelAtividade,
                    'prazoAtendimentoAtende'        => $demanda->prazoAtendimentoAtende,
                    'nomeCompleto'                  => $demanda->nomeCompleto
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return json_encode($arrayDadosDemandas);
    }

    public function listarUniverso()
    {
        $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
        $dadosAtende = Atende::where('codigoUnidade', $unidadeUsuario)->get();

        return json_encode($dadosAtende);
    }
    public function responderAtende_bkp(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $responderAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $responderAtende->statusAtende      = 'FINALIZADO';
            $responderAtende->respostaAtende    = $request->respostaAtende;
            $responderAtende->dataAlteracao     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $responderAtende->contratoFormatado;
            $historico->tipo            = "RESPOSTA";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($responderAtende->idAtende, 5, '0', STR_PAD_LEFT) . " " . $request->respostaAtende;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $responderAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende respondido!");
            $request->session()->flash('corpoMensagem', "O Atende foi respondido com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Resposta não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro da resposta do Atende. Tente novamente");
        }
        return redirect("/atende/minhas-demandas");
    }

    public function criaModeloMensagem(Request $request)
    {try {
        DB::beginTransaction();
        
        $novaMensagem = new ModeloMensagem;
        $novaMensagem->nomeModelo          = $request->nomeModelo;
        $novaMensagem->modeloMensageria    = $request->modeloMensageria;
        $novaMensagem->matricula           = session('matricula');
        $novaMensagem->save();

        // RETORNA A FLASH MESSAGE
        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Modelo de mensagem criado!");
        $request->session()->flash('corpoMensagem', "O novo modelo foi salvo com sucesso.");

        DB::commit();
    } catch (\Throwable $th) {
        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
            dd($th);
        } else {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
        }
        DB::rollback();
        // RETORNA A FLASH MESSAGE
        $request->session()->flash('corMensagem', 'danger');
        $request->session()->flash('tituloMensagem', "Modelo de mensagem não salvo");
        $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a criação do modelo. Tente novamente");
    }
    return back();

    }

    public function apagarModeloMensagem($id)
    {
        try {
        
        DB::beginTransaction();
        $apagarMensagem = ModeloMensagem::find($id);
        $apagarMensagem->delete();
    

        // RETORNA A FLASH MESSAGE
        session()->flash('corMensagem', 'success');
        session()->flash('tituloMensagem', "Modelo de mensagem excluido!");
        session()->flash('corpoMensagem', "O modelo foi excluido com sucesso.");

        DB::commit();
    } catch (\Throwable $th) {
        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
        } else {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
        }
        DB::rollback();
        // RETORNA A FLASH MESSAGE
        session()->flash('corMensagem', 'danger');
        session()->flash('tituloMensagem', "Algo deu errado!!!");
        session()->flash('corpoMensagem', "Tente novamente");
    }
    return back();

    }

    public function listarModeloMensagem()
    {

        $mensagemCadastrada = ModeloMensagem::where('matricula', session('matricula'))->get();

        return json_encode($mensagemCadastrada);
    }

    public function listarAtendesFinalizadoResponsavel()
    {
       
       
        // ->where('statusAtende','<>','FINALIZADO')
        // ->get();

        // return json_encode($dadosAtende);
        $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
        $dadosAtende = DB::table('TBL_ATENDE_DEMANDAS')
            ->join('TBL_GESTAO_EQUIPES_ATIVIDADES', DB::raw('CONVERT(VARCHAR, TBL_GESTAO_EQUIPES_ATIVIDADES.idAtividade)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.idAtividade)'))
            ->join('TBL_GESTAO_EQUIPES_CELULAS', DB::raw('CONVERT(VARCHAR, TBL_GESTAO_EQUIPES_CELULAS.idEquipe)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.idEquipe)'))
            ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))
            ->select(DB::raw('
                    TBL_ATENDE_DEMANDAS.[idAtende] as idAtende,
                    TBL_ATENDE_DEMANDAS.[contratoFormatado] as contratoFormatado,
                    TBL_ATENDE_DEMANDAS.[numeroContrato] as numeroContrato,
                    TBL_ATENDE_DEMANDAS.[idAtividade] as idAtividade,
                    TBL_EMPREGADOS.[nomeCompleto] as matriculaResponsavelAtividade,
                    TBL_ATENDE_DEMANDAS.[assuntoAtende] as assuntoAtende,
                    TBL_ATENDE_DEMANDAS.[descricaoAtende] as descricaoAtende,
                    TBL_ATENDE_DEMANDAS.[motivoRedirecionamento] as motivoRedirecionamento,
                    TBL_ATENDE_DEMANDAS.[respostaAtende] as respostaAtende,
                    TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende] as prazoAtendimentoAtende,
                    TBL_ATENDE_DEMANDAS.[statusAtende] as statusAtende,
                    TBL_ATENDE_DEMANDAS.[matriculaCriadorDemanda] as matriculaCriadorDemanda,
                    TBL_ATENDE_DEMANDAS.[emailContatoResposta] as emailContatoResposta,
                    TBL_ATENDE_DEMANDAS.[dataCadastro] as dataCadastro,
                    TBL_ATENDE_DEMANDAS.[dataAlteracao] as dataAlteracao,
                    TBL_ATENDE_DEMANDAS.[codigoUnidade] as codigoUnidade,
                    TBL_ATENDE_DEMANDAS.[emailContatoCopia] as emailContatoCopia,
                    TBL_ATENDE_DEMANDAS.[emailContatoNovaCopia] as emailContatoNovaCopia,
                    TBL_ATENDE_DEMANDAS.[idEquipe] as idEquipe,
                    TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
                    TBL_GESTAO_EQUIPES_ATIVIDADES.[nomeAtividade] as nomeAtividade
            '))
             ->where('codigoUnidade', $unidadeUsuario)
             ->where('statusAtende','=','FINALIZADO')
             ->where('matriculaResponsavelAtividade','=', session('matricula'))
             ->orderBy('dataAlteracao', 'desc')
            ->limit(20)
             ->get();

             return json_encode($dadosAtende);
    }


}
