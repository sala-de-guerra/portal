$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.getJSON('/produtividade-vilop/api/relatorio-cards-geral', function(dados){
        $.each(dados, function(key, item){
            
            $('#sigla'+item.NU_CGC).html(item.Sigla)
            $('#nome'+item.NU_CGC).html(item.nomeAgencia)

            $('#produtividade'+item.NU_CGC).html('<b>'+item.PRODUTIVIDADE_G2+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.NU_CGC).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fteApurada'+item.NU_CGC).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.NU_CGC).html('<b>'+parseInt(item.LAP_UNIDADE)+'</b>' )


            $('#centralizadora'+item.NU_CGC).html(item.NU_CGC+" - "+item.Sigla)
            $('#nomeCentralizadora'+item.NU_CGC).html(item.nomeAgencia)
            $('#resultado'+item.NU_CGC).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.NU_CGC}`).css({"background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.NU_CGC}`).css({"background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.NU_CGC}`).css({"background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case null:
                    $('#corUnidade'+item.NU_CGC).remove()
                break
            }

        })
    })
})

$(document).ready(function(){
    //modal VILOP
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-vilop', function(dados){
        $.each(dados, function(key, item){
            $('#sigla'+item.unidade).html(item.nomeUnidade)
            //$('#nome'+item.unidade).html(item.nomeUnidade)

            $('#vice'+item.unidade).html(item.unidade)
            $('#siglaVice'+item.unidade).html(item.nomeUnidade+" - VP Logística e Operações")
            $('#produtividade'+item.unidade).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.unidade).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fte'+item.unidade).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.unidade).html('<b>'+parseInt(item.totalLAP)+'</b>' )
            $('#resultado'+item.unidade).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.unidade}`).css({"background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.unidade}`).css({"background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.unidade}`).css({"background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case null:
                    $('#corUnidade'+item.unidade).remove()
                break
            }
        })
    })
});

$(document).ready(function(){
    //modal DI
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-di', function(dados){
        $.each(dados, function(key, item){

            $('#sigla'+item.codigoSr).html(item.Sigla)
            $('#nome'+item.codigoSr).html(item.nomeSr)

            $('#diretoria'+item.codigoSr).html(item.codigoSr+" - "+item.Sigla)
            $('#siglaDiretoria'+item.codigoSr).html(item.nomeSr)

            var produtividade = item.PRODUTIVIDADE
            if (produtividade === '' || produtividade === null){
                $('#corUnidade'+item.codigoSr).css("display", "none")
                $('#produtividade'+item.codigoSr).html('<b> Não há dados</b> <sup style="font-size: 20px">%</sup>' )

            } else {
                $('#produtividade'+item.codigoSr).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
                $('#desempenho'+item.codigoSr).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
                $('#fte'+item.codigoSr).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
                $('#lap'+item.codigoSr).html('<b>'+parseInt(item.totalLAP)+'</b>' )

                $('#resultado'+item.codigoSr).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            }

            
            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.codigoSr}`).css({"background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.codigoSr}`).css({"background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.codigoSr}`).css({"background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case null:
                    $('#corUnidade'+item.codigoSr).remove()
                break
            }
        })
    })
});

$(document).ready(function(){
    //modal SN
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-sn', function(dados){
        $.each(dados, function(key, item){
            console.log(typeof(dados))
            $('#sigla'+item.codigoSr).html(item.Sigla)
            $('#nome'+item.codigoSr).html(item.nomeSr)

            $('#super'+item.codigoSr).html(item.codigoSr+" - "+item.Sigla)
            $('#siglaSuper'+item.codigoSr).html(item.nomeSr)

            $('#produtividade'+item.codigoSr).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.codigoSr).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fte'+item.codigoSr).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.codigoSr).html('<b>'+parseInt(item.totalLAP)+'</b>' )
            $('#resultado'+item.codigoSr).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.codigoSr}`).css({"background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.codigoSr}`).css({"background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.codigoSr}`).css({"background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
                break
            }
            // console.log($('#corUnidade'+item.codigoSr).css('background-color'))
            if ($('#corUnidade'+item.codigoSr).css('background-color') == 'rgb(255, 255, 255)') {
                $(this).remove()
            }
        })
        
    })
    // var produtividade = item.PRODUTIVIDADE
    //     if (produtividade === [] || produtividade === null){
    //         $('#corUnidade'+item.codigoSr).remove()
    //         $('#produtividade'+item.codigoSr).html('<b> Não há dados</b> <sup style="font-size: 20px">%</sup>' )

    //     } 
});

$(document).ready(function(){
    //modal GN
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-gn', function(dados){
        $.each(dados, function(key, item){

            $('#sigla'+item.unidade).html(item.Sigla)
            $('#nome'+item.unidade).html(item.nomeAgencia)

            $('#gerencia'+item.unidade).html(item.unidade+" - "+item.Sigla)
            $('#siglaGerencia'+item.unidade).html(item.nomeAgencia)
            $('#produtividade'+item.unidade).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.unidade).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fte'+item.unidade).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.unidade).html('<b>'+parseInt(item.totalLAP)+'</b>' )

            $('#resultado'+item.unidade).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.unidade}`).css({"background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.unidade}`).css({"background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.unidade}`).css({"background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case null:
                    $('#corUnidade'+item.unidade).remove()
                break
            }
        })
    })
});


$('.level-1').hover(function(event){
    $($(this).find("span")[1]).show();
    $(this).css("background", "#004c8c");
}, function() {
    $($(this).find("span")[1]).hide();
    $(this).css("background", "#005ca9");
})

$('.level-2').hover(function(event){
    $($(this).find("span")[1]).show();
    $(this).css("background", "#ec7500");
}, function() {
    $($(this).find("span")[1]).hide();
    $(this).css("background", "#f39200");
})

$('.level-3').hover(function(event){
    $($(this).find("span")[1]).show();
    $(this).css("background", "#40a797");
}, function() {
    $($(this).find("span")[1]).hide();
    $(this).css("background", "#54bbab");
})

$('.level-4').hover(function(event){
    $($(this).find("span")[1]).show();
    $(this).css("background", "#00a2cd");
}, function() {
    $($(this).find("span")[1]).hide();
    $(this).css("background", "#00b5e5");
})

$('.level-4B').hover(function(event){
    $($(this).find("span")[1]).show();
    $(this).css("background", "#00a2cd");
}, function() {
    $($(this).find("span")[1]).hide();
    $(this).css("background", "#00b5e5");
})

$('.level-5').hover(function(event){
    $($(this).find("span")[1]).show();
    $(this).css("background", "#3a4859");
}, function() {
    $($(this).find("span")[1]).hide();
    $(this).css("background", "#5f758f");
})

$('.list-group-item').hover(function(event){
    $(this).css("background", "#b3c7cb");
    $($(this).find("span")[1]).show();
}, function() {
    $(this).css("background-color", "#EFF5F6");
    $($(this).find("span")[1]).hide();
})

$("#cisep").hover(function(){
    $("#listaCisep").show();
}, function(){
    $("#listaCisep").hide();
})

$("#ceope").hover(function(){
    $("#listaCeope").show();
}, function(){
    $("#listaCeope").hide();
})

$("#cecoq").hover(function(){
    $("#listaCecoq").show();
}, function(){
    $("#listaCecoq").hide()
})

