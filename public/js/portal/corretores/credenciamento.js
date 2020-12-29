var csrfVar = $('meta[name="csrf-token"]').attr('content');

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "asc" ]],

       columnDefs: [
           {type: 'date-uk', targets: [3]} //vai filtrar a coluna com data dd/mm/yyyy
        ],
       
        "pageLength": 10,
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


$(document).ready(function(){
    $.getJSON('lista-credenciados', function(dados){
        $.each(dados, function(key, item) {

            var CREDENCIADO= item.credenciado
            var CREDENCIADOFormatado = CREDENCIADO.toUpperCase();
            
            var convocacao = moment(item.dataConvoc).format('DD/MM/YYYY')

            let linha =  
                `<tr>
                    <td style="text-align:center;">${item.processo}</td>
                   
                    <td style="white-space:nowrap;" style="text-align:left;"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDadosCredenciado${item.processo}"><i style="color: #054f77; font-size: 13pt;" class="fas fa-info-circle"></i></button>${CREDENCIADOFormatado}

                    <div class="modal fade" id="modalDadosCredenciado${item.processo}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                    <h5 class="modal-title" style="color: white;">Dados do Credenciado </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <p>${CREDENCIADOFormatado}</p>
                                    </div>
                                    
                                    <div class="form-group" id="CNPJValor${item.processo}">
                                        <label>CNPJ:</label>
                                        <p>${item.CNPJ}</p>
                                    </div>

                                    <div class="form-group" id="CPFValor${item.processo}">
                                        <label>CPF:</label>
                                        <p>${item.CPF}</p>
                                    </div>

                                    <div class="form-group" id="RepresValor${item.processo}">
                                        <label>Representante:</label>
                                        <p>${item.Representante}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <p>${item.email}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    </td>


                    <td style="text-align:center;">${item.numeroContrato}</td>
                    <td style="text-align:center;">${convocacao}</td>
                    <td style="white-space:nowrap;" class="text-center"><a href="file:\\arquivos.caixa\sp\SP7062FS201\PUBLIC\Credenciamento_001.2020_Corretores\Corretores Contratados"><button type="button" class="btn btn-link">${item.contratoDevolvido}</button></a></td>

                    <td style="white-space:nowrap;" class="text-center"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalSicaf${item.processo}">
                    ${item.SICAF}</button>

                        <!-- Modal --> 
                            <div class="modal fade" id="modalSicaf${item.processo}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <span data-toggle="tooltip" data-placement="top" title="Enviar e-mail"></span>
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                            <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Enviar e-mail de aviso de pendência no SICAF</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="form-group">
                                            <form class="col" action="envia-email-sicaf/${item.processo}" method="POST">
                                                <input type="hidden" name="_token" value="${csrfVar}">
                                                <input type="hidden" name="nomeCredenciado" value="${CREDENCIADOFormatado}">
                                                <div class="modal-body">
                                                    <p>Deseja enviar e-mail para <strong>${CREDENCIADOFormatado}</strong> informando sobre a pendência no SICAF?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>   

                                
                    </td>

                    
                </tr>`

                


            $(linha).appendTo('#tblCredenciamento>tbody');

            if(item.CNPJ == null){
                $('#CNPJValor' + item.processo).text("")
            }

            if(item.CPF == null){
                $('#CPFValor' + item.processo).text("")
            }   

            if(item.Representante == null){
                $('#RepresValor' + item.processo).text("")
            }   
            
        })
    }).done(function() {
    _formataDatatableComData("tblCredenciamento")
    
    })
})

