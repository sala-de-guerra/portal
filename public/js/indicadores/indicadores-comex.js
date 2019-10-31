var cliente, email, box; 
var opQuantidade = [], opDia = [],accData = [], accCadastradas = [], accCanceladas=[], accLiquidadas=[], 
accDataMes = [], accCadastradasMes = [], accCanceladasMes=[], accLiquidadasMes=[], contratoData=[], contratoQuantidade=[], contratoValorMN=[];
var agora = new Date;

  /* Começo: Esta função altera dinamicamente o mês na página de indicadores */
    
function DataAtual(){
   
    var meses = ['Janeiro', 'Fevereiro', 'Março','Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro','Novembro','Dezembro'];
    let hoje = agora.getMonth();
        return meses[hoje];
}

// var mesAtual = document.querySelector("#mes-atual");
// // mesAtual.textContent = DataAtual();

var mes = DataAtual();

$('.carousel').carousel({
    interval: 0
  })


        function displayDialog(cliqueBox) {
           box= ("#"+cliqueBox);
           console.log(box);
            switch(box){

                case ('#boxOrdens'):
                    // $('#mapa').show();
                    $('#op').show();
                    $('#accAce').hide();
                    $('#antecipados').hide();
                    $('#atendimento').hide();
                    $('#quantidadeContratacao').hide();
                break;
                case ('#liquidacao'):
                    $('#accAce').show();
                    
                    $('#op').hide();
                    $('#quantidadeContratacao').hide();
                    $('#antecipados').hide();
                    $('#atendimento').hide();                
                break;
                case ('#antecipado'):
                    $('#antecipados').show();
                    $('#accAce').hide();
                    $('#quantidadeContratacao').hide();
                    $('#op').hide();
                  
                    $('#atendimento').hide();                
                break;               
                case ('#qualidade'):
                    $('#atendimento').show();
                    $('#antecipados').hide();
                    $('#accAce').hide();
                    $('#quantidadeContratacao').hide();
                    $('#op').hide();
                   
                break;
                case ('#contratos'):
                    $('#quantidadeContratacao').show();
                    $('#atendimento').hide();
                    $('#antecipados').hide();
                    $('#accAce').hide();
                   
                    $('#op').hide();
                   
                break;
            }
         
        }
/* FIM: Esta função altera dinamicamente o mês na página de indicadores */

// funções para carregar os dados do painel

$(document).ready(function(){
    carrega_painel();
    carrega_opEnviada();
    carrega_accAce();
    carrega_contratacao();
    // carregaMapa();
    // carregaGraficoAccAceMensal();
    });
        
function carrega_opEnviada(){
        
    $.ajax({
    
        type:'GET',
        url: '../esteiracomex/indicadores/painel-matriz/ordens-recebidas',
        dataType: 'JSON',
    
        success: function(data){
         
            for (var i = 0; i < data.opesEnviadas.length; i++){
            opQuantidade.push(data.opesEnviadas[i].quantidade);
            opDia.push(data.opesEnviadas[i].dia.split(/\-/).reverse().join('-').substring(0, 5));
            }
         

        var chart2 = document.getElementById('graficoOP');
        var chartOpDia = new Chart(chart2, {
            type: 'bar',
            data: {
            
                labels: opDia,
                datasets: [{
                    label: 'Enviadas para agência' ,
                    data: opQuantidade,
                    
                    backgroundColor: 
                    '#B0C4DE',
                        
                    borderColor: 'black',
                    borderWidth: 1,
                    // fontColor: 'black'
                
                },{
                
                    label: 'Enviadas para clientes',
                    data: [2, 5, 5, 6, 8, 2, 9, 8, 2],
                    backgroundColor: 
                    "#f39c12",
			        borderColor: 'black',
                    borderWidth: 1,
		        }], 

            
            },
        
        options: {
            title: {
                display: true,
                text: 'Op recebidas nos últimos 30 dias'
            },
          
            tooltips: {
              displayColors: true,
              callbacks:{
                mode: 'index',
              },
            },
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'black',
                },
            },
            scales: {
              xAxes: [{
                stacked: true,
                gridLines: {
                  display: false,
                }
              }],
              yAxes: [{
                stacked: true,
                gridLines: {
                    display: false
                 },
                ticks: {
                  beginAtZero: true,
                },
                type: 'linear',
              }]
            },
            
            }
        });
        }
    });
}
 
// carrega graficos resultados acc
function carrega_accAce(){
        
    $.ajax({
    
        type:'GET',
        url: '../esteiracomex/indicadores/painel-matriz/resumo-acc-ace-30dias',
        dataType: 'JSON',
    
        success: function(acc){
         console.log(acc);
            for (var i = 0; i < acc.resumoAccAceUltimos30dias.length; i++){
                accData.push(acc.resumoAccAceUltimos30dias[i].data.split(/\-/).reverse().join('-').substring(0, 5));
                accCadastradas.push(acc.resumoAccAceUltimos30dias[i].cadastradas);
                accLiquidadas.push(acc.resumoAccAceUltimos30dias[i].liquidadas);
                accCanceladas.push(acc.resumoAccAceUltimos30dias[i].canceladas);
           
            }

console.log(accData);

            var ctx = document.getElementById('analisesAccAce30dias').getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
                data: {
                    labels:accData,
                    datasets: [{
                        label: '#Cadastradas',
                        data: accCadastradas,
                        backgroundColor: 
                            "#3c8dbc",
                        fill:false,    
                        borderColor:  "#3c8dbc",
                        borderWidth: 3,
                        
                    }, {
                    label: '#Liquidadas',
                        data: accLiquidadas,
                        backgroundColor: 
                            "#f39c12",
                        fill:false,
                        borderColor: "#f39c12",
                        borderWidth: 3,
                        type: 'bar',
                        
                    }, {
                        label: '#Canceladas',
                            data: accCanceladas,
                            backgroundColor: 
                                '#B0C4DE',
                            fill:false,    
                            borderColor:  '#B0C4DE',
                            borderWidth: 3,
                            type: 'bar',
                            
                        }],
                },            
      
        options: {
            title: {
                display: true,
                text: 'Análises ACC/ACE Dia'
            },
            legend: {
                position: 'right',
                labels: {
                    fontColor: 'black',
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                       display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                     },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });
        // }
    // });
// }
// function carregaGraficoAccAceMensal(){
    $.ajax({
    
        type:'GET',
        url: '../esteiracomex/indicadores/painel-matriz/resumo-acc-ace-mensal',
        dataType: 'JSON',
    
        success: function(accMes){
         
            for (var i = 0; i < accMes.resumoAccAceMensal.length; i++){
                accDataMes.push((accMes.resumoAccAceMensal[i].mes)+"-"+(accMes.resumoAccAceMensal[i].ano));
                accCadastradasMes.push(accMes.resumoAccAceMensal[i].cadastradas);
                accLiquidadasMes.push(accMes.resumoAccAceMensal[i].liquidadas);
                accCanceladasMes.push(accMes.resumoAccAceMensal[i].canceladas);
           
            }
  console.log(accCadastradasMes,accCanceladasMes,accLiquidadasMes,accDataMes)

            var ctx1 = document.getElementById('analisesAccAceMensal').getContext('2d');
            var myChart1 = new Chart(ctx1, {
              type: 'line',
                data: {
                    labels: accDataMes,
                    datasets: [{
                        label: '#Cadastradas',
                        data: accCadastradasMes,
                        backgroundColor: 
                            "#3c8dbc",
                        fill:false,
                            
                        borderColor: "#3c8dbc",
                        borderWidth: 3
                    }, {
                    label: '#Liquidadas',
                        data: accLiquidadasMes,
                        backgroundColor: 
                            "#f39c12",
                        fill:false,    
                        borderColor: "#f39c12",
                        borderWidth: 3,
                        type: 'line',
                    }, {
                        label: '#Canceladas',
                        data: accCanceladasMes,
                        backgroundColor: 
                            '#B0C4DE',
                        fill:false,    
                        borderColor: '#B0C4DE',
                        borderWidth: 3,
                        type: 'line',
                        }],
                },            
      
        options: {
            
            title: {
                display: true,
                text: 'Análises ACC/ACE Mês'
            },
            legend: {
                position: 'right',
                labels: {
                    fontColor: 'black',
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                       display: false
                    }
                 }],
                yAxes: [{
                    gridLines: {
                        display: false
                     },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });
        }
    });
    }
    });
}
   
 
function carrega_contratacao(){
        
    $.ajax({
    
        type:'GET',
        url: '../../js/indicadores/contratacoes.json',
        dataType: 'JSON',
    
        success: function(contrato){
         
            for (var i = 0; i < contrato.length; i++){
                contratoData.push(contrato[i].data);
                contratoQuantidade.push(contrato[i].quantidade);
                contratoValorMN.push(contrato[i].valorMN);
           
            }
            console.log(contrato);
            var ctx = document.getElementById('contratacoes').getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'line',
                data: {
                labels:contratoData,
                    datasets: [{
                        label: '#Valor',
                        data: contratoValorMN,
                        backgroundColor: 
                            "#f39c12",
                        fill:false,
                        borderColor: "#f39c12",
                        borderWidth: 3,
                        yAxisID:"valor"
                        
                    },{
                        label: '#Contratos',
                        data: contratoQuantidade,
                        backgroundColor: 
                            "#3c8dbc",
                        fill:false,    
                        borderColor:  "#3c8dbc",
                        borderWidth: 3,
                        yAxisID:"quantidade"
                    }, ],
                },            
      
        options: {
            title: {
                display: true,
                text: 'Contratações ACC/ACE'
            },
            legend: {
                position: 'right',
                labels: {
                    fontColor: 'black',
                }
            },
            
            scales: {
                xAxes: [{
                    gridLines: {
                       display: false
                    }
                }],
                yAxes: [
                    
                    {
                    id: 'valor',
                    position: 'right',
                    gridLines: {
                        display: false
                        }                 
                    },
                    {
                    id: 'quantidade',
                    position: 'left',
                    ticks: {
                        beginAtZero: true
                        },
                    gridLines: {
                        display: false
                        }                 
                    },
                   
                ]
            }
        }
        });
    }
});
}

// até aqui ok

    function carrega_painel(){
    
      $.ajax({
    
        type:'GET',
        url: '../../js/indicadores/painel.json',
        dataType: 'JSON',
    
        success: function(data){
       
            $.each(data, function(key, item){
           switch (key) {
                case 0:
                $('#op-recebida').html(item.op.opRecebidasMes);
                   break;
                // case 1:
                //     cliente = item.clientesEmail.clientesComex;
                //     email = item.clientesEmail.emailCadastrado;
                // break; 
                case 2:
                    accCadastradas = item.analisesAccAce.cadastradas;
                    accCanceladas = item.analisesAccAce.canceladas;
                    accLiquidadas = item.analisesAccAce.liquidadas;
                    break; 
                // case 3:
                //     antecipadosCadastradas = item.antecipados.cadastradas;
                //     antecipadosAnalisadas = item.antecipados.analisadas;
                //     antecipadosInconforme = item.antecipados.inconformeCanceladas;
                //     break;
                case 4:
                    $('#contratado').html(item.antecipadosCobranca.contratado);
                    $('#bloqueado').html(item.antecipadosCobranca.bloqueado);
                    $('#conforme').html(item.antecipadosCobranca.conforme);
                    $('#reiterado').html(item.antecipadosCobranca.reiterado);
                    $('#cobrado').html(item.antecipadosCobranca.cobrado);
                    break; 
            }

          });  
        //   console.log(antecipadosCadastradas);
          
        //   carregaGraficoClienteEmail(cliente,email);
        //   carregaGraficoAccAce( accCadastradas, accCanceladas, accLiquidadas);
        //   carregaGraficoAntecipados( antecipadosCadastradas, antecipadosAnalisadas, antecipadosInconforme);
   
        }  
       })
   
    }      
   



function carregaGraficoAntecipados(){
  var ctx = document.getElementById('graficoAntecipados');
  var myChart = new Chart(ctx, {
    type: 'bar',
      data: {
          labels: [mes],
          datasets: [{
              label: '#Cadastradas',
              data: [antecipadosCadastradas],
              backgroundColor: 
              "#3c8dbc",
                  
              borderColor: 'black',
              borderWidth: 1
          }, {
          label: '#Analisadas',
              data: [antecipadosAnalisadas],
              backgroundColor: 
              "#f39c12",
                  
              borderColor: 'black',
              borderWidth: 1,
              type: 'bar',
          }, {
            label: '#Inconforme/Canceladas',
                data: [antecipadosInconforme],
                backgroundColor: 
                    '#B0C4DE',
                    
                borderColor: 'black',
                borderWidth: 1,
                type: 'bar',
            }],
      },
   
      options: {
          scales: {
            xAxes: [{
                gridLines: {
                   display: false
                }
             }],
              yAxes: [{
                gridLines: {
                    display: false
                 },
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
}

var estado =[],valor=[];

function carregaMapa(){

    $.ajax({
    
        type:'GET',
        url: '/../js/indicadores/mapa.json',
        dataType: 'JSON',
    
        success: function(mapa){
         
            for (var i = 0; i < mapa.estados.length; i++){
               estado.push(mapa.estados[i].nome),
               valor.push(mapa.estados[i].contrato)
        
            }
            for (var i = 0; i < estado.length; i++){
            if (estado[i] == $('#'+estado[i])){
                $('#'+estado[i]).attr("title");
             
            }
            // console.log($('#'+estado[i]).addClass("title"="+"+valor[i]+"+"))
        }
           
}


});
console.log(estado,valor)
}
 

   

