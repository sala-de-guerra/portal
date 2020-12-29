@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<!-- add the shim first -->
<script type="text/javascript" src="{{ asset('js/portal/bens-moveis/sheetJS/shim.min.js') }}"></script>
<!-- after the shim is referenced, add the library -->
<script type="text/javascript" src="{{ asset('js/portal/bens-moveis/sheetJS/xlsx.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/portal/bens-moveis/sheetJS/FileSaver.min.js') }}"></script>

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Doação de bens móveis
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/"> Preparar e Ofertar</a> </li>
            <li class="breadcrumb-item active"> Doação de bens móveis</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<form method="POST">
    @csrf
    <div class="form-group">
    
              
        <label for="txt"><i class="fa fa-paste 2x"></i> Cole aqui o texto com a tag SPAN  </label>
        <textarea 
          class="form-control" 
          id="txt" 
          rows="15" 
          name="txt"
          autofocus
          oninvalid="this.setCustomValidity('Por favor só clique em enviar após colar o conteúdo')"
          oninput="setCustomValidity('')"
          required></textarea>
    </div>

    <button type="submit" class="btn btn-primary" id="gera-relatorio"> Gerar o Relatório</button>
    <a class="btn btn-warning" href="{{ url()->current() }}"> <i class="fa fa-trash" aria-hidden="true"></i> Limpar Resultado </a>
    
    @isset($lista_itens)
        <a class=" btn btn-success text-white" id="emite-planilha">
              <i class="fa fa-lg fa-file-excel-o"></i> 
              Baixe aqui o arquivo em Excel 
        </a>
    @endisset
    
</form>



         
@isset($lista_itens)

      <div class="card mt-3 border border-info" >
          
        <div class="card-header ">
            &#128521; Processamento Realizado com sucesso!
            <p>
              Copie e cole o resultado abaixo numa planilha 
              (mais interessante se o relatório usar várias páginas com a TAG SPAN ) 
              ou então gere o arquivo excel diretamente no botão verde acima. 
            </p>
          </div>

          <div class="card-body">
            <div class="row" id="historico-exportador">
              <div class="col-md-12 container-fluid">
                  <table 
                    class="table table-striped table-bordered table-responsive" 
                    id="tabelaResultado">
                      <thead>
                        <tr>
                          <th scope="col">Quantidade</th>
                          <th scope="col">Descrição</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($lista_itens as $item)
                        <tr>
                          <td>{{ $item['quantidade'] }}</td>
                          <td>{{ $item['nome'] }}</td>
                        </tr>  
                      @endforeach 
                    </tbody>
                  </table>
              </div>
            </div>
          </div> 
        </div>
    
    @endisset
    




@stop





@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

    <script src="{{ asset('js/portal/bens-moveis/bens-moveis.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
