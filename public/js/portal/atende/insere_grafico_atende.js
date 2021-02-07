
var totalDataUltimos30dias = [];
var totalAtendesCadastrados = [];
var totalAtendesRespondidos = [];


$("#Grafico").one("click", function() {
  

  $('document').ready(function() {

    $('document').ready(function() {

      $.getJSON('/indicadores/atende/lista-atende-grafico', function(dados){
        $.each(dados, function(key, item) {  
        dataFormatoBr = item.data
        dataFormatoBr = moment(dataFormatoBr).format("DD/MM/YYYY")
        totalDataUltimos30dias.push(dataFormatoBr);
        totalAtendesCadastrados.push(item.totalAtendesCadastrados);
        totalAtendesRespondidos.push(item.totalAtendesRespondidos);

        })
        grafico(totalDataUltimos30dias,totalAtendesCadastrados, totalAtendesRespondidos)
      })
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
                  label: 'Abertos',
                  borderColor: 'rgba(36,124,180)',
                  backgroundColor: 'rgba(36,124,180)',
                  data: quantidadeTotalAberto
                },
                {
                  label: 'Respondidos',
                  borderColor: 'rgba(40,167,69)',
                  backgroundColor: 'rgba(40,167,69)',
                  data: quantidadeRespondidos
                }
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
    $('.spinnerGrafico').remove()
  })
})

$( "#Grafico" ).click(function() {
  $('#graficoGeral').show();
});