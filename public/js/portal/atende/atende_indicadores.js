//formata idAtende #00000
function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

var csrfVar = $('meta[name="csrf-token"]').attr('content');

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "asc" ]],
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



$(document).ready( function () {
    $.getJSON('atende/total-novos-atendes', function(dados){
        $.each(dados, function(key, item) {  
            $('#totalNovos').text(item.totalAtendesNovos)
        })
    })

    $.getJSON('atende/total-atende-respondido', function(dados){
        $.each(dados, function(key, item) {  
            $('#totalTratados').text(item.totalAtendesRespondidos)
        })
    })

    $.getJSON('atende/total-atende-aberto', function(dados){
        $.each(dados, function(key, item) {  
            $('#totalPendentes').text(item.totalAtendeParaResponder)
        })
    })

    $.getJSON('atende/total-atende-vencido', function(dados){
        $.each(dados, function(key, item) {  
          $('#totalVencidos').text(item.totalAtendesVencidos)
        })
    })

  $("#listagemVencidos").one("click", function() {
    $.getJSON('atende/lista-atende-vencido', function(dados){
      $.each(dados, function(key, item) {
        let atende = item.idAtende  
        var tabela = 
        `
        <tr>
        <td style="text-align:center;">${item.nomeResponsavelAtividade}</td>
        <td style="text-align:center;">#`+pad(atende, 5)+`</td>
        <td style="text-align:center;"><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
        <td style="text-align:center;">${item.diasVencido}</td>
        </tr>
        `
        $(tabela).appendTo('#tblIndicadorAtendeVencidos>tbody');  
      })
    }).done(function() {
      _formataDatatableComData("tblIndicadorAtendeVencidos")
    })
  })
  

  $("#listagemNovos").one("click", function() {
    $.getJSON('atende/lista-atende-novos', function(dados){
      $.each(dados, function(key, item) {
        let atende = item.idAtende  
        var tabela = 
          `
          <tr>
              <td style="text-align:center;">${item.nomeResponsavelAtividade}</td>
              <td style="text-align:center;">#`+pad(atende, 5)+`</td>
              <td style="text-align:center;"><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
          </tr>
          `
        $(tabela).appendTo('#tblIndicadorAtendeNovos>tbody');  
      })
    }).done(function() {
      _formataDatatableComData("tblIndicadorAtendeNovos")
    })
  })

  $("#listagemTratados").one("click", function() {
    $.getJSON('atende/lista-atende-tratados', function(dados){
      $.each(dados, function(key, item) {
        let atende = item.idAtende  
        var tabela = 
          `
          <tr>
              <td style="text-align:center;">${item.nomeResponsavelAtividade}</td>
              <td style="text-align:center;">#`+pad(atende, 5)+`</td>
              <td style="text-align:center;"><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
          </tr>
          `
        $(tabela).appendTo('#tblIndicadorAtendeTratados>tbody');  
      })
    }).done(function() {
      _formataDatatableComData("tblIndicadorAtendeTratados")
    })
  })

  $("#listagemPendentes").one("click", function() {
    $.getJSON('atende/lista-atende-pendente', function(dados){
      $.each(dados, function(key, item) {
        let atende = item.idAtende  
        var tabela = 
          `
          <tr>
              <td style="text-align:center;">${item.nomeResponsavelAtividade}</td>
              <td style="text-align:center;">#`+pad(atende, 5)+`</td>
              <td style="text-align:center;"><a href="/consulta-bem-imovel/${item.contratoFormatado}" class="cursor-pointer">${item.numeroContrato}</a></td>
          </tr>
          `
        $(tabela).appendTo('#tblIndicadorAtendePendentes>tbody');  
      })
    }).done(function() {
      _formataDatatableComData("tblIndicadorAtendePendentes")
    })
  })

  $.getJSON('atende/lista-atende-geral', function(dados){
    $.each(dados, function(key, item) {
      
      var novo = Number(item.novos)
      var pendentes = Number(item.pendente)
      var finalizados = Number(item.finalizado)
      var vencidos = Number(item.vencido)
      var total = pendentes + finalizados + vencidos

      var n = (novo*100)/total
      var f = (finalizados*100)/total
      var p = (pendentes*100)/total
      var v = (vencidos*100)/total

        let linha =
        `<tr>
            <td>${item.matricula}</td>
            <td>${novo}</td>
            <td>${finalizados}</td>
            <td>${pendentes}</td>
            <td>${vencidos}</td>
            <td>
            </div>
            <div class="progress mt-1" style="height: 4px;">
              <div class="progress-bar bg-info" role="progressbar" style="width: ${n}%" aria-valuenow="${novo}" aria-valuemin="0" aria-valuemax="${total}"></div>
            </div>
            <div 
            <div class="progress mt-1" style="height: 4px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: ${f}%" aria-valuenow="${finalizados}" aria-valuemin="0" aria-valuemax="${total}"></div>
            </div>
            <div class="progress mt-1" style="height: 4px;">
              <div class="progress-bar bg-warning" role="progressbar" style="width: ${p}%" aria-valuenow="${pendentes}" aria-valuemin="0" aria-valuemax="${total}"></div>
            </div>
            <div class="progress mt-1" style="height: 4px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: ${v}%" aria-valuenow="${vencidos}" aria-valuemin="0" aria-valuemax="${total}"></div>
            </div><br>

            </td>
        </tr>`
      $(linha).appendTo('#tblIndicadorAtende>tbody');
    })
  }).done(function() {
  _formataDatatableComData("tblIndicadorAtende")
  })
})

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

function mudaInfoVencidos() {
  if($('#listagemVencidos').text() == "Mais informações"){
    $('#listagemVencidos').text("Ocultar");
  }else{
    $('#listagemVencidos').text("Mais informações")
  }
}


/* 
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {

    type: 'line',

    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    options: {}
});
*/

setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
  }, 2000);