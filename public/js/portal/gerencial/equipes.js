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

/*************************************************\
| Limpar campos do modal ao clicar fora ou fechar |
\*************************************************/

$('.modal').on('hidden.bs.modal', function(e){
    $(this).find("form")[0].reset();       
});

/************************************************************\
| Função que limpa os cards da tela e recria, a.k.a. refresh |
\************************************************************/

function refresh(regiaoUnidade) {
    $('#equipes').empty();
    $('#selectCriarEquipe').empty();
    $('#selectAlterarEquipe').empty();
    $('#selectAlterarGestor').empty();
    $('#selectExcluirEquipe').empty();
    montaCardsEquipes(regiaoUnidade);
};

/********************************************************\
| Função mostra as equipes da regiao do usuario da seção |
\********************************************************/

$(document).ready( function () {
    let regiaoUnidadeSecao = $('#lotacao').html();
    $('#selectGilie').val(regiaoUnidadeSecao);
    montaCardsEquipes(regiaoUnidadeSecao);
});

/**********************************************************\
| Limpar cards e criar cards ao trocar o select de regiões |
\**********************************************************/

$('#selectGilie').change(function() {
    let regiaoUnidade = $(this).val();
    refresh(regiaoUnidade);
});

/*********************************************************************\
| Função que cria uma lista para cada equipe com empregados populados |
\*********************************************************************/

function montaCardsEquipes (regiaoUnidade) {
    // $.getJSON('/gerencial/gestao-equipes/listar-equipes', function(dados) {
    $.getJSON('/gerencial/gestao-equipes/listar-equipes', function(dados) {
        // console.log(dados[regiaoUnidade]);

        // $.each(dados[regiaoUnidade], function(key, item) {
        $.each(dados[regiaoUnidade], function(key, item) {
            // console.log(item);

            let arrayEmpregados = [];

            $.each(item.empregadosEquipe, function(key, item) {
                // console.log(item);
                let card =
                    `<li id="` + item.matricula + `">` +
                        `<div class="callout callout-info row p-0">` +
                            `<div class="col-md-3">` +
                                `<img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula=` + item.matricula + `" class="img-circle elevation-2 user-image-resize-50px" alt="User Image" onerror="this.src='{{ asset('/img/question-mark.png') }}';">` +
                            `</div>` +
                            `<div class="col-md-9">` +
                                `<h5 class="card-title">` + item.nomeCompleto + `</h5>` +
                                `<p class="card-text m-0">` +
                                    `<small class="text-muted">` + item.nomeFuncao + `</small>` +
                                    `<span class="badge bg-primary float-right" id="eventual` + item.matricula + `" style="display:none;">Eventual</span>` +
                                `</p>` +
                            `</div>` +
                        `</div>` +
                    `</li>`
                ;

                arrayEmpregados.push(card);

            });

            // console.log(arrayEmpregados);

            let stringEmpregados = arrayEmpregados.join(' ').trim();

            let lista =
                `<div id="cardLista` + item.idEquipe + `" class="col-md-3">` +
                    `<div class="card card-default">` +
                        `<div class="card-header">` +
                            `<h3 class="card-title">` +
                                `<b>Equipe ` + item.nomeEquipe + `</b>` +
                                `<br>` +
                                `Gestor: ` + item.nomeGestorEquipe +
                            `</h3>` +
                        `</div>` +
                        `<div class="card-body">` +
                            `<ul id="` + item.idEquipe + `" class="connectedSortable list-unstyled">` +
                                stringEmpregados +
                            `</ul>` +
                        `</div>` +
                    `</div>` +
                `</div>`
            ;

            $(lista).appendTo('#equipes');

            $('#eventual' + item.matriculaEventualEquipe).show();

            /*****************************************************\
            | Monta options do select de alterar e excluir equipe |
            \*****************************************************/

            let optionNomeCelula =
                `<option value="` + item.idEquipe + `">` + item.nomeEquipe + `</option>`
            ;

            $(optionNomeCelula).appendTo('#selectAlterarEquipe');
            $(optionNomeCelula).appendTo('#selectExcluirEquipe');

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
                    let idEquipe = ui.item[0].parentElement.id;    

                    $.ajax({
                        type: 'put',
                        url: '/gerencial/gestao-equipes/alocar-empregado',
                        data: {matricula, idEquipe, _token},
                        success: function (result){
                            console.log(result);
                            $('#eventual' + matricula).hide();

                            Toast.fire({
                                icon: 'success',
                                title: 'Alteração salva!'
                            });
                                
                        },
                    
                        error: function () {
                            
                            $(ui.sender).sortable('cancel');

                            Toast.fire({
                                icon: 'error',
                                title: 'Erro: alteração não efetuada!'
                            });                        }
                    });
                
                }
            })
            .disableSelection()
            ;

        });

    });

    /***********************************************************************\
    | Função que pega a lista de gestores e popula o select de criar equipe |
    \***********************************************************************/
    
    $.getJSON('/gerencial/gestao-equipes/listar-gestores', function(dados) {
        // console.log(dados);

        $.each(dados, function(key, item) {
            
            let option =
                `<option value="` + item.matricula + `" selected>` + item.nomeCompleto + `</option>`
            ;

            $(option).appendTo('#selectCriarEquipe');
            $(option).appendTo('#selectAlterarGestor');

        });

        let selectedVazio = 
            `<option value="" selected>Selecione</option>`
        ;

        $(selectedVazio).appendTo('#selectCriarEquipe');
        $(selectedVazio).appendTo('#selectAlterarEquipe');
        $(selectedVazio).appendTo('#selectAlterarGestor');
        $(selectedVazio).appendTo('#selectExcluirEquipe');
    });

};

/****************************************************************\
| Função que cria, edita e exclui equipe sem dar refresh na tela |
\****************************************************************/

$('form').submit( function(e) {

    e.preventDefault();

    let data = JSON.stringify( $(this).serializeArray() );
    let url = $(this).attr('action');
    let method = $(this).attr('method');

    console.log(data);
    console.log(url);
    console.log(method);

    $.ajax({
        type: method,
        url: url,
        data: {data, _token},
        success: function (result){

            $('.modal').modal('hide');
    
            Toast.fire({
                icon: 'success',
                title: 'Alteração salva!'
            });

            let regiaoUnidade = $('#selectGilie').val();
            console.log(regiaoUnidade);
            refresh(regiaoUnidade);
            
        },
      
        error: function () {
            
            $('.modal').modal('hide');

            Toast.fire({
                icon: 'error',
                title: 'Erro: alteração não efetuada!'
            });
        }
    });
});