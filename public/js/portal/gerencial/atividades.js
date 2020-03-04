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

$(".modal").on('hidden.bs.modal', function(e){
    $(this).find("form")[0].reset();
});

/********************************************************\
| Função mostra as equipes da regiao do usuario da seção |
\********************************************************/

let lotacaoUsuario = $('#lotacao').html();
let regiaoUnidadeSecao = '';

$(document).ready( function () {
    // console.log(lotacaoUsuario);
    switch (lotacaoUsuario) {
        case '7257':
            regiaoUnidadeSecao = 'SP';
            break;
    };

    $.getJSON('../../js/equipes' + regiaoUnidadeSecao + '.json', function(dados) {
        $.each(dados, function(key, item) {
            let option = 
                `<option value="` + item.id + `">` + item.nomeEquipe + `</option>`
            ;

            $(option).appendTo('#selectEquipe');
            
        });
    });
    
});

/************************************************************\
| Função que limpa os cards da tela e recria, a.k.a. refresh |
\************************************************************/

function refresh(equipe) {
    $('#equipe').empty();
    // $('#selectCriarEquipe').empty();
    // $('#selectAlterarEquipe').empty();
    // $('#selectAlterarGestor').empty();
    // $('#selectExcluirEquipe').empty();
    montaCardsAtividades(equipe);
};

/**********************************************************\
| Limpar cards e criar cards ao trocar o select de equipes |
\**********************************************************/

$('#selectEquipe').change(function() {
    let equipe = $(this).val();
    refresh(equipe);
});

/*********************************************************************\
| Função que cria uma lista para cada equipe com empregados populados |
\*********************************************************************/


function montaCardsAtividades(equipe) {

    $.getJSON('../js/atividades' + regiaoUnidade + '.json', function(dados) {


            var empregados = '';

            let tabela =
                `<div id="cardEquipe` + item.id + `" class="col-md-12">` +
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
            
    });

};


/******************************************************\
| Função que exclui uma equipe sem dar refresh na tela |
\******************************************************/

function noRefreshPost(form) {

    let dados = $(form).serialize();
    let route = $(form).attr('action');

    $.post(route, {dados, _token}, function (){

        $('.modal').modal('hide');

        Toast.fire({
            icon: 'success',
            title: 'Alteração salva!'
        });

        refresh(regiaoUnidade);
    })
    .fail(function () {
        
        $('.modal').modal('hide');

        Toast.fire({
            icon: 'error',
            title: 'Erro: alteração não efetuada!'
        });
    });
};
