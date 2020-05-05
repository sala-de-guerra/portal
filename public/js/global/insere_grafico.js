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
    
        type:'pie',
        // type: 'bar',
        // type: 'doughnut',
        // type: 'horizontalBar',
        // type: 'polarArea',

        data: {
            labels: [`À tratar`, `GILIE`, `Agência`, `JURIR-EMGEA`, `Demandas Concluidas`, `Distratos Concluidos`,],
                datasets: [{             
                backgroundColor: ['OrangeRed', 'RoyalBlue', 'DeepSkyBlue', 'DodgerBlue', 'LimeGreen', 'CornflowerBlue'],
                borderColor: 'white',
                data: quantidade,
            
            }]
        },

        // Configuration options go here
        options: {
     
        }
    }); 
}
