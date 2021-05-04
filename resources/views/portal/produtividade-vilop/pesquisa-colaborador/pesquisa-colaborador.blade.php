@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')
<input type="hidden" id='tokenVilop' value="{{ csrf_token() }}">
@if (session('tituloMensagem'))
<div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }}">
    <div class="card-header">
        <div class="card-body">
            <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
            <br>
            <p class="card-text">{{ session('corpoMensagem') }}</p>
        </div>
    </div>
</div>
@endif
@section('conteudo')
</div>

<div class="card">
  <div class="card-body">
    <h4>Instruções para responder o questionário:</h4>
    <hr>
    <p>Oi <b style="color: #005ca9;">{{$nome}}</b>! <i class="far fa-smile"></i> <p>
    <p>Queremos conhecer você e sua unidade um pouco melhor e, para isso, contamos com seu apoio para indicar as microatividades da {{$unidadeCGC}} ( {{$sigla}} ) que você faz e o seu tempo médio para executá-las.</p>
    <p>Ah! As respostas <b>não são editáveis</b> e são <b>salvas uma a uma</b>, ou seja, <b>não tem como alterar depois de responder o item.</b>.</p>
    <p>Então, preencha os campos com tranquilidade e atenção usando o prazo disponível, tá? <i class="far fa-calendar-check"></i> <b style="color: #005ca9;">3 a 5 de maio de 2021.</b></p>
    <p><b ><i class="fas fa-exclamation-triangle" style= "color:red;"></i>**ATENÇÃO</b>:  Se sua lotação for diferente de {{$unidadeCGC}} – {{$sigla}}, use o campo de busca abaixo para achar sua unidade atual.</p>

    <form class="form-inline m-0" id="buscaUnidade" action="" method="post">
      <div class="input-group">
        <input class="form-control" type="text"  autocomplete="off" name="buscaUnidade" placeholder="Pesquise por CGC" title="Digite o código da unidade que se pretende buscar..." required>
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"  title="Pesquisar"> <i class="fas fa-search"></i> </button>
        </div>
    </form>
  </div>
</div>

<div class="card">
    <div class="card-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF); color: white;">
      <h5><b>Pesquisa de Atividades - Unidade: <span id='unidade'> {{$unidadeCGC}} </span></b></h5>
    </div> 
    </div>
    <div class="card-body">
      <table id="tblAtividadesVilop" class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th>MACROATIVIDADE</th>
                <th>MICROATIVIDADE</th>
                <th>Responda SOMENTE a(s) atividade(s) que executa</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
    </div>
  </div>



@endsection

@section('js')
<script>
/**********************\
| Config inicial Toast |
\**********************/

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

var unidade = $('#unidade').text()
unidade = unidade.trim();
var csrfVarVilop = $('#tokenVilop').val();

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "asc" ]],
        "pageLength": 25,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
};
$(document).ready(function(){
  swal({
    title: "Leia com atenção e ajude-nos a melhorar as nossas atividades na VILOP.",
    text: "Participe, respondendo o questionário até 05/05/2021.",
    icon: "warning",
    confirmButtonText: 'Ok'
  });

      $.getJSON('/produtividade-vilop/pesquisa/colaborador/lista-micro-colaboradores/' + unidade, function(dados){
        $.each(dados, function(key, item) {
          
           console.log(dados) 
          var linha =  `<tr>
            <td>${item.nomeMacroatividade}</td>
            <td>${item.nomeMicroatividade}</td>
            <td> 
                <button id="btnMicro${item.idMicro}" type="button" class="btn btn-link" data-toggle="modal" data-target="#editar${item.idMicro}"><i style="color: #054f77; font-size: 13pt;" class="far fa-edit"></i></button>
                
                <div class="modal fade" id="editar${item.idMicro}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                            <h5 class="modal-title" id="exampleModalLabel"  style="color: white;" >Microprocesso: <strong> ${item.nomeMicroatividade} </strong> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="/produtividade-vilop/pesquisa/colaborador/responde-pesquisa" method="post" id='formColaborador${item.idMicro}'>
                            <input type="hidden" name="_token" value="${csrfVarVilop}">
                            <input type="hidden" name="unidade" value="${unidade}">
                            <input type="hidden" name="idMicro" value="${item.idMicro}">
                            <div class="modal-body">
                              <label for="appt">O tempo médio para realização de 1 volume dessa atividade é: </label><br>
                              <p class="text-muted"><i>O Campo deverá ser preenchido com números &rarr; HH:MM:SS </i></p>
                              <p class="text-muted"><i>Exemplo: 01 hora 25 minutos 15 segundos . Digite &rarr; 01:25:15 </i></p>
                              <p class="text-muted"><mark><i>Após o envio, este dado <b>não</b> poderá ser modificado!</i></mark></p>
                              <input type="time" step="1" id="quantidadeHoras${item.idMicro}"name="quantidadeHoras" required><br>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                              <button type="submit" class="btn btn-success">Responder</button>
                            </div>
                          </form> 

                          </div>
                        </div>
                      </div>
              </td>
            </tr>`

            $(linha).appendTo('#tblAtividadesVilop>tbody');

            $('#formColaborador'+item.idMicro).submit( function(e) {
            e.preventDefault();
            
            var valorInput = $("#quantidadeHoras"+item.idMicro).val()
            if (valorInput == '00:00' || valorInput == '00:00:00'){
              alert("O preenchimento não pode ser zerado")
            }else{
            let datas = JSON.stringify( $(this).serialize() );
            let url = $(this).attr('action');
            let method = $(this).attr('method');
   
            $.ajax({
                type: method,
                url: url,
                data: $(this).serialize(),
                success: function (result){
                    $('.modal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Respondido com sucesso'
                    });
                    $('#btnMicro'+ item.idMicro).remove()
                },
                error: function () {
                    $('.modal').modal('hide');
                    Toast.fire({
                        icon: 'error',
                        title: 'Erro: tente novamente!'
                    });
                }
             });
            }
            })
        })
    }).done(function() {
      $.getJSON('/produtividade-vilop/pesquisa/colaborador/lista-micro-colaborador/' + unidade, function(dados){
            $.each(dados, function(key, item) {
            $('#btnMicro'+ item.idMicro).remove()
            })
        })
        _formataDatatableComData('tblAtividadesVilop')
    })
})

$('#buscaUnidade').submit( function(e) {
  e.preventDefault();
  var $input = $(this).find('[name=buscaUnidade]');
  window.location = `/produtividade-vilop/pesquisa/colaborador/${$input.val()}`
})
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection