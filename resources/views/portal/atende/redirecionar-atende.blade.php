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
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Atende</li>
            <li class="breadcrumb-item active"><a href="/"> Minhas Demandas</a> </li>
        </ol>
    </div>
</div><br>


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">       
            <div class="card-body">
                
                <form>
                    <div class="form-group">
                       
                        <label for="exampleFormControlSelect1">Selecione o Destinatário</label>
                        <select class="form-control" id="selectDestinatario" name="matriculaResponsavelAtividade">
     
                        </select>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Motivo do redirecionamento</label>
                            <textarea class="form-control" name="motivoRedirecionamento" rows="3"></textarea>
                          </div>


                    </div><br>
                    <button style="float: right;" type="submit" class="btn btn-primary">Enviar</button>
                  </form>

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->


</div> <!-- /.row -->


 @stop 


@section('content')



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')
<script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/atende/redirecionar-demandas.js') }}"></script>

@stop
