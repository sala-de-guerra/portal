$(document).ready(function(){
   
    carregarTabelaGestor();
   
});	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// //carrega tabela com os contratos pendentes no Gestor
function carregarTabelaGestor()
{
    $.getJSON('../api/bndes/v1/siaf_contratos_gestor', function(json){

        $.each(json, function (key, value){
          
            linha = atualizaTabelaGestor(value);
            $('#tabelaGestor>tbody').append(linha);

        }
        
        );
       
        $('#tabelaGestor').DataTable({
            responsive: true,
        } );
           
    });
    
}

//atualiza a tabela 
function refreshTabelaGestor(tabelaAtualizada, idTabelaDataTable)
{
    $("#" + idTabelaDataTable).DataTable().fnDestroy();
    $("#" + idTabelaDataTable).empty(); 

    let novaTable = document.createElement('thead');
    let novaTableTr = document.createElement('tr');

    let novaTableThPedido = document.createElement('th');
    let tituloPedido = document.createTextNode("Pedido");
    novaTableThPedido.appendChild(tituloPedido);
    novaTableTr.appendChild(novaTableThPedido);

    let novaTableThTomador = document.createElement('th');
    let tituloTomador = document.createTextNode("Tomador");
    novaTableThTomador.appendChild(tituloTomador);
    novaTableTr.appendChild(novaTableThTomador);

    let novaTableThCtrCaixa = document.createElement('th');
    let tituloCtrCaixa = document.createTextNode("Ctr CAIXA");
    novaTableThCtrCaixa.appendChild(tituloCtrCaixa);
    novaTableTr.appendChild(novaTableThCtrCaixa);

    let novaTableThCtrBndes = document.createElement('th');
    let tituloCtrBndes = document.createTextNode("Ctr BNDES");
    novaTableThCtrBndes.appendChild(tituloCtrBndes);
    novaTableTr.appendChild(novaTableThCtrBndes);

    let novaTableThLote = document.createElement('th');
    let tituloLote = document.createTextNode("Lote");
    novaTableThLote.appendChild(tituloLote);
    novaTableTr.appendChild(novaTableThLote);

    let novaTableThValor = document.createElement('th');
    let tituloValor = document.createTextNode("Valor");
    novaTableThValor.appendChild(tituloValor);
    novaTableTr.appendChild(novaTableThValor);

    let novaTableThComando = document.createElement('th');
    let tituloComando = document.createTextNode("Comando");
    novaTableThComando.appendChild(tituloComando);
    novaTableTr.appendChild(novaTableThComando);

    let novaTableThStatus = document.createElement('th');
    let tituloStatus = document.createTextNode("Status");
    novaTableThStatus.appendChild(tituloStatus);
    novaTableTr.appendChild(novaTableThStatus);

    let novaTableThObs = document.createElement('th');
    let tituloObs = document.createTextNode("");
    novaTableThObs.appendChild(tituloObs);
    novaTableTr.appendChild(novaTableThObs);
    
    let novaTableThEditar = document.createElement('th');
    let tituloEditar = document.createTextNode("");
    novaTableThEditar.appendChild(tituloEditar);
    novaTableTr.appendChild(novaTableThEditar);
    let novaTableBody = document.createElement('tbody');
    
    novaTable.appendChild(novaTableTr);

    document.getElementById(idTabelaDataTable).appendChild(novaTable);
    document.getElementById(idTabelaDataTable).appendChild(novaTableBody);

    ObjTabelaAtualizada = JSON.parse(tabelaAtualizada);
    $.each(ObjTabelaAtualizada, function (key, value){         
        linha = atualizaTabelaGestor(value);
        $("#" + idTabelaDataTable + ">tbody").append(linha);               
    });
    
    $("#" + idTabelaDataTable).DataTable({
        responsive: true, 
    });
    $("#" + idTabelaDataTable).css("width","100%");    
}

//atualiza a tabela para visualizacao dos contratos
function atualizaTabelaGestor(json)
{ 
   
    bDestroy : true,  
    linha = '<tr>' +         
                '<td>' + json.codigoDemanda        + '</td>' +
                '<td>' + json.nomeCliente      + '</td>' +
                '<td>' + json.contratoCaixa    + '</td>' +
                '<td>' + json.contratoBndes    + '</td>' +
                '<td>' + json.dataLote    + '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + '</td>' +
                '<td>' + json.tipoOperacao.replace("A","AMORTIZAÇÃO").replace("L","LIQUIDAÇÃO")   + '</td>' +
                '<td>' + json.status.replace("GESTOR RESIDUO SIFBN","RESIDUO SIFBN")		        + '</td>' +
                '<td>'	+				
                    '<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrar" onclick ="visualizaDemanda(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
                    '<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditar" onclick ="editarContrato(\'' + json.codigoDemanda	+ '\')" ></button> ' + 
                '</td>' +
            '</tr>';
    return linha;
}