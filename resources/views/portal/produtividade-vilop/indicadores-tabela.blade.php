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
<div id="accordion">
  <div class="card">
    <div class="card-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <span style='color: white'>Maior volume</span>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <table id="tblMaiorVolume" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th scope="col">Atividade</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <span style='color: white'>Atendimentos Complexos - Críticos</span>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <table id="tblComplexosCriticos" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th scope="col">Atividade</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <span style='color: white'>Atendimentos Manuais</span>
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <table id="tblAtendimentosManuais" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th scope="col">Atividade</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <span style='color: white'>Atendimentos Secundários</span>
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        <table>
          <thead>
            <tr>
              <th>Student ID</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th colspan="2">Computer Science</th>
            </tr>
            <tr>
              <td>3741255</td>
              <td>Jones, Martha</td>
            </tr>
            <tr>
              <td>4077830</td>
              <td>Pierce, Benjamin</td>
            </tr>
            <tr>
              <td>5151701</td>
              <td>Kirk, James</td>
            </tr>
          </tbody>
          <tbody>
            <tr>
              <th colspan="2">Russian Literature</th>
            </tr>
            <tr>
              <td>3971244</td>
              <td>Nim, Victor</td>
            </tr>
          </tbody>
          <tbody>
            <tr>
              <th colspan="2">Astrophysics</th>
            </tr>
            <tr>
              <td>4100332</td>
              <td>Petrov, Alexandra</td>
            </tr>
            <tr>
              <td>8892377</td>
              <td>Toyota, Hiroko</td>
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
              <th colspan="2">Computer Science</th>
      </tr>
      <tr>
              <th>teste</th>
              <td>${item.NOME_MACROATIVIDADE} - ${item.NOME_MICROATIVIDADE}</td>
              <td></td>
              <td></td>
          </tr>
          `
        if (item.RESULTADO == 'MAIOR VOLUME'){
          $(lista).appendTo('#tblMaiorVolume');
        }else if (item.RESULTADO == 'COMPLEXOS CRITICOS'){
          $(lista).appendTo('#tblComplexosCriticos');
        }else if (item.RESULTADO == 'MANUAIS'){
          $(lista).appendTo('#tblAtendimentosManuais');
        }else if (item.RESULTADO == 'SECUNDÁRIOS'){
          $(lista).appendTo('#tblAtendimentosSecundarios');
        }
    })
  })
})
</script>
@endsection