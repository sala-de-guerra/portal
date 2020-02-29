
var _token = $('meta[name="csrf-token"]').attr('content');

/**********************\
| Config inicial Toast |
\**********************/

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

/*********************************************************************\
| Função que cria uma lista para cada equipe com empregados populados |
\*********************************************************************/

$(document).ready( function () {

    $.getJSON('../js/equipes.json', function(dados) {
        // console.log(dados);
        $.each(dados, function(key, item) {
            
            let arrayEmpregados = [];

            $.each(item.equipe, function(key, item) {
                
                let card =
                    `<li id="` + item.matricula + `">` +
                        `<div class="callout callout-primary row p-0">` +
                            `<div class="col-md-12" id="eventual` + item.matricula + `" style="display:none;">` +
                                `<i class="fas fa-fw fa-crown px-1"></i>` +
                            `</div>` +
                            `<div class="col-md-3">` +
                                `<img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula=` + item.matricula + `" class="img-circle elevation-2 user-image-resize-50px" alt="User Image" onerror="this.src='{{ asset('/img/question-mark.png') }}';">` +
                            `</div>` +
                            `<div class="col-md-9">` +
                                `<h5 class="card-title">` + item.nomeCompleto + `</h5>` +
                                `<p class="card-text"><small class="text-muted">` + item.nomeFuncao + `</small></p>` +
                            `</div>` +
                        `</div>` +
                    `</li>`
                ;

                arrayEmpregados.push(card);

            });

            // console.log(arrayEmpregados);

            let stringEmpregados = arrayEmpregados.join(' ').trim();

            let lista =
                `<div class="col-md-3">` +
                    `<div class="card card-default">` +
                        `<div class="card-header">` +
                            `<h3 class="card-title">` +
                                `<b>Célula ` + item.nomeCelula + `</b>` +
                                `<br>` +
                                `Gestor: ` + item.nomeGestorCelula +
                            `</h3>` +
                        `</div>` +
                        `<div class="card-body">` +
                            `<ul class="connectedSortable list-unstyled">` +
                            stringEmpregados +
                            `</ul>` +
                        `</div>` +
                    `</div>` +
                `</div>`
            ;

            $(lista).appendTo('#equipes');

            $('#eventual' + item.matriculaEventualCelula).show();

        });

        /***************************************************\
        | Animação de clicar & arrastar e salvar alterações |
        \***************************************************/

        $( '.connectedSortable' )
        .sortable({
            connectWith: '.connectedSortable',
            receive: function( event, ui ) {
                // console.log(ui);
                // console.log(ui.item);
                // console.log(ui.item[0].id);
                // console.log(ui.item[0].parentElement.id);
                // console.log(ui.item[0].children);

                let matricula = ui.item[0].id;
                let celula = ui.item[0].parentElement.id;
                let callout = ui.item[0].children;

                // console.log({matricula, celula, _token});

                $.post('/url', {matricula, celula, _token}, function (){
                    // trocarCor(celula, callout);

                    Toast.fire({
                        icon: 'success',
                        title: 'Alteração salva!'
                    });
                })
                .fail(function () {
                    
                    $(ui.sender).sortable('cancel');

                    Toast.fire({
                        icon: 'error',
                        title: 'Erro: alteração Não efetuada!'
                    });
                });

            }
        })
        .disableSelection()
        ;
        
    });

    
});