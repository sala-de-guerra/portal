$(document).ready(function(){

    $.getJSON('/produtividade-vilop/api/relatorio-cards-geral', function(dados){
        $.each(dados, function(key, item){
            $('#sigla'+item.NU_CGC).html(item.Sigla)
            $('#nome'+item.NU_CGC).html(item.nomeAgencia)
            $('#produtividade'+item.NU_CGC).html('<b>'+item.PRODUTIVIDADE_G2+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#desempenho'+item.NU_CGC).html('<b>'+item.DESEMPENHO+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#pessoas'+item.NU_CGC).html('<b>'+item.PESSOAS+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fteApurada'+item.NU_CGC).html('<b>'+item.FTE_APURADA+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lap'+item.NU_CGC).html('<b>'+parseInt(item.LAP_UNIDADE)+'</b>' )
        })
    })
});

$('.level-1').hover(function(event){
    $($(this).find("span")[0]).show();
    $(this).css("background", "#004c8c");
}, function() {
    $($(this).find("span")[0]).hide();
    $(this).css("background", "#005ca9");
})

$('.level-2').hover(function(event){
    $($(this).find("span")[0]).show();
    $(this).css("background", "#ec7500");
}, function() {
    $($(this).find("span")[0]).hide();
    $(this).css("background", "#f39200");
})

$('.level-3').hover(function(event){
    $($(this).find("span")[0]).show();
    $(this).css("background", "#40a797");
}, function() {
    $($(this).find("span")[0]).hide();
    $(this).css("background", "#54bbab");
})

$('.level-4').hover(function(event){
    $($(this).find("span")[0]).show();
    $(this).css("background", "#00a2cd");
}, function() {
    $($(this).find("span")[0]).hide();
    $(this).css("background", "#00b5e5");
})

$('.level-4B').hover(function(event){
    $($(this).find("span")[0]).show();
    $(this).css("background", "#00a2cd");
}, function() {
    $($(this).find("span")[0]).hide();
    $(this).css("background", "#00b5e5");
})

$('.level-5').hover(function(event){
    $($(this).find("span")[0]).show();
    $(this).css("background", "#3a4859");
}, function() {
    $($(this).find("span")[0]).hide();
    $(this).css("background", "#5f758f");
})

$('.list-group-item').hover(function(event){
    $(this).css("background", "#b3c7cb");
    $($(this).find("span")[0]).show();
}, function() {
    $(this).css("background-color", "#EFF5F6");
    $($(this).find("span")[0]).hide();
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

