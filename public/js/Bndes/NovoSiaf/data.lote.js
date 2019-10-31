$(document).ready(function(){
   
    carregaDataLotes();
    
 });

//  carrega as datas dos lotes
function carregaDataLotes(json){
    var url = ('../api/bndes/v1/dados_lote')
    
  $.ajax({
      
    type: 'GET',
    url : url,
    
      success: function(carregadata){
      
        
      var data = JSON.parse(carregadata);
        
            $("#dataLoteAtual").html(data.dataLoteAtual);
            $("#dataLoteAnterior").html(data.dataLoteAnterior);
            $("#proxLote").html(data.dataLoteAtual);
            $("#loteAnt").html(data.dataLoteAnterior);              
            $("#dataLimiteCadastro").html(data.dataLimiteParaCadastroDemanda);
      }  
  });
}
