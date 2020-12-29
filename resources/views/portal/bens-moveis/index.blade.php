@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


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


<form method="POST" action="{{ action('BensMoveis\bensMoveisController@exportaTabela') }}">
    <div class="form-group">
              
        <label for="txt"><i class="fa fa-paste 2x"></i> Cole aqui o texto com a tag SPAM</label>
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
              (mais interessante se o relatório usar várias páginas com a TAG SPAM ) 
              ou então gere o arquivo excel diretamente no botão verde acima. 
            </p>
          </div>

          <div class="card-body">
            <div class="row" id="historico-exportador" onload="arrumaMoeda()">
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



@stop
