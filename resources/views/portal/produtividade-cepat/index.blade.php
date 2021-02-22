@extends('portal.produtividade-cepat.template')
@extends('portal.produtividade-cepat.componentes.menu-lateral')

@section('saudacao')
<h4>Seja bem vindo!</h4>    
@endsection

@section('conteudo')
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

           <div class="col-12">
                <div class="card">
                    <div class="card-header"> <h3 class="card-title">PESQUISA - GD INDICADORES DE PRODUTIVIDADE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                           </button>
                        </div>
                    </div>
                            
                    <div class="card-body">


                        <form method="post" 
                            action="/produtividade-cepat/cria-macro-atividade" 
                            id="formMacroatividade"
                            class="form-inline">
                                    <div class="modal-body">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input type="hidden" name="cgcUnidade" value="{{$unidadeCGC}}">
                                            <input type="hidden" name="nomeUnidade" value="{{$unidadeNome}}">
                                            <label for="nomeMacroAtividade" class="mt-0">Estabeleça as macroatividades da unidade abaixo</label>
                                            <a 
                                                tabindex="-1"
                                                href="#" data-toggle="tooltip" data-placement="top" 
                                                data-html="true"
                                                title="<p>Use este campo para criar as macroatividades da unidade abaixo.</p>
                                                <p> Caso deseje alterar outra unidade é necessário navegar pela busca acima no campo 'Pesquise por CGC'. </p>
                                                ">
                                                <span><i class="far fa-question-circle"></i></span>
                                            </a> 
                                                                                        
                                            <input 
                                            type="text" 
                                            class="form-control-plaintext mt-1 border-bottom" 
                                            id="nomeMacroAtividade" 
                                            rows="1" 
                                            name="nomeMacroAtividade" 
                                            title="Atenção! Neste campo já se inicia o preenchimento da pesquisa"
                                            placeholder="Digite aqui o nome da MACROATIVIDADE para unidade abaixo..." autofocus required>
                                            <button type="submit" class=" form-group btn btn-primary mt-1 ">Criar MACROATIVIDADE</button>
                                            
                                        </div>

                                    </div>

                                 
                                    {{-- <div class="modal-footer">
                                                                      
                                        
                                    </div> --}}
                                </form>

                    </div>
        </div>
      </div>
    </div>

    <div  style="display: none;" class="row" id='cardTabela'>
        <div class="col-md-12">
            <div class="card card-default">
    
                <div class="card-header">
                    <h3 class="card-title callout callout-info mt-1">
                        <span id='unidade'> {{$unidadeCGC}} </span> - {{$unidadeNome}}
                    </h3>
                </div> <!-- /.card-header -->
                <input type="hidden" id="tokencepat" value="{{ csrf_token() }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tblAtividadescepat" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>MACROATIVIDADE</th>
                                        <th>MICROATIVIDADE</th>
                                        <th>ATIVIDADE</th>
                                        <th>AÇÃO CRIAR MICROATIVIDADE </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>                  

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->  
    </div> <!-- /.row -->
   
    <div style="display: none;" class="row" id='cardExplicacao'> <!-- /.card-explicação-Macro -->
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title callout callout-info mt-1">
                        <span id='unidade'> {{$unidadeCGC}} </span> - {{$unidadeNome}}
                    </h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Ainda não existem macroatividades cadastradas para a unidade!</p>
                            <p>Para começar a incluir as MACROATIVIDADES da unidade <strong> {{$unidadeCGC}} - {{$unidadeNome}} </strong>, clicar no botão azul acima preenchendo o nome da Macroatividade. </p>
                            <p>Caso a unidade a qual se pretende preencher as macro e microatividades seja diferente da de lotação, orientamos pesquisar pelo código da unidade em barra de pesquisa 'Pesquise pelo CGC'. Ex. GILIE/SP, pesquisa: 7257 </p>
                        </div>
                    </div>                  

                </div> <!-- /.card-body -->


                



            </div> <!-- /.card -->
        </div> <!-- /.col -->  
    </div> <!-- /.row -->
    
@endsection



@section('js')

<script>
$('[name="dataResposta"]').mask('00/00/0000');

    $('#selecao').change(function() {
        window.location = $(this).val();
    });


$('.popover-dismiss').popover({
  trigger: 'focus'
})

function focarInput() {
     document.getElementById("nomeMacroAtividade").focus();
}

</script>
<script src="{{ asset('js\global\formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/produtividade/produtividade-cepat.js') }}"></script>

@stop