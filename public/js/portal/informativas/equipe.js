$(document).ready( function () {

    $.getJSON('/equipe/listar-nomes-equipe', function(dados){
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">


                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipal');
        });
    }).done(function() {
        $.getJSON('/equipe/listar-equipe', function(dados){
            $.each(dados, function(key, item) {
                let linha = `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light bg-size">
                  <div class="card-header text-muted border-bottom-0">
                    ${item.matricula}
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">
                        <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                        <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                        <div class="spinner-border spinner text-primary" role="status">
                          
                        </div>
                        </span> </p>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>`
                         
                $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
        });
    }) 
});



  setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);
          
      });
  });
  $('.spinner').remove()
  }, 2000);