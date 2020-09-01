$('#selectGILIE').change(function(){
    if ($(this).val() === "7257") {
        $('#nomeGestor').text('');
      $.getJSON('/equipe/listar-gerente-sp', function(dados){
        $.each(dados, function(key, item) {
          $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
       })
    })
  
      $.getJSON('/equipe/listar-nomes-equipe', function(dados){
        $('#warning').css('display', 'block');
        $('#mostraBH').css('display', 'none');
        $('#mostraBU').css('display', 'none');
        $('#mostraBE').css('display', 'none');
        $('#mostraBR').css('display', 'none');
        $('#mostraCT').css('display', 'none');
        $('#mostraFO').css('display', 'none');
        $('#mostraGO').css('display', 'none');
        $('#mostraSA').css('display', 'none');
        $('#mostraRE').css('display', 'none');
        $('#mostraRJ').css('display', 'none');
        $('#mostraPO').css('display', 'none');
        $('#mostraSP').css('display', 'block');
          $.each(dados, function(key, item) {

              let linha = `
              <div class="card card-solid">
                  <div class="card-body pb-0">
                    <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                      <div class="row" style="cursor: pointer;">
                        <div class="col-2">
                          <span role="button"><b>${item.nomeEquipe}:</b></span>
                        </div>
                        <div class="col-4">
                          <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                        </div>
                        <div class="col-4">
                          <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                        </div>
                      </div>   
                    </a><br>
                  <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                  </div>
                </div>
              </div>`
              
              $(linha).appendTo('#divPrincipalSP');

              if (item.nomeEventual == null){
                item.nomeEventual = 'Não selecionado'
                $('#eventual'+item.matriculaEventual).remove();
            }  
          });
          $('#divPrincipalSP').attr('id', 'divPrincipalSPPopulado');
      }).done(function() {
          $.getJSON('/equipe/listar-equipe', function(dados){
              $.each(dados, function(key, item) {
                  let linha = `
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                  <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                    <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                      ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                      <i class="fab fa-skype fa-2x"></i>
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
              }).always(function() {
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
                  setTimeout(function(){  
                    $( "#warning" ).fadeOut( "slow", function() {
                      $('#warning').css('display', 'none');
                    })}, 1000);
              })
          });
      })
    }else if ($(this).val() === "7251") {
        $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-po', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-po', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'block');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalPO');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalPO').attr('id', 'divPrincipalPopuladoPO');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-po', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000); 
                      })
                });
            }) 
        }
        else if ($(this).val() === "7244") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-bh', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-bh', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'block');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalBH');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalBH').attr('id', 'divPrincipalPopuladoBH');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-bh', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                          $( "#warning" ).fadeOut( "slow", function() {
                            $('#warning').css('display', 'none');
                          })}, 1000); 
                        })
                });
            }) 
        }
        else if ($(this).val() === "7242") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-bu', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-bu', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'block');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalBU');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalBU').attr('id', 'divPrincipalPopuladoBU');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-bu', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                        setTimeout(function(){  
                        $( "#warning" ).fadeOut( "slow", function() {
                          $('#warning').css('display', 'none');
                        })}, 1000); 
                      })
                });
            }) 
        }
        else if ($(this).val() === "7243") {
            $('#nomeGestor').text('');
                $.getJSON('/equipe/listar-gerente-be', function(dados){
                $.each(dados, function(key, item) {
                    $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
                })
            })
            $.getJSON('/equipe/listar-nomes-equipe-be', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'block');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalBE');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalBE').attr('id', 'divPrincipalPopuladoBE');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-be', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000);
                      })
                });
            }) 
        }
        else if ($(this).val() === "7109") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-br', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-br', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'block');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalBR');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalBR').attr('id', 'divPrincipalPopuladoBR');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-br', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000);
                      })
                });
            }) 
        }
        else if ($(this).val() === "7247") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-ct', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-ct', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'block');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalCT');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalCT').attr('id', 'divPrincipalPopuladoCT');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-ct', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000); 
                      })
                });
            }) 
        }
        else if ($(this).val() === "7248") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-fo', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-fo', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'block');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalFO');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalFO').attr('id', 'divPrincipalPopuladoFO');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-fo', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000); 
                          })
                });
            }) 
        }
        else if ($(this).val() === "7249") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-go', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-go', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'block');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalGO');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalGO').attr('id', 'divPrincipalPopuladoGO');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-go', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000); 
                      })
                });
            }) 
        }
        else if ($(this).val() === "7254") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-rj', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-rj', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'block');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalRJ');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalRJ').attr('id', 'divPrincipalPopuladoRJ');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-rj', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000); 
                      })
                });
            }) 
        }
        else if ($(this).val() === "7253") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-re', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-re', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'none');
                $('#mostraRE').css('display', 'block');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalRE');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalRE').attr('id', 'divPrincipalPopuladoRE');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-re', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                          setTimeout(function(){  
                            $( "#warning" ).fadeOut( "slow", function() {
                              $('#warning').css('display', 'none');
                            })}, 1000); 
                      })
                });
            }) 
        }
        else if ($(this).val() === "7255") {
            $('#nomeGestor').text('');
            $.getJSON('/equipe/listar-gerente-sa', function(dados){
              $.each(dados, function(key, item) {
                $('#nomeGestor').html(' <b>GERENTE DE FILIAL: </b>' + item.nomeCompleto + ` (${item.matricula})`);
             })
          })
            $.getJSON('/equipe/listar-nomes-equipe-sa', function(dados){
                $('#warning').css('display', 'block');
                $('#mostraBH').css('display', 'none');
                $('#mostraBU').css('display', 'none');
                $('#mostraBE').css('display', 'none');
                $('#mostraBR').css('display', 'none');
                $('#mostraCT').css('display', 'none');
                $('#mostraFO').css('display', 'none');
                $('#mostraGO').css('display', 'none');
                $('#mostraSA').css('display', 'block');
                $('#mostraRE').css('display', 'none');
                $('#mostraRJ').css('display', 'none');
                $('#mostraPO').css('display', 'none');
                $('#mostraSP').css('display', 'none');
                $.each(dados, function(key, item) {
                    let linha = `
                    <div class="card card-solid">
                    <div class="card-body pb-0">
                      <a data-toggle="collapse" data-target="#collapse${item.idEquipe}" id="menuCollapse${item.idEquipe}">
                        <div class="row" style="cursor: pointer;">
                          <div class="col-2">
                            <span role="button"><b>${item.nomeEquipe}:</b></span>
                          </div>
                          <div class="col-4">
                            <span class="badge badge-info badge-large">Gestor:</span> ${item.nomeGestor} (${item.matriculaGestor})
                          </div>
                          <div class="col-4">
                            <span id="eventual${item.matriculaEventual}"><span class="badge badge-info badge-large">Eventual:</span> ${item.nomeEventual} (${item.matriculaEventual})</span>
                          </div>
                        </div>   
                      </a><br>
                    <div class="row d-flex align-items-stretch" id="divAppendCard${item.idEquipe}">
                    </div>
                  </div>
                </div>`
                    
                    
                    $(linha).appendTo('#divPrincipalSA');
                    if (item.nomeEventual == null){
                        item.nomeEventual = 'Não selecionado'
                        $('#eventual'+item.matriculaEventual).remove();
                    }
                });
                $('#divPrincipalSA').attr('id', 'divPrincipalPopuladoSA');
            }).done(function() {
                $.getJSON('/equipe/listar-equipe-sa', function(dados){
                    $.each(dados, function(key, item) {
        
                      let linha = `
                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                      <div class="card bg-light bg-size collapse" id="collapse${item.idEquipe}">
                        <div class="card-header card-topo text-muted border-bottom-0 pr-3">
                          ${item.matricula} <a href="im:<sip:${item.matricula}@corp.caixa.gov.br>" class="btn btn-link" style="float: right;">
                          <i class="fab fa-skype fa-2x"></i>
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
                    }).always(function() {
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
                    setTimeout(function(){  
                      $( "#warning" ).fadeOut( "slow", function() {
                        $('#warning').css('display', 'none');
                       })}, 1000); 
                      })
                });
            }) 
        }else{
            $('#nomeGestor').text('Selecione a GILIE no botão acima e clique na equipe para expandir');
            $('#warning').css('display', 'none');
            $('#mostraBH').css('display', 'none');
            $('#mostraBU').css('display', 'none');
            $('#mostraBE').css('display', 'none');
            $('#mostraBR').css('display', 'none');
            $('#mostraCT').css('display', 'none');
            $('#mostraFO').css('display', 'none');
            $('#mostraGO').css('display', 'none');
            $('#mostraSA').css('display', 'none');
            $('#mostraRE').css('display', 'none');
            $('#mostraRJ').css('display', 'none');
            $('#mostraPO').css('display', 'none');
            $('#mostraSP').css('display', 'none');
        }
        
    })