@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')


@section('saudacao')
<h3 class="card-title callout callout-info mt-1">
    <b>Indicadores: </b> <span id='unidade'> {{$unidadeCGC}} </span> - {{$unidadeNome}}
</h3> 
@endsection


@section('conteudo')
</div>

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

<div class="card">
  <div class="card-header">
    Itens de Mensuração
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
          <table id="tblAtividades" class="table table-bordered table-striped dataTable">
              <thead>
                  <tr>
                      <th>ATIVIDADE</th>
                      <th>MINUTOS DISPONIVEIS</th>
                      <th>MINUTOS TRABALHADOS</th>
                  </tr>
              </thead>
              <tbody>
                <tr style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="maiorVolume">
                  <th colspan="3" style="color: white">MAIOR VOLUME</th>
                </tr>
                <tr style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="criticos">
                  <th colspan="3" style="color: white">ATENDIMENTOS COMPLEXOS - CRÍTICOS</th>
                </tr>
                <tr style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="manuais">
                  <th colspan="3" style="color: white">ATENDIMENTOS MANUAIS</th>
                </tr>
                <tr style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="secundarios">
                  <th colspan="3" style="color: white">ATENDIMENTOS SECUNDÁRIOS</th>
                </tr>
                <tr style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="autormatizados">
                  <th colspan="3" style="color: white">ATENDIMENTOS AUTOMATIZADOS</th>
                </tr>
              </tbody>
          </table>
      </div>
  </div> 
  </div>
</div>  


</div>
@endsection

@section('js')
<script>
var unidade = $('#unidade').text()
unidade = unidade.trim();
var csrfVarVilop = $('#tokenVilop').val();

$(document).ready(function() {
  $.getJSON('/produtividade-vilop/indicadores/tabela-geral-sql/' + unidade, function(dados){
    $.each(dados, function(key, item) { 
      console.log("oi")
      let lista = `
          <tr>
              <td>${item.NOME_MACROATIVIDADE} - ${item.NOME_MICROATIVIDADE}</td>
              <td>${item.MINUTOS_DISPONIVEIS}</td>
              <td>${item.MINUTOS_TRABALHADOS}</td>
          </tr>
          `
        if (item.RESULTADO == 'MAIOR VOLUME'){
          $(lista).insertAfter('#maiorVolume');
        }else if (item.RESULTADO == 'COMPLEXOS CRITICOS'){
          $(lista).insertAfter('#criticos');
        }else if (item.RESULTADO == 'MANUAIS'){
          $(lista).insertAfter('#manuais');
        }else if (item.RESULTADO == 'SECUNDÁRIOS'){
          $(lista).insertAfter('#secundarios');
        }else if (item.RESULTADO == 'AUTOMATIZADOS'){
          $(lista).insertAfter('#autormatizados');
        }
    })
  })
})
</script>
@endsection