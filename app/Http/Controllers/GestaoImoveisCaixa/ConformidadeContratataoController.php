<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Classes\GestaoImoveisCaixa\MensagensCobranca;
use App\Models\HistoricoPortalGilie;
use App\Classes\Ldap;
use App\Http\Controllers\Controller;
use App\Models\GestaoImoveisCaixa\ConformidadeContratacao;
use App\Models\BaseSimov;
use App\Models\GestaoImoveisCaixa\PainelDeVendasGeipt;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class ConformidadeContratataoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.imoveis.contratacao.controle-conformidade');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function listarContratosConformidade()
    // {
    //     $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        
    //     $arrayContratosConformidade = [];
    //     $consultaContratosConformidade = DB::table('ADJTBL_imoveisCaixa')
    //                                         ->join('ALITB075_VENDA_VL_OL37', DB::raw('CONVERT(VARCHAR, ADJTBL_imoveisCaixa.numeroContrato)'), '=', DB::raw('CONVERT(VARCHAR, ALITB075_VENDA_VL_OL37.NU_BEM)'))
    //                                         ->join('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ADJTBL_imoveisCaixa.numeroContrato)'), '=', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'))
    //                                         ->join('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
    //                                         ->leftJoin('TBL_HISTORICO_PORTAL_GILIE', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_HISTORICO_PORTAL_GILIE.numeroContrato)'))
    //                                         ->select(DB::raw('
    //                                             ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
    //                                             ALITB001_Imovel_Completo.[ACEITA_CCA] as aceitaCca, 
    //                                             ALITB001_Imovel_Completo.[CLASSIFICACAO] as classificacaoImovel,
    //                                             ALITB001_Imovel_Completo.[NOME_PROPONENTE] as nomeProponente,
    //                                             ALITB001_Imovel_Completo.[UNA] as gilieDeVinculacao, 
    //                                             ADJTBL_imoveisCaixa.numeroContrato, 
    //                                             ADJTBL_imoveisCaixa.codigoAgencia,
    //                                             ALITB001_Imovel_Completo.[VALOR_REC_PROPRIOS_PROPOSTA] as valorRecursosPropriosProposta,
    //                                             ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as valorTotalProposta,
    //                                             ALITB001_Imovel_Completo.[VALOR_FGTS_PROPOSTA] as valorFgtsProposta,
    //                                             ALITB001_Imovel_Completo.[VALOR_FINANCIADO_PROPOSTA] as valorFinanciadoProposta,
    //                                             ADJTBL_imoveisCaixa.[tipoDeContratacao] as tipoContratacao,
    //                                             ALITB001_Imovel_Completo.[TIPO_VENDA] as tipoVenda,
    //                                             ADJTBL_imoveisCaixa.[nomeStatusDoDossie] as statusContratacao,
    //                                             ADJTBL_imoveisCaixa.[cardDeAgrupamento] as cardAgrupamento,
    //                                             CONVERT(VARCHAR, ADJTBL_imoveisCaixa.[dataStatus], 103) as dataStatus,
    //                                             CONVERT(VARCHAR, ADJTBL_imoveisCaixa.[dataSimov], 103) as dataSimov,
    //                                             ALITB075_VENDA_VL_OL37.[VL_TOTAL_RECEBIDO] as valorTotalRecebido,
    //                                             TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia] as emailAgencia,
    //                                             TBL_HISTORICO_PORTAL_GILIE.[updated_at] as dataNovoHistorio,
    //                                             TBL_HISTORICO_PORTAL_GILIE.[atividade] as tipoHistorico
    //                                         '))
    //                                         ->where('ADJTBL_imoveisCaixa.codigoGilie', $codigoUnidadeUsuarioSessao)
    //                                         ->where(function($cardAgrupamento) {
    //                                             $cardAgrupamento->where('ADJTBL_imoveisCaixa.cardDeAgrupamento', '!=', 'Negócios Realizados')
    //                                                     ->where('ADJTBL_imoveisCaixa.cardDeAgrupamento', '!=', 'CICOB');
    //                                         })
    //                                         ->where(function($statusSimov) {
    //                                             $statusSimov->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', 'Em Contratação')
    //                                                     ->orWhere('ALITB001_Imovel_Completo.STATUS_IMOVEL', 'Contratação pendente');
    //                                         })
    //                                         ->latest()->get();
    //     $arrayContratosParaRemoverRepetidos = [];
    //     foreach ($consultaContratosConformidade as $contrato) {
    //         if (!in_array($contrato->numeroContrato, $arrayContratosParaRemoverRepetidos)) {
    //             switch ($contrato->aceitaCca) {
    //                 case 'Nao':
    //                     $fluxoContratacao = 'AG';
    //                     break;      
    //                 default:
    //                     $fluxoContratacao = 'CCA';
    //                     break;     
    //             }
    //             switch ($contrato->classificacaoImovel) {
    //                 case 'Em Cadastramento EMGEA':
    //                 case 'EMGEA':
    //                 case 'EMGEA - Realização de Garantia':
    //                 case 'EMGEA- Alienação Fiduciária': 
    //                     $classificacaoImovel = 'EMGEA';
    //                     break;
    //                 case 'Oriundo do Crédito Imobiliário':
    //                 case 'Oriundos SFI-Gar. Fiduciária':
    //                 case 'SFI - Gar.Fid.Reg.Créd.Imob':
    //                     $classificacaoImovel = 'CAIXA';
    //                     break;
    //                 case 'Patrimonial':
    //                 case 'Patrimonial - Alienação Fiduciária':
    //                 case 'Patrimonial -Realização de Garantia':
    //                     $classificacaoImovel = 'PATRIMONIAL';
    //                     break;
    //                 default:
    //                     $classificacaoImovel = $contrato->classificacaoImovel;
    //                     break;
    //             }

    //             if ($contrato->valorRecursosPropriosProposta == $contrato->valorTotalProposta) {
    //                 $tipoProposta = 'A vista com recursos proprios';
    //             } elseif (($contrato->valorFgtsProposta + $contrato->valorRecursosPropriosProposta) == $contrato->valorTotalProposta) {
    //                 $tipoProposta = 'A vista com FGTS';
    //             } else {
    //                 $tipoProposta = 'Financiado';
    //             }
    
    //             if ($contrato->valorTotalRecebido >= $contrato->valorRecursosPropriosProposta) {
    //                 $sinalPago = 'SIM';
    //             } else {
    //                 $sinalPago = 'NAO';
    //             }
                
    //             array_push($arrayContratosConformidade, [
    //                 'contratoFormatado' => $contrato->contratoFormatado,
    //                 'numeroContrato' => $contrato->numeroContrato,
    //                 'fluxoContratacao' => $fluxoContratacao, 
    //                 'codigoAgencia' => $contrato->codigoAgencia,
    //                 'tipoVenda' => $contrato->tipoVenda,
    //                 'tipoProposta' => $tipoProposta,
    //                 'valorRecursosProprios' => $contrato->valorRecursosPropriosProposta,
    //                 'valorTotalRecebido' => $contrato->valorTotalRecebido,
    //                 'sinalPago' => $sinalPago,
    //                 'statusContratacao' => $contrato->statusContratacao,
    //                 'cardAgrupamento' => $contrato->cardAgrupamento,
    //                 'dataEntradaConformidade' => $contrato->dataStatus,
    //                 'classificacaoImovel' => $classificacaoImovel,
    //                 'emailAgencia' => $contrato->emailAgencia,
    //                 'nomeProponente' => $contrato->nomeProponente,
    //                 'gilieDeVinculacao' =>$contrato->gilieDeVinculacao,
    //                 'dataNovoHistorio' =>$contrato->dataNovoHistorio,
    //                 'tipoHistorico' =>$contrato->tipoHistorico
    //             ]);
    //             array_push($arrayContratosParaRemoverRepetidos, $contrato->numeroContrato);
    //         }
    //     }
    //     return json_encode($consultaContratosConformidade);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  string  $contratoFormatado
    //  * @return \Illuminate\Http\Response
    //  */
    // public function emitirPropostaContratacao($contratoFormatado)
    // {
    //     $dadosContrato = BaseSimov::where('BEM_FORMATADO', $contratoFormatado)->first();
    //     $dadosProposta = [
    //         // 1 - MODALIDADE
    //         'modalidade' => $dadosContrato->TIPO_VENDA,

    //         // 2 - IDENTIFICAÇÃO DOS PROPONENTES
    //         'nomePrimeiroProponente' => $dadosContrato->NOME_PROPONENTE,
    //         'dataNascimentoPrimeiroProponente' => 
    //     ];
        
        
        
    //     return json_encode($dadosContrato);
    //     return json_encode($dadosProposta);
    // }
    public function registrarHistoricoConformidade(Request $request, $numeroContratoFormatado)
    
    {      
        try {
            DB::beginTransaction();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $numeroContratoFormatado;
            $historico->tipo = $request->tipoAtendimento;
            $historico->atividade = $request->atividadeAtendimento;
            $historico->observacao = strip_tags($request->observacaoAtendimento);
            // dd(date("Y-m-d H:i:s", time()));
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Histórico registrado!");
            $request->session()->flash('corpoMensagem', "O seu registro de histórico foi cadastrado com sucesso.");

            DB::commit();
            return response('deu certo', 200);
        } catch (\Throwable $th) {
            // dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Histórico não registrado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro do histórico. Tente novamente");
            return response('não deu certo', 500);
        }
        // return redirect("/estoque-imoveis/conformidade-contratacao");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function EnviodeCobrancaAgencia(Request $request)
    {
        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($request->emailAgencia);
            $mail->addCC('c098453@mail.caixa');
        }else{
            $mail->addAddress('c098453@mail.caixa');
        }
        $mail->Subject = 'Retorno de finalização do processo '. $request->contratoFormatado;
        // $mensagemAutomatica = file_get_contents(("CobrancaAgenciaAndamentoFinanciamento.php"), dirname(__FILE__));
        // $mensagemAutomatica = str_replace("%AGENCIA%", $request->codigoAgencia, $mensagemAutomatica);
        // $mensagemAutomatica = str_replace("%contratoFormatado%", $request->contratoFormatado, $mensagemAutomatica);
        // $mensagemAutomatica = str_replace("%nomeProponente%", $request->nomeProponente, $mensagemAutomatica);
        // $mensagemAutomatica = str_replace("%GILIE%", $request->gilieDeVinculacao, $mensagemAutomatica);
        $mail->Body = nl2br($request->observacaoAtendimento);
        $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $request->contratoFormatado;
            $historico->tipo = "ANALISE";
            $historico->atividade = "COBRANCA";
            $historico->observacao = strip_tags($request->observacaoAtendimento);
            // dd(date("Y-m-d H:i:s", time()));
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            $historico->save();
        $mail->send();
        echo 'Mensagem enviada';
         } catch (Exception $e) {
             echo "Erro. Mensagem não foi enviada: {$mail->ErrorInfo}";
        }
    }
    public function EnviodeCobrancaPagamentoCliente(Request $request)
    {
        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;
        $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');
        if (env('APP_ENV') == 'PRODUCAO'){
            $mail->addAddress($request->emailContato);
            $mail->addCC('c098453@mail.caixa');
        }else{
            $mail->addAddress('c098453@mail.caixa');
        }
        $mail->Subject = 'Retorno de finalização do processo '. $request->bemFormatado;
        // $mensagemAutomatica = file_get_contents(("CobrancaAgenciaAndamentoFinanciamento.php"), dirname(__FILE__));
        // $mensagemAutomatica = str_replace("%AGENCIA%", $request->codigoAgencia, $mensagemAutomatica);
        // $mensagemAutomatica = str_replace("%contratoFormatado%", $request->contratoFormatado, $mensagemAutomatica);
        // $mensagemAutomatica = str_replace("%nomeProponente%", $request->nomeProponente, $mensagemAutomatica);
        // $mensagemAutomatica = str_replace("%GILIE%", $request->gilieDeVinculacao, $mensagemAutomatica);
        $mail->Body = nl2br($request->observacaoAtendimento);
        $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $request->bemFormatado;
            $historico->tipo = "ANALISE";
            $historico->atividade = "COBRANCA";
            $historico->observacao = strip_tags($request->observacaoAtendimento);
            // dd(date("Y-m-d H:i:s", time()));
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            $historico->save();
        $mail->send();
        echo 'Mensagem enviada';
         } catch (Exception $e) {
             echo "Erro. Mensagem não foi enviada: {$mail->ErrorInfo}";
        }
    }

public function listarContratosConformidade()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        
        $arrayContratosConformidade = [];
        $consultaContratosConformidade = DB::table('ALITB001_Imovel_Completo')
                                        ->leftjoin('TBL_SALDO_ATUALIZADO_CONTRATOS_SINAF', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_SALDO_ATUALIZADO_CONTRATOS_SINAF.numeroContrato)'))
                                        ->leftjoin('ADJTBL_imoveisCaixa', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CONVERT(VARCHAR, ADJTBL_imoveisCaixa.numeroContrato)'))
                                        ->leftjoin('TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.AGENCIA_CONTRATACAO_PROPOSTA)'), '=', DB::raw('CONVERT(VARCHAR, TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.nomeAgencia)'))
                                        ->leftJoin('TBL_HISTORICO_PORTAL_GILIE', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_HISTORICO_PORTAL_GILIE.numeroContrato)'))
                                        ->select(DB::raw('
                                            ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
                                            ALITB001_Imovel_Completo.[ACEITA_CCA] as aceitaCca, 
                                            ALITB001_Imovel_Completo.[CLASSIFICACAO] as classificacaoImovel,
                                            ALITB001_Imovel_Completo.[NOME_PROPONENTE] as nomeProponente,
                                            ALITB001_Imovel_Completo.[UNA] as gilieDeVinculacao,
                                            ALITB001_Imovel_Completo.[DATA_PROPOSTA] as DATA_PROPOSTA,
                                            ALITB001_Imovel_Completo.[NU_BEM] as numeroContrato, 
                                            TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[codigoAgencia] as codigoAgencia,
                                            ALITB001_Imovel_Completo.[VALOR_REC_PROPRIOS_PROPOSTA] as valorRecursosPropriosProposta,
                                            ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as valorTotalProposta,
                                            ALITB001_Imovel_Completo.[VALOR_FGTS_PROPOSTA] as valorFgtsProposta,
                                            ALITB001_Imovel_Completo.[VALOR_FINANCIADO_PROPOSTA] as valorFinanciadoProposta,
                                            ADJTBL_imoveisCaixa.[tipoDeContratacao] as tipoContratacao,
                                            ALITB001_Imovel_Completo.[TIPO_VENDA] as tipoVenda,
                                            ADJTBL_imoveisCaixa.[nomeStatusDoDossie] as statusContratacao,
                                            ADJTBL_imoveisCaixa.[cardDeAgrupamento] as cardAgrupamento,
                                            CONVERT(VARCHAR, ADJTBL_imoveisCaixa.[dataStatus], 103) as dataStatus,
                                            CONVERT(VARCHAR, ADJTBL_imoveisCaixa.[dataSimov], 103) as dataSimov,
                                            TBL_SALDO_ATUALIZADO_CONTRATOS_SINAF.[saldoAtualContrato] as valorTotalRecebido,
                                            TBL_HISTORICO_PORTAL_GILIE.[updated_at] as dataNovoHistorio,
                                            TBL_HISTORICO_PORTAL_GILIE.[atividade] as tipoHistorico,
                                            TBL_RELACAO_AG_SR_GIGAD_COM_EMAIL.[emailAgencia] as emailAgencia
                                    '))

                                            ->where('ALITB001_Imovel_Completo.UNA', $siglaGilie)
                                            ->where(function($statusSimov) {
                                                $statusSimov->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', 'Em Contratação')
                                                        ->orWhere('ALITB001_Imovel_Completo.STATUS_IMOVEL', 'Contratação pendente');
                                            })
                                            ->latest()->get();
       $arrayContratosParaRemoverRepetidos = [];
        foreach ($consultaContratosConformidade as $contrato) {
            if (!in_array($contrato->numeroContrato, $arrayContratosParaRemoverRepetidos)) {
                switch ($contrato->aceitaCca) {
                    case 'Sim':
                    case 'SIM':
                        $fluxoContratacao = 'CCA';
                        $contrato->cardAgrupamento = 'CCA';
                        $contrato->statusContratacao = 'CCA';
                        $contrato->dataStatus = Carbon::parse($contrato->DATA_PROPOSTA)->format('d/m/Y');
                        break;
                    default:
                        $fluxoContratacao = 'AG';
                        break;
                }
                switch ($contrato->classificacaoImovel) {
                    case 'Em Cadastramento EMGEA':
                    case 'EMGEA':
                    case 'EMGEA - Realização de Garantia':
                    case 'EMGEA- Alienação Fiduciária': 
                        $classificacaoImovel = 'EMGEA';
                        break;
                    case 'Oriundo do Crédito Imobiliário':
                    case 'Oriundos SFI-Gar. Fiduciária':
                    case 'SFI - Gar.Fid.Reg.Créd.Imob':
                        $classificacaoImovel = 'CAIXA';
                        break;
                    case 'Patrimonial':
                    case 'Patrimonial - Alienação Fiduciária':
                    case 'Patrimonial -Realização de Garantia':
                        $classificacaoImovel = 'PATRIMONIAL';
                        break;
                    default:
                        $classificacaoImovel = $contrato->classificacaoImovel;
                        break;
                }

                if ($contrato->valorRecursosPropriosProposta == $contrato->valorTotalProposta) {
                    $tipoProposta = 'A vista com recursos proprios';
                } elseif (($contrato->valorFgtsProposta + $contrato->valorRecursosPropriosProposta) == $contrato->valorTotalProposta) {
                    $tipoProposta = 'A vista com FGTS';
                } else {
                    $tipoProposta = 'Financiado';
                }
    
                if ($contrato->valorTotalRecebido >= $contrato->valorRecursosPropriosProposta) {
                    $sinalPago = 'SIM';
                } else {
                    $sinalPago = 'NAO';
                }

                if ($contrato->statusContratacao == null) {
                    $contrato->cardAgrupamento = 'Agência';
                    $contrato->statusContratacao = 'Em Tratamento Agência';
                    $contrato->dataStatus = Carbon::parse($contrato->DATA_PROPOSTA)->format('d/m/Y');
                } 
                
                array_push($arrayContratosConformidade, [
                    'contratoFormatado' => $contrato->contratoFormatado,
                    'numeroContrato' => $contrato->numeroContrato,
                    'fluxoContratacao' => $fluxoContratacao, 
                    'codigoAgencia' => $contrato->codigoAgencia,
                    'tipoVenda' => $contrato->tipoVenda,
                    'tipoProposta' => $tipoProposta,
                    'valorRecursosProprios' => $contrato->valorRecursosPropriosProposta,
                    'valorTotalRecebido' => $contrato->valorTotalRecebido,
                    'sinalPago' => $sinalPago,
                    'statusContratacao' => $contrato->statusContratacao,
                    'cardAgrupamento' => $contrato->cardAgrupamento,
                    'dataEntradaConformidade' => $contrato->dataStatus,
                    'classificacaoImovel' => $classificacaoImovel,
                    'emailAgencia' => $contrato->emailAgencia,
                    'nomeProponente' => $contrato->nomeProponente,
                    'gilieDeVinculacao' =>$contrato->gilieDeVinculacao,
                    'dataNovoHistorio' =>$contrato->dataNovoHistorio,
                    'tipoHistorico' =>$contrato->tipoHistorico,

                ]);
                array_push($arrayContratosParaRemoverRepetidos, $contrato->numeroContrato);
            }
        }
        return json_encode($arrayContratosConformidade, JSON_UNESCAPED_UNICODE);
        // return json_encode($consultaContratosConformidade);
    }

}
