<?php


namespace App\Http\Controllers\Siouv;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\HistoricoPortalGilie;
use App\Models\Siouv\Siouv;
use App\Models\Siouv\numeroCE;
use App\Models\Atende;
use App\Classes\DiasUteisClass;

class siouvController extends Controller
{
    public function indexSiouv()
    {  
        return view('portal.gerencial.gestao-siouv');
    }

    public function listaUniversoSiouv()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $universoSiouv= DB::table('TBL_SIOUV')
            ->leftjoin('TBL_SIOUV_DEMANDAS', DB::raw('CONVERT(VARCHAR, TBL_SIOUV_DEMANDAS.numeroSiouv)'), '=', DB::raw('CONVERT(VARCHAR, TBL_SIOUV.numeroSiouv)'))    
            ->select(DB::raw("
            TBL_SIOUV.[numeroSiouv] as numeroSiouv,
            TBL_SIOUV.[tipo] as tipo,
            ISNULL(TBL_SIOUV_DEMANDAS.[NU_BEM], 'Não Cadastrado') as contrato,
            ISNULL(TBL_SIOUV_DEMANDAS.[contratoFormatado], 'Não Cadastrado') as contratoFormatado,
            ISNULL(TBL_SIOUV_DEMANDAS.[matriculaResponsavelAtividade], 'Não Cadastrado') as responsavel,
            ISNULL(TBL_SIOUV_DEMANDAS.[processo], 'Não Cadastrado') as processo,
            TBL_SIOUV.[vencimento] as vencimento,
            TBL_SIOUV.[manifesto] as manifesto,
            TBL_SIOUV.[comentario] as comentario,
            TBL_SIOUV.[Nome] as Nome,
            TBL_SIOUV.[CPF] as CPF,
            TBL_SIOUV.[email] as email
            
            "))
            ->where('TBL_SIOUV.unidade', '=', $codigoUnidadeUsuarioSessao)
            ->whereNull('TBL_SIOUV_DEMANDAS.status')
             ->get();

        return json_encode($universoSiouv);
    }

    public function listaCoordenadores()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $equipe = DB::table('TBL_EMPREGADOS')
        ->select(DB::raw("
        TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
        TBL_EMPREGADOS.[matricula] as matricula

      "))
        ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', $codigoUnidadeUsuarioSessao)
        ->where('TBL_EMPREGADOS.nomeFuncao', 'COORDENADOR CENTR FILIAL')
        ->get(); 
        
        return json_encode($equipe);
    }

    public function listaSiouvEmAberto()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $universoSiouv= DB::table('TBL_ATENDE_DEMANDAS')
            ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))  
            ->join('TBL_SIOUV_DEMANDAS', DB::raw('CONVERT(VARCHAR, TBL_SIOUV_DEMANDAS.NU_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.numeroContrato)'))
            ->leftjoin('TBL_SIOUV', DB::raw('CONVERT(VARCHAR, TBL_SIOUV.numeroSiouv)'), '=', DB::raw('CONVERT(VARCHAR, TBL_SIOUV_DEMANDAS.numeroSiouv)'))   
            ->select(DB::raw("
            TBL_SIOUV_DEMANDAS.[tipo] as tipo,
            TBL_SIOUV_DEMANDAS.[numeroSiouv] as numeroSiouv,
            TBL_ATENDE_DEMANDAS.[contratoFormatado] as contratoFormatado,
            TBL_ATENDE_DEMANDAS.[numeroContrato] as contrato,
            TBL_ATENDE_DEMANDAS.[matriculaResponsavelAtividade] as matriculaResponsavelAtividade,
            TBL_EMPREGADOS.[nomeCompleto] as nomeEmpregado,
            ISNULL(TBL_SIOUV.[vencimento], 'SIOUV Fechado / ATENDE Aberto') as vencimento,
            TBL_SIOUV.[manifesto] as manifesto,
            TBL_SIOUV.[comentario] as comentario,
            TBL_SIOUV.[Nome] as Nome,
            TBL_SIOUV.[CPF] as CPF,
            TBL_SIOUV.[email] as email
            
            "))
            ->where('TBL_ATENDE_DEMANDAS.codigoUnidade', '=', $codigoUnidadeUsuarioSessao)
            ->where('TBL_ATENDE_DEMANDAS.statusAtende', '=', 'CADASTRADO')
            ->where('TBL_ATENDE_DEMANDAS.idAtividade', '=', '76')
            ->whereRaw('TBL_ATENDE_DEMANDAS.assuntoAtende = TBL_SIOUV_DEMANDAS.processo')
            ->get();

        return json_encode($universoSiouv);
    }

    public function listaSiouvPAREmAberto()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $universoSiouv= DB::table('TBL_SIOUV_DEMANDAS')
            ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_SIOUV_DEMANDAS.matriculaResponsavelAtividade)'))  
            ->join('TBL_SIOUV', DB::raw('CONVERT(VARCHAR, TBL_SIOUV.numeroSiouv)'), '=', DB::raw('CONVERT(VARCHAR, TBL_SIOUV_DEMANDAS.numeroSiouv)'))   
            ->select(DB::raw("
            TBL_SIOUV_DEMANDAS.[tipo] as tipo,
            TBL_SIOUV_DEMANDAS.[numeroSiouv] as numeroSiouv,
            ISNULL(TBL_SIOUV_DEMANDAS.[contratoFormatado], 'Contrato Par') as contratoFormatado,
            TBL_SIOUV_DEMANDAS.[NU_BEM] as contrato,
            TBL_SIOUV_DEMANDAS.[matriculaResponsavelAtividade] as matriculaResponsavelAtividade,
            TBL_EMPREGADOS.[nomeCompleto] as nomeEmpregado,
            ISNULL(TBL_SIOUV.[vencimento], 'SIOUV Fechado / ATENDE Aberto') as vencimento,
            TBL_SIOUV.[manifesto] as manifesto,
            TBL_SIOUV.[comentario] as comentario,
            TBL_SIOUV.[Nome] as Nome,
            TBL_SIOUV.[CPF] as CPF,
            TBL_SIOUV.[email] as email
            
            "))
            ->where('TBL_SIOUV.unidade', '=', $codigoUnidadeUsuarioSessao)
            ->where('TBL_SIOUV_DEMANDAS.status', '=', 'PAR')
            ->get();

        return json_encode($universoSiouv);
    }


        public function cadastraDadosSiouv(Request $request)
    { 
        $date = date('Y-m-d');

        try {
            DB::beginTransaction();

        $dadosSimov = BaseSimov::where('NU_BEM', $request->cadastraContratoSiouv)->first();

        $data = str_replace("/", "-", $request->prazo);
    
        $novaDemandaAtende = new Atende;
        $novaDemandaAtende->contratoFormatado               = $dadosSimov->BEM_FORMATADO;
        $novaDemandaAtende->codigoUnidade                   = '7257';
        $novaDemandaAtende->idEquipe                        = '11';
        $novaDemandaAtende->idAtividade                     = '76';
        $novaDemandaAtende->numeroContrato                  = $request->cadastraContratoSiouv;
        $novaDemandaAtende->assuntoAtende                   = $request->cadastraProcessolSiouv;
        $novaDemandaAtende->descricaoAtende                 = "Atenção: ao responder esta demanda ainda será necessário copiar a resposta no atender.caixa.". PHP_EOL .
                                                            "SIOUV: ". $request->siouv . PHP_EOL. PHP_EOL . $request->manifesto;
        $novaDemandaAtende->statusAtende                    = 'CADASTRADO';
        $novaDemandaAtende->matriculaCriadorDemanda         = session('matricula');
        $novaDemandaAtende->prazoAtendimentoAtende          = date('Y-m-d', strtotime($data));
        $novaDemandaAtende->matriculaResponsavelAtividade   = $request->cadastraResponsavelSiouv;
        $novaDemandaAtende->dataCadastro                    = date("Y-m-d H:i:s", time());
        $novaDemandaAtende->dataAlteracao                   = date("Y-m-d H:i:s", time());
        $novaDemandaAtende->emailContatoResposta            = $request->email;
        $novaDemandaAtende->save();

        // CADASTRA HISTÓRICO
        $historico = new HistoricoPortalGilie;
        $historico->matricula       = session('matricula');
        $historico->numeroContrato  = $dadosSimov->BEM_FORMATADO;
        $historico->tipo            = "CADASTRO";
        $historico->atividade       = "ATENDE";
        $historico->observacao      = "CADASTRO DO ATENDE #" . str_pad($novaDemandaAtende->idAtende, 5, '0', STR_PAD_LEFT) . " - SIOUV: " . "<br>" .
            "<b>". "Assunto: " . "</b>" . $request->cadastraProcessolSiouv . "<br>" . "<b>"."Descrição do SIOUV: ". "</b>" . "<br>". $request->manifesto;
        $historico->created_at      = date("Y-m-d H:i:s", time());
        $historico->updated_at      = date("Y-m-d H:i:s", time());
        $historico->save();

        $novoSiouv = new Siouv;
        $novoSiouv->numeroSiouv                     = $request->siouv;
        $novoSiouv->matriculaResponsavelAtividade   = $request->cadastraResponsavelSiouv;
        $novoSiouv->status                          = 'Distribuido';
        $novoSiouv->NU_BEM                          = $request->cadastraContratoSiouv;
        $novoSiouv->contratoFormatado               = $dadosSimov->BEM_FORMATADO;
        $novoSiouv->processo                        = $request->cadastraProcessolSiouv;
        $novoSiouv->dataCriacao                     = $date;
        $novoSiouv->tipo                            = $request->tipo;
        $novoSiouv->save();

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Cadastro realizado!");
        $request->session()->flash('corpoMensagem', "O cadastro do Atende foi realizado com sucesso.");

        DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Cadastro não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o cadastro. Tente novamente");
        }

        return redirect("/gerencial/gestao-siouv");
    }

    public function modeloSac($siouv)
    {  
        $dadosSiouv = DB::table('TBL_SIOUV')->where('numeroSiouv', $siouv)->first();
        // $dadosDemandaSimov = Siouv::where('numeroSiouv', $siouv)->first();
        $dadosEmpregado = DB::table('TBL_EMPREGADOS')->where('matricula', session('matricula'))->first();

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');


        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=Siouv". $dadosSiouv->numeroSiouv . ".doc");

        $word = '<html>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <body>
        ';


        $word .= "
        <p><b>São Paulo, ".strftime('%d de %B de %Y', strtotime('today'))."</b></p>".
        "<br>
        <p>Prezado(a) Senhor(a)<br>
        <b>".$dadosSiouv->Nome."</b></p>
        SAC - <b>". $dadosSiouv->numeroSiouv . "</b></p>
        <p>1.	Recebemos sua demanda abaixo através de nosso SAC:</p>
        <p>". $dadosSiouv->manifesto . "</p>
        <p>2.	[CONTEÚDO DA RESPOSTA AQUI]</p>
        <p>3.	Permanecemos à disposição.</p>
        <br>
        <p>Atenciosamente,</p>
        <br>".
        $dadosEmpregado->nomeCompleto."<br>".
        $dadosEmpregado->nomeFuncao.

        "</html>";

        return $word;
    }

    public function modeloSIOUV($siouv)
    {  
        $dadosSiouv = DB::table('TBL_SIOUV')->where('numeroSiouv', $siouv)->first();
        // $dadosDemandaSimov = Siouv::where('numeroSiouv', $siouv)->first();
        $dadosEmpregado = DB::table('TBL_EMPREGADOS')->where('matricula', session('matricula'))->first();

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');


        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=Siouv". $dadosSiouv->numeroSiouv . ".doc");

        $word = "<html>
        <meta http-equiv="."Content-Type"." content="."text/html"." charset="."utf-8".">
        <img src=". asset('img/caixaPNG.png').">
        <body>
        ";


        $word .= "
        <p>[COPIAR NÚMERO CE]</p>
        <p><b>São Paulo, ".strftime('%d de %B de %Y', strtotime('today'))."</b></p>".
        "<br>
        <p>À<br>
        CEOUV</p>".
        "<p>Assunto: Ocorrência nº <b>". $dadosSiouv->numeroSiouv . "</b></p>".
        "<p>Prezados Senhores,</p>".
        "<p>1. Cumprimentando-vos cordialmente, em atenção à abertura de ocorrência de ouvidoria nº <b>". $dadosSiouv->numeroSiouv . "</b>, temos a informar:</p>
        <p>2.	[CONTEÚDO DA RESPOSTA AQUI]</p>
        <p>3. Permanecemos à disposição para dirimir eventuais dúvidas.</p>
        <br>
        <p>Atenciosamente,</p>
        <br>".
        $dadosEmpregado->nomeCompleto."<br>".
        $dadosEmpregado->nomeFuncao.
        "<p>XXXXXXXXX<br>
        Coordenador</p>
        <p>Marcelo Barboza Fernandes<br>
        Gerente de Filial</p>
        <p><b>GILIE/SP | GI ALIENAR BENS MOVEIS E IMOVEIS</b></p>
        </html>";

        return $word;
    }

    public function responderSiouv(Request $request)
    {  
        $date = date('Y-m-d');

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
        $mail->addAddress( $request->email);
        $mail->addCC(session('matricula')."@mail.caixa");
        $mail->addBCC('GILIESP09@caixa.gov.br');

        $mail->Subject = 'Você recebeu uma resposta de GILIE/SP';
        $mail->Body = $request->respostaSiouv;
        $mail->send();

        $novoSiouv = new Siouv;
        $novoSiouv->numeroSiouv                     = $request->siouv;
        $novoSiouv->status                          = "Respondido";
        $novoSiouv->dataCriacao                     = $date;
        $novoSiouv->save();

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Email enviado");
        $request->session()->flash('corpoMensagem', "O Email foi enviado com sucesso.");

        return redirect("/gerencial/gestao-siouv");
    }

        public function criaNumeroCE()
    {  
        $novaCE = new numeroCE;
        $novaCE->matricula = session('matricula');
        $novaCE->save();

        return redirect("/gerencial/gestao-siouv/gestao-siouv-ce");
    }
            public function pegaNumeroCE()
    {  
        $idCe = DB::table('TBL_NUMERO_CE')->latest('idCe')->first();
        $numeroCE = "CE GILIE/SP " . str_pad($idCe->idCe, 5, '0', STR_PAD_LEFT)."-04/".date("Y");
        
        return view('portal.gerencial.gestao-siouv-ce', compact('numeroCE'));
    }

    public function cadastraDadosSiouvPar(Request $request)
    { 
        $date = date('Y-m-d');

        try {
            DB::beginTransaction();

        $novoSiouv = new Siouv;
        $novoSiouv->numeroSiouv                     = $request->siouv;
        $novoSiouv->matriculaResponsavelAtividade   = $request->cadastraResponsavelSiouv;
        $novoSiouv->status                          = 'PAR';
        $novoSiouv->NU_BEM                          = $request->cadastraContratoSiouv;
        $novoSiouv->contratoFormatado               = null;
        $novoSiouv->processo                        = $request->cadastraProcessolSiouv;
        $novoSiouv->dataCriacao                     = $date;
        $novoSiouv->tipo                            = $request->tipo;
        $novoSiouv->save();

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
        $mail->addAddress($request->cadastraCoordenadorSiouv .'@mail.caixa');
        $mail->addCC($request->cadastraResponsavelSiouv."@mail.caixa");
        $mail->addBCC('GILIESP09@caixa.gov.br');

        $mail->Subject = 'Você recebeu um direcionamento SIOUV - PAR';
        $mail->Body =  'SIOUV: '.$request->siouv . '<br><br>'. 
        '<b>'.'Nome: ' . '</b>'.'<br>'.$request->nome . '<br>'. 
        '<b>'.'CPF: ' . '</b>'.'<br>'.$request->cpf . '<br>'. 
        '<b>'.'Manifesto: ' . '</b>'.'<br>'.$request->manifesto . '<br>'. 
        '<b>'.'Comentário: '. '</b>'.'<br>'.$request->comentario. '<br>'. '<br>'. '<br>'.
        'ROTINAS AUTOMÁTICAS GILIE - SIOUV';
        $mail->send();

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Cadastro realizado!");
        $request->session()->flash('corpoMensagem', "O cadastro do Atende foi realizado com sucesso.");

        DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Cadastro não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o cadastro. Tente novamente");
        }

        return redirect("/gerencial/gestao-siouv");
    }
    public function apagariouvPar(Request $request, $siouv)
    {
    
        try {
            DB::beginTransaction();
        
        $apagarSiouvPar = Siouv::find($siouv);
        $apagarSiouvPar->status  = "BAIXADO";
        $apagarSiouvPar->save();

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Siouv deletado!");
        $request->session()->flash('corpoMensagem', "O Siouv foi deletado com sucesso.");

        DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Não deletado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a exclusão. Tente novamente");
        }

    return redirect("/gerencial/gestao-siouv");
    }
   
         
}
