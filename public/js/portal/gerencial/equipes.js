/*****************************************\
| Função da animação de clicar e arrastar |
\*****************************************/

$( function dragDrop() {
    $( "#listaCelulaAdministrar, #listaCelulaGerencia, #listaCelulaPreparar, #listaCelulaContratacao" ).sortable({
    connectWith: ".connectedSortable"
    }).disableSelection();
});

/*********************************************\
| Função que cria um card para cada empregado |
\*********************************************/

$(document).ready( function () {

    $.getJSON('url da rota', function(dados) {

        each(dados, function(key,item) {

            let card =
                `<li>` +
                    `<div class="callout callout-danger row p-0">` +
                        `<div class="col-md-3">` +
                            `<img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula=` + item.matricula + `" class="img-circle elevation-2 user-image-resize-50px" alt="User Image" onerror="this.src='{{ asset('/img/question-mark.png') }}';">` +
                        `</div>` +
                        `<div class="col-md-9">` +
                            `<h5 class="card-title">` + item.nomeCompleto + `</h5>` +
                            `<p class="card-text"><small class="text-muted">` + item.nomeFuncao + `</small></p>` +
                        `</div>` +
                    `</div>` +
                '</li>';
            
            switch (item.vinculacao) {
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

        dragDrop();
    });

    /*****************************\
    | Função que salva alterações |
    \*****************************/


});

