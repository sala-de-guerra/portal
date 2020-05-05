<?php

namespace App\Classes\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\RelacaoAgSrComEmail;
use App\Models\BaseSimov;
use Illuminate\Support\Carbon;
use Cmixin\BusinessDay;
use App\Models\GestaoImoveisCaixa\DistratoRelacaoDespesas;

class DistratoPhpMailer
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public static function enviarMensageria($request, $modeloMensagem)
    {
        $mail = new PHPMailer(true);
        $objRelacaoEmailUnidades = self::validaUnidadeDemandanteEmail($request);
        self::carregarDadosEmail($request, $modeloMensagem, $objRelacaoEmailUnidades, $mail);
        self::enviarEmail($mail);
    }

    public static function validaUnidadeDemandanteEmail($objDistrato) 
    {
        $objRelacaoEmailUnidades = RelacaoAgSrComEmail::where('codigoAgencia', $objDistrato->codigoAgenciaContratacao)->first();
        $arrayDadosEmailUnidade = [
            'nomeAgencia' => $objRelacaoEmailUnidades->nomeAgencia,
            'emailAgencia' => $objRelacaoEmailUnidades->emailAgencia,
            'nomeSr' => $objRelacaoEmailUnidades->nomeSr,
            'emailSr' => $objRelacaoEmailUnidades->emailsr
        ];
        return json_decode(json_encode($arrayDadosEmailUnidade), FALSE);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public static function carregarDadosEmail($request, $modeloMensagem, $objRelacaoEmailUnidades, $mail)
    {
        //Server settings
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8'; 
        $mail->isHTML(true);                                         
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;
        // $mail->SMTPDebug = 2;                                         

        // DESTINATÁRIOS
        $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
        $mail->addReplyTo('GILIESP01@caixa.gov.br');

        switch (env('APP_ENV')) {
            case 'DESENVOLVIMENTO':

                $mail->addAddress('c098453@mail.caixa');
                break;
            case 'HOMOLOGACAO':
                $mail->addBCC('c098453@mail.caixa');
                $mail->addAddress(session('matricula') . '@mail.caixa');
                break;
            case 'PRODUCAO':
                $mail->addBCC(session('matricula') . '@mail.caixa');
                $mail->addBCC('c076585@mail.caixa');
                $mail->addBCC('c079436@mail.caixa');
                $mail->addBCC('GILIESP09@mail.caixa');
                break;
        }
  
        // CAPTURA OS DADOS DO CONTRATO
        $dadosContrato = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();

        // VALIDA CLASSIFICAÇÃO DO IMÓVEL
        switch ($dadosContrato->CLASSIFICACAO) {
            case 'Em Cadastramento EMGEA':
            case 'EMGEA':
            case 'EMGEA - Realização de Garantia':
            case 'EMGEA- Alienação Fiduciária': 
                $classificacao = 'EMGEA';
                break;
            case 'Oriundo do Crédito Imobiliário':
            case 'Oriundos SFI-Gar. Fiduciária':
            case 'SFI - Gar.Fid.Reg.Créd.Imob':
                $classificacao = 'CAIXA';
                break;
            case 'Patrimonial':
            case 'Patrimonial - Alienação Fiduciária':
            case 'Patrimonial -Realização de Garantia':
                $classificacao = 'PATRIMONIAL';
                break;
            default:
                $classificacao = $dadosContrato->CLASSIFICACAO;
                break;
        }
        
        $mensagemAutomatica = file_get_contents(("MensagensDistrato/{$modeloMensagem}.php"), dirname(__FILE__));

        // REALIZA O REPLACE DAS VARIAVEIS COM OS DADOS DO JSON
        switch ($modeloMensagem) {
            case 'notificacaoCadastroDistrato':
                // INSERE DESTINATARIOS
                // if (env('APP_ENV') == 'PRODUCAO') {
                //     if ($request->emailProponente) {
                //         $mail->addCC($request->emailProponente);
                //     }
                //     if ($request->emailCorretor) {
                //         $mail->addCC($request->emailCorretor);
                //     }
                //     $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
                // }

                // CONVERT A STRING DATA PROPOSTA EM DATETIME E ASSIM MUDAR O FORMATO DELA
                $dataConvertida = strtotime($request->dataProposta);
                $dataProposta = date('d/m/Y', $dataConvertida);

                $mail->Subject = "Notificação de cadastro de Distrato - Imóvel $request->contratoFormatado";

                // SUBSTITUI AS VARIAVÉIS DO MODELO DE E-MAIL COM OS DADOS DA OPERAÇÃO
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%ENDERECO_IMOVEL%", $dadosContrato->ENDERECO_IMOVEL, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%DATA_PROPOSTA%", $dataProposta, $mensagemAutomatica);
                break;
            case 'notificacaoGestorParecerAnalista':
                // INSERE DESTINATARIOS
                if (env('APP_ENV') == 'PRODUCAO') {
                    $mail->addAddress('c072452@mail.caixa');
                    $mail->addAddress('c090120@mail.caixa');
                    $mail->addAddress('c079436@mail.caixa');
                }

                $mail->Subject = "Notificação de Parecer do Analista de Distrato - Imóvel $request->contratoFormatado";

                // SUBSTITUI AS VARIAVÉIS DO MODELO DE E-MAIL COM OS DADOS DA OPERAÇÃO
                $mensagemAutomatica = str_replace("%URL_PORTAL_DEMANDA_DISTRATO%", env('APP_URL') . "/estoque-imoveis/distrato/tratar/" . $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                break;
            case 'orientacaoClienteDistratoComMulta':
                // INSERE DESTINATARIOS
                // if (env('APP_ENV') == 'PRODUCAO') {
                //     if ($request->emailProponente) {
                //         $mail->addAddress($request->emailProponente);
                //     }
                //     if ($request->emailCorretor) {
                //         $mail->addCC($request->emailCorretor);
                //     }
                //     $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
                // }

                $valorMulta = $request->valorTotalProposta * 0.05;

                $mail->Subject = "Orientações para processo de distrato - Comprador $request->nomeProponente - CHB $request->contratoFormatado";

                // SUBSTITUI AS VARIAVÉIS DO MODELO DE E-MAIL COM OS DADOS DA OPERAÇÃO
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_TOTAL_PROPOSTA_DISTRATO%", $request->valorTotalProposta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_MULTA_DISTRATO%", $valorMulta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);               
                break;
            case 'orientacaoClienteDistratoSemMulta':
                // INSERE DESTINATARIOS
                // if (env('APP_ENV') == 'PRODUCAO') {
                //     if ($request->emailProponente) {
                //         $mail->addAddress($request->emailProponente);
                //     }
                //     if ($request->emailCorretor) {
                //         $mail->addCC($request->emailCorretor);
                //     }
                //     $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
                // }

                $mail->Subject = "Orientações para processo de distrato - Comprador $request->nomeProponente - CHB $request->contratoFormatado";

                // SUBSTITUI AS VARIAVÉIS DO MODELO DE E-MAIL COM OS DADOS DA OPERAÇÃO
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);
                break;
            case 'pedidoAutorizacaoEmgea':
                // INSERE DESTINATARIOS
                // if (env('APP_ENV') == 'PRODUCAO') {
                //     $mail->addAddress('geipt@mail.caixa');
                // }

                $mail->Subject = "Solicitação de autorização de distrato - Imóvel EMGEA - Comprador $request->nomeProponente - CHB $request->contratoFormatado";

                // SUBSTITUI AS VARIAVÉIS DO MODELO DE E-MAIL COM OS DADOS DA OPERAÇÃO
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                break;
            case 'solicitacaoDocumentosReembolso':
                // INSERE DESTINATARIOS
                // if (env('APP_ENV') == 'PRODUCAO') {
                //     if ($request->emailProponente) {
                //         $mail->addAddress($request->emailProponente);
                //     }
                //     if ($request->emailCorretor) {
                //         $mail->addCC($request->emailCorretor);
                //     }
                //     $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
                // }

                $mail->Subject = "Solicitação de documentos para processo de distrato - Comprador $request->nomeProponente - CHB $request->contratoFormatado";

                // SUBSTITUI AS VARIAVÉIS DO MODELO DE E-MAIL COM OS DADOS DA OPERAÇÃO
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);
                break;
            case 'orientacaoAgenciaDistrato':
                // INSERE DESTINATARIOS
                // if (env('APP_ENV') == 'PRODUCAO') {
                //     $mail->addAddress($objRelacaoEmailUnidades->emailAgencia);
                // }

                $mail->Subject = "Orientação para contabilização de Distrato - Comprador $request->nomeProponente - CHB $request->contratoFormatado";

                $valorMulta = $request->valorTotalProposta * 0.05;

                // MONTA COMPONENTE PARA MONTAR AS ORIENTAÇÕES CONTABEIS PARA A AGÊNCIA
                $objBaseSimov = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();
                $objRelacaoDespesasDistrato = DistratoRelacaoDespesas::where('idDistrato', $request->idDistrato)->where('devolucaoPertinente', 'SIM')->get();
                $corpoMensagemOrientacaoAgencia = '';
                $corpoMensagemOrientacaoAgencia = self::montaComponenteDistratoLevantamentoRecursosPorClassificacaoImovel($objBaseSimov, $request, $objRelacaoDespesasDistrato, $corpoMensagemOrientacaoAgencia);
                $corpoMensagemOrientacaoAgencia = self::montaComponentePorDespesaOrientacoesAgencia($objBaseSimov, $request, $objRelacaoDespesasDistrato, $corpoMensagemOrientacaoAgencia);

                // SUBSTITUI AS VARIAVÉIS DO MODELO DE E-MAIL COM OS DADOS DA OPERAÇÃO
                $mensagemAutomatica = str_replace("%ORIENTACAO_AGENCIA%", $corpoMensagemOrientacaoAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%URL_PORTAL_DEMANDA_DISTRATO%", env('APP_URL') . "/consulta-bem-imovel/" . $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%ID_DISTRATO%", $request->idDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CONTRATO_BEM%", $request->contratoFormatado, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_AGENCIA%", $objRelacaoEmailUnidades->nomeAgencia, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MODALIDADE_VENDA%", $classificacao, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%NOME_PROPONENTE_DISTRATO%", $request->nomeProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%CPF_CNPJ_PROPONENTE%", $request->cpfCnpjProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%MOTIVO_DISTRATO%", $request->motivoDistrato, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_TOTAL_PROPOSTA_DISTRATO%", $request->valorTotalProposta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%VALOR_MULTA_DISTRATO%", $valorMulta, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%TELEFONE_PROPONENTE%", $request->telefoneProponente, $mensagemAutomatica);
                $mensagemAutomatica = str_replace("%EMAIL_PROPONENTE%", $request->emailProponente, $mensagemAutomatica);
                break;
        }       
        $mail->Body = $mensagemAutomatica;
        return $mail; 
    }

    public static function enviarEmail($mail) 
    {
        try {
            $mail->send();
        } catch (Exception $e) {
            // echo "Mensagem não pode ser enviada. Erro: {$mail->ErrorInfo}";
        }
    }

    public static function montaComponenteDistratoLevantamentoRecursosPorClassificacaoImovel($objBaseSimov, $objDistrato, $objRelacaoDespesasDistrato, $corpoMensagemOrientacaoAgencia)
    {
        $dataEfetivaLevantamento = '';
        $valorTotalLevantamento = 0;

        // REALIZAR O LEVANTAMENTO DAS DESPESAS RELACIONADA AOS RECURSOS PROPRIOS, FGTS, FINANCIAMENTO, MULTA E PARCELAMENTO
        foreach ($objRelacaoDespesasDistrato as $despesa) {
            switch ($despesa->tipoDespesa) {
                case 'RECURSOS PROPRIOS':
                    $dataEfetivaLevantamento = Carbon::parse($despesa->dataEfetivaDaDespesa)->format('d/m/Y');
                    $valorTotalLevantamento += $despesa->valorDespesa;
                    break;
                case 'FGTS':
                case 'MULTA':
                case 'FINANCIAMENTO':
                case 'PARCELAMENTO':
                    $valorTotalLevantamento += $despesa->valorDespesa;
                    break;
            }
        }
       
        // MONTAR O COMPONENTE QUE MONTA AS INFORMAÇÕES PARA LEVANTAMENTO DE RECURSOS
        switch ($objBaseSimov->CLASSIFICACAO) {
            // PATRIMONIAL
            case 'Patrimonial':
            case 'Patrimonial - Alienação Fiduciária':
            case 'Patrimonial -Realização de Garantia':
                $corpoMensagemOrientacaoAgencia .= "
                    <tr>
                        <td class='pl-40px'>
                            <b>•</b>
                        </td>
                        <td class='pl-20px'>
                            <b>Levantamento do Valor de Compra do Imóvel - CHB: $objBaseSimov->contratoFormatado</b> <br>
                            -> DLE evento 28246-4 SL-1;  <br>
                            -> Valor: R$ " . number_format($valorTotalLevantamento, 2, ',', '.') . ", correspondente à soma de Valor de Recursos Próprios com Financiamento e / ou FGTS, se houverem.
                        </td>
                    </tr>";
                break;
            //CAIXA OU EMGEA
            case 'EMGEA':
            case 'EMGEA - Realização de Garantia':
            case 'EMGEA- Alienação Fiduciária':
            case 'PANAMERICANO':
            case 'Oriundo do Crédito Imobiliário':
            case 'Oriundos SFI-Gar. Fiduciária':
            case 'SFI - Gar.Fid.Reg.Créd.Imob':
                $corpoMensagemOrientacaoAgencia .= "
                    <tr>
                        <td class='pl-40px'>
                            <b>•</b>
                        </td>
                        <td class='pl-20px'>
                            <b>Levantamento do Valor de Compra do Imóvel - CHB: $objBaseSimov->contratoFormatado </b> <br>
                            -> verificar se o imóvel está cadastrado no GCE/GE ou GCI/CE; <br>
                            -> no GCE/GE ou GCI/CE, recuperar e excluir o TP 195 ou 196 do imóvel; <b>(comando já efetuado pela GILIE)</b>; <br>
                            -> após este procedimento, o GCE/GCI gera um TP 252 pendente no valor da venda; <br>
                            -> comandar o TP 252 com sinal D <b>(efetuar este comando na mesma data da contabilização da DLE)</b>; <br>
                            -> DLE evento 1295-5 SIACI AD Recebimento - IR 5 – SL 2 (estorno);  <br>
                            -> Data efetiva: $dataEfetivaLevantamento, a mesma do TP 195 ou 196; <br>
                            -> Valor: R$ " . number_format($valorTotalLevantamento, 2, ',', '.') . ", correspondente à soma de Valor de Recursos Próprios com Financiamento e / ou FGTS, se houverem.
                        </td>
                    </tr>";
                break;
        }
        // RETORNA PARA O METODO DE MONTA
        return $corpoMensagemOrientacaoAgencia;
    }

    public static function montaComponentePorDespesaOrientacoesAgencia($objBaseSimov, $objDistrato, $objRelacaoDespesasDistrato, $corpoMensagemOrientacaoAgencia)
    {        
        foreach ($objRelacaoDespesasDistrato as $despesa) {
            // CAPTURA AS DESPESAS DA DEMANDA
            switch ($despesa->tipoDespesa) {
                case 'MULTA':
                    $corpoMensagemOrientacaoAgencia .= "
                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>Finalização do Valor de Compra do Imóvel (Multa) - CHB: $objDistrato->contratoFormatado</b> <br>
                                -> DLE Evento 22351-4 ROMID-RECEBIMENTOS A CLASSIFICAR-FINALIZACAO CICOC; <br>
                                -> Valor: R$ " . number_format($despesa->valorDespesa, 2, ',', '.') . "; <br>
                                -> Histórico: Reversão em multa do processo de distrato CHB $objBaseSimov->NU_BEM.
                            </td>
                        </tr>";
                    break;
                case 'RECURSOS PROPRIOS':
                    $corpoMensagemOrientacaoAgencia .= "
                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>Finalização do Valor de Compra do Imóvel (Recursos Próprios) - CHB: $objDistrato->contratoFormatado</b> <br>
                                -> Creditar na conta do cliente o valor R$ " . number_format($despesa->valorDespesa, 2, ',', '.') . ".
                            </td>
                        </tr>";
                    break;
                case 'FINANCIAMENTO E FGTS':
                case 'PARCELAMENTO E FGTS':
                    $corpoMensagemOrientacaoAgencia .= "
                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>Exclusão do Contrato de Financiamento em Evolução - CHB: $objDistrato->contratoFormatado</b> <br>
                                <b>Para exclusão do contrato de financiamento ativo em evolução no SIACI/CIWEB, a agência deverá solicitar a exclusão à CEHOP conforme MN HH160:</b> <br>
                                4.6 EXCLUSÃO DE CONTRATOS HABITACIONAIS EM EVOLUÇÃO NO SIACI/CIWEB/GCI - MÓDULO CONCESSÃO E SIAOI <br>
                                4.6.1 AGÊNCIA/PA <br>
                                4.6.1.1 Identifica situação passível de exclusão do contrato habitacional. <br>
                                4.6.1.2 Preenche o Formulário de Solicitação de Exclusão conforme modelo disponível na Página Intranet CEHOP, no link: “Tutoriais Agência”. <br>
                                4.6.1.3 Encaminha o Formulário de Solicitação de Exclusão através de mensagem eletrônica para a SR de vinculação e solicita concordância daquela Unidade. <br>
                                4.6.1.4 Encaminha o Formulário de Solicitação de Exclusão e a concordância da SR para análise da CEHOP, através de mensagem eletrônica para a caixa postal CEHOP17, juntamente com o endereço lógico da rede onde poderão ser obtidos os arquivos de imagens dos documentos digitalizados, tais como contrato, distrato e certidão da matrícula, padrão “.TIF” ou “.PDF”. <br>
                                4.6.1.5 Aguarda manifestação da Centralizadora em até 10 dias úteis contados da data de cada mensagem recebida pela CEHOP, mensagem única ou de retorno(s). <br>
                                4.6.1.6 Efetua os procedimentos operacionais, contábeis e de estorno, inclusive em contas de clientes, de subsídio e de FGTS, se necessários, além da exclusão/regularização do contrato no SIOPI. 
                            </td>
                        </tr>
                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>Finalização do Valor de Compra do Imóvel (Financiamento) - CHB: $objDistrato->contratoFormatado</b> <br>
                                -> DLE evento 0223-2 Estorno de concessão de financiamento – SL 1;  <br>
                                -> Valor: R$ " . number_format($despesa->valorDespesa, 2, ',', '.') . "; <br>
                                -> no GCI/SI, recuperar e excluir o TP 001 do contrato de financiamento; <br>
                                -> após este procedimento as prestações (TP 310) e a taxa à vista recebida (TP 319) ficarão pendentes no CAR, bem como será gerado um TP 025 no CAC; <br>
                                -> comandar o pedido 025 com sinal C;
                            </td>
                        </tr>

                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>Devolução do FGTS para a conta vinculada (se houver) - CHB: $objDistrato->contratoFormatado</b> <br>
                                -> no  caso  de  utilização  de  FGTS,  efetuar  o  cancelamento  total  do  DAMP,  solicitando  à  GIFUG  o  retorno  à  conta vinculada do FGTS.
                            </td>
                        </tr>";

                    break;
                case 'PARCELAS E TAXAS DE FINANCIAMENTO':
                    $corpoMensagemOrientacaoAgencia .= "
                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>Devolução das Parcelas e taxas de Financiamento - CHB: $objDistrato->contratoFormatado</b> <br>
                                -> no GCI/SI Excluir as prestações e taxas através da ação EXC; <br>
                                -> DLE evento  0203-8 Devolução de prestação e diferença de prestação - SL 1; <br>
                                -> Valor: R$ " . number_format($despesa->valorDespesa, 2, ',', '.') . "; <br>
                                -> Em contrapartida, efetuar crédito na conta do cliente; <br>
                                -> A atualização monetária das parcelas e taxas é calculada pela taxa da poupança e contabilizada conforme abaixo; <br>
                                -> DLE evento 08679-7 Despesas com Distrato - SL 1; <br>
                                -> Centro de Custo: 7257; <br>
                                -> Número de conciliação: $objBaseSimov->NU_BEM; <br>
                                -> Histórico: atualização monetária apurada sobre o valor pago em taxa e prestações do financiamento.
                            </td>
                        </tr>";
                    break;
                case 'AUTORIZADAS REEMBOLSO EMGEA':
                    $corpoMensagemOrientacaoAgencia .= "
                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>Reembolso de Despesas Autorizadas pela EMGEA - CHB: $objDistrato->contratoFormatado</b> <br>
                                -> DLE evento 02534-8 - SL 1 - IR 5; <br>
                                -> Valor: R$ " . number_format($despesa->valorDespesa, 2, ',', '.') . "; <br>
                                -> Número de conciliação: $objBaseSimov->NU_BEM; <br>
                                -> Histórico: Valor do $despesa->tipoDespesa + atualização monetária apurada sobre o valor pago.
                            </td>
                        </tr>";
                    break;
                case 'BENFEITORIAS':
                case 'COMISSAO DE LEILOEIRO':
                case 'CONDOMINIO':
                case 'CUSTAS CARTORARIAS':
                case 'IPTU':
                case 'ITBI':
                    $corpoMensagemOrientacaoAgencia .= "
                        <tr>
                            <td class='pl-40px'>
                                <b>•</b>
                            </td>
                            <td class='pl-20px'>
                                <b>$despesa->tipoDespesa + Correção Monetária - CHB: $objDistrato->contratoFormatado</b> <br>
                                -> DLE evento 08679-7 Despesas com Distrato - SL 1; <br>
                                -> Valor: R$ " . number_format($despesa->valorDespesa, 2, ',', '.') . "; <br>
                                -> Centro de Custo: 7257; <br>
                                -> Produto: 0427-6 Imóveis adjudicados/arrematados; <br>
                                -> Projeto: 990630; <br>
                                -> Número de conciliação: $objBaseSimov->NU_BEM; <br>
                                -> Histórico: Valor do $despesa->tipoDespesa + atualização monetária apurada sobre o valor pago.
                            </td>
                        </tr>";
                    break;
            }
        }
        // RETORNA PARA O METODO DE MONTA
        return $corpoMensagemOrientacaoAgencia;
    }
}