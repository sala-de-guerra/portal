//Função global que anima a barra de progresso do arquivo formata_data.js

function _progressBar (){

    var progress = '';

    $('.progress .progress-bar').css("width", function() {

        switch($('#statusGeral').html()) {

            case "CADASTRADA": 
                progress = 13.5;
                break;

            case "DISTRIBUIDA":
            case "EM ANALISE":
                progress = 26;
                break;

            case "INCONFORME":
                progress = 38;
                break;

            case "CONFORME":
                progress = 50;
                break;

            case "CONTRATO EMITIDO":
            case "CONTRATO ENVIADO":
                progress = 62;
                break;
            
            case "CONTRATO PENDENTE":
                progress = 75;
                break;

            case "CONTRATO ASSINADO":
            case "ASSINATURA CONFORME":
            case "NÃO LIQUIDADA":
                progress = 87;
                break;

            case "LIQUIDADA":
                progress = 100
                break;
        }
        return progress + "%";
    });

    switch (progress) {
        case 13.5:
            $('#Cadastrada').removeClass('border-default');
            break;
        case 26:
            $('#Cadastrada').removeClass('border-default');
            $('#emAnalise').removeClass('border-default').addClass('border-warning');
            $('#progressBar').addClass('progress-bar-warning');
            break;
        case 38:
            $('#Cadastrada').removeClass('border-default');
            $('#emAnalise').removeClass('border-default');
            $('#Inconforme').removeClass('border-default').addClass('border-danger');
            $('#progressBar').addClass('progress-bar-danger');
            break;
        case 50:
            $('#Cadastrada').removeClass('border-default');
            $('#emAnalise').removeClass('border-default');
            $('#Inconforme').removeClass('border-default');
            $('#Conforme').removeClass('border-default').addClass('border-warning');
            $('#progressBar').addClass('progress-bar-warning');
            break;
        case 62:
            $('#Cadastrada').removeClass('border-default');
            $('#emAnalise').removeClass('border-default');
            $('#Inconforme').removeClass('border-default');
            $('#Conforme').removeClass('border-default');
            $('#Enviado').removeClass('border-default').addClass('border-warning');
            $('#progressBar').addClass('progress-bar-warning');
            break;
        case 75:
            $('#Cadastrada').removeClass('border-default');
            $('#emAnalise').removeClass('border-default');
            $('#Inconforme').removeClass('border-default');
            $('#Conforme').removeClass('border-default');
            $('#Enviado').removeClass('border-default');
            $('#Pendente').removeClass('border-default').addClass('border-danger');
            $('#progressBar').addClass('progress-bar-danger');
            break;
        case 87:
            $('#Cadastrada').removeClass('border-default');
            $('#emAnalise').removeClass('border-default');
            $('#Inconforme').removeClass('border-default');
            $('#Conforme').removeClass('border-default');
            $('#Enviado').removeClass('border-default');
            $('#Pendente').removeClass('border-default');
            $('#Assinado').removeClass('border-default').addClass('border-warning');
            $('#progressBar').addClass('progress-bar-warning');
            break;
        case 100:
            $('#Cadastrada').removeClass('border-default');
            $('#emAnalise').removeClass('border-default');
            $('#Inconforme').removeClass('border-default');
            $('#Conforme').removeClass('border-default');
            $('#Enviado').removeClass('border-default');
            $('#Pendente').removeClass('border-default');
            $('#Assinado').removeClass('border-default');
            $('#Liquidada').removeClass('border-default').addClass('border-success');
            $('#progressBar').addClass('progress-bar-success');
            break;
    }
            
    // if (progress >= 26) {
    //     $('#emAnalise').removeClass('border-default');
    // }
    // if (progress >= 38) {
    //     $('#Inconforme').removeClass('border-default').addClass('border-danger');
    // }
    // if (progress >= 50) {
    //     $('#Conforme').removeClass('border-default');
    // }
    // if (progress >= 62) {
    //     $('#Cont.Emitido').removeClass('border-default');
    // }
    // if (progress >= 75) {
    //     $('#Cont.Pendente').removeClass('border-default');
    // }
    // if (progress >= 87) {
    //     $('#Cont.Assinado').removeClass('border-default');
    // }
    // if (progress == 100) {
    //     $('#Liquidada').removeClass('border-default').addClass('border-success');
    // }
    
};


