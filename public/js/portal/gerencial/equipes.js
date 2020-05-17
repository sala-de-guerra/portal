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

/*************************************************\
| Cria options do select de unidade conforme json |
\*************************************************/

$.getJSON('/gerencial/gestao-equipes/listar-unidades', function(dados) {
    $.each(dados.unidades, function(key, item) {
        let option =
            `<option value="` + key + `" selected>` + item + `</option>`
        ;
        $(option).appendTo('#selectGilie');
    });
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
    $(".menu-hamburguer").click();
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
    $.getJSON('/gerencial/gestao-equipes/listar-equipes/' + regiaoUnidade, function(dados) {
    // $.getJSON('../js/equipes2.json', function(dados) {
        // console.log(dados);

        // $.each(dados[regiaoUnidade], function(key, item) {
        $.each(dados, function(key, item) {
            // console.log(item);

            let arrayEmpregados = [];

            $.each(item.empregadosEquipe, function(key, item) {
                // console.log(item);
                let card =
                    `<li id="` + item.matricula + `" class="col-md-3">` +
                        `<div class="callout callout-info row p-0 m-1">` +
                            // `<div class="col-md-3">` +
                            // `<img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula=` + item.matricula + `" class="img-circle elevation-2 user-image-resize-50px my-1" alt="User Image" onerror="this.src='/img/question-mark.png';">` +
                            // `</div>` +
                            `<div class="col-md-12">` +
                            `<p class="card-title">` + item.nomeCompleto + `</p>` +
                            `<p class="card-text m-0">` +
                            
                            `<span class="badge bg-primary my-1" id="eventual` + item.matricula + `" style="display:none;">Eventual</span>` +
                                `<small class="text-muted">&nbsp;&nbsp;&nbsp;` + item.nomeFuncao + `  </small>` +
                                `</p>` +
                            `</div>` +
                        `</div>` +
                    `</li>`
                ;

                arrayEmpregados.push(card);                

                $('#selectAlterarEventual').change( function() {
                    $('#nomeEventualAlterar').remove();

                    if ($(this).val() === item.matricula) {
    
                        let inputHiddenNome =
                            `<input type="hidden" name="nomeEventual" value="` + item.nomeCompleto + `" id="nomeEventualAlterar">`
                        ;
    
                        $(inputHiddenNome).appendTo('#formAlterarEquipe');
                    }
                });
    
            });

            // console.log(arrayEmpregados);

            $('#selectAlterarEquipe').change( function() {
                if ($(this).val() === item.idEquipe) {
                    $('#selectAlterarEventual').empty();
        
                    $.each(item.empregadosEquipe, function(key, item) {
                        let optionEventual =
                            `<option value="` + item.matricula + `" selected>` + item.nomeCompleto + `</option>`
                        ;                
                        $(optionEventual).appendTo('#selectAlterarEventual');
                    });
                    let selectedVazio = 
                        `<option value="" selected>Selecione</option>`
                    ;

                    $(selectedVazio).appendTo('#selectAlterarEventual');
                }

            });

            let stringEmpregados = arrayEmpregados.join(' ').trim();

            let lista =
                `<div id="cardLista` + item.idEquipe + `" class="col-md-12">` +
                    `<div class="card card-default">` +
                        `<div class="card-header">` +
                            `<h3 class="card-title">` +
                                `<b>EQUIPE ` + item.nomeEquipe + `</b>` +
                                `<br>` +
                                `Gestor: ` + item.nomeGestorEquipe +
                            `</h3>` +
                        `</div>` +
                        `<div class="card-body">` +
                            `<ul id="` + item.idEquipe + `" class="connectedSortable list-unstyled row m-1">` +
                                stringEmpregados +
                            `</ul>` +
                        `</div>` +
                    `</div>` +
                `</div>`
            ;

            $(lista).appendTo('#equipes');

            $('#eventual' + item.matriculaEventualEquipe).show();

            $('#selectExcluirEquipe').change( function() {
                if ($(this).val() === item.idEquipe) {

                    $('#nomeEquipeExcluir').remove();

                    let inputHiddenNome =
                        `<input type="hidden" name="nomeEquipe" value="` + item.nomeEquipe + `" id="nomeEquipeExcluir">`
                    ;

                    $(inputHiddenNome).appendTo('#formExcluirEquipe');
                }
            });

            /*****************************************************\
            | Monta options do select de alterar e excluir equipe |
            \*****************************************************/
            if (item.idEquipe !== "1") {
                let optionNomeCelula =
                    `<option value="` + item.idEquipe + `">` + item.nomeEquipe + `</option>`
                ;
                $(optionNomeCelula).appendTo('#selectAlterarEquipe');
                $(optionNomeCelula).appendTo('#selectExcluirEquipe');
            }

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
                            // console.log(result);
                            $('#eventual' + matricula).hide();
                            refresh(regiaoUnidade);

                            Toast.fire({
                                icon: 'success',
                                title: 'Alteração salva!'
                            });
                                
                        },
                    
                        error: function () {
                            
                            $(ui.sender).sortable('cancel');

                            Toast.fire({
                                icon: 'error',
                                title: 'Erro: alteração não efetuada.'
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
    
    $.getJSON('/gerencial/gestao-equipes/listar-gestores/' + regiaoUnidade, function(dados) {
    // $.getJSON('../js/gestoresSP.json', function(dados) {

        // console.log(dados);

        $.each(dados, function(key, item) {
            
            let option =
                `<option value="` + item.matricula + `" selected>` + item.nomeCompleto + `</option>`
            ;

            $(option).appendTo('#selectCriarEquipe');
            $(option).appendTo('#selectAlterarGestor');

            /**********************************************\
            | Criar input hidden ao trocar valor do select |
            \**********************************************/

            $('#selectCriarEquipe').change( function() {
                if ($(this).val() === item.matricula) {

                    $('#nomeGestorCriar').remove();

                    let inputHiddenNome =
                        `<input type="hidden" name="nomeGestor" value="` + item.nomeCompleto + `" id="nomeGestorCriar">`
                    ;

                    $(inputHiddenNome).appendTo('#formCriarEquipe');
                
                }
            });

            $('#selectAlterarGestor').change( function() {
                if ($(this).val() === item.matricula) {

                    $('#nomeGestorAlterar').remove();

                    let inputHiddenNome =
                        `<input type="hidden" name="nomeGestor" value="` + item.nomeCompleto + `" id="nomeGestorAlterar">`
                    ;

                    $(inputHiddenNome).appendTo('#formAlterarEquipe');
                }
            });


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

$('.ajaxForm').submit( function(e) {

    e.preventDefault();

    let data = JSON.stringify( $(this).serialize() );
    let url = $(this).attr('action');
    let method = $(this).attr('method');

    // console.log(data);
    // console.log(url);
    // console.log(method);

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
            // console.log(regiaoUnidade);
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
