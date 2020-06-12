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
            Atividades Genéricas
        </h1>
    </div><br>


    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i></i> Atende</li>
            <li class="breadcrumb-item active"><a href="/gerencial/gerenciar-demanda-generica">Atividades Genéricas</a> </li>    
        </ol>
    </div>
</div><br>


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">       
            <div class="card-body">
                <h5>Cadastrar nova Atividade Genérica</h5><br>
                <form method="post" action="/gerencial/cadastra-atividade-generica">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="nomeAtividadeGenerica">Atividade</label>
                      <input type="text" class="form-control" name="nomeAtividadeGenerica" id="nomeAtividadeGenerica"  placeholder="Nome da Atividade" required>
                    </div>
                    <div class="form-group">
                      <label for="prazoAtendimento">Prazo de Atendimento</label>
                      <input type="number" class="form-control" name="prazoAtendimento" id="prazoAtendimento" placeholder="Prazo de Atendimento" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecione o Destinatário</label>
                        <select class="form-control" id="responsavelAtendimento" name="responsavelAtendimento">
                        '<option value="" selected>Selecione</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                  </form> <br><br>

                  <div class="col-sm-12 table-responsive p-0">
                    <table id="tblAtendeGenericoGerencial" class="table table-bordered table-striped dataTable">
                        <thead>
                            <tr>
                                <th>Atividade</th>
                                <th>Responsável</th>
                                <th>Prazo Atendimento (dias)</th>
                                <th>Ações</th>
                                <!-- <th>Botão provisório</th> -->


                                <!-- <th>Vencimento</th> -->
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                        
                    </table>
                </div> <!-- /.col-sm-12 -->


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
<script src="{{ asset('js/global/formata_datatable.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/atende/gestao-atende-generico.js') }}"></script>
@stop
