
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
    <title>MODELO - ORIENTAÇÃO AO CLIENTE DE DISTRATO - PROTOCOLO %ID_DISTRATO%</title>

</head>

<body style='font-family: sans-serif; padding: 20px'>


<!-- DE GILIESP01@CAIXA.GOV.BR -->
<!-- PARA  %EMAIL_PROPONENTE% %EMAIL_CORRETOR% -->
<!-- CC %EMAIL_AGENCIA% -->
<!-- CCO GILIESP01@CAIXA.GOV.BR; %USUARIO_SESSAO% -->
<!-- ASSUNTO Orientações ao cliente para processo de distrato - Comprador %NOME_PROPONENTE% - CHB %CONTRATO_BEM%-->

    <p>Prezados(as) Senhores(as),</p>

    <br>
    <p>C/C Agência %NOME_AGENCIA%</p>

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
    <br>


    <table>
        <thead></thead>
        <tbody>
            <tr>
                <td>
                    1
                </td>
                <td class="pl-20px">
                    Tendo em vista a solicitação de desistência de aquisição pela arrematante, informamos 
                    que o distrato ou cancelamento motivado por desinteresse do adquirente equipara-se à 
                    desistência, com multa revertida em favor da CAIXA
                </td>
            </tr>
            <tr>
                <td>
                    2
                </td>
                <td class="pl-20px">
                    A devolução dos valores serão realizados na agência da Caixa escolhida para contração, 
                    agência %NOME_AGENCIA%, para qual já enviamos autorização e orientações necessárias.
                </td>
            </tr>
            <tr>
                <td>
                    3
                </td>
                <td class="pl-20px">
                    Os valores passíveis de devolução pela Caixa são os que seguem:
                </td>
            </tr>
            <tr>
                <td>
                    <b class="pl-40px">•</b>
                </td>
                <td>
                    <b>valores pagos a título de recursos próprios tais como sinal, prestação de 
                    financiamento e tarifa de concessão de financiamento;</b>
                </td>
            </tr>
            <tr>
                <td>
                    4
                </td>
                <td class="pl-20px">
                    Sendo assim, de acordo com as Regras do edital, o arrematante desistente será penalizado 
                    com multa, conforme segue:
                </td>
            </tr>
            <tr>
                <td class="pl-20px">
                    <b>16</b>
                </td>
                <td class="pl-20px">
                    <b>DA MULTA</b>
                </td>
            </tr>
            <tr>
                <td class="pl-20px">
                    16.1
                </td>
                <td class="pl-20px">
                    Após o pagamento da parte em recursos próprios, o proponente vencedor perde em favor da 
                    CAIXA, o valor equivalente a 5% do valor mínimo de venda, a título de multa, nos casos de:
                </td>
            </tr>
            <tr>
                <td class="pl-20px">
                    16.1.1
                </td>
                <td class="pl-20px">
                    desistência;
                </td>
            </tr>
            <tr>
                <td class="pl-20px">
                    16.1.2
                </td>
                <td class="pl-20px">
                    não cumprimento do prazo para pagamento do valor total;
                </td>
            </tr>
            <tr>
                <td class="pl-20px">
                    16.1.3
                </td>
                <td class="pl-20px">
                    descumprimento de quaisquer outras condições estabelecidas nas presentes regras.
                </td>
            </tr>

            <tr>
                <td>
                    5
                </td>
                <td class="pl-20px">
                    Dessa forma, considerando as Regras acima expostas, com as quais o cliente concorda no 
                    momento em que oferece proposta para o imóvel, informamos que o cliente será multada em 
                    5% do valor de venda do imóvel (%VALOR_TOTAL_PROPOSTA_DISTRATO%), ou seja, 
                    R$ %VALOR_MULTA_DISTRATO% de multa.
                </td>
            </tr>
            <tr>
                <td>
                    6
                </td>
                <td class="pl-20px">
                    O valor restante pago em recursos próprios, será creditado na conta de titularidade da 
                    arremate, a qual solicitamos informar através desse e-mail.
                </td>
            </tr>
            <tr>
                <td>
                    7
                </td>
                <td class="pl-20px">
                    Sendo o que tínhamos a informar, agradecemos e nos colocamos à disposição.
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