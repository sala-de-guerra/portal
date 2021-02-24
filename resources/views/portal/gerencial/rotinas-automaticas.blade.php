@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Rotinas Automáticas
        </h1>
    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i><a href="/indicadores/rotinas-automaticas">Indicadores</a></li>
            <li class="breadcrumb-item active"> Rotinas Automáticas</li>
        </ol>
    </div>
</div><br>

@stop

@section('content')

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


    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
            
                <div class="card-body">

                    <table id="tblRotinas" class="table table-bordered table-striped">
                        <thead>                   
                            <tr>
                                <th>Processo</th>
                                <th>Último Tratamento</th>
                                <th>Status</th>
                                <th>Observação</th>
                                <th> </th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        
                        </tbody>

                    </table>

                </div>

            </div> 

        </div> 
    
    </div> 



<!-- Modal -->
<div class="modal fade" id="modalObsPortal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method='post' action='/gerencial/rotinas' id="formObsPortal">
            {{ csrf_field() }} 
                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                    <h5 style="color: white;" class="modal-title" id="exampleModalScrollableTitle">Observações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-0">
                    
                        <div class="px-2" style="overflow-y: auto; height: 100%;">
                            <div class="form-group">
                                <label>Nova Observação</label>
                                <textarea name="observacaoAtendimento" class="form-control" rows="5" required></textarea>
                            </div>                      
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--
<form>
    <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
        <h5 style="color: white;" class="modal-title" id="exampleModalScrollableTitle">Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="form-group">
    <label class="input-group-text" for="exampleFormControlSelect1">Selecione o status</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Atualizado</option>
      <option>Pendente</option>
      <option>Erro na Atualização</option>
      <option>4</option>
    </select>
  </div>
  
</form>
-->



@stop

@section('footer')

@stop

 
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/portal/gerencial/rotinas-automaticas.js') }}"></script>

@stop
