$(document).ready(function(){
    $(".menu-hamburguer").click();

    $('h1').hover(function(event){
        $($(this).find("span")[0]).show();
        $(this).css("background", "#004c8c");
    }, function() {
        $($(this).find("span")[0]).hide();
        $(this).css("background", "#005ca9");
    })

    $('h2').hover(function(event){
        $($(this).find("span")[0]).show();
        $(this).css("background", "#ec7500");
    }, function() {
        $($(this).find("span")[0]).hide();
        $(this).css("background", "#f39200");
    })

    $('h3').hover(function(event){
        $($(this).find("span")[0]).show();
        $(this).css("background", "#40a797");
    }, function() {
        $($(this).find("span")[0]).hide();
        $(this).css("background", "#54bbab");
    })

    $('h4').hover(function(event){
        $($(this).find("span")[0]).show();
        $(this).css("background", "#00a2cd");
    }, function() {
        $($(this).find("span")[0]).hide();
        $(this).css("background", "#00b5e5");
    })

    $('h5').hover(function(event){
        $($(this).find("span")[0]).show();
        $(this).css("background", "#b3c7cb");
    }, function() {
        $($(this).find("span")[0]).hide();
        $(this).css("background", "#d0e0e3");
    })

    $('.list-group-item').hover(function(event){
        $(this).css("background", "#b3c7cb");
    }, function() {
        $(this).css("background-color", "#EFF5F6");
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

});