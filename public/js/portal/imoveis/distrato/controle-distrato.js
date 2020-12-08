$(document).ready(function(){

    $.getJSON('/estoque-imoveis/distrato/listar-protocolos', function(dados){
        $.each(dados, function(key, item) {          

            var linha = 
                '<tr href="/estoque-imoveis/distrato/tratar/' + item.contratoFormatado + '" class="cursor-pointer">' +
                    '<td>' + item.idDistrato + '</td>' +
                    '<td style="white-space:nowrap;">' + item.contratoFormatado + '</td>' +
                    '<td>' + item.nomeProponente + '</td>' +
                    '<td>' + item.statusAnaliseDistrato + '</td>' +
                    '<td>' + item.motivoDistrato + '</td>' +
                    '<td class="formata-data">' + item.created_at + '</td>' +
                '</tr>';
            $(linha).appendTo('#tblDistrato>tbody'); 
        })

        _formataData();
        _formataDatatable();

        $('#tblDistrato tbody').on('click', 'tr', function () {
            var href = $(this).attr("href");            
            if (href == undefined) {
                document.location.href = '/estoque-imoveis/distrato';
            } else {
                document.location.href = href;
            };
        });  

    });
    $('#inputChb').mask('00.0000.0000000-0');
});



// RESETAR CAMPOS DO FORM DE CADASTRO DE DEMANDA DE DISTRATO AO FECHAR O MODAL

// $('#modalCadastraDistrato').on('hidden.bs.modal', function(e){
//     $("#formCadastraDemandaDistrato")[0].reset();           
// });

$(".modal").on('hidden.bs.modal', function(e){
    $(this).find("form")[0].reset();       
});


// FUNCAO DE VALIDAR CHB E JA PEGAR NOME E CPF DA ROTA DE CONSULTA-BEM
function _validarCHB(inputChb){
    $("input[name='nomeProponente']").val('');
    $("input[name='cpfCnpjProponente']").val('');

    let numeroContrato = $(inputChb).val()
    
    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){
        $("input[name='nomeProponente']").val(dados.nomeProponente);
        $("input[name='cpfCnpjProponente']").val(dados.cpfCnpjProponente);
    })
    .fail(function() {
        alert("CHB " + numeroContrato + " não encontrado!");
    });
};