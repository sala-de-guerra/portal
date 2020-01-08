$(document).ready(function(){

    $.getJSON('/estoque-imoveis/distrato/listar-protocolos', function(dados){

        $.each(dados, function(key, item) {
            var linha =
                '<tr href="/consulta-bem-imovel/' + item.contratoFormatado + '">' +
                    '<td>' + item.contratoFormatado + '</td>' +
                    '<td>' + item.nomeProponente + '</td>' +
                    '<td>' + item.statusAnaliseDistrato + '</td>' +
                    '<td>' + item.motivoDistrato + '</td>' +
                    '<td>' + item.created_at + '</td>' +
                '</tr>';
            
            $(linha).appendTo('#tblDistrato>tbody');
        })
    
    });

    _formataDatatable ();

});

// RESETAR CAMPOS DO FORM DE CADASTRO DE DEMANDA DE DISTRATO AO FECHAR O MODAL

$('#modalCadastraDistrato').on('hidden.bs.modal', function(e){
    $("#formCadastraDemandaDistrato")[0].reset();           
});

// FUNCAO DE VALIDAR CHB E JA PEGAR NOME E CPF DA ROTA DE CONSULTA-BEM

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


