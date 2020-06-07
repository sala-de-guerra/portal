//Função global que formata a data para valor humano.
function _formataData() {
    moment.locale('pt-br');

    $('.formata-data').each(function (key, item) {
        var data = $(this).text()
        var dataFormatada = moment(data, 'YYYY-MM-DD, HH:mm:ss').format('L LT');
        $(item).text(dataFormatada);
    });

    $('.formata-data-sem-hora').each(function (key, item) {
        var data = $(this).text()
        var dataFormatada = moment(data, 'YYYY-MM-DD, HH:mm:ss').format('L');
        $(item).text(dataFormatada);
    });
};

//Função global que formata dinheiro para valor humano.

function _formataValores() {
    numeral.locale('pt-br');
    $('.formata-valores').each(function (key, item) {
        var valor = $(this).text()
        var valorFormatado = numeral(valor.replace('.', ',')).format('0,0.00');
        $(item).text(valorFormatado);
    });
    
    $('.mascaradinheiro').mask('000.000.000.000.000,00' , { reverse : true});
    $('.mascaradata').mask('00/00/0000');

};

//Função global que formata a data para valor humano.
function _formataDataInput() {
    moment.locale('pt-br');

    $('.formata-data-input').each(function (key, item) {
        var data = $(this).text()
        var dataFormatada = moment(data, 'YYYY-MM-DD, HH:mm:ss').format('L LT');
        $(item).text(dataFormatada);
    });

    $('.formata-data-sem-hora-input').each(function (key, item) {
        var data = $(this).text()
        var dataFormatada = moment(data, 'YYYY-MM-DD, HH:mm:ss').format('L');
        $(item).text(dataFormatada);
    });
};

function _formataDatas() {
    moment.locale('pt-br');

    $('.formata-datas').each(function (key, item) {
        var data = $(this).text()
        var dataFormatada = moment(data, 'YYYY-MM-DD, HH:mm:ss').format('L LT');
        $(item).text(dataFormatada);
    });

    $('.formata-data-sem-horas').each(function (key, item) {
        var data = $(this).text()
        var dataFormatada = moment(data, 'YYYY-MM-DD, HH:mm:ss').format('L');
        $(item).text(dataFormatada);
    });
};