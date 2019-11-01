$(document).ready(function(){
   
    carregarTabelaLoteAtual();
//formata campo valor no modal de editar cadastro
$("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela com os contratos a serem amortizados no lote
function carregarTabelaLoteAtual()
{
    $.getJSON('../api/bndes/v1/siaf_amortizacoes_lote_atual', function(json){

        $.each(json, function (key, value){
          
            linha = atualizaTabela(value);
            $('#tabelaLoteAtual>tbody').append(linha);
            
        }
        
        );
        bDestroy : true;
        $('#tabelaLoteAtual').DataTable({
            responsive: true,
           
        } );
       
  
    });
    
}

  