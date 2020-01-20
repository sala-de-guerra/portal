
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
        <tr>
            <td>
                <p>1</p>
            </td>
            <td>
                <p class="pl-20px">O protocolo de distrato %ID_DISTRATO% teve Parecer do Analista emitido 
                    e está disponível para deliberação do Gestor no Portal GILIE atrvés do link abaixo:</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> </p>
            </td>
            <td>
                <p class="pl-40px">
                <a href="<?= env('APP_URL') ?>/estoque-imoveis/distrato/tratar/%CONTRATO_BEM%">
                <?= env('APP_URL') ?>/estoque-imoveis/distrato/tratar/%CONTRATO_BEM%</a>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2</p>
            </td>
            <td>
                <p class="pl-20px">Favor efetuar a análise levando em consideração o motivo do distrato, 
                    as observações do Parecer do Analista e as despesas cadastradas.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2.1</p>
            </td>
            <td>
                <p class="pl-20px">Cada despesa pode ser invalidada caso seja pertinente.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3</p>
            </td>
            <td>
                <p class="pl-20px">Alertamos que a orientação de distrato só será enviada à agência 
                    mediante a emissão do Parecer do Gestor.</p>
            </td>
        </tr>

    </table>

    <br>        
    <p class="destaque">
    Atenciosamente,
    <br>
    Portal GILIE/SP
    </P>


</body>
</html>