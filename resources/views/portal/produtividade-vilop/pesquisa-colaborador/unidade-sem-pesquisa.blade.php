@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')
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
    <div class="card-header">
      Pesquisa Atividades
    </div>
    <div class="card-body">
        <p><b>No momento não existe pesquisa para a unidade {{$unidadeCGC}} – {{$sigla}}:</b></p>
        <p>Somente será possível responder a pesquisa de março-2021 após o envio da mensuração realizada pela unidade. Contacte seu gestor sobre a carga dos dados no portal produtividade.</p>
        <form class="form-inline m-0" id="buscaUnidade" action="" method="post">
            <div class="input-group">
              <input class="form-control" type="text"  autocomplete="off" name="buscaUnidade" placeholder="Pesquise por CGC" title="Digite o código da unidade que se pretende buscar..." required>
              <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"  title="Pesquisar"> <i class="fas fa-search"></i> </button>
              </div>
          </form>
    </div>
  </div>
</div>


@endsection

@section('js')
<script>
$('#buscaUnidade').submit( function(e) {
  e.preventDefault();
  var $input = $(this).find('[name=buscaUnidade]');
  window.location = `/produtividade-vilop/pesquisa/colaborador/${$input.val()}`
})
</script>
@endsection