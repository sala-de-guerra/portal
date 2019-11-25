//Função global que valida codigos SWIFT e IBAN preenchidos na pagina

// ####################### VALIDAÇÃO DE SWIFT #######################
function _validaSwift(field, value){
    $(field).siblings('div.flag').remove();
    isBic(value);
    function isBic(value) {
        let validation = /^([A-Z]{6}[A-Z2-9][A-NP-Z1-9])(X{3}|[A-WY-Z0-9][A-Z0-9]{2})?$/.test( value.toUpperCase() );

        if (value == ''){
            $(field).siblings('div.flag').remove();
            $('#submitBtn').attr("disabled", false);
        }
        else {
            if (validation == true) {
                $(field).after('<div class="flag"><small class="label bg-green">Este SWIFT é VÁLIDO!</small></div>');
                $('#submitBtn').prop("disabled", false);
            }
            else {
                $(field).after('<div class="flag"><small class="label bg-red">Este SWIFT é INVÁLIDO!</small></div>');
                $('#submitBtn').prop("disabled", true);
            };
        };

    };
};

// ####################### VALIDAÇÃO DE IBAN #######################

function _validaIban(field, value){
    $(field).siblings('div.flag').remove();
    if (value == ''){
        $(field).siblings('div.flag').remove();
        $('#submitBtn').attr("disabled", false);

    }
    else {
        if (IBAN.isValid(value)) {
            $(field).after('<div class="flag"><small class="label bg-green">Este IBAN é VÁLIDO!</small></div>');
            $('#submitBtn').attr("disabled", false);

        }
        else {
            $(field).after('<div class="flag"><small class="label bg-red">Este IBAN é INVÁLIDO!</small></div>');
            $('#submitBtn').attr("disabled", true);
        };
    };
};