// quando o documento carrega chama a função que carrega os dados dos contratos amortizados/liquidados nos ultimos 12 meses
$(document).ready(function(){
   
    carregarDados12meses();
   
 });	

 //token segurança do laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela dos clientes dos ultimos 12 meses
function carregarDados12meses(){

    $.getJSON('../api/bndes/v1/lista_solicitacoes_ultimos_doze_meses', function(json){

        $.each(json, function (key, value){

            linha = atualizaTabela12meses(value);
            $('#tabelaPesquisaSolicitacoes>tbody').append(linha);

        });

        // transforma a tabela em data table
        $("#tabelaPesquisaSolicitacoes").DataTable();

    });
}

//função que monta a tabela com os clientes de acordo com o perfil
function atualizaTabela12meses(json){
    //destroy a table para criar uma nova com os dados
	bDestroy : true,
	
	linha = '<tr>' +
				
                '<td>' + json.codigoDemanda + '</td>' +
                '<td>' + json.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5")	+ '</td>' +
                '<td>' + json.contratoCaixa + '</td>' +
                '<td>' + json.nomeCliente+ '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")  + '</td>' +               
                '<td>' + json.dataLote + '</td>' +
				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrar" onclick ="visualizaDemanda(\'' + json.codigoDemanda + '\')" ></button> ' + 
				                
            '</tr>';
    return linha;
   
}

