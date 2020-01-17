
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

    th, td {
        border: 1px solid black;
        padding: 5px;
    }

   </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="./estilos.css">  não deu --> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MODELO - NOTIFICAÇÃO DE CADASTRO DE DISTRATO - PROTOCOLO %ID_DISTRATO%</title>

</head>

<body style='font-family: sans-serif; padding: 20px'>

<!-- <h4>Para Conferir e Enviar E-mail</h4>
<ul>
    <li>Contrato: %CONTRATO_BEM%</li>
    <li>Nome Agência: %NOME_AGENCIA%</li>
    <li>Código Agência: %CODIGO_AGENCIA%</li>
    <li>Nome Proponente: %NOME_PROPONENTE%</li>
    <li>E-mail Proponente: %EMAIL_PROPONENTE%</li>
    <li>Nome Corretor: %NOME_CORRETOR%</li>
    <li>E-mail Corretor: %EMAIL_CORRETOR%</li>
    <li>Endereço Imóvel: %ENDERECO_IMOVEL%</li>
    <li>MO Utilizado: %MO_UTILIZADO%</li>
    <li>Edital Leião: %EDITAL_LEILAO%</li>
    <li>Manual Utilizado: %MN_UTILIZADO%</li>
    <li>Origem Matricula: %ORIGEM_MATRICULA%</li>
</ul> -->

    <p class="nao-responder">MENSAGEM AUTOMÁTICA. FAVOR NÃO RESPONDER.</p>

    <p>À(o)</p>
    <p>Senhor(a) %NOME_PROPONENTE_DISTRATO%,</p>

    <br>
    <p>Agência %NOME_AGENCIA%</p>
    <p>A/C Setor de Habitação</p>

    <br>
    <p>Prezados,</p>

    <b class="centralizado">NOTIFICAÇÃO DE CADASTRO DE DISTRATO - (IMÓVEL: %CONTRATO_BEM%) </b>

    <br>
    <br>
    <br>
    <p>1     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Informamos que foi cadastrada nesta data a demanda de distrato número %ID_DISTRATO% referente ao imóvel %CONTRATO_BEM% cito à %ENDERECO_IMOVEL% comprado por vossa senhoria em %DATA_PROPOSTA% e entraremos em contato em breve.</p>

    <p>1.1   &nbsp;&nbsp;   A GILIE/SP irá executar a pré-análise desta demanda e reserva-se o direito de solicitar maiores informações ou docuumentos durante o processo de análise.</p>

    <p>2   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Em caso de dúvidas, favor entrar em contato com a Agência de vinculação da negociação ou com esta GILIE / SP através da caixa postal GILIESP01@caixa.gov.br.</p>

    <br>        
    <p class="destaque">
    Atenciosamente,
    <br>
    Equipe GILIE/SP
    </P>


</body>
</html>