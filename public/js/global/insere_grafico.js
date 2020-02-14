$('document').ready(function() {

$.ajax({
type: "GET",
url: '/estoque-imoveis/distrato/indicadores-distrato ',
dataType: "json",
success: function (data) {
   console.log(data)

   var nomearray = [];
   var quantidadearray = [];

   for (var i in data){

    nomearray.push(data[i]);
    quantidadearray.push(data[i])

   }
   grafico(nomearray, quantidadearray);
}
});
});
 
function grafico(nome, quantidade){
     var ctx = document.getElementById('myChart').getContext('2d');
   
   var chart = new Chart(ctx, {
   
    type: 'horizontalBar',

   
    data: {
        labels: [`não Iniciadas`, `GILIE`, `Agência`, `JURIR/EMGEA`, `Concluido` ],
            datasets: [{             
            backgroundColor: ['fireBrick', 'CornflowerBlue', 'DarkBlue', 'CornflowerBlue', 'LightGreen'],
            borderColor: 'white',
            data: quantidade,
            label: 'Grafico'
          
        }]
    },

    // Configuration options go here
    options: {}
});
}
