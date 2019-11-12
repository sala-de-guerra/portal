$(document).ready(function(){

  var imoveis = new Bloodhound({
    datumTokenizer: function (datum) {
      console.log(datum);

      var numeroBemTokens = Bloodhound.tokenizers.whitespace(datum.numeroBem);
      var enderecoTokens = Bloodhound.tokenizers.whitespace(datum.endereco);
      var nomeProponenteTokens = Bloodhound.tokenizers.whitespace(datum.nomeProponente);
      var cpfCnpjProponenteTokens = Bloodhound.tokenizers.whitespace(datum.cpfCnpjProponente);
      var nomeExMutuarioTokens = Bloodhound.tokenizers.whitespace(datum.nomeExMutuario);
      var cpfCnpjExMutuarioTokens = Bloodhound.tokenizers.whitespace(datum.cpfCnpjExMutuario);
      
      return numeroBemTokens
        .concat(enderecoTokens)
        .concat(nomeProponenteTokens)
        .concat(cpfCnpjProponenteTokens)
        .concat(nomeExMutuarioTokens)
        .concat(cpfCnpjExMutuarioTokens)
        ;

        
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
        url: "js/mock.json",
        transform: function (data) {
          // console.log(data.response.bens);
          return $.map(data.response.bens, function (bem) {
              return {
                numeroBem: bem.numero_bem,
                endereco: bem.endereco,
                nomeProponente: bem.nome_proponente,
                cpfCnpjProponente: bem.cpf_cnpj_proponente,
                nomeExMutuario: bem.nome_ex_mutuario,
                cpfCnpjExMutuario: bem.cpf_cnpj_ex_mutuario
              };
          });
        }
      }
  });


  // initialize the bloodhound
  imoveis.initialize();

  $('.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1
    },
    {
      name: 'proponente',
      limit: 10,
      display: 'numeroBem',
      source: imoveis.ttAdapter(),
      templates: {
          header: '<h4 class="source-name">Pesquisa por Proponente</h4>',
          empty: [
            '<h4 class="source-name">Pesquisa por Proponente</h4>' +
            '<div class="empty-message">' +
              'Nenhum resultado encontrado.' +
            '</div>'
          ].join('\n'),
          suggestion: Handlebars.compile('<li>CHB: {{numeroBem}} - Endereço: {{endereco}} - Nome: {{nomeProponente}} - CPF/CNPJ: {{cpfCnpjProponente}}</li>')
      }
    },
    {
      name: 'ex-mutuario',
      limit: 10,
      display: 'numeroBem',
      source: imoveis.ttAdapter(),
      updater: function (selectedName) {  
        window.location.href =[ selectedName ]+".php";  
            },
      templates: {
          header: '<h4 class="source-name">Pesquisa por Ex-Mutuário</h4>',
          empty: [
            '<h4 class="source-name">Pesquisa por Ex-Mutuário</h4>' +
            '<div class="empty-message">' +
              'Nenhum resultado encontrado.' +
            '</div>'
          ].join('\n'),
          suggestion: Handlebars.compile('<li>CHB: {{numeroBem}} - Endereço: {{endereco}} - Nome: {{nomeExMutuario}} - CPF/CNPJ: {{cpfCnpjExMutuario}}</li>')
      }
    },
  );

  // $("#btn-pesquisar-navbar").on( "click", function() {
  //   var chb = $(".typeahead").data("value"); 
  //   window.location.href = "/consulta-bem-imovel/" + chb;
  // });

  $("#formPesquisa").submit(function (){
      var chb = $(".typeahead").val();
      $(this).attr('action', '/consulta-bem-imovel/' + chb);
  });



});