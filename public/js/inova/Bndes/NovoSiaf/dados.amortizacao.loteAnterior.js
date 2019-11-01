$(document).ready(function(){
   
    carregarTabelaLoteAnt();
    
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

//carrega tabela com os contratos amortizados no lote anterior
function carregarTabelaLoteAnt()
{
    $.getJSON('../api/bndes/v1/siaf_amortizacoes_lote_anterior', function(json){

        $.each(json, function (key, value){
          
            linha = atualizaTabela(value);
            $('#tabelaLoteAnterior>tbody').append(linha);

        });
       
        $('#tabelaLoteAnterior').DataTable();
   
    });
    
}
