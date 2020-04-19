@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')
<style>
  

    
</style>

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-4">
        <h1 class="m-0 text-dark">Imóvel CAIXA nº <p class="d-inline" id="numeroBem"></p></h1>
    </div>
    <div class="col-sm-4">
    <button style="background-color: #ffa500; color: white;" type="button" class="btn" data-toggle="modal" data-target="#modalAtende">
     <b>+ Atende</b>  
    </button>
    </div>
    <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> <a href="/pesquisar"> Pesquisar Bem Imóvel</a> </li>
            <li class="breadcrumb-item active"> <a href="/index"> Consultar Bem Imóvel</a> </li>
        </ol>
    </div>
</div>

<!-- Modal Atende -->
<div class="modal fade" id="modalAtende" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
        <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Abrir Atende</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMicro">
                    <i class="far fa-question-circle fa-3x"></i><p>Contratação</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMicro">
                    <i class="far fa-question-circle fa-3x"></i><p>Pagamento</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMicro">
                    <i class="far fa-question-circle fa-3x"></i><p>AlgumaCoisa</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMicro">
                    <i class="far fa-question-circle fa-3x"></i><p>Celula TI</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMicro">
                    <i class="far fa-question-circle fa-3x"></i><p>Administrativo</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalMicro">
                    <i class="far fa-question-circle fa-3x"></i><p>OiEusouGoku</p>
                </button>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Microatividade -->
<div class="modal fade" id="modalMicro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
        <h5 style="color: white;" class="modal-title" id="exampleModalLabel">Abrir Atende</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">
                    <i class="far fa-question-circle fa-3x"></i><p>Micro1</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">
                    <i class="far fa-question-circle fa-3x"></i><p>Micro2</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">
                    <i class="far fa-question-circle fa-3x"></i><p>Micro3</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">
                    <i class="far fa-question-circle fa-3x"></i><p>Micro4</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">
                    <i class="far fa-question-circle fa-3x"></i><p>Micro5</p>
                </button>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalForm">
                    <i class="far fa-question-circle fa-3x"></i><p>Micro6</p>
                </button>
            </div>
        </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMicro">Voltar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal do Form -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header"style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Abrir Atende</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
            <div class="form-group">
                <label>Assunto</label>
                <input type="text" class="form-control" id="assuntoAtende" placeholder="Assunto do Atende">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descrição</label>
                <textarea class="form-control" id="formAtende" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email">
              <small id="emailHelp" class="form-text text-muted">Preencha este campo caso deseje enviar uma cópia da resposta.</small>
            </div>

        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Voltar</button>
        <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>















@if (session('tituloMensagem'))
    <div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }} hidden" >
        <div class="card-header">
            <div class="card-body">
                <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
                <br>
                <p class="card-text">{{ session('corpoMensagem') }}</p>
            </div>
        </div>
    </div>
@endif

@stop


@section('content')


@include('portal.imoveis.componentes.tabs-dados-imovel')


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/tooltip.css') }}">
@stop


@section('js')
    <script>
        var numeroContrato = '{{ $numeroContrato }}';
    </script>
    
    <!-- <script src="{{ asset('js/global/formata_observacoes.js') }}"></script> -->
    <script src="{{ asset('js/global/formata_progress_bar.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_historico.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_mensagens_enviadas.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_despesas_distrato.js') }}"></script>
    <script src="{{ asset('js/global/formata_lista_distrato.js') }}"></script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>   <!--Função global que formata a data para valor humano br.-->
    <script src="{{ asset('js/portal/imoveis/consulta-bem-imovel.js') }}"></script>
    <script>
                setTimeout(function(){
                $('#fadeOut').fadeOut("slow");
                }, 4000);
    </script>

@stop