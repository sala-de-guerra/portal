<!DOCTYPE html>
<html lang="pt-br">
    <style>
    .fixarRodape {
        bottom: 0;
        position: fixed;
        width: 90%;
    }
    
    .nao-responder{
        color:gray;
        font-weight: bolder;
    }

table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
</style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="./estilos.css">  não deu --> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificação de demanda ATENDE</title>

</head>


<body style='font-family: sans-serif; padding: 20px'>


<p class="nao-responder">MENSAGEM AUTOMÁTICA. FAVOR NÃO RESPONDER.</p>
<p>Às GILIES,</p>
<p>Senhor(a) Gerente</p>
<p>1.   Segue relação dos boletos pagos na data de %dia_anterior%</p>
                <table class="table" style="overflow-x:auto;">
                        <thead>
                            <tr>
                            <th data-label="GILIE">GILIE</th>
                            <th data-label="Contrato">Contrato</th>
                            <th data-label="Contrato">UF</th>
                            <th data-label="Proponente">Proponente</th>
                            <th data-label="Valor">Valor de pagamento</th>
                            <th data-label="Status">Total proposta</th>
                            </tr>
                        </thead>
                        <tbody>
                    %listagem_de_Contratos%
                    </tbody>
                </table>
       
<p>2.   Seguem também relação dos contratos com previsão de cancelamento em %dia_anterior%, caso tenha algum contrato com boleto pago ou com prazo concedido ao cliente, deverá ser gerado um boleto com data de validade igual ao prazo final para pagamento.</p>

                <table class="table" style="overflow-x:auto;">
                                        <thead>
                                            <tr>
                                            <th data-label="GILIE">GILIE</th>
                                            <th data-label="Contrato">Contrato</th>
                                            <th data-label="Proponente">Proponente</th>
                                            <th data-label="Valor">Motivo do Cancelamento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    %listagem_de_cancelados%
                                    </tbody>
                                </table>

<p>3.   A relação completa pode ser encontrada em  <a href="https://portal.gilie.sp.caixa/contratacao/controle-boletos">https://portal.gilie.sp.caixa/contratacao/controle-boletos</a></p>
<p>4.   Acesse também  <a href="https://portal.gilie.sp.caixa/contratacao/tempo-medio-atendimento">https://portal.gilie.sp.caixa/contratacao/tempo-medio-atendimento</a>
para controle de gestão do tempo de atendimento</p>
<footer class="fixarRodape">    
<p class="destaque">
Atenciosamente,
<br><br>
GILIE/SP | GI ALIENAR BENS MOVEIS E IMOVEIS<br>
<a href="https://portal.gilie.sp.caixa/">https://portal.gilie.sp.caixa/</a>;  
</p>
</footer>


</body>
</html>