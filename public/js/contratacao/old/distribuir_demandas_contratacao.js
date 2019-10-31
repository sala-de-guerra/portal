$(document).ready(function() {

    $.ajax({
        type: 'GET',
        url: '../../api/esteiracomex/distribuicao',
        // url: '../../js/contratacao/carrega_distribuicao_contratacao.json',
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            // captura os arrays de demandas do json
            $.each(dados.demandasEsteira[0].contratacao, function(key, item) {

            // monta a linha com o array de cada demanda
                var linha = 
                    '<tr>' +
                        '<td>' + item.idDemanda + '</td>' +
                        '<td>' + item.dataCadastro + '</td>' +
                        '<td>' + item.nomeCliente + '</td>' +
                        '<td>' + item.cpfCnpj + '</td>' +
                        '<td>' + item.tipoOperacao + '</td>' +
                        '<td>' + item.valorOperacao + '</td>' +
                        '<td>' + item.unidadeDemandante + '</td>' +
                        '<td>' + item.statusAtual + '</td>' +
                        '<td>' +
                                '<input type="hidden" name="protocolo" value="' + item.idDemanda + '">' + 
                                '<input type="hidden" name="tipoDemanda" value="contratacao">' + 
                                '<select name="analista" id="selectDistribuir' + item.idDemanda + '" class="selectDistribuir" inline required>' +
                                    '<option value="">Distribuir</option>' +
                                '</select>' +
                                '<button type="submit" rel="tooltip" class="btn btn-primary inline gravaDistribuicao" title="Gravar distribuição">' + 
                                    '<span> <i class="glyphicon glyphicon-floppy-disk"> </i></span>' + 
                                '</button>' +
                        '</td>' +
                    '</tr>';

                // popula a linha na tabela
                $(linha).appendTo('#tabelaContratacoes>tbody');

            });
            // monta as options de distribuição de cada linha dependendo do tipo de modalidade
            $.each(dados.demandasEsteira[0].empregadosDistribuicao, function(key, item) {

                var nome = item.nome;
                var stringNome = nome.split(" ");
                var primeiroNome = stringNome[0] + '-' + item.matricula;
                var options = '<option class="matricula" value="' + item.matricula + '">' + primeiroNome + '</option>'
                
                $(options).appendTo('.selectDistribuir');
            });
        
        }
    });

});