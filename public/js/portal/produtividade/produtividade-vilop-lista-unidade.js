var csrfVarVilop = $('#tokenVilop').val();
function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 1, "asc" ]],     
        "pageLength": 15,
        "language": {
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
}

var unidade = $('#unidade').text()
unidade = unidade.trim();

var contadorColaborador = 0;
var contadorGerencial = 0;
var contadorApoioAdministrativo = 0;
var contadorOperacional = 0;
var contadorAfastado = 0;

$(document).ready(function() {
    $.getJSON('/produtividade-vilop/lista/lista-universo/' + unidade, function(dados){
        $.each(dados, function(key, item) {{

            contadorColaborador += 1;
                       
            let codigoFuncao = item.fc_efetiva_codigo
            
            function verificaFuncao(){
                if (codigoFuncao == 2056 || codigoFuncao == 195 || codigoFuncao ==853) {
                    return "Assistente Júnior"
                } else if (codigoFuncao == 2141 || codigoFuncao == 2142) {
                    return "Gerente Centralizadora"
                } else if (codigoFuncao == 2057 || codigoFuncao == 198) {
                    return "Assistente Pleno"
                } else if (codigoFuncao == 2058 || codigoFuncao == 246) {
                    return "Assistente Senior"
                } else if (codigoFuncao == 2061 || codigoFuncao == 2062) {
                    return "Coordenador(a) Centralizadora"
                } else if (codigoFuncao == 2036) {
                    return "Auxiliar Operacional"
                } else if (codigoFuncao == 2060) {
                    return "Supervisor Centralizadora"
                } else if (codigoFuncao == 2022) {
                    return "Avaliador(a) Penhor"
                }  else if (codigoFuncao == 196 || codigoFuncao == 855) {
                    return "Analista Junior 8h"
                }  else if (codigoFuncao == 199) {
                    return "Analista Pleno 8h"
                } else if (codigoFuncao == 2055) {
                    return "Tesoureiro Executivo"
                } else if (codigoFuncao == 2259) {
                    return "Supervisor Centralizadora 6h"
                } else if (codigoFuncao == 312) {
                    return "Tecnico Fom 6h"
                } else if (codigoFuncao == 318) {
                    return "Tecnico Sistemas"
                } else if (codigoFuncao == 396) {
                    return "Assistente Técnico I"
                } else if (codigoFuncao == 456) {
                    return "Supervisor I F3"
                } else if (codigoFuncao == 579) {
                    return "Av Exec Senior 6h"
                } else if (codigoFuncao == 615) {
                    return "Consultor Regional I 6h"
                } else if (codigoFuncao == 616) {
                    return "Consultor Regional I 8h"
                } else if (codigoFuncao == 618) {
                    return "Consultor Regional II 6h"
                } else if (codigoFuncao == 619) {
                    return "Consultor Regional II 8h"
                } else if (codigoFuncao == 621) {
                    return "Tecnico Operacional Ret 6h"
                } else if (codigoFuncao == 616) {
                    return "Tecnico Operacional Ret 8h"
                } else{
                    return "TBN / Escriturário"
                }
            }

            let Funcao = verificaFuncao()

            let lista = 
            `
                <tr>
                    <td style="text-align: center;">${item.matricula}-${item.dv}</td>
                    <td style="white-space: nowrap;">${item.nome}</td>
                    <td style="text-align: center;">${Funcao}</td>
                    <td style="text-align: center;">${item.RESULTADO}</td>
                    <td style="white-space: nowrap; text-align: center;" id="botaoEditarApoio${item.matricula}">                     
                        <button type="button" id="enquadra${item.matricula}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarEnquadra${item.matricula}">
                            <i class="fas fa-edit"></i> Enquadramento
                        </button>

                        <div class="modal fade" id="editarEnquadra${item.matricula}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                        <p style="color: white;" class="modal-title" id="exampleModalLabel">Deseja alterar o enquadramento do(a) colaborador(a):<br><strong>c$${item.matricula}-${item.dv} - ${item.nome}</strong>?</p>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/produtividade-vilop/edita-operacional/${item.matricula}">
                                        <input type="hidden" name="_token" value="${csrfVarVilop}">
                                        
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="formEditar${item.matricula}">Qualificação</label>
                                                <select class="form-control" name="qualificacao" id="formEditar${item.matricula}">
                                                    <option value="OPERACIONAL" selected>Operacional</option>
                                                    <option value="APOIO ADMINISTRATIVO" >Apoio Administrativo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Alterar</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                                </form>

                    </td>
                </tr>
            `
            
            $(lista).appendTo('#baseEmpregados>tbody');
            
            let apoio = item.RESULTADO
            switch (apoio){
                case "GESTOR":
                    contadorGerencial += 1;
                    $('#enquadra'+item.matricula).remove();
                    break
                
                case "OPERACIONAL":
                    contadorOperacional += 1;
                    break

                case "APOIO ADMINISTRATIVO":
                    contadorApoioAdministrativo += 1;
                    break

                case "AFASTADO":
                    contadorAfastado += 1;
                    $('#enquadra'+item.matricula).remove();
            }
        }
         
        var totalColaboradores = contadorColaborador
        $('#totalUnidade').html('<b>' + totalColaboradores + '</b>')

        var totalGerencial = contadorGerencial
        $('#totalGerencial').html('<b>' + totalGerencial + '</b>')

        var totalApoioAdministrativo = contadorApoioAdministrativo
        $('#totalApoioAdministrativo').html('<b>' + totalApoioAdministrativo + '</b>')

        var totalOperacional = contadorOperacional
        $('#totalOperacional').html('<b>' + totalOperacional + '</b>')

        var totalAfastado = contadorAfastado
        $('#totalAfastado').html('<b>' + totalAfastado + '</b>')

        })
    }).done(function() {
        _formataDatatableComData("baseEmpregados")
    })
})