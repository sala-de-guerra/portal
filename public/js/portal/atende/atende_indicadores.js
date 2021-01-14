//formata idAtende #00000
function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

var csrfVar = $('meta[name="csrf-token"]').attr('content');


function _formataDatatableComData (idTabela, ordenaColuna, ordenaForma){
  $('#' + idTabela).DataTable({
    "order": [[ ordenaColuna, ordenaForma ]],
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
  
  $('.spinnerTblDistribuido').remove()

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
      _formataDatatableComData ('tblIndicadorAtendeVencidos', '3', 'asc')
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
      _formataDatatableComData ('tblIndicadorAtendeNovos', '1', 'asc')
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
      _formataDatatableComData ('tblIndicadorAtendeTratados', '1', 'asc')
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
      _formataDatatableComData ('tblIndicadorAtendePendentes', '1', 'asc')
    })
  })
  
  $("#listagemGeral").one("click", function() {
    $.getJSON('atende/lista-atende-geral', function(dados){
      $.each(dados, function(key, item) {
        
        var novo = Number(item.novos)
        var pendentes = Number(item.pendente)
        var finalizados = Number(item.finalizado)
        var vencidos = Number(item.vencido)
        var total = pendentes + finalizados + vencidos
        
        var porcentagemNovos = (novo*100)/total
        var porcentagemFinalizados = (finalizados*100)/total
        var porcentagemPendentes = (pendentes*100)/total
        var porcentagemVencidos = (vencidos*100)/total
        
        let linha =
          `
            <tr>
              <td style="text-align:center;">${item.nome}</td>
              <td style="text-align:center;">${novo}</td>
              <td style="text-align:center;">${finalizados}</td>
              <td style="text-align:center;">${pendentes}</td>
              <td style="text-align:center;">${vencidos}</td>
              <td>
              
                <div class="container">
                  <div class="row">
                    <div class="col col-sm-1">
                      <span class="badge bg-info">${novo}</span>
                    </div>
                    <div class="col col-sm-6">
                      <div class="progress mt-1" style="height: 6px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: ${porcentagemNovos}%" aria-valuenow="${novo}" aria-valuemin="0" aria-valuemax="${total}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="container">
                  <div class="row">
                    <div class="col col-sm-1">
                      <span class="badge bg-success">${finalizados}</span>
                    </div>
                    <div class="col col-sm-6">
                      <div class="progress mt-1" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: ${porcentagemFinalizados}%" aria-valuenow="${finalizados}" aria-valuemin="0" aria-valuemax="${total}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  
                <div class="container">
                  <div class="row">
                    <div class="col col-sm-1">
                      <span class="badge bg-warning">${pendentes}</span>
                    </div>
                    <div class="col col-sm-6">
                      <div class="progress mt-1" style="height: 6px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: ${porcentagemPendentes}%" aria-valuenow="${pendentes}" aria-valuemin="0" aria-valuemax="${total}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="container">
                  <div class="row">
                    <div class="col col-sm-1">
                      <span class="badge bg-danger">${vencidos}</span>
                    </div>
                    <div class="col col-sm-6">
                      <div class="progress mt-1" style="height: 6px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: ${porcentagemVencidos}%" aria-valuenow="${vencidos}" aria-valuemin="0" aria-valuemax="${total}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </td>
            </tr>
          `
          $(linha).appendTo('#tblIndicadorAtende>tbody');
      })
    }).done(function() {
    _formataDatatableComData('tblIndicadorAtende', '4', 'desc')
    })
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

function mudaInfoGrafico() {
  if($('#geralGrafico').text() == "Mais informações"){
    $('#geralGrafico').text("Ocultar");
  }else{
    $('#geralGrafico').text("Mais informações")
  }
}

function mudaInfoGeral() {
  if($('#listagemGeral').text() == "Mais informações"){
    $('#listagemGeral').text("Ocultar");
  }else{
    $('#listagemGeral').text("Mais informações")
  }
}

// function grafico(nome, quantidade){
//   var ctx = document.getElementById('myChart').getContext('2d');
//   var chart = new Chart(ctx, {
    
//       // The type of chart we want to create
//       type: 'line',

//       // The data for our dataset
//       data: {
//           labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//           datasets: [{
//               label: 'My First dataset',
//               backgroundColor: 'rgb(255, 99, 132)',
//               borderColor: 'rgb(255, 99, 132)',
//               data: [0, 10, 5, 2, 20, 30, 45]
//           }]
//       },

//       // Configuration options go here
//       options: {}
//   });
// }

// function grafico(nome, quantidade){
//     var ctx = document.getElementById('myChart').getContext('2d');


//   var chart = new Chart(ctx, {

//     type:'bar',
//     // type: 'bar',
//     // type: 'doughnut',
//     // type: 'horizontalBar',
//     // type: 'polarArea',

//     data: {
//         labels: [`GILIE`, `Agência`, `EMGEA`],
//             datasets: [{
//             label: "",            
//             backgroundColor: ['RoyalBlue', 'DeepSkyBlue', 'seagreen'],
//             borderColor: 'white',
//             data: [10, 10, 5],
//             barThickness: 86,
//             maxBarThickness: 88,
//             minBarLength: 2,
//         }]
//     },

//     // Configuration options go here
//     options: {
//         legend: {
//             display: false
//         },
//     }
//   }); 
// }




setTimeout(function(){
    $('#fadeOut').fadeOut("slow");
  }, 2000);