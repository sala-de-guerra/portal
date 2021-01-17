
var nomearray = [];
var quantidadeTotalarray = [];
var nomeNovosarray = [];
var quantidadeNovosarray = [];

$("#geralGrafico").one("click", function() {

  $('document').ready(function() {

    $.getJSON('/indicadores/atende/lista-atende-grafico', function(dados){
      $.each(dados, function(key, item) {  
      dataFormatoBr = item.dataUltimaAlteracao
      dataFormatoBr = moment(dataFormatoBr).format("DD/MM/YYYY")
      quantidadeTotalarray.push(item.total);
      nomearray.push(dataFormatoBr);

      })
    })

    $.getJSON('/indicadores/atende/lista-novos-atendes-grafico', function(dados){
      $.each(dados, function(key, item) {  
      dataFormatoBr = item.dataUltimaAlteracao
      dataFormatoBr = moment(dataFormatoBr).format("DD/MM/YYYY")
      quantidadeNovosarray.push(item.totalAtendesNovos);
      nomeNovosarray.push(dataFormatoBr);

      })
      grafico(quantidadeTotalarray, nomearray, quantidadeNovosarray, nomeNovosarray)
      console.log(quantidadeNovosarray)
    })

    

    function grafico(quantidadeTotal, nome, quantidadeNovos, nomeNovos){
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
          
            // The type of chart we want to create
            type: 'line',
      
            // The data for our dataset
            data: {
                labels: nome,
                datasets: [
                {
                  label: 'Total atendes (aberto e/ou respondido)',
                  borderColor: 'blue',
                  backgroundColor: 'rgba(255,255,255, 0)',
                  data: quantidadeTotal
                },
                {
                  label: 'Novos',
                  borderColor: 'rgba(23,162,184)',
                  backgroundColor: 'rgba(255,255,255, 0)',
                  data: quantidadeNovos
                },
                {
                  label: 'Tratados',
                  borderColor: 'rgba(40,167,69)',
                  backgroundColor: 'rgba(255,255,255, 0)',
                  data: [1, 5, 6, 8, 2, 3, 5, 0, 4]
                },
                {
                  label: 'Pendentes',
                  borderColor: 'rgba(255,193,7)',
                  backgroundColor: 'rgba(255,255,255, 0)',
                  data: [2, 6, 8, 5, 3, 8, 0, 7, 5]
                },
                {
                  label: 'Vencidos',
                  borderColor: 'rgba(220,53,69)',
                  backgroundColor: 'rgba(255,255,255, 0)',
                  data: [4, 9, 9, 3, 3, 7, 1, 2, 5]
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
  })
})