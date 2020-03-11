var _token = $('meta[name="csrf-token"]').attr('content');
var equipes;
var atividades;
var equipe;
var regiaoUnidadeSecao;

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

$(document).ready( function () {

    $(".menu-hamburguer").click();
    /***********************************\
    | GET dados do banco e monta tabela |
    \***********************************/

    regiaoUnidadeSecao = $('#lotacao').html();
    $.when($.getJSON('../../js/equipes2.json', function(dados) {} ), $.getJSON( '../../js/atividades.json', function(dados) {}))
    // $.when($.getJSON('/gerencial/gestao-equipes/listar-equipes/' + regiaoUnidadeSecao, function(dados) {} ), $.getJSON( '../../js/atividades.json', function(dados) {}))
    .done(function(a1, a2) {

        equipes = a1[0];
        atividades = a2[0];

        /******************************************************************\
        | Função mostra as equipes da regiao do usuario da seção no select |
        \******************************************************************/

        $.each(equipes, function(key, item) {

            // console.log(item);

            if (item.idEquipe != "1") {
                // console.log(item);
                let option =
                    `<option value="` + item.idEquipe + `">` + item.nomeEquipe + `</option>`
                ;
                $(option).appendTo('#selectEquipe');
            }
        });

        /************************************************************\
        | Função que limpa os cards da tela e recria, a.k.a. refresh |
        \************************************************************/

        function refresh(equipe) {
            $('#headEquipe').empty();
            $('#bodyEquipe').empty();
            $('.dataTable').dataTable().fnDestroy();
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
            equipe = $(this).val();
            refresh(equipe);
        });

        /*******************************************************\
        | Função que cria a tabela de atividades e responsáveis |
        \*******************************************************/

        function montaCardsAtividades(equipe) {

            /***************************************\
            | Criar headers da tabela de atividades |
            \***************************************/

            let arrayHeadersMacroatividades = [];

            $.each(atividades[equipe], function(key, item) {

                let colunaHeader;

                if (item.atividadesSubordinadas.length === 0) {

                    colunaHeader =
                        `<td class="min-width-20vw p-0">` +
                            `<table class="table table-bordered p-0 m-0">` +
                                `<tr>` +
                                    `<th>` + item.nomeAtividade + `</th>` +
                                `</tr>` +
                            `</table>` +
                        `</td>`
                    ;

                    arrayHeadersMacroatividades.push(colunaHeader);

                } else {

                    let nomeMacroAtividade = item.nomeAtividade;

                    $.each(item.atividadesSubordinadas, function(key, item) {
                        colunaHeader =
                            `<td class="min-width-20vw p-0">` +
                                `<table class="table table-bordered p-0 m-0">` +
                                    `<tr>` +
                                        `<th>` + nomeMacroAtividade + `</th>` +
                                    `</tr>` +
                                    `<tr>` +
                                        `<th>` + item.nomeAtividade + `</th>` +
                                    `</tr>` +
                                `</table>` +
                            `</td>`
                        ;

                        arrayHeadersMacroatividades.push(colunaHeader);
                    });
                }
            });

            let header =
                `<tr>` +
                    `<td class="min-width-20vw p-0">` +
                        `<table class="table table-bordered p-0 m-0">` +
                            `<tr>` +
                                `<th>Macro-Atividade</th>` +
                            `</tr>` +
                            `<tr>` +
                                `<th>Micro-Atividade</th>` +
                            `</tr>` +
                        `</table>` +
                    `</td>` +
                    arrayHeadersMacroatividades.join(' ').trim() +
                `</tr>`
            ;

            $(header).appendTo('#headEquipe');

            /**************************************\
            | Criar linhas da tabela de atividades |
            \**************************************/

            $.each(equipes, function(key, item) {

                // console.log(item.idEquipe);

                if (item.idEquipe === equipe) {

                    $.each(item.empregadosEquipe, function(key, item) {

                        /*******************************************\
                        | Criar form com checkbox preenchido ou não |
                        \*******************************************/

                        let arrayLinhaTabelaAtividade = [];

                        let matriculaLinha = item.matricula;
            
                        $.each(atividades[equipe], function(key, item) {
                            
                            function criaFormCheckbox (item) {
                                let arrayResponsaveisAtividade = item.responsaveisAtividade;
                                let checkbox;

                                    if (arrayResponsaveisAtividade.findIndex(x => x.matricula === matriculaLinha) === -1) {
                                        checkbox = `<input class="form-control" type="checkbox" title="Clique para salvar">`;
                                    } else {
                                        checkbox = `<input class="form-control" type="checkbox" checked="checked" title="Clique para salvar">`;
                                    };


                                let form =
                                    `<td class="">` +
                                        `<form id="formAtividade` + item.idAtividade + `matricula` + matriculaLinha + `" action="" method="PUT" class="">` +
                                            checkbox +
                                        `</form>` +
                                    `</td>`
                                ;

                                arrayLinhaTabelaAtividade.push(form);

                            };
                            
                            if (item.atividadesSubordinadas.length === 0) {
                                criaFormCheckbox(item);

                            } else {
                                $.each(item.atividadesSubordinadas, function(key, item) {
                                    criaFormCheckbox(item);
                                });
                            };
                                    
                        });
                
                        let linha = 
                            `<tr>` +
                                `<td class="min-width-20vw p-0">` +
                                    `<div class="callout callout-info p-1 m-1">` +
                                        `<div class="">` +
                                            `<h5 class="card-title">` + item.nomeCompleto + `</h5>` +
                                            `<p class="card-text m-0">` +
                                                `<small class="text-muted">` + item.nomeFuncao + `</small>` +
                                            `</p>` +
                                        `</div>` +
                                    `</div>` +
                                `</td>` +
                                arrayLinhaTabelaAtividade.join(' ').trim() +
                            `</tr>`
                        ;

                        $(linha).appendTo('#bodyEquipe'); 
                    
                    });
                };
                    
            });        
            $('.dataTable').dataTable({
                ordering: false,
                paging: false,
                searching: false,
                info: false,
                scrollY:        "400px",
                scrollX:        true,
                scrollCollapse: true,
                paging:         false,
                fixedColumns:   {
                    leftColumns: 1,
                    rightColumns: 1,
                },
            });
            
        };
        
        
    });

});