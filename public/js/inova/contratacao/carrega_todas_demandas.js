    $.ajax({
        type: 'GET',
        url: '../../esteiracomex/gerenciar/listar-demandas-para-distribuir',
        // url: '../../js/contratacao/tabela_minhas_demandas_contratacao.json',
        data: 'value',
        dataType: 'json',
        success: function (dados) {

            // captura os arrays de demandas do json
            $.each(dados.demandasEsteira[0].contratacao, function(key, item) {

            // monta a linha com o array de cada demanda
                var linha = 
                    '<tr href="/esteiracomex/contratacao/consultar/' + item.idDemanda + '">' +
                        '<td>' + item.idDemanda + '</td>' +
                        '<td class="formata-data">' + item.dataCadastro + '</td>' +
                        '<td>' + item.nomeCliente + '</td>' +
                        '<td>' + item.cpfCnpj + '</td>' +
                        '<td>' + item.tipoOperacao + '</td>' +
                        '<td class="mascaradinheiro">' + item.valorOperacao + '</td>' +
                        '<td>' + item.unidadeDemandante + '</td>' +
                        '<td>' + item.statusAtual + '</td>' +
                    '</tr>';

                // popula a linha na tabela
                $(linha).appendTo('#tabelaPedidosContratacao>tbody');
            });

            //Função global que formata a data para valor humano do arquivo formata_data.js
            _formataData();

            //Função global que formata dinheiro para valor humano do arquivo formata_data.js.
            _formataValores();

            //Função global que formata DataTable para portugues do arquivo formata_datatable.js.
            _formataDatatable();

            $('#tabelaPedidosContratacao tbody').on('click', 'tr', function () {
                var href = $(this).attr("href");            
                if (href == undefined) {
                    document.location.href = '/esteiracomex/acompanhar/contratacao';
                } else {
                    document.location.href = href;
                };
            });  
        }
    });