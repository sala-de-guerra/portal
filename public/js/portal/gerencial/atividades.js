var _token = $('meta[name="csrf-token"]').attr('content');
var equipes;
var equipe;
var regiaoUnidadeSecao = $('#lotacao').html();

$(document).ready( function () {
    $(".menu-hamburguer").click();
});

/**********************\
| Config inicial Toast |
\**********************/

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

/*********************\
| Form to JSON object |
\*********************/

function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

/******************************************************************\
| Função mostra as equipes da regiao do usuario da seção no select |
\******************************************************************/

// $.getJSON('../../js/equipes2.json', function(dados) {
$.getJSON('/gerencial/gestao-equipes/listar-equipes/' + regiaoUnidadeSecao, function(dados) {
    equipes = dados;
    // console.log(equipes);
    $.each(equipes, function(key, item) {
        if (item.idEquipe != "1") {
            let option =
                `<option value="` + item.idEquipe + `">` + item.nomeEquipe + `</option>`
            ;
            $(option).appendTo('#selectEquipe');
        }
    });
});

/**************************************************************\
| Função da show ou hide no select de macroatividade vinculada |
\**************************************************************/

$('#selectTipoAtividadeCriar').change(function(){
    $('#selectMacroatividadeVinculacaoCriar').val("");
    if ($(this).val() === "true") {
        $('#divMacroatividadeVinculacaoCriar').show();
        $('#selectMacroatividadeVinculacaoCriar').attr("required", true);
    } else {
        $('#divMacroatividadeVinculacaoCriar').hide();
        $('#selectMacroatividadeVinculacaoCriar').attr("required", false);
    }
});

/*************************************************\
| Limpar campos do modal ao clicar fora ou fechar |
\*************************************************/

$('.modal').on('hidden.bs.modal', function(e){
    $(this).find("form")[0].reset();
    $('#divMacroatividadeVinculacaoCriar').hide();
    $('#selectMacroatividadeVinculacaoCriar').attr("required", false);
});

/************************************************************\
| Função que limpa os cards da tela e recria, a.k.a. refresh |
\************************************************************/

function refresh(equipe) {
    $('#cardTabela').empty();
    $('#headEquipe').empty();
    $('#bodyEquipe').empty();
    $('#selectMacroatividadeVinculacaoCriar').empty();
    $('#idEquipeCriar').val(equipe);
    $('#idAtividadeAlterar').empty();
    $('#idAtividadeExcluir').empty();
    montaCardsAtividades(equipe);
};

/**********************************************************\
| Limpar cards e criar cards ao trocar o select de equipes |
\**********************************************************/

$('#selectEquipe').change(function() {
    equipe = $(this).val();
    refresh(equipe);
});

/****************************************************************\
| Função que cria, edita e exclui equipe sem dar refresh na tela |
\****************************************************************/

$('.form-gestao-atividades').submit( function(e) {

    e.preventDefault();

    let data = JSON.stringify($(this).serialize());
    let method = $(this).attr('method');
    let url;

    if (method === 'delete') {
        let idAtividade = $('#idAtividadeExcluir').val();
        url = $(this).attr('action') + idAtividade;
    } else if (method === 'put') {
        let idAtividade = $('#idAtividadeAlterar').val();
        url = $(this).attr('action') + idAtividade;
    } else {
        url = $(this).attr('action')
    }

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

            let equipe = $('#selectEquipe').val();
            // console.log(regiaoUnidade);
            refresh(equipe);
            
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

/*******************************************************\
| Função que cria a tabela de atividades e responsáveis |
\*******************************************************/

function montaCardsAtividades(equipe) {

    /***********************************\
    | GET dados do banco e monta tabela |
    \***********************************/
    let atividades = [];


    // $.when($.getJSON( '../../js/atividades.json', function(dados) {}))
    $.when($.getJSON( '/gerencial/gestao-atividades/listar-atividades/' + regiaoUnidadeSecao, function(dados) {}))
    .done(function(a1) {
        // console.log(a1);
        
        $.each(a1, function(key, item) {
            if (item[equipe] !== undefined) {
                // console.log(item[equipe]);
                atividades = item[equipe];
            }
        });
        
        // console.log(atividades);

        // $.each(a1, function(key, item) {
        //     let idEquipe = Object.getOwnPropertyNames(item);
        //     // console.log(idEquipe);
        //     atividades = idEquipe[0];
        // });

        /***********************************************************************\
        | Criar options da selecao de macroatividade do form de criar atividade |
        \***********************************************************************/

        $.each(atividades, function(key, item) {
            let optionMacroatividade = `<option value="` + item.idAtividade + `" selected>` + item.nomeAtividade + `</option>`;                
            $(optionMacroatividade).appendTo('#selectMacroatividadeVinculacaoCriar');
        });

        let selectedVazio = 
            `<option value="" selected>Selecione</option>`
        ;

        $(selectedVazio).appendTo('#selectMacroatividadeVinculacaoCriar');
        $(selectedVazio).appendTo('#idAtividadeAlterar');
        $(selectedVazio).appendTo('#idAtividadeExcluir');
        
        /***************************************\
        | Criar headers da tabela de atividades |
        \***************************************/

        let arrayHeadersMacroatividades = [];

        $.each(atividades, function(key, item) {
            let colunaHeader;

            if (item.atividadesSubordinadas.length === 0) {

                colunaHeader =
                    `<td class="min-width-20vw p-0">` +
                        `<table class="table p-0 m-0">` +
                            `<tr>` +
                                `<th class="text-center">` + item.nomeAtividade + `</th>` +
                            `</tr>` +
                        `</table>` +
                    `</td>`
                ;

                arrayHeadersMacroatividades.push(colunaHeader);

                let optionMacroatividadeAlterar =
                    `<option value="` + item.idAtividade + `">` + item.nomeAtividade + `</option>`
                ;

                $(optionMacroatividadeAlterar).appendTo('#idAtividadeAlterar');
                $(optionMacroatividadeAlterar).appendTo('#idAtividadeExcluir');

            } else {

                let nomeMacroAtividade = item.nomeAtividade;

                $.each(item.atividadesSubordinadas, function(key, item) {
                    colunaHeader =
                        `<td class="min-width-20vw p-0">` +
                            `<table class="table p-0 m-0">` +
                                `<tr>` +
                                    `<th class="text-center">` + nomeMacroAtividade + `</th>` +
                                `</tr>` +
                                `<tr>` +
                                    `<th class="text-center">` + item.nomeAtividade + `</th>` +
                                `</tr>` +
                            `</table>` +
                        `</td>`
                    ;

                    arrayHeadersMacroatividades.push(colunaHeader);

                    let optionMicroatividadeAlterar =
                        `<option value="` + item.idAtividade + `">` + item.nomeAtividade + `</option>`
                    ;

                    $(optionMicroatividadeAlterar).appendTo('#idAtividadeAlterar');
                    $(optionMicroatividadeAlterar).appendTo('#idAtividadeExcluir');

                });
            }
        });

        let header =
            `<tr>` +
                `<td class="min-width-20vw p-0">` +
                    `<table class="table p-0 m-0">` +
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

        // $(header).appendTo('#headEquipe');

        /**************************************\
        | Criar linhas da tabela de atividades |
        \**************************************/

        let body = [];

        $.each(equipes, function(key, item) {

            // console.log(item);

            if (item.idEquipe === equipe) {

                $.each(item.empregadosEquipe, function(key, item) {

                    /*******************************************\
                    | Criar form com checkbox preenchido ou não |
                    \*******************************************/

                    let arrayLinhaTabelaAtividade = [];

                    let matriculaLinha = item.matricula;
        
                    $.each(atividades, function(key, item) {
                        
                        function criaFormCheckbox (item) {
                            let arrayResponsaveisAtividade = item.responsaveisAtividade;
                            let checkbox;

                                if (arrayResponsaveisAtividade.findIndex(x => x.matricula === matriculaLinha) === -1) {
                                    checkbox = `<input class="form-control" name="atuandoAtividade" value="true" type="checkbox" title="Clique para salvar">`;
                                } else {
                                    checkbox = `<input class="form-control" name="atuandoAtividade" value="true" type="checkbox" title="Clique para salvar" checked>`;
                                };


                            let form =
                                `<td class="">` +
                                    `<form id="formAtividade` + item.idAtividade + `matricula` + matriculaLinha + `" action="/gerencial/gestao-atividades/designar-empregado-atividade" method="post" class="form-checkbox">` +
                                        checkbox +
                                        // `<input type="hidden" name="atuandoAtividade" value="off"></input>` +
                                        `<input type="hidden" name="idAtividade" value="` + item.idAtividade + `">` +
                                        `<input type="hidden" name="matriculaResponsavelAtividade" value="` + matriculaLinha + `">` +
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

                    // $(linha).appendTo('#bodyEquipe');
                    body.push(linha);
                });
            };
                
        });

        let table =
            `<table id="tabelaEquipe" class="table p-0 m-0 dataTable">` +
                `<thead id="headEquipe">` +
                    header +
                `</thead>` +
                `<tbody id="bodyEquipe">` +
                    body.join(' ').trim() +
                `</tbody>` +
            `</table>`
        ;

        $(table).appendTo('#cardTabela')

        /*********************************************************************\
        | Função que designa atividade para empregado sem dar refresh na tela |
        \*********************************************************************/

        $('input[type="checkbox"]').change(function() {

            $('#checkboxHidden').remove();

            let form = (this.form);

            if (this.checked === false) {
                let checkboxHidden = 
                    `<input type="hidden" id="checkboxHidden" name="atuandoAtividade" value="false">`
                ;
                $(checkboxHidden).appendTo(form);
            } 

            let data = getFormData($(form));
            let url = $(form).attr('action');
            let method = $(form).attr('method');

            console.log(data);
            console.log(url);
            console.log(method);

            $.ajax({
                type: method,
                url: url,
                data: {data, _token},
                success: function (result){
                    Toast.fire({
                        icon: 'success',
                        title: 'Alteração salva!'
                    });
                },
                error: function () {
                    Toast.fire({
                        icon: 'error',
                        title: 'Erro: alteração não efetuada!'
                    });
                    refresh(equipe);
                }
            });
        });

        /******************\
        | Config dataTable |
        \******************/

        $('.dataTable').dataTable({
            ordering:       false,
            paging:         false,
            searching:      false,
            info:           false,
            scrollY:        500,
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   {
                leftColumns: 1,
                heightMatch: 'none'
            },
            language: {
                sEmptyTable: "Nenhum registro encontrado",
                sLoadingRecords: "Carregando...",
                sProcessing: "Processando...",
            }
        });
    
    });
};
function colocaBotoes(){
    if ($('#selectEquipe').val() != ""){
            $('.botaoAtividade').css('visibility', 'visible');
            $('#cardTabelaDiv').css('visibility', 'visible');
    }else{
            $('.botaoAtividade').css('visibility', 'hidden');
            $('#cardTabelaDiv').css('visibility', 'hidden');
    }
}
function SIMCheck() {
    if (document.getElementById('CheckS').checked) {
        document.getElementById('visibilidade').style.visibility = 'visible';
    } else {
        document.getElementById('visibilidade').style.visibility = 'hidden';
    }
}
