
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
    <title>MODELO - NOTIFICAÇÃO DE PARECER DE DISTRATO - PROTOCOLO %ID_DISTRATO%</title>

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
    <p>Senhor(a) Gestor(a),</p>

    <br>
    <p>Prezado,</p>

    <b class="centralizado">NOTIFICAÇÃO DE PARECER DE DISTRATO - (IMÓVEL: %CONTRATO_BEM%) </b>

    <br>
    <br>
    <br>
    <p>1     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  O protocolo de distrato %ID_DISTRATO% teve Parecer do Analista emitido e está disponível para deliberação do Gestor no Portal GILIE atrvés do link abaixo:</p>

    <p>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a href="https://portal.gilie.hom.sp.caixa/estoque-imoveis/distrato/tratar/%CONTRATO_BEM%">https://portal.gilie.hom.sp.caixa/estoque-imoveis/distrato/tratar/%CONTRATO_BEM%</a></p>

    <p>2   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Favor efetuar a análise levando em consideração o motivo do distrato, as observações do Parecer do Analista e as despesas cadastradas.</p>

    <p>2.1  &nbsp;&nbsp;    Cada despesa pode ser invalidada caso seja pertinente.</p>

    <p>3   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Alertamos que a orientação de distrato só será enviada à agência mediante a emissão do Parecer do Gestor.</p>

    <br>        
    <p class="destaque">
    Atenciosamente,
    <br>
    Portal GILIE/SP
    </P>


</body>
</html>