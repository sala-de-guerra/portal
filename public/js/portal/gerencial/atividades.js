var _token = $('meta[name="csrf-token"]').attr('content');
var equipes = [];


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

/*************************************************\
| Limpar campos do modal ao clicar fora ou fechar |
\*************************************************/

var ajaxResp = $.ajax({
    url: "../../js/equipes.json",
    })
    .done(function(response) { // <--- notice the argument here
    equipes = response; // <---- this will be the data you want to work with
})

console.log(equipes);

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

    /********************************************************\
    | Função mostra as equipes da regiao do usuario da seção |
    \********************************************************/

    $(document).ready( function () {

        let regiaoUnidadeSecao = $('#lotacao').html();

        // $.getJSON('../../js/equipes.json', function(dados) {
        //     equipes.push(dados);
            
        //     $.each(equipes[regiaoUnidadeSecao], function(key, item) {
        //         let option = 
        //             `<option value="` + item.id + `">` + item.nomeEquipe + `</option>`
        //         ;

        //         $(option).appendTo('#selectEquipe');
                
        //     });
        // });
        
        console.log(equipes);
    });

    /*********************************************************\
    | Função que cria uma linha da tabela para cada empregado |
    \*********************************************************/

    function montaCardsAtividades(equipe) {

        alert('oi');

        $.getJSON('../js/atividades.json', function(atividades) {


            let cardEmpregado =
            `<li id="` + item.matricula + `">` +
                `<div class="callout callout-info row p-0">` +
                    `<div class="col-md-3">` +
                        `<img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula=` + item.matricula + `" class="img-circle elevation-2 user-image-resize-50px" alt="User Image" onerror="this.src='{{ asset('/img/question-mark.png') }}';">` +
                    `</div>` +
                    `<div class="col-md-9">` +
                        `<h5 class="card-title">` + item.nomeCompleto + `</h5>` +
                        `<br>` +
                        `<div class="row">` +
                            `<p class="card-text col"><small class="text-muted">` + item.nomeFuncao + `</small></p>` +
                            `<div class="float-right col" id="eventual` + item.matricula + `" style="display:none;">` +
                                `<span class="badge bg-primary">Eventual</span>` +
                            `</div>` +
                        `</div>` +
                    `</div>` +
                `</div>` +
            `</li>`
        ;
        
        });

    };