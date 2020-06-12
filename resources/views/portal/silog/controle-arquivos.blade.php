@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

@if (session('tituloMensagem'))
    <div class="card text-white bg-{{ session('corMensagem') }}">
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
                Controle de Envio de Arquivo
            </h1>
        </div>

        <!-- <div class="col-sm-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDistrato">
                <i class="far fa-lg fa-edit"></i>
                Cadastrar Pedido de Distrato
            </button>
        </div> -->

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/controle-arquivos"> Controle de Envio de Arquivo</a> </li>
            </ol>
        </div>
    </div>

@stop


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                    <form method="POST" action="/controle-arquivos/envia" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label>Arquivo</label>
                        <input type="file" name="arquivo" required><br><br>
                        <input type="submit" class="btn btn-primary" value="Enviar"><br><br><br>

                    </form>

                    <div class="row">
                        <div class="col-sm-12 table-responsive p-0">
                            <table id="tblimportexcel" class="table table-bordered table-striped hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Caixa</th>
                                        <th>Silog</th>

                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                                
                            </table>


                                </div>
                            </div>
                        </div> <!-- /.col-sm-12 -->
                    </div> <!-- /.row -->
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
    <script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
    <script src="{{ asset('js/portal/silog/lista-upload.js') }}"></script>
    

@stop
