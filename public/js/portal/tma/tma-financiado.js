    
var csrfVar = $('meta[name="csrf-token"]').attr('content');


function _formataDatatableComId (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "desc" ]],
        "columnDefs": [{
            "render": function(data){
             return parseFloat(data).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});},
            "targets": [2]
            }],
        "pageLength": 25,
        "language": {
            "decimal": ",",
            "thousands": ".",
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
};


$(document).ready(function(){
    $.getJSON('/tma-venda-com-financimento', function(dados){
        $.each(dados, function(key, item) {
            var linha =
                `<tr>
                    <td><a href="/consulta-bem-imovel/${item.BEM_FORMATADO}" class="cursor-pointer">${item.NU_BEM}</a></td>
                    <td>${item.tipoVenda}</td>
                    <td>${item.PAGAMENTO_BOLETO}</td>
                    <td>${item.DIAS_DECORRIDOS}</td>
                    <td id="nomeProponente${item.NU_BEM}">${item.NOME_PROPONENTE}</td>
                    <td style="white-space:nowrap;">${item.CPF_CNPJ_PROPONENTE}</td>
                    <td id="colunacca${item.NU_BEM}">${item.ACEITA_CCA}</td>
                    <td style="white-space:nowrap;">
                    <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton${item.NU_BEM}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Ação
                    </button>` + `
                    <button type="button" id="boleto${item.NU_BEM}" class="btn btn-primary" data-toggle="modal" data-target="#consultaBoletoModal${item.NU_BEM}">
                      <i class="fas fa-barcode"></i>
                    </button> 
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" id="baixar${item.NU_BEM}" type="button" data-toggle="modal" data-target="#baixarContrato${item.NU_BEM}"><i class="fas fa-dollar-sign"></i>&nbsp  Baixar</a>
                          <a class="dropdown-item" id="cancelar${item.NU_BEM}" type="button" data-toggle="modal" data-target="#cancelarContrato${item.NU_BEM}"><i class="fas fa-times"></i>&nbsp Cancelar</a>
                          <a class="dropdown-item" id="aguarda${item.NU_BEM}" type="button" data-toggle="modal" data-target="#aguardaContrato${item.NU_BEM}"><i class="far fa-pause-circle"></i> Aguardar</a>
                        </div>
                      </div>

                        <!-- Modal baixa -->
                        <div class="modal fade" id="baixarContrato${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Baixar contrato</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="/tma/baixar-financiado-chb/${item.BEM_FORMATADO}" method="post" id="formBaixar${item.NU_BEM}">
                              <input type="hidden" name="_token" value="${csrfVar}">
                              <div class="modal-body">
                                  <p>Deseja marcar o contrato <strong>${item.BEM_FORMATADO}</strong> como baixado ?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                  <button type="submit" class="btn btn-primary">Baixar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <!-- Modal cancelar -->
                        <div class="modal fade" id="cancelarContrato${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cancelar contrato</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="/tma/cancelar-financiado-chb/${item.BEM_FORMATADO}" method="post" id="Formcancelar${item.NU_BEM}">
                              <input type="hidden" name="_token" value="${csrfVar}">
                              <input type="hidden" name="nomeProponente" value="${item.NOME_PROPONENTE}">
                              <input type="hidden" name="cpfNnpjProponente" value="${item.CPF_CNPJ_PROPONENTE}">
                              <div class="modal-body">
                                  <p>Deseja marcar o contrato <strong>${item.BEM_FORMATADO}</strong> como distrato ?</p>
                                </div>
                                <div class="modal-body">
                                <label for="observacaoAtendimento">Observação</label>
                                <textarea class="form-control" name="observacaoAtendimento" rows="5" required>venda cancelada - pagamento não identificado no SIMOV e SIACI - boleto baixado - cpf: ${item.CPF_CNPJ_PROPONENTE} - nome: ${item.NOME_PROPONENTE}
                                </textarea>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                  <button type="submit" class="btn btn-danger">Distratar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <!-- Modal aguardar -->
                        <div class="modal fade" id="aguardaContrato${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Aguarda pagamento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="/tma/aguarda-pagamento-financiado-chb/${item.BEM_FORMATADO}" method="post" id="formPagar${item.NU_BEM}">
                              <input type="hidden" name="_token" value="${csrfVar}">
                              <div class="modal-body">
                                <label for="observacaoAtendimento">Observação</label>
                                <textarea class="form-control" name="observacaoAtendimento" rows="5" required></textarea>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                  <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="consultaBoletoModal${item.NU_BEM}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xxl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Consulta Boleto</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Status</th>
                                  <th scope="col">Proponente</th>
                                  <th scope="col">Data emissão</th>
                                  <th scope="col">Data validade</th>
                                  <th scope="col">Data pagamento</th>
                                  <th scope="col">Banco pagamento</th>
                                  <th scope="col">Tipo pagamento</th>
                                  <th scope="col">Valor Boleto</th>
                                </tr>
                              </thead>
                              <tbody id="tabelaPagamento${item.NU_BEM}">
                               
                              </tbody>
                            </table>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                          </div>
                        </div>
                      </div>


                    </td>
                </tr>`       
        
            $(linha).appendTo('#tblTmaFinanciado>tbody');
              if (item.baixaEfetuada == 'sim'){
                $('#nomeProponente'+item.NU_BEM).html('<b style="color: blue;">'+item.NOME_PROPONENTE +'</b>')
                $('#dropdownMenuButton'+item.NU_BEM).remove()
              }else if (item.baixaEfetuada == 'del'){
                $('#nomeProponente'+item.NU_BEM).html('<b style="color: red;">'+item.NOME_PROPONENTE +'</b>')
                $('#dropdownMenuButton'+item.NU_BEM).remove()
              }else if (item.baixaEfetuada == 'pag'){
                $('#nomeProponente'+item.NU_BEM).html('<b style="color: green;">'+item.NOME_PROPONENTE +'</b>')
              }else if (item.repetido != null){
                $('#nomeProponente'+item.NU_BEM).html('<b style="color: red;">* </b>'+item.NOME_PROPONENTE)
              }

              $( "#boleto" + item.NU_BEM).one("click", function() {
                $.getJSON('/contratacao/controle-boletos/listar-boleto/'+item.NU_BEM, function(dados){
                  $.each(dados, function(key, item) {
                    var valorSemformatacao = item.valorBoleto
                    var valBoleto = valorSemformatacao.toString().replace(',', '.')
                    console.log(item.valBoleto)
                    var valorBoletoFormatado = Number(valBoleto).toLocaleString('pt-BR', {style: "currency", currency: "BRL"})
                    let linha =
                    `<tr>
                        <td id="colunaStatus${item.nuBEM + item.banco}">${item.status}</td>
                        <td id="colunaProponente${item.nuBEM + item.banco}">${item.proponente}</td>
                        <td id="colunaEmissao${item.nuBEM + item.banco}">${item.emissao}</td>
                        <td id="colunaValidade${item.nuBEM + item.banco}">${item.validade}</td>
                        <td id="colunaPagamento${item.nuBEM + item.banco}">${item.dataPagamento}</td>
                        <td id="colunaBanco${item.nuBEM + item.banco}">${item.banco}</td>
                        <td id="colunaTipo${item.nuBEM + item.banco}">${item.tipo}</td>
                        <td id="colunaValorBoleto${item.nuBEM + item.banco}">${valorBoletoFormatado}</td>
                    </tr>`
                      $('#tabelaPagamento'+item.nuBEM).append(linha);
                      if($('#colunaPagamento'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaPagamento'+item.nuBEM + item.banco).text("")
                      }
                      if($('#colunaProponente'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaProponente'+item.nuBEM + item.banco).text("")
                      }
                      if($('#colunaStatus'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaStatus'+item.nuBEM + item.banco).text("")
                      }
                      if($('#colunaEmissao'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaEmissao'+item.nuBEM + item.banco).text("")
                      }
                      if($('#colunaValidade'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaValidade'+item.nuBEM + item.banco).text("")
                      }
                      if($('#colunaBanco'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaBanco'+item.nuBEM + item.banco).text("")
                      }
                      if($('#colunaTipo'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaTipo'+item.nuBEM + item.banco).text("")
                      }
                      if($('#colunaValorBoleto'+item.nuBEM + item.banco).text() == 'null'){
                        $('#colunaValorBoleto'+item.nuBEM + item.banco).text("")
                      }
                  })
                })  
              }) 

              if ($('#colunacca' +item.NU_BEM).text() == 'null'){
                $('#colunacca' +item.NU_BEM).text('Nao')
              }
              $('#formBaixar'+item.NU_BEM).submit( function(e) {
                e.preventDefault();
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        $('.modal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Baixa Efetuada!'
                        });
                    $('#nomeProponente'+item.NU_BEM).html('<b style="color: blue;">'+item.NOME_PROPONENTE +'</b>')
                    $('#dropdownMenuButton'+item.NU_BEM).remove()
                    },
                    error: function () {
                        $('.modal').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: tente novamente!'
                        });
                      } 
                    });
              })

              $('#Formcancelar'+item.NU_BEM).submit( function(e) {
                e.preventDefault();
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        $('.modal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Cancelamento Efetuado!'
                        });
                      $('#nomeProponente'+item.NU_BEM).html('<b style="color: red;">'+item.NOME_PROPONENTE +'</b>')
                      $('#dropdownMenuButton'+item.NU_BEM).remove()
                    },
                    error: function () {
                        $('.modal').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: tente novamente!'
                        });
                      } 
                    });
              })

              $('#formPagar'+item.NU_BEM).submit( function(e) {
                e.preventDefault();
                let datas = JSON.stringify( $(this).serialize() );
                let url = $(this).attr('action');
                let method = $(this).attr('method');
                // console.log(datas);
                // console.log(url);
                // console.log(method);
                $.ajax({
                    type: method,
                    url: url,
                    // data: {datas, csrfVar},
                    data: $(this).serialize(),
                    success: function (result){
                        $('.modal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Aguardando pagamento!'
                        });
                      $('#nomeProponente'+item.NU_BEM).html('<b style="color: green;">'+item.NOME_PROPONENTE +'</b>')
                    },
                    error: function () {
                        $('.modal').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro: tente novamente!'
                        });
                      } 
                    });
              })
            }
        )}
    ).done(function() {
        _formataDatatableComId('tblTmaFinanciado')
         $('.spinnerTbl').remove()
    })
})

setTimeout(function(){
  $('#fadeOut').fadeOut("slow");
}, 2000);