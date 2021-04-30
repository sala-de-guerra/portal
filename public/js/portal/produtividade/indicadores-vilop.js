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
            //$('#centralizadora'+item.NU_CGC).html(item.NU_CGC+" - "+item.Sigla)
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
                    $(`#corUnidade${item.NU_CGC}`).remove()
                break
            }
        })
    })
});

$(document).ready(function(){
    //modal VILOP
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-vilop', function(dados){
        $.each(dados, function(key, item){
            $('#vice'+item.unidade).html(item.unidade)
            $('#siglaVice'+item.unidade).html(item.nomeUnidade)
            $('#produtividade'+item.unidade).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.unidade).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fte'+item.unidade).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.unidade).html('<b>'+parseInt(item.totalLAP)+'</b>' )
        })
    })
});

$(document).ready(function(){
    //modal DI
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-di', function(dados){
        $.each(dados, function(key, item){
            $('#diretoria'+item.codigoSr).html(item.codigoSr)
            $('#siglaDiretoria'+item.codigoSr).html(item.nomeSr)
            $('#produtividade'+item.codigoSr).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.codigoSr).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fte'+item.codigoSr).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.codigoSr).html('<b>'+parseInt(item.totalLAP)+'</b>' )
        })
    })
});

$(document).ready(function(){
    //modal SN
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-sn', function(dados){
        $.each(dados, function(key, item){
            $('#super'+item.codigoSr).html(item.codigoSr)
            $('#siglaSuper'+item.codigoSr).html(item.nomeSr)
            $('#produtividade'+item.codigoSr).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.codigoSr).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fte'+item.codigoSr).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.codigoSr).html('<b>'+parseInt(item.totalLAP)+'</b>' )
        })
    })
});

$(document).ready(function(){
    //modal GN
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-gn', function(dados){
        $.each(dados, function(key, item){
            $('#gerencia'+item.codigoSr).html(item.codigoSr)
            $('#siglaGerencia'+item.codigoSr).html(item.nomeSr)
            $('#produtividade'+item.codigoSr).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.codigoSr).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fte'+item.codigoSr).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.codigoSr).html('<b>'+parseInt(item.totalLAP)+'</b>' )
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

