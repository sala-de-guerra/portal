
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
        text-align: justify;
        vertical-align: text-top;
    }

   </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="./estilos.css">  não deu --> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MODELO - NOTIFICAÇÃO DE CADASTRO DE DISTRATO - PROTOCOLO %ID_DISTRATO%</title>

</head>

<!-- DE GILIESP09@CAIXA.GOV.BR -->
<!-- PARA %EMAIL_PROPONENTE%  -->
<!-- CC %EMAIL_AGENCIA% -->
<!-- CCO GILIESP01@CAIXA.GOV.BR; %USUARIO_SESSAO% -->
<!-- ASSUNTO Notificação de cadastro de Distrato - Imóvel %CONTRATO_BEM% -->

<body style='font-family: sans-serif; padding: 20px'>

    <p class="nao-responder">MENSAGEM AUTOMÁTICA. FAVOR NÃO RESPONDER.</p>

    <p>À(o)</p>
    <p>Senhor(a) %NOME_PROPONENTE_DISTRATO%,</p>

    <br>
    <p>Agência %NOME_AGENCIA%</p>
    <p>A/C Setor de Habitação</p>

    <br>
    <p>Prezados,</p>

    <br>
    <b class="centralizado">NOTIFICAÇÃO DE CADASTRO DE DISTRATO - (IMÓVEL: %CONTRATO_BEM%) </b>
 
    <br>
    <br>
    <table>
        <thead></thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="pl-20px">
                    Informamos que foi cadastrada nesta data a demanda de distrato 
                    número %ID_DISTRATO% referente ao imóvel %CONTRATO_BEM% cito à %ENDERECO_IMOVEL% 
                    comprado por vossa senhoria em %DATA_PROPOSTA% e entraremos em contato em breve.
                </td>
            </tr>
            <br>
            <tr>
                <td>1.1</td>
                <td class="pl-20px">
                    A GILIE/SP irá executar a pré-análise desta demanda e reserva-se o 
                    direito de solicitar maiores informações ou docuumentos durante o processo de análise.
                </td>
            </tr>
            <br>
            <tr>
                <td>2</td>
                <td class="pl-20px">
                    Em caso de dúvidas, favor entrar em contato com a Agência de vinculação 
                    da negociação ou com esta GILIE/SP através da caixa postal GILIESP01@caixa.gov.br.
                </td>
            </tr>
        </tbody>
    </table>
    
    <br>
    <p class="destaque">
    Atenciosamente,
    <br>
    Equipe GILIE/SP
    </P>


</body>
</html>