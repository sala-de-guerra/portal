// quando o documento carrega chama a função que carrega os dados dos contratos por lote fechado
$(document).ready(function(){
   
    carregarLotes();
   
 });	

 //token segurança do laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela dos clientes da agência de acordo com o Perfil 
function carregarLotes(){

    $.getJSON('../api/bndes/v1/lista_solicitacoes_por_lotes', function(json){

        $.each(json, function (key, value){

            linha = atualizaTabelaLotes(value);
            $('#tabelaListaSolicitacoes>tbody').append(linha);

        });

        // transforma a tabela em data table
        $("#tabelaListaSolicitacoes").DataTable();

    });
}

//função que monta a tabela 
function atualizaTabelaLotes(json){
    //destroy a table para criar uma nova com os dados
	bDestroy : true,
	
	linha = '<tr>' +
				
                
                '<td align="center">' + json.dataLote	+ '</td>' +
                '<td align="center">' + json.solicitadas  + '</td>' +
                '<td align="center">' + json.acatadas  + '</td>' +
                '<td align="center">' + json.canceladas  + '</td>' +
                '<td align="center">' + json.outros  + '</td>' +
                '<td align="center">' + json.valorLote.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")  + '</td>' +
				'<td>'	+				
					'<button class="btn btn-btn-box-tool btn-xs btn-success tip center-block btn-excel" data-widget="tooltip" title="Exportar dados do lote para Excel" onclick ="geraExcel(\'' + json.dataLote.replace("/","-").replace("/","-") + '\')"><i class="fa fa-file-excel-o"></i></button> ' + 
               
            '</tr>';
    return linha;
   
}

function geraExcel(json){
   
    try{
    var url = ('../api/bndes/v1/exporta_lote_para_excel/'+ json);

    window.open(url,"_self");
    
    }
    catch(Error){
        console.log(Error);
         
     }
}
