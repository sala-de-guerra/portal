var nomearray = [];
var quantidadearray = [];

$('document').ready(function() {

$.getJSON('/indicadores/atende/lista-atende-grafico', function(dados){

    $.each(dados, function(key, item) {  
    dataFormatoBr = item.dataUltimaAlteracao
    dataFormatoBr = moment(dataFormatoBr).format("DD/MM/YYYY")
    quantidadearray.push(item.total);
    nomearray.push(dataFormatoBr);
  
    })
    grafico(quantidadearray, nomearray)
  })


function grafico(quantidade, nome){
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
      
        // The type of chart we want to create
        type: 'bar',
  
        // The data for our dataset
        data: {
            labels: nome,
            datasets: [{
                label: 'Total atendes (aberto e/ou respondido)',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: quantidade
            }]
        },
        // Configuration options go here
        options: {}
    });
  }
})