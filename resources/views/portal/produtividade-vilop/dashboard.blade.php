@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')


@section('conteudo')    
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
        <div class="card-header"> <h3 class="card-title">INDICADORES - GD INDICADORES DE PRODUTIVIDADE</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
               </button>
            </div>
        </div>
      <div class="card-body">
        <section class="content">
        <div class="container-fluid">
          {{-- <div class="spinner-border spinnerTblDistribuido text-primary" role="status">
              <span class="sr-only"></span>
          </div> --}}
              {{-- <span class="spinnerTblDistribuido">Carregando Dados Aguarde...</span> --}}
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="totalUnidades"></h3>
                    <h5><strong>Unidades Pesquisadas</strong></h5>
                    <p>Qtde de Áreas com resposta</p>
                </div>
                <div class="icon">
                  <i class="far fa-bookmark"></i>
                </div>
                <a data-toggle="collapse" aria-expanded="false" aria-controls="listaNovos" href="#listaNovos" class="small-box-footer" role="button" id="listagemNovos" onclick="mudaInfoNovos()">Mais informações</a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="totalMacro"> </h3>
                  <h5><strong>Macroatividades</strong></h5>
                    <p>Qtde macroatividades cadastradas</p>
                </div>
                <div class="icon">
                  <i class="fas fa-check"></i>
                </div>
                <a data-toggle="collapse" aria-expanded="false" aria-controls="listaTratados" href="#listaTratados" class="small-box-footer" role="button" id="listagemTratados" onclick="mudaInfoTratados()">Mais informações</a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="totalMicro"> </h3>
                  <h5><strong>Microatividades</strong></h5>
                    <p>Qtde microatividades cadastradas</p>
                </div>
                <div class="icon">
                  <i class="fas fa-exclamation"></i>
                </div>
                <a data-toggle="collapse" aria-expanded="false" aria-controls="listaPendentes" href="#listaPendentes" class="small-box-footer" role="button" id="listagemPendentes" onclick="mudaInfoPendentes()">Mais informações</a>
              </div>
            </div>
          </div>
        </div>

        <div class="collapse" id="listaNovos">
          <div class="card card-body card-outline card-info">
            <h2 class="card-title"><b>Unidades Pesquisadas</b></h2>&nbsp
            <table id="listaUnidades" class="table table-bordered table-striped">
              <thead>                   
                <tr>
                    <th>CGC - SIGLA</th>
                    <th>NOME UNIDADE</th>
                    <th style="text-align:center;">PLANILHA </th>
                </tr>
              </thead>
              
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

        <div class="collapse" id="listaTratados">
          <div class="card card-body card-outline card-success"> 
            <h2 class="card-title"><b>Macroatividades Cadastradas</b></h2>&nbsp
              <table id="tblListaMacro" class="table table-bordered table-striped">
                <thead>                   
                  <tr>
                    <th style="text-align:center;">CGC - UNIDADE</th>
                    <th style="text-align:center;">MACROATIVIDADE</th>
                    <th style="text-align:center;">MATRICULA CADASTRAMENTO</th> 
                    <th style="text-align:center;">DATA PREENCHIMENTO</th> 
                  </tr>
                </thead>
                
                <tbody>

                </tbody>
              </table>
          </div>
        </div>

        <div class="collapse" id="listaPendentes">
          <div class="card card-body card-outline card-warning">
            <h2 class="card-title"><b>Microatividades Cadastradas</b></h2>&nbsp
              <table id="tblListaMicro" class="table table-bordered table-striped">
                <thead>                   
                  <tr>
                    <th style="text-align:center;">Usuário</th>
                    <th style="text-align:center;">Nº Atende</th>
                    <th style="text-align:center;">Contrato</th> 
                  </tr>
                </thead>
                
                <tbody>

                </tbody>

            </table>
          </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <p>pesquise a unidade para ver os indicadores</p>
        <div class="input-group nav-search-bar form-inline m-0" >
            <input class="form-control form-control-navbar" type="text"  autocomplete="off" name="pesquisar-unidades" placeholder="Pesquise por CGC" title="Digite o código da unidade que se pretende buscar..." required>
            <div class="input-group-append">
                <button class="btn btn-primary"  title="Pesquisar" onclick="_getUnidade();"><i class="fas fa-search"></i> </button>
            </div>
        </div>
    </div>
  </div>


<div style="visibility: hidden;" id="indicadores">
    <div class="row">
      <div class="col-sm">
        <div class="card">
            <div class="card-header"> 
                <h3 class="card-title">Médias niveis microatividade</h3>
            </div>
            <canvas id="myChart" height="300"></canvas>
        </div>
      </div>

      <div class="col-sm">
        <div class="card">
            <div class="card-header"> 
                <h3 class="card-title">Titulo</h3>
            </div>
            <table class="table" id='tblTempoDemanda'>
                <thead>
                  <tr>
                    <th scope="col">ATIVIDADE</th>
                    <th scope="col">MÉDIA</th>
                    <th scope="col">TEMPO</th>
                  </tr>
                </thead>
                <tbody>
    
                </tbody>
              </table>    
      </div>
</div> 
    </div>


<div class="col-sm">
    <div class="card">
        <div class="card-header"> 
            <h3 class="card-title">Titulo</h3>
        </div>
        <table class="table" id='tblVlmDemanda'>
            <thead>
              <tr>
                <th scope="col">ATIVIDADE</th>
                <th scope="col">VOLUME DEMANDA</th>
                <th scope="col">VOLUMENTE TRATADA</th>
                <th scope="col">%</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>    
  </div>
</div>
</div>

</div>
</div>
@endsection



@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>

    function _formataDatatableComData (idTabela){
        $('#' + idTabela).DataTable({
            //"order": [[ 3, "asc" ]],     
            "pageLength": 10,
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Mostrar _MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    }
    var randomColorGenerator = function () { 
    return '#' + (Math.random().toString(16) + '0000000').slice(2, 8); 
    }; 
    


    var totalUnidades = 0
    var totalMacro = 0
    var totalMicro = 0
    $.getJSON('/produtividade-vilop/unidades-macro-cadastrada', function(dados){
        $.each(dados, function(key, item) { 
            let lista = `
            <tr>
                <td>
                    <a href="/produtividade-vilop/${item.CGC_UNIDADE}" class="cursor-pointer">${item.CGC_UNIDADE} - ${item.Sigla} </a>
                </td>
                <td>
                    <a href="/produtividade-vilop/${item.CGC_UNIDADE}" class="cursor-pointer">${item.NOME_UNIDADE}</a>
                </td>
                <td style="text-align:center;">
                    <span> 
                        <a href="/produtividade-vilop/excel/planilha-vilop-geral/${item.CGC_UNIDADE}">
                            <button
                            type="button" 
                            class="btn btn-success">
                            Baixar a Planilha Respostas da unidade <i class="fas fa-file-excel"></i></button></a>
                    </span>
                </td>
            </tr>
            `
            totalUnidades+=1
            $(lista).appendTo('#listaUnidades');
        })
    }).done(function() {
            $('#totalUnidades').text(totalUnidades);
            _formataDatatableComData("listaUnidades")
        })

    $.getJSON('/produtividade-vilop/dashboard/dados-macro', function(dados){
        $.each(dados, function(key, item) { 
            let lista = `
            <tr>
                <td>
                    <a href="/produtividade-vilop/${item.CGC_UNIDADE}" class="cursor-pointer">${item.CGC_UNIDADE} - ${item.NOME_UNIDADE} </a>
                </td>
                <td style="text-align:center;">${item.NOME_MACROATIVIDADE}</td>
                <td style="text-align:center;">${item.MATRICULA_RESPONSAVEL_RESPOSTA}</td>
                <td style="text-align:center;">${item.DATA_RESPOSTA}</td>
            </tr>
            `
            totalMacro+=1
            $(lista).appendTo('#tblListaMacro');
        })
    }).done(function() {
            $('#totalMacro').text(totalMacro);
            _formataDatatableComData("tblListaMacro")
        })

    $.getJSON('/produtividade-vilop/dashboard/dados-micro', function(dados){
        $.each(dados, function(key, item) { 
            let lista = `
            <tr>
                <td>
                    <a href="/produtividade-vilop/${item.CGC_UNIDADE}" class="cursor-pointer">${item.CGC_UNIDADE} - ${item.NOME_UNIDADE} </a>
                </td>
                <td style="text-align:center;">${item.NOME_MICROATIVIDADE}</td>
                <td style="text-align:center;">${item.RESPONSAVEL_CADASTRO_MICROATIVIDADE}</td>
            </tr>
            `
            totalMicro+=1
            $(lista).appendTo('#tblListaMicro');
        })
    }).done(function() {
            $('#totalMicro').text(totalMicro);
            _formataDatatableComData("tblListaMicro")
        })


function _getUnidade(){
    $("#indicadores").css("visibility", "visible")
    $("#tblVlmDemanda>tbody").empty();
    $("#tblTempoDemanda>tbody").empty();

    var unidade = $("input[name='pesquisar-unidades']").val();

    var nomeMicroatividade = [] 
    var media = [] 
    var colors = []       
    $.getJSON('/produtividade-vilop/dashboard/media-niveis-micro/' + unidade, function(dados){
        $.each(dados, function(key, item) {
            var mediaNiveis = item.Average 
            nomeMicroatividade.push(item.NOME_MICROATIVIDADE);
            media.push(parseFloat(mediaNiveis).toFixed(2));
            colors.push(randomColorGenerator());
        })
    }).done(function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        label: 'Something',
        data: {
            labels: nomeMicroatividade,
            datasets: [{
                backgroundColor: colors,
                data: media
            }]
        },

        // Configuration options go here
        options: {
            legend: {
        display: false
        },   
        scales: {
        xAxes: [{
            barPercentage: 0.4
        }]
    }
        }
    });
})

$.getJSON('/produtividade-vilop/dashboard/dados-indicadores-micro/' + unidade, function(dados){
        $.each(dados, function(key, item) {
            var porcentagem = (item.VOLUME_TOTAL_TRATADA / item.VOLUME_TOTAL_DEMANDA) * 100
            let lista = `
            <tr>
                <td>${item.NOME_MICROATIVIDADE}</td>
                <td>${item.VOLUME_TOTAL_DEMANDA}</td>
                <td>${item.VOLUME_TOTAL_TRATADA}</td>
                <td id="porcentagem${item.idMicro}">${porcentagem.toFixed(0)}</td>
            </tr>
            `

            let tempo = `
            <tr>
                <td>${item.NOME_MICROATIVIDADE}</td>
                <td>${item.MEDIA_DIA}</td>
                <td>${item.TEMPO_EM_MINUTOS}</td>
            </tr>
            `
            $(lista).appendTo('#tblVlmDemanda');
            $(tempo).appendTo('#tblTempoDemanda');
            if ($('#porcentagem'+ item.idMicro).text() == 'NaN'){
                $('#porcentagem'+ item.idMicro).text('0')
            } 
        })
    })
}

function mudaInfoPendentes() {
  if($('#listagemPendentes').text() == "Mais informações"){
    $('#listagemPendentes').text("Ocultar");
  }else{
    $('#listagemPendentes').text("Mais informações")
  }
}

function mudaInfoTratados() {
  if($('#listagemTratados').text() == "Mais informações"){
    $('#listagemTratados').text("Ocultar");
  }else{
    $('#listagemTratados').text("Mais informações")
  }
}
      
function mudaInfoNovos() {
  if($('#listagemNovos').text() == "Mais informações"){
    $('#listagemNovos').text("Ocultar");
  }else{
    $('#listagemNovos').text("Mais informações")
  }
}

</script>

@endsection
