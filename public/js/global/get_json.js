function _get_json(url) { 
    var dados = $.ajax({
        type: 'GET',
        url: '' + url + '',
        data: 'value',
        dataType: 'json',
        global: false,
        async:false,
        success: function (dados) {
            return dados;
        }
    }).responseJSON;

    console.log (dados);

};
