$(document).ready(function(){

    $.getJSON('/estoque-imoveis/distrato/listar-protocolos', function(dados){

        $.each(distratos, function(key, item) {
            var linha = 
                '<tr href="/consulta-bem-imovel/' + item.contratoFormatado + '>' +
                    '<td>' + item.contratoFormatado + '</td>' +
                    '<td>' + item.nomeProponente + '</td>' +
                    '<td>' + item.statusAnalise + '</td>' +
                    '<td>' + item.motivoDistrato + '</td>' +
                    '<td>' + item.created_at + '</td>' +
                    '<td>' + '</td>' +
                '</tr>';
            
            $(linha).appendTo('#tblDistrato>tbody');
        })
    
    });

    _formataDatatable ();

});

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
