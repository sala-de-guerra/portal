// popula o botão de receber documentos leiloeiro
$.getJSON('/fornecedores/controle-leiloeiros/listar-leiloeiros/' + unidade, function(dados){
    $.each(dados, function(key, item) {
        var botaoLeiloeiro = '<option value="'+item.idLeiloeiro+'">'+item.nomeEmpresaAssessoraLeiloeiro+'</option>'
        $(botaoLeiloeiro).appendTo('#inputGroupSelect01')
    })
})