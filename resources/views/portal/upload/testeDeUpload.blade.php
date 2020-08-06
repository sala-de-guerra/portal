@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Teste de upload
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Teste de upload</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Teste de Upload</h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">

               <form action="testedeupload/enviar" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleFormControlFile1">Escolha o arquivo</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="arquivoTeste">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
               </form>

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->


</div> <!-- /.row -->


@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')



@stop
