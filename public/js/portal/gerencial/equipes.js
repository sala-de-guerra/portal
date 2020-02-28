
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

/*********************************************\
| Função que cria um card para cada empregado |
\*********************************************/

$(document).ready( function () {

    $.getJSON('../js/empregados.json', function(dados) {

        $.each(dados, function(key, item) {

            let calloutColor = '';

            switch (item.nomeEquipe) {
                case 'Celula Administrar':
                    calloutColor = 'warning';
                    break;
                case 'Celula Gerencial':
                    calloutColor = 'info';
                    break;
                case 'Celula Preparar':
                    calloutColor = 'success ';
                    break;
                case 'Celula Contratacao':
                    calloutColor = 'danger';
                    break;
                default:
                    calloutColor = 'info';
            }

            let card =
                `<li id="` + item.matricula + `">` +
                    `<div class="callout callout-` + calloutColor + ` row p-0">` +
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
            
            switch (item.nomeEquipe) {
                case 'Celula Administrar':
                    $(card).appendTo('#listaCelulaAdministrar');
                    break;
                case 'Celula Gerencial':
                    $(card).appendTo('#listaCelulaGerencia');
                    break;
                case 'Celula Preparar':
                    $(card).appendTo('#listaCelulaPreparar');
                    break;
                case 'Celula Contratacao':
                    $(card).appendTo('#listaCelulaContratacao');
                    break;
                default:
                    $(card).appendTo('#listaCelulaGerencia');
            }
                
        });
        
    });

    /***************************************************\
    | Animação de clicar e arrastar e salvar alterações |
    \***************************************************/

    $( '#listaCelulaAdministrar, #listaCelulaGerencia, #listaCelulaPreparar, #listaCelulaContratacao' )
        .sortable({
            connectWith: '.connectedSortable',
        })
        .on( 'sortstop', function( event, ui ) {
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
                trocarCor(celula, callout);

                Toast.fire({
                    icon: 'success',
                    title: 'Alteração salva!'
                });
            })
            .fail(function () {
                
                $('#listaCelulaAdministrar, #listaCelulaGerencia, #listaCelulaPreparar, #listaCelulaContratacao').sortable('cancel');

                Toast.fire({
                    icon: 'error',
                    title: 'Erro: alteração Não efetuada!'
                });
            });
        

            function trocarCor(celula, callout) {
                $(callout).removeClass('callout-warning callout-info callout-success callout-danger');

                switch (celula) {
                    case 'listaCelulaAdministrar':
                        $(callout).addClass('callout-warning');
                        break;
                    case 'listaCelulaGerencia':
                        $(callout).addClass('callout-info');
                        break;
                    case 'listaCelulaPreparar':
                        $(callout).addClass('callout-success');
                        break;
                    case 'listaCelulaContratacao':
                        $(callout).addClass('callout-danger');
                        break;
                }
            }

        })
        .disableSelection()
    ;

});