$(document).ready(function(){

    $.getJSON('/estoque-imoveis/distrato/listar-protocolos', function(dados){

        $.each(dados, function(key, item) {
            
            var dataformatada = formataDataHumana(item.created_at);

            var linha = 
                '<tr href="/consulta-bem-imovel/' + item.contratoFormatado + '">' +
                    '<td>' + item.idDistrato + '</td>' +
                    '<td>' + item.contratoFormatado + '</td>' +
                    '<td>' + item.nomeProponente + '</td>' +
                    '<td>' + item.statusAnaliseDistrato + '</td>' +
                    '<td>' + item.motivoDistrato + '</td>' +
                    '<td>' + dataformatada + '</td>' +
                '</tr>';
            $(linha).appendTo('#tblDistrato>tbody');
        })
        _formataDatatable();
    });
    // _formataDatatable();
});

function formataDataHumana(data)
{
    let dataNaoFormatada;
    let dataFormatoPtBr;
    if (data == null || data == undefined) {
        dataFormatoPtBr = ''; 
    } else {
        dataNaoFormatada = new Date(data); 
        dataFormatoPtBr = dataNaoFormatada.toLocaleString();
    }
    return dataFormatoPtBr;
}

function _validarCHB(inputChb){
    $("input[name='nomeProponente']").val('');
    $("input[name='cpfCnpjProponente']").val('');

    let numeroContrato = $(inputChb).val()
    
    console.log(numeroContrato)

    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){
        $("input[name='nomeProponente']").val(dados.nomeProponente);
        $("input[name='cpfCnpjProponente']").val(dados.cpfCnpjProponente);
    })
    .fail(function() {
        alert("CHB " + numeroContrato + " não encontrado!");
    });
};
