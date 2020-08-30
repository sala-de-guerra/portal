//SÃO PAULO
$('#selectGILIE').change(function(){
  if ($(this).val() === "7257") {

    $.getJSON('/equipe/listar-gerente-sp', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe', function(dados){
      $('#mostraSP').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalSP');
        });
        $('#divPrincipalSP').attr('id', 'divPrincipalSPPopulado');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe', function(dados){
            $.each(dados, function(key, item) {
                let linha = `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light bg-size">
                  <div class="card-header text-muted border-bottom-0 pr-3">
                    ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                    <i class="fab fa-skype"></i>
                  </a>

                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">
                        <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                        <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                        <div class="spinner-border spinner text-primary" role="status">
                          
                        </div>
                        </span> </p>
                      </div><br>
                    </div>
                  </div>
                </div>
              </div>`
                $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraSP').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

//PORTO ALEGRE
$('#selectGILIE').change(function(){
  if ($(this).val() === "7251") {
    $.getJSON('/equipe/listar-gerente-po', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })
    $.getJSON('/equipe/listar-nomes-equipe-po', function(dados){
      $('#mostraPO').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalPO');
        });
        $('#divPrincipalPO').attr('id', 'divPrincipalPopuladoPO');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-po', function(dados){
            $.each(dados, function(key, item) {

              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);

            });
              $.getJSON('/equipe/listar-equipe-po', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraPO').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-po', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-po', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// BELO HORIZONTE
$('#selectGILIE').change(function(){
  if ($(this).val() === "7244") {
    
    $.getJSON('/equipe/listar-gerente-bh', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-bh', function(dados){
      $('#mostraBH').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalBH');
        });
        $('#divPrincipalBH').attr('id', 'divPrincipalPopuladoBH');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-bh', function(dados){
            $.each(dados, function(key, item) {

              let linha = `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light bg-size">
                  <div class="card-header text-muted border-bottom-0 pr-3">
                    ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                    <i class="fab fa-skype"></i>
                  </a>

                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">
                        <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                        <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                        <div class="spinner-border spinner text-primary" role="status">
                          
                        </div>
                        </span> </p>
                      </div><br>
                    </div>
                  </div>
                </div>
              </div>`
                $(linha).appendTo('#divAppendCard'+item.idEquipe);

            });
              $.getJSON('/equipe/listar-equipe-bh', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraBH').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-bh', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-bh', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// BAURU
$('#selectGILIE').change(function(){
  if ($(this).val() === "7242") {

    $.getJSON('/equipe/listar-gerente-bu', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-bu', function(dados){
      $('#mostraBU').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalBU');
        });
        $('#divPrincipalBU').attr('id', 'divPrincipalPopuladoBU');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-bu', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-bu', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraBU').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-bu', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-bu', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// BELEM
$('#selectGILIE').change(function(){
  if ($(this).val() === "7243") {

    $.getJSON('/equipe/listar-gerente-be', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-be', function(dados){
      $('#mostraBE').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalBE');
        });
        $('#divPrincipalBE').attr('id', 'divPrincipalPopuladoBE');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-be', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-be', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraBE').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-be', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-be', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// BRASILIA
$('#selectGILIE').change(function(){
  if ($(this).val() === "7109") {

        $.getJSON('/equipe/listar-gerente-br', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-br', function(dados){
      $('#mostraBR').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalBR');
        });
        $('#divPrincipalBR').attr('id', 'divPrincipalPopuladoBR');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-br', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-br', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraBR').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-br', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-br', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// CURITIBA
$('#selectGILIE').change(function(){
  if ($(this).val() === "7247") {

    $.getJSON('/equipe/listar-gerente-ct', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-ct', function(dados){
      $('#mostraCT').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalCT');
        });
        $('#divPrincipalCT').attr('id', 'divPrincipalPopuladoCT');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-ct', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-ct', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraCT').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-ct', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-ct', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// FORTALEZA
$('#selectGILIE').change(function(){
  if ($(this).val() === "7248") {

    $.getJSON('/equipe/listar-gerente-fo', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-fo', function(dados){
      $('#mostraFO').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalFO');
        });
        $('#divPrincipalFO').attr('id', 'divPrincipalPopuladoFO');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-fo', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-fo', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraFO').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-fo', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-fo', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// GOIANIA
$('#selectGILIE').change(function(){
  if ($(this).val() === "7249") {

    $.getJSON('/equipe/listar-gerente-go', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-go', function(dados){
      $('#mostraGO').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalGO');
        });
        $('#divPrincipalGO').attr('id', 'divPrincipalPopuladoGO');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-go', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-go', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraGO').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-go', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-go', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// RIO DE JANEIRO
$('#selectGILIE').change(function(){
  if ($(this).val() === "7254") {

    $.getJSON('/equipe/listar-gerente-rj', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-rj', function(dados){
      $('#mostraRJ').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalRJ');
        });
        $('#divPrincipalRJ').attr('id', 'divPrincipalPopuladoRJ');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-rj', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-rj', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraRJ').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-rj', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-rj', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// RECIFE
$('#selectGILIE').change(function(){
  if ($(this).val() === "7253") {

    $.getJSON('/equipe/listar-gerente-re', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-re', function(dados){
      $('#mostraRE').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalRE');
        });
        $('#divPrincipalRE').attr('id', 'divPrincipalPopuladoRE');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-re', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-re', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraRE').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-re', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-re', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})

// SALVADOR
$('#selectGILIE').change(function(){
  if ($(this).val() === "7255") {

    $.getJSON('/equipe/listar-gerente-sa', function(dados){
      $.each(dados, function(key, item) {
        $('#nomeGestor').text(item.nomeCompleto);
     })
  })

    $.getJSON('/equipe/listar-nomes-equipe-sa', function(dados){
      $('#mostraSA').css('display', 'block');
        $.each(dados, function(key, item) {
            let linha = `
            <div class="card card-solid">
                <div class="card-body pb-0">
                <div class="card-header"><h3 class="card-title"><b>${item.nomeEquipe}</b> - Gestor: ${item.nomeGestor}</h3></div><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                </div>
            </div>`
            
            
            $(linha).appendTo('#divPrincipalSA');
        });
        $('#divPrincipalSA').attr('id', 'divPrincipalPopuladoSA');
    }).done(function() {
        $.getJSON('/equipe/listar-equipe-sa', function(dados){
            $.each(dados, function(key, item) {
              let linha = `
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light bg-size">
                <div class="card-header text-muted border-bottom-0 pr-3">
                  ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-sm bg-teal" style="float: right;">
                  <i class="fab fa-skype"></i>
                </a>

                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead"><b>${item.nomeCompleto}</b></h2>
                      <p class="text-muted text-sm"><span id="atividade${item.matricula}">
                      <div class="spinner-border spinner text-primary" role="status">
                        
                      </div>
                      </span> </p>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>`
              $(linha).appendTo('#divAppendCard'+item.idEquipe);
            });
              $.getJSON('/equipe/listar-equipe-sa', function(dados){
                $.each(dados, function(key, item) {
                  $('#divAppendCard'+item.idEquipe).attr('id', '#divAppendCardpreenchido'+item.idEquipe);
               })
            })
        });
    }) 
  }else{
    $('#mostraSA').css('display', 'none');
  }

setTimeout(function(){ 
    $.getJSON('/equipe/listar-atividade-sa', function(dados){
      $.each(dados, function(key, item) {
          let linha = `<p>${item.nomeAtividade}</p>`
          $(linha).appendTo('#atividade'+item.matriculaResponsavel);     
      });
  });
    $.getJSON('/equipe/listar-atividade-sa', function(dados){
      $.each(dados, function(key, item) {
        let linha = `<p>${item.nomeAtividade}</p>`
        $('#atividade'+item.matriculaResponsavel).attr('id', '#atividadePreenchida'+item.matriculaResponsavel);   
      });
    });
  $('.spinner').remove()
  }, 2000);
})