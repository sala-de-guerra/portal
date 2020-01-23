
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
    <title>MODELO - ORIENTAÇÃO À AGÊNCIA - PROTOCOLO %ID_DISTRATO%</title>

</head>

<body style='font-family: sans-serif; padding: 20px'>

<!-- DE GILIESP01@CAIXA.GOV.BR -->
<!-- PARA %EMAIL_AGENCIA% -->
<!-- CCO GILIESP01@CAIXA.GOV.BR; %USUARIO_SESSAO% -->
<!-- ASSUNTO Orientação para contabilização de Distrato- Comprador %NOME_PROPONENTE% - CHB %CONTRATO_BEM%-->

    <p>À</p>
    <p>AG %NOME_AGENCIA%,</p>

    <br>
    <p>Prezados,</p>

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
            <tr>
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