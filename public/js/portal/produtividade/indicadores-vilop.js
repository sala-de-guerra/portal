$(document).ready(function(){
    $(".menu-hamburguer").click();

    $.getJSON('/produtividade-vilop/api/relatorio-cards-geral', function(dados){
        $.each(dados, function(key, item){

            $(`#botao${item.NU_CGC}`).css({"background-color": "#5f758f", "color": "white"})
            $('#sigla'+item.NU_CGC).html(item.Sigla)
            $('#nome'+item.NU_CGC).html(item.nomeAgencia)

            $('#prodUnidade'+item.NU_CGC).css("display", "block");
            $('#unidadeSemNenhumDado'+item.NU_CGC).css("display", "none");
            $('#produtividade'+item.NU_CGC).html('<b>'+item.PRODUTIVIDADE_G2+'</b> <sup style="font-size: 20px">%</sup>' )
            
            $('#desUnidade'+item.NU_CGC).css("display", "block");
            $('#desempenho'+item.NU_CGC).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#fteUnidade'+item.NU_CGC).css("display", "block");
            $('#fteApurada'+item.NU_CGC).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#lapUnidade'+item.NU_CGC).css("display", "block");
            $('#lap'+item.NU_CGC).html('<b>'+parseInt(item.LAP_UNIDADE)+'</b>' )


            $('#centralizadora'+item.NU_CGC).html(item.NU_CGC+" - "+item.Sigla)
            $('#nomeCentralizadora'+item.NU_CGC).html(item.nomeAgencia)
            $('#resultado'+item.NU_CGC).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.NU_CGC}`).css({"display": "block","background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.NU_CGC}`).css({"display": "block","background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.NU_CGC}`).css({"display": "block","background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
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
            $(`#botao${item.unidade}`).css({"background-color": "#005ca9", "color": "white"})

            $('#sigla'+item.unidade).html(item.nomeUnidade)
            //$('#nome'+item.unidade).html(item.nomeUnidade)

            $('#vice'+item.unidade).html(item.unidade)
            $('#siglaVice'+item.unidade).html(item.nomeUnidade+" - VP Logística e Operações")

            $('#unidadeSemNenhumDado'+item.unidade).css("display", "none");

            $('#prodUnidade'+item.unidade).css("display", "block");
            $('#produtividade'+item.unidade).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#desUnidade'+item.unidade).css("display", "block");
            $('#desempenho'+item.unidade).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#fteUnidade'+item.unidade).css("display", "block");
            $('#fte'+item.unidade).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#lapUnidade'+item.unidade).css("display", "block");
            $('#lap'+item.unidade).html('<b>'+parseInt(item.totalLAP)+'</b>' )
            $('#resultado'+item.unidade).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.unidade}`).css({"display": "block","background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.unidade}`).css({"display": "block","background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.unidade}`).css({"display": "block","background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
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
            $(`#botao${item.codigoSr}`).css({"background-color": "#f39200", "color": "white"})

            $('#sigla'+item.codigoSr).html(item.Sigla)
            $('#nome'+item.codigoSr).html(item.nomeSr)


            $('#unidadeSemNenhumDado'+item.codigoSr).css("display", "none");

            $('#diretoria'+item.codigoSr).html(item.codigoSr+" - "+item.Sigla)
            $('#siglaDiretoria'+item.codigoSr).html(item.nomeSr)

            $('#prodUnidade'+item.codigoSr).css("display", "block");
            $('#produtividade'+item.codigoSr).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#desUnidade'+item.codigoSr).css("display", "block");
            $('#desempenho'+item.codigoSr).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#fteUnidade'+item.codigoSr).css("display", "block");
            $('#fte'+item.codigoSr).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#lapUnidade'+item.codigoSr).css("display", "block");
            $('#lap'+item.codigoSr).html('<b>'+parseInt(item.totalLAP)+'</b>' )

            $('#resultado'+item.codigoSr).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})
            
            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.codigoSr}`).css({"display": "block","background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.codigoSr}`).css({"display": "block","background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.codigoSr}`).css({"display": "block","background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
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
            
            $(`#botao${item.codigoSr}`).css({"background-color": "#54bbab", "color": "white"})

            $('#unidadeSemNenhumDado'+item.codigoSr).css("display", "none");

            $('#super'+item.codigoSr).html(item.codigoSr+" - "+item.Sigla)
            $('#siglaSuper'+item.codigoSr).html(item.nomeSr)

            $('#prodUnidade'+item.codigoSr).css("display", "block");
            $('#produtividade'+item.codigoSr).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#desUnidade'+item.codigoSr).css("display", "block");
            $('#desempenho'+item.codigoSr).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#fteUnidade'+item.codigoSr).css("display", "block");
            $('#fte'+item.codigoSr).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#lapUnidade'+item.codigoSr).css("display", "block");
            $('#lap'+item.codigoSr).html('<b>'+parseInt(item.totalLAP)+'</b>' )
            $('#resultado'+item.codigoSr).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.codigoSr}`).css({"display": "block","background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.codigoSr}`).css({"display": "block","background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.codigoSr}`).css({"display": "block","background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
                break
            }
            
        })  
    })
});

$(document).ready(function(){
    //modal GN
    $.getJSON('/produtividade-vilop/indicadores/indicadores-vilop/cards-gn', function(dados){
        $.each(dados, function(key, item){

            $(`#botao${item.unidade}`).css({"background-color": "#00b5e5", "color": "white"})

            $('#sigla'+item.unidade).html(item.Sigla)
            $('#nome'+item.unidade).html(item.nomeAgencia)

            $('#unidadeSemNenhumDado'+item.unidade).css("display", "none");

            $('#gerencia'+item.unidade).html(item.unidade+" - "+item.Sigla)
            $('#siglaGerencia'+item.unidade).html(item.nomeAgencia)

            $('#prodUnidade'+item.unidade).css("display", "block");
            $('#produtividade'+item.unidade).html('<b>'+item.PRODUTIVIDADE+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#desUnidade'+item.unidade).css("display", "block");
            $('#desempenho'+item.unidade).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#fteUnidade'+item.unidade).css("display", "block");
            $('#fte'+item.unidade).html('<b>'+item.totalFTEAPURADA+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#lapUnidade'+item.unidade).css("display", "block");
            $('#lap'+item.unidade).html('<b>'+parseInt(item.totalLAP)+'</b>' )

            $('#resultado'+item.unidade).html('<b>'+item.RESULTADO+'</b>').css({"padding-top": "50px"})

            var colorido = item.COR
            switch (colorido){
                case "vermelho":
                    $(`#corUnidade${item.unidade}`).css({"display": "block","background-color": "#fc8a76", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "amarelo":
                    $(`#corUnidade${item.unidade}`).css({"display": "block","background-color": "#ffc230", "color": "white","text-align": "right", "padding-top":"50px"});
                break
                case "verde":
                    $(`#corUnidade${item.unidade}`).css({"display": "block","background-color": "#c2dc26", "color": "white","text-align": "right", "padding-top":"50px"});
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
}, function() {
    $($(this).find("span")[1]).hide();
})

$('.level-2').hover(function(event){
    $($(this).find("span")[1]).show();
}, function() {
    $($(this).find("span")[1]).hide();
})

$('.level-3').hover(function(event){
    $($(this).find("span")[1]).show();
}, function() {
    $($(this).find("span")[1]).hide();
})

$('.level-4').hover(function(event){
    $($(this).find("span")[1]).show();
}, function() {
    $($(this).find("span")[1]).hide();
})

$('.level-4B').hover(function(event){
    $($(this).find("span")[1]).show();
}, function() {
    $($(this).find("span")[1]).hide();
})

$('.level-5').hover(function(event){
    $($(this).find("span")[1]).show();
}, function() {
    $($(this).find("span")[1]).hide();
})

$('.list-group-item').hover(function(event){
    $($(this).find("span")[1]).show();
}, function() {
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

