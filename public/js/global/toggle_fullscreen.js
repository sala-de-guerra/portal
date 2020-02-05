$(document).keyup(function(e){
    if(e.which==122){
        e.preventDefault();//kill anything that browser may have assigned to it by default
        //do what ever you wish here :)
        if ($("#btnFullscreen").is(':visible') === true) {
            $("#btnFullscreen").hide();
            $("#btnFullscreenOff").show();
        } else {
            $("#btnFullscreen").show();
            $("#btnFullscreenOff").hide();
        };
    }
 });

document.addEventListener('fullscreenchange', exitHandler);
document.addEventListener('webkitfullscreenchange', exitHandler);
document.addEventListener('mozfullscreenchange', exitHandler);
document.addEventListener('MSFullscreenChange', exitHandler);

function exitHandler() {
    if (!document.fullscreenElement && !document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
        $("#btnFullscreen").show();
        $("#btnFullscreenOff").hide();
    }
}  


$("#btnFullscreen").click(function() {
    toggleFullScreen();
    $("#btnFullscreen").hide();
    $("#btnFullscreenOff").show();
});

$("#btnFullscreenOff").click(function() {
    toggleFullScreen();
    $("#btnFullscreen").show();
    $("#btnFullscreenOff").hide();
});

function toggleFullScreen() {
    if (!document.fullscreenElement &&    // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
        if (document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen();
        } else if (document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.exitFullscreen) {
        document.exitFullscreen();
        } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
        }
    }
}
