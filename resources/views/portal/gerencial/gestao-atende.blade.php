@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Gestão Atende
        </h1>
    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Atende</li>
            <li class="breadcrumb-item active"><a href="/"> Gestão Atende</a> </li>
        </ol>
    </div>
</div><br>

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">       
            <div class="card-body">
                <p>Selecione a atividade:</p>
                
                {{-- select Macro --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Equipe</label>
                    </div>
                    <div class="col-sm-3">
                        <select name="selectEquipe" id="selectEquipe" class="form-control">
                            <option value="" selected>Selecione</option>
                        </select>
                    </div>
                    </select>
                  </div>
                {{-- fim do select --}}

                {{-- select Micro --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Macro-Atividade</label>
                    </div>
                    <div class="col-sm-3">
                        <select name="selectEquipe" id="selectMacro" class="form-control">
                            <option value="" selected>Selecione</option>
                        </select>
                    </div>
                    </select>
                  </div>
                {{-- fim do select --}}




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
<script src="{{ asset('js/portal/atende/gestao-atende.js') }}"></script>
@stop
