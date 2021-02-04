
var totalDataUltimos30dias = [];
var quantidadeTotalAberto = [];
var quantidadeRespondidos = [];
var nomeNovosarray = [];
var quantidadeNovosarray = [];

$("#Grafico").one("click", function() {
  

  $('document').ready(function() {

    $.getJSON('/indicadores/atende/lista-atende-grafico', function(dados){
      $.each(dados, function(key, item) {  
      dataFormatoBr = item.dataCadastro
      dataFormatoBr = moment(dataFormatoBr).format("DD/MM/YYYY")
      quantidadeTotalAberto.push(item.total);
      totalDataUltimos30dias.push(dataFormatoBr);

      })
    })

    $.getJSON('/indicadores/atende/lista-finalizados-grafico', function(dados){
      $.each(dados, function(key, item) {  
        quantidadeRespondidos.push(item.totalRespondido);
      //nomeNovosarray.push(dataFormatoBr);

      })
      grafico(totalDataUltimos30dias,quantidadeTotalAberto, quantidadeRespondidos, nomeNovosarray)
    })

    

    function grafico(totalDataUltimos30dias, quantidadeTotalAberto, quantidadeRespondidos, nomeNovos){
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
          
            // The type of chart we want to create
            type: 'bar',
      
            // The data for our dataset
            data: {
                labels: totalDataUltimos30dias,
                datasets: [
                {
                  label: 'Total',
                  borderColor: 'rgba(23,162,84)',
                  backgroundColor: 'rgba(220,53,69)',
                  data: quantidadeTotalAberto
                },
                {
                  label: 'Respondidos',
                  borderColor: 'rgba(40,167,69)',
                  backgroundColor: 'rgba(40,167,69)',
                  data: quantidadeRespondidos
                }
                // {
                //   label: 'Pendentes',
                //   borderColor: 'rgba(255,193,7)',
                //   backgroundColor: 'rgba(255,193,7, 0.7)',
                //   data: quantidadePendentes
                // },
                // {
                //   label: 'Vencidos',
                //   borderColor: 'rgba(220,53,69)',
                //   backgroundColor: 'rgba(220,53,69, 0.7)',
                //   data: quantidadeVencidos
                // }
              ]
            },
            // Configuration options go here
            options: {
              scales:{
                xAxes: [{
                  gridLines: {
                    display: false,
                  }
                }
                ]
              },
              legend: {
                position: 'bottom',
                labels: {
                  padding: 20,
                  boxWidth: 15,
                }
              },
              layout: {
                padding: {
                  right: 50,
                }
              },
              tooltips:{
                backgroundColor: 'rgba(166,166,166)',
                titleFontSize: 12,
                xPadding: 20,
                yPadding: 20,
                bodyFontSize: 11,
                bodySpacing: 13,
                mode: 'x',
              },
              line: {
                borderWidth: 6,
                fill: false,
              },
              point: {
                radius: 9,
                borderWidth: 8,
                backgroundColor: 'white',
                hoverRadius: 12,
                hoverBorderRadius: 9,
              }
            }
        });
      }
      $('#graficoGeral').show();
    $('.spinnerGrafico').remove()
  })
})

$( "#Grafico" ).click(function() {
  $('#graficoGeral').show();
});