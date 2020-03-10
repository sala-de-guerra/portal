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

        // console.log(a1);
        console.log(a2[0]);


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

                let arrayHeadersMicroatividades = [];

                if (item.atividadesSubordinadas == null) {

                } else {
                    $.each(item.atividadesSubordinadas, function(key, item) {
                        let th =
                            `<th>` + item.nomeAtividade + `</th>`
                        ;

                        arrayHeadersMicroatividades.push(th);

                    });
                }

                let colunaHeader =
                    `<td class="p-0">` +
                        `<table class="table table-bordered p-0 m-0">` +
                            `<tr>` +
                                `<th>` + item.nomeAtividade + `</th>` +
                            `</tr>` +
                            `<tr>` +
                                arrayHeadersMicroatividades.join(' ').trim() +
                            `</tr>` +
                        `</table>` +
                    `</td>`
                ;

                arrayHeadersMacroatividades.push(colunaHeader);

            });

            let header =
                `<tr class="row">` +
                    `<td class="col-md-3 p-0">` +
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

                        let matricula = item.matricula;

                        /*******************************************\
                        | Criar form com checkbox preenchido ou não |
                        \*******************************************/

                        function criaFormCheckbox (item) {

                        };
            
                        let arrayLinhaTabelaAtividade = [];
            
                        $.each(atividades[equipe], function(key, item) {
                            
                            let checkbox;
            
            
                            checkbox = `<input type="checkbox" checked="false" title="">`;
            
            
                            if (item.atividadesSubordinadas == null) {
                                criaFormCheckbox(item);
                            } else {
                                $.each(item.atividadesSubordinadas, function(key, item) {
                                    criaFormCheckbox(item);
                                });
                            };
            
                            let td =
                                `<td class="p-0">` +
            
                                `</td>`
                            ;
            
                            arrayLinhaTabelaAtividade.push(td);
            
                        });
            
                
                        let linha = 
                            `<tr class="row">` +
                                `<td class="col-md-3 p-0">` +
                                    `<div class="callout callout-info row p-0 m-0">` +
                                        `<div class="col-md-12">` +
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
        };    

    });

});


    /********************************************************\
    | Função mostra as equipes da regiao do usuario da seção |
    \********************************************************/


    // let regiaoUnidadeSecao = $('#lotacao').html();

    // $.getJSON('../../js/equipes.json', function(dados) {
    //     equipes.push(dados);
        
    //     $.each(equipes[regiaoUnidadeSecao], function(key, item) {
    //         let option = 
    //             `<option value="` + item.id + `">` + item.nomeEquipe + `</option>`
    //         ;

    //         $(option).appendTo('#selectEquipe');
            
    //     });
    // });
    
    // console.log(equipes);

    /*********************************************************\
    | Função que cria uma linha da tabela para cada empregado |
    \*********************************************************/

    // function montaCardsAtividades(equipe) {

    //     alert('oi');

    //     $.getJSON('../js/atividades.json', function(atividades) {


    //         let cardEmpregado =
    //         `<li id="` + item.matricula + `">` +
    //             `<div class="callout callout-info row p-0">` +
    //                 `<div class="col-md-3">` +
    //                     `<img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula=` + item.matricula + `" class="img-circle elevation-2 user-image-resize-50px" alt="User Image" onerror="this.src='{{ asset('/img/question-mark.png') }}';">` +
    //                 `</div>` +
    //                 `<div class="col-md-9">` +
    //                     `<h5 class="card-title">` + item.nomeCompleto + `</h5>` +
    //                     `<br>` +
    //                     `<div class="row">` +
    //                         `<p class="card-text col"><small class="text-muted">` + item.nomeFuncao + `</small></p>` +
    //                         `<div class="float-right col" id="eventual` + item.matricula + `" style="display:none;">` +
    //                             `<span class="badge bg-primary">Eventual</span>` +
    //                         `</div>` +
    //                     `</div>` +
    //                 `</div>` +
    //             `</div>` +
    //         `</li>`
    //     ;
    
    //     });
    // };
