
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
    <title>MODELO - NOTIFICAÇÃO DE PARECER DE DISTRATO - PROTOCOLO %ID_DISTRATO%</title>

</head>

<!-- DE GILIESP09@CAIXA.GOV.BR -->
<!-- PARA %EMAIL_GESTOR%  -->
<!-- CCO GILIESP01@CAIXA.GOV.BR; %USUARIO_SESSAO% -->
<!-- ASSUNTO Notificação de Parecer do Analista de Distrato - Imóvel %CONTRATO_BEM% -->


<body style='font-family: sans-serif; padding: 20px'>

    <p class="nao-responder">MENSAGEM AUTOMÁTICA. FAVOR NÃO RESPONDER.</p>

    <p>À(o)</p>
    <p>Senhor(a) Gestor(a),</p>

    <br>
    <p>Prezado,</p>

    <b class="centralizado">NOTIFICAÇÃO DE PARECER DE DISTRATO - (IMÓVEL: %CONTRATO_BEM%) </b>

    <br>
    <br>
    <table>
        <thead></thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="pl-20px">
                    O protocolo de distrato %ID_DISTRATO% teve Parecer do Analista emitido 
                    e está disponível para deliberação do Gestor no Portal GILIE atrvés do link abaixo:
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="pl-40px">
                    <a href="%URL_PORTAL_DEMANDA_DISTRATO%">
                    %URL_PORTAL_DEMANDA_DISTRATO%
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td class="pl-20px">
                    Favor efetuar a análise levando em consideração o motivo do distrato, 
                    as observações do Parecer do Analista e as despesas cadastradas.
                </td>
            </tr>
            <tr>
                <td>2.1</td>
                <td class="pl-20px">
                    Cada despesa pode ser invalidada caso seja pertinente.
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td class="pl-20px">
                    Alertamos que a orientação de distrato só será enviada à agência 
                    mediante a emissão do Parecer do Gestor.
                </td>
            </tr>
    </table>

    <br>        
    <p class="destaque">
    Atenciosamente,
    <br>
    GILIE/SP | GI ALIENAR BENS MOVEIS E IMOVEIS
    </P>


</body>
</html>