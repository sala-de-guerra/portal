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




@stop


@section('content')
<!-- <iframe src="http://habitacao.caixa/index.asp" style="height:200px;width:300px"></iframe> -->

<!-- <div class="row">

    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">
                    Resultado da Pesquisa
                </h3>
            </div>

            

        </div>
    </div>
</div> /.row -->

@if (is_array($resultadoPesquisa))
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0 text-dark">
                @if (count($resultadoPesquisa) == 1)
                    Foi encontrato {{ count($resultadoPesquisa) }} resultado:
                @else
                    Foram encontratos {{ count($resultadoPesquisa) }} resultados:
                @endif
            </h3>
        </div>
    </div>

    <div class="card card-solid">
        <div class="card-body pb-0">
            @foreach ($resultadoPesquisa as $resultado)
            <a href="/consulta-bem-imovel/{{ $resultado['contratoFormatado'] }}" >
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p class="text-muted"><b>CHB:</b> {{ $resultado['numeroContrato'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <p class='text-muted'><b>ENDEREÇO:</b> {{ $resultado['enderecoImovel'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p class='text-muted text-sm'><b>FILIAL:</b> {{ $resultado['gilieResponsavel'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p class="text-muted"><b>CIDADE:</b> {{ $resultado['cidadeImovel'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p class='text-muted text-sm'><b>TIPO VENDA:</b> {{ $resultado['tipoVenda'] }} </p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p class='text-muted text-sm'><b>MATRICULA:</b> {{ $resultado['matriculaImovel'] }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p class='text-muted text-sm'><b>CPF/CNPJ EX-MUTUÁRIO:</b> {{ $resultado['cpfCnpjExMutuario'] }}</p>
                                    
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <p class='text-muted text-sm'><b>NOME EX-MUTUÁRIO:</b> {{ $resultado['nomeExMutuario'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <p class='text-muted text-sm'><b>CPF/CNPJ PROPONENTE:</b> {{ $resultado['cpfCnpjProponente'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <p class='text-muted text-sm'><b>NOME PROPONENTE:</b> {{ $resultado['nomeProponente'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@else
    <h4>{{ $resultadoPesquisa }}</h4>
@endIf

@stop

@section('footer')

@stop

@section('css')
@stop


@section('js')

@stop
