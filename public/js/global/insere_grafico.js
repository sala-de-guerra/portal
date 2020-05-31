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
    
        type:'bar',
        // type: 'bar',
        // type: 'doughnut',
        // type: 'horizontalBar',
        // type: 'polarArea',

        data: {
            labels: [`GILIE`, `Agência`, `EMGEA`],
                datasets: [{
                label: "",            
                backgroundColor: ['RoyalBlue', 'DeepSkyBlue', 'seagreen'],
                borderColor: 'white',
                data: quantidade,
                barThickness: 86,
                maxBarThickness: 88,
                minBarLength: 2,
            }]
        },

        // Configuration options go here
        options: {
            legend: {
                display: false
            },
        }
    }); 

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
        var ctx = document.getElementById('myChart2').getContext('2d');
    
    
    var chart = new Chart(ctx, {
    
        type:'bar',
        // type: 'bar',
        // type: 'doughnut',
        // type: 'horizontalBar',
        // type: 'polarArea',

        data: {
            labels: [`GILIE`, `Agência`, `EMGEA`],
                datasets: [{
                label: "",            
                backgroundColor: ['RoyalBlue', 'DeepSkyBlue', 'seagreen'],
                borderColor: 'white',
                data: quantidade,
                barThickness: 86,
                maxBarThickness: 88,
                minBarLength: 2,
            }]
        },

        // Configuration options go here
        options: {
            legend: {
                display: false
            },
        }
    }); 
}
