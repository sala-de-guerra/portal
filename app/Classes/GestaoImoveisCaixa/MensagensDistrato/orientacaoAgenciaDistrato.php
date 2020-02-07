<!DOCTYPE html>
<html lang="pt-br">
<head>

    <style>
    .centralizado{
        text-align: center;
    }

    .destaque{
        color:black;
        font-weight:bolder;
        font-weight:900;
    }

    .margem{
        margin-left:20px;
    }

    .nao-responder{
        color:gray;
        font-weight: bolder;
    }

    p {
        margin: 5px;
    }

    .pl-20px{
        padding-left: 20px;
    }

    .pl-40px{
        padding-left: 40px;
    }

    td {
        /* text-align: justify; */
        vertical-align: text-top;
        padding-bottom: 10px;
    }

   </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="./estilos.css">  não deu --> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MODELO - ORIENTAÇÃO À AGÊNCIA - PROTOCOLO %ID_DISTRATO%</title>

</head>

<body style='font-family: sans-serif; padding: 20px'>

<!-- DE GILIESP01@CAIXA.GOV.BR -->
<!-- PARA %EMAIL_AGENCIA% -->
<!-- CCO GILIESP01@CAIXA.GOV.BR; %USUARIO_SESSAO% -->
<!-- ASSUNTO Orientação para contabilização de Distrato- Comprador %NOME_PROPONENTE% - CHB %CONTRATO_BEM%-->

    <p>À</p>
    <p>AG %NOME_AGENCIA%,</p>
    <p>A/C Setor de Habitação</p>

    <br>
    <p>Prezado(a) Senhor(a) Gerente,</p>

    <br>
    <table>
        <thead></thead>
        <tbody>
            <tr>
                <td>
                    <b class="centralizado">Assunto:</b>
                </td>
                <td>
                    <b class="pl-20px">Distrato de Imóvel comprado na modalidade %MODALIDADE_VENDA% - Nº do Bem: %CONTRATO_BEM%</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="centralizado">Arrematante:</b>
                </td>
                <td>
                    <b class="pl-20px">%NOME_PROPONENTE_DISTRATO% - CPF / CNPJ: %CPF_CNPJ_PROPONENTE%</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b class="centralizado">Motivo:</b>
                </td>
                <td>
                    <b class="pl-20px">%MOTIVO_DISTRATO%</b>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    <table>
        <thead></thead>
        <tbody>
            <tr>
                <td>
                    1
                </td>
                <td class="pl-20px">
                    Encaminhamos as orientações para a devolução dos valores ao arrematante 
                    %NOME_PROPONENTE_DISTRATO%, tendo em vista o cancelamento da alienação do imóvel 
                    oriundo do contrato %CONTRATO_BEM%.
                </td>
            </tr>
            <tr>
                <td>
                    1.1
                </td>
                <td class="pl-20px">
                    Solicitamos que a agência entre em contato com o cliente para agendar a data para 
                    a devolução dos valores através dos números de telefone: %TELEFONE_PROPONENTE%  ou 
                    pelo email: %EMAIL_PROPONENTE%. 
                </td>
            </tr>
            <!-- <tr>
                <td>
                    2
                </td>
                <td class="pl-20px">
                    Para efetuar a devolução dos valores, segue abaixo orientações contábeis detalhadas 
                    e link para confecção das DLE através do SINAF WEB: 
                </td>
            </tr>
            <tr>
                <td>
                    2.1
                </td>
                <td class="pl-20px">
                    Para confeccionar as DLE de forma automatizada 
                    <a href="%URL_PORTAL_DEMANDA_DISTRATO%">
                        clique aqui
                    </a> para acessar a página "Consultar Bem Imóvel" do Portal GILIE; 
                </td>
            </tr>
            <tr>
                <td>
                    2.2
                </td>
                <td class="pl-20px">
                    Clique na aba "Distrato" e depois clique no botão "Baixar planilha de DLE SINAF WEB";
                </td>
            </tr>
            <tr>
                <td>
                    2.3
                </td>
                <td class="pl-20px">
                    Acesse o portal <a href="https://sinaf.caixa"></a>sinaf.caixa, clique na aba 
                    "Emitir DLE em lote" e efetue o upload da planilha baixada;
                </td>
            </tr>
            <tr>
                <td>
                    2.4
                </td>
                <td class="pl-20px">
                    Ainda no SINAF WEB, clique na aba "Consulta" - "Meus Documentos" e gere as DLE.
                </td>
            </tr> -->
            <tr>
                <td>
                    3
                </td>
                <td class="pl-20px">
                    Abaixo estão listados os valores, datas e eventos contábeis cadastrados no SINAF WEB:
                </td>
            </tr>


            %ORIENTACAO_AGENCIA%

            <!-- SE O IMÓVEL FOR CAIXA OU EMGEA -->
            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Levantamento do Valor de Compra do Imóvel - CHB: %CONTRATO_BEM%</b> <br>
                    -> verificar se o imóvel está cadastrado no GCE/GE ou GCI/CE; <br>
                    -> no GCE/GE ou GCI/CE, recuperar e excluir o TP 195 ou 196 do imóvel <b>(comando já efetuado pela GILIE)</b>; <br>
                    -> após este procedimento, o GCE/GCI gera um TP 252 pendente no valor da venda; <br>
                    -> comandar o TP 252 com sinal D <b>(efetuar este comando na mesma data da contabilização da DLE)</b>; <br>
                    -> DLE evento 1295-5 SIACI AD Recebimento - IR 5 – SL 2 (estorno); <br>
                    -> Data efetiva: %DATA_EFETIVA_DESPESA%, a mesma do TP 195 ou 196; <br>
                    -> Valor: %VALOR_DESPESA%, correspondente à soma de Valor de Recursos Próprios com Financiamento e / ou FGTS, se houverem.
                </td>
            </tr> -->

            <!-- SE O IMÓVEL FOR PATRIMONIAL -->
            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Levantamento do Valor de Compra do Imóvel - CHB: %CONTRATO_BEM%</b> <br>
                    -> DLE evento 28246-4 SL-1;  <br>
                    -> Valor: %VALOR_DESPESA%, correspondente à soma de Valor de Recursos Próprios com Financiamento e / ou FGTS, se houverem.
                </td>
            </tr> -->

            <!-- SE TIVER MULTA CADASTRADO -->
            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Finalização do Valor de Compra do Imóvel (Multa)- CHB: %CONTRATO_BEM%</b> <br>
                    -> DLE Evento 22351-4 ROMID-RECEBIMENTOS A CLASSIFICAR-FINALIZACAO CICOC; <br>
                    -> Valor: %VALOR_DESPESA%; <br>
                    -> Histórico: Reversão em multa do processo de distrato CHB %NUMERO_CONTRATO%.
                </td>
            </tr> -->

            <!-- SE TIVER RECURSOS PROPRIOS CADASTRADO -->

            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Finalização do Valor de Compra do Imóvel (Recursos Próprios)- CHB: %CONTRATO_BEM%</b> <br>
                    -> Creditar na conta do cliente o valor %VALOR_DESPESA%.
                </td>
            </tr> -->
            

            <!-- SE TIVER FINANCIAMENTO OU PARCELAMENTO CADASTRADO -->

            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Exclusão do Contrato de Financiamento em Evolução - CHB: %CONTRATO_BEM%</b> <br>
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
            </tr> -->

            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Finalização do Valor de Compra do Imóvel (Financiamento)- CHB: %CONTRATO_BEM%</b> <br>
                    -> DLE evento 0223-2 Estorno de concessão de financiamento – SL 1;  <br>
                    -> Valor: %VALOR_DESPESA%; <br>
                    -> no GCI/SI, recuperar e excluir o TP 001 do contrato de financiamento; <br>
                    -> após este procedimento as prestações (TP 310) e a taxa à vista recebida (TP 319) ficarão pendentes no CAR, bem como será gerado um TP 025 no CAC; <br>
                    -> comandar o pedido 025 com sinal C;
                </td>
            </tr> -->

            <!-- SE TIVER PARCELAS E TAXAS DE FINANCIAMENTO CADASTRADO -->

            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Devolução das Parcelas e taxas de Financiamento - CHB: %CONTRATO_BEM%</b> <br>
                    -> no GCI/SI Excluir as prestações e taxas através da ação EXC; <br>
                    -> DLE evento  0203-8 Devolução de prestação e diferença de prestação - SL 1; <br>
                    -> Valor: %SOMA_DAS_PRESTACOES%; <br>
                    -> Em contrapartida, efetuar crédito na conta do cliente; <br>
                    -> A atualização monetária das parcelas e taxas é calculada pela taxa da poupança e contabilizada conforme abaixo; <br>
                    -> DLE evento 08679-7 Despesas com Distrato - SL 1; <br>
                    -> Valor: %SOMA_ATUALIZACAO_DESPESA%; <br>
                    -> Centro de Custo: 7257; <br>
                    -> Produto: 0427-6 Imóveis adjudicados/arrematados; <br>
                    -> Número de conciliação: %NUMERO_CONTRATO%; <br>
                    -> Histórico: atualização monetária apurada sobre o valor pago em taxa e prestações do financiamento.
                </td>
            </tr> -->

            <!-- SE TIVER FGTS CADASTRADO -->
            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Devolução do FGTS para a conta vinculada - CHB: %CONTRATO_BEM%</b> <br>
                    -> no  caso  de  utilização  de  FGTS,  efetuar  o  cancelamento  total  do  DAMP,  solicitando  à  GIFUG  o  retorno  à  conta vinculada do FGTS.
                </td>
            </tr> -->

            <!-- SE TIVER REEMBOLSO AUTORIZADO EMGEA CADASTRADO -->
            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>Reembolso de Despesas Autorizadas pela EMGEA - CHB: %CONTRATO_BEM%</b> <br>
                    -> DLE evento 02534-8 - SL 1 - IR 5; <br>
                    -> Valor: %SOMA_DEPESA_E_ATUALIZACAO%; <br>
                    -> Número de conciliação: %NUMERO_CONTRATO%; <br>
                    -> Histórico: Valor do %TIPO DESPESA% + atualização monetária apurada sobre o valor pago.
                </td>
            </tr> -->
            
            <!-- SE TIVER (
                BENFEITORIAS
                COMISSAO DE LEILOEIRO
                CONDOMINIO
                CUSTAS CARTORARIAS
                IPTU
                ITBI
                OUTRAS DESPESAS
            )CADASTRADO -->
            <!-- <tr>
                <td class="pl-40px">
                    <b>•</b>
                </td>
                <td class="pl-20px">
                    <b>%TIPO DESPESA% + Correção Monetária - CHB: %CONTRATO_BEM%</b> <br>
                    -> DLE evento 08679-7 Despesas com Distrato - SL 1; <br>
                    -> Valor: %SOMA_DEPESA_E_ATUALIZACAO%
                    -> Centro de Custo: 7257; <br>
                    -> Produto: 0427-6 Imóveis adjudicados/arrematados; <br>
                    -> Projeto: 990630; <br>
                    -> Número de conciliação: %NUMERO_CONTRATO%; <br>
                    -> Histórico: Valor do %TIPO DESPESA% + atualização monetária apurada sobre o valor pago.
                </td>
            </tr> -->

            <tr>
                <td>
                    4
                </td>
                <td class="pl-20px">
                    Permanecemos à disposição.
                </td>
            </tr>

            
        </tbody>
    </table>

    <br>        
    <p class="destaque">
    Atenciosamente,
    <br>
    GILIE/SP | GI ALIENAR BENS MOVEIS E IMOVEIS
    </P>


</body>
</html>