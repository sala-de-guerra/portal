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

    if (idBarra == "progressBarGeral") {
        switch (statusAtual) {
            case 'Em Análise':
            case 'Em Cadastramento':
            case 'Aguarda Justif. Avaliação':
            case 'Em Pendência':
            case 'Em Reavaliação':
            case 'Aguarda Licitação':
            case 'Arrendado':
            case 'Devolvido':
            case 'Excluído':
            case 'Indício de Fraude':
            case 'Laudo Vencido':
            case 'Licitação':
            case 'Montagem de Licitação':
                statusAtual = 'Preparaçâo';
                break;
            case 'Aguarda 1º Leilão SFI':
            case 'Aguarda 2º Leilão SFI':
            case 'Em Homologação':
                statusAtual = 'Leilão';
                break;
            case 'Em Contratação':
            case 'Contratação pendente':
                statusAtual = 'Contratação';
                break;
            case 'Vendido':
            case 'Venda Direito Preferência':
            case 'Venda Direta Beneficiário':
            case 'Venda Direta Especial':
            case 'Venda Direta FAR':
            case 'Venda Direta Ocupante':
            case 'Venda por credenciado':
                statusAtual = 'Vendido';
                break;
            case 'Venda Direta Online':
            case 'Venda Direta':
                statusAtual = 'Venda Online';
                break;
        }
    };

    if (idBarra.indexOf ("progressBarDistrato") > -1) {
        switch (statusAtual) {
            case 'AGUARDA AUTORIZACAO EMGEA':
            case 'CADASTRADA':
            case 'CANCELADA':
                statusAtual = 'Cadastrada';
                break;
            case 'AGUARDA DOCUMENTOS CLIENTE':
                statusAtual = 'Aguarda Docs.';
                break;
            case 'AGUARDA PARECER GESTOR':
            case 'CONSULTA JURIR':
            case 'EM ANALISE':
                statusAtual = 'Em Análise';
                break;
            case 'AVERBACAO DISTRATO':
            case 'ENCAMINHADO AGENCIA':
                statusAtual = 'Encaminhado Agência';
                break;
            case 'CONCLUIDA':
                statusAtual = 'Concluída';
                break;
        }
    };


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