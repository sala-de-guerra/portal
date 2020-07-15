@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

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

<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Minhas Demandas
        </h1>
    </div><br>


    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i></i> Atende</li>
            <li class="breadcrumb-item active"><a href="/atende/minhas-demandas"> Minhas Demandas</a> </li>    
        </ol>
    </div>
</div><br>



 @stop 


@section('content')

<div id="accordion" role="tablist" aria-multiselectable="true">
    <div class="card card-primary">
      <div class="card-header" role="tab" id="headingOne"  onclick="mudaColapse()">
        <h5 class="mb-0">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <div class="row">
                <div class="col-md-10">
                
                        <div class="row">
                            <div class="col-sm">
                                ATENDE: <b>{{$listaDemandasAtende->idAtende}}</b> 
                            </div>
                            <div class="col-sm">
                                Aberto por: <b>{{$listaDemandasAtende->matriculaCriadorDemanda}}</b>  
                            </div>
                            <div class="col-sm">
                                Contrato: <b>{{$listaDemandasAtende->contratoFormatado}}
                                </div></b>
                          </div>
               
                </div>
                <div class="col-md-2">
                    <button id="collapse" class="btn btn-primary" style="float: right">X</button>
                </div>
            </div>
          </a>
        </h5>
      </div>

      <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
        <div class="card-block">
        
    <div class="row">
        <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <b><p>Assunto: </b>{{$listaDemandasAtende->assuntoAtende}}</p> 
                                <div class="container">
                                    <p>{{$listaDemandasAtende->descricaoAtende}}</p> 
                                </div>

                            </div>
                        </div>
                                </div>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="/atende/responder/{{$listaDemandasAtende->idAtende}}">
                        {{ csrf_field() }} 
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="_method" value="PUT">
                                <input type="hidden" name="emailContatoResposta" value="{{$listaDemandasAtende->emailContatoResposta}}">
                                <input type="hidden" name="emailContatoCopia" value="{{$listaDemandasAtende->emailContatoCopia}}">
                                <input type="hidden" name="emailContatoNovaCopia" value="{{$listaDemandasAtende->emailContatoNovaCopia}}">
                                <input type="hidden" name="descricaoAtende" value="{{$listaDemandasAtende->descricaoAtende}}">
                                <input type="hidden" name="matriculaCriadorDemanda" value="{{$listaDemandasAtende->matriculaCriadorDemanda}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Responder Atende</label>
                                <textarea class="form-control" name="respostaAtende" rows="10" required></textarea>
                                </div>
                                <div class="row">
                                <div class="form-group col-sm-10">
                                <input type="file" name="arquivo">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Responder</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->



                     

@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')

@stop
