
function _formataProgressBar (idBarra, arrayPorcentagemEStatus, statusAtual) {

    var barra = 
        '<div class="d-flex justify-content-around">' +
            '<div class="progress padding0 border-radius-10px min-width-95">' +
                '<div id="barra' + idBarra + '" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: " aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>' +
            '</div>' +
        '</div>' +

        '<ul id="lista' + idBarra + '" class="list-inline d-flex justify-content-between progress-ul">' +
        '</ul>';
    
    $(barra).appendTo('#' + idBarra);

    var porcentagemPreenchimento =  Object.keys(arrayPorcentagemEStatus).find(value => arrayPorcentagemEStatus[value] == statusAtual); 

    $.each(arrayPorcentagemEStatus, function(key, item) {
        
        if (porcentagemPreenchimento >= key) {
            var passo =
                '<li>' +
                    '<div class="progress-step bg-green progress-item"></div>' +
                    '<span class="badge bg-green">' + item + '</span>' +
                '</li>';
        }
        else {
            var passo =
            '<li>' +
                '<div class="progress-step bg-secondary progress-item"></div>' +
                '<span class="badge bg-secondary">' + item + '</span>' +
            '</li>';

        }

        $(passo).appendTo('#lista' + idBarra);

    });

    $('#barra' + idBarra).css("width", function() {
        return porcentagemPreenchimento + "%";
    });


};