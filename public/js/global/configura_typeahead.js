$(document).ready(function(){

  var imoveis = new Bloodhound({
    datumTokenizer: function (datum) {
      // console.log(datum);

      var bemFormatadoTokens = Bloodhound.tokenizers.whitespace(datum.bemFormatado);
      var numeroBemTokens = Bloodhound.tokenizers.whitespace(datum.numeroBem);
      var enderecoCompletoTokens = Bloodhound.tokenizers.whitespace(datum.enderecoCompleto);
      // var nomeProponenteTokens = Bloodhound.tokenizers.whitespace(datum.nomeProponente);
      // var cpfCnpjProponenteTokens = Bloodhound.tokenizers.whitespace(datum.cpfCnpjProponente);
      // var nomeExMutuarioTokens = Bloodhound.tokenizers.whitespace(datum.nomeExMutuario);
      // var cpfCnpjExMutuarioTokens = Bloodhound.tokenizers.whitespace(datum.cpfCnpjExMutuario);
      
      return numeroBemTokens
        .concat(bemFormatadoTokens)
        .concat(enderecoCompletoTokens)
        // .concat(nomeProponenteTokens)
        // .concat(cpfCnpjProponenteTokens)
        // .concat(nomeExMutuarioTokens)
        // .concat(cpfCnpjExMutuarioTokens);
        

        
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
        url: "/js/baseSimov.json",
        transform: function (data) {
          return $.map(data.bens, function (bem) {
              return {
                bemFormatado: bem.bemFormatado,
                numeroBem: bem.numeroBem,
                enderecoCompleto: bem.enderecoCompleto,
                // nomeProponente: bem.nomeProponente,
                // cpfCnpjProponente: bem.cpfCnpjProponente,
                // nomeExMutuario: bem.nomeExMutuario,
                // cpfCnpjExMutuario: bem.cpfCnpjExMutuario
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
      name: 'endereco',
      limit: 10,
      display: 'bemFormatado',
      source: imoveis.ttAdapter(),
      templates: {
          header: '<h4 class="source-name">Pesquisa por Endereço</h4>',
          empty: [
            '<h4 class="source-name">Pesquisa por Endereço</h4>' +
            '<div class="empty-message">' +
              'Nenhum resultado encontrado.' +
            '</div>'
          ].join('\n'),
          suggestion: Handlebars.compile('<li>CHB: {{numeroBem}} - Endereço: {{enderecoCompleto}}</li>')
      }
    },
    // {
    //   name: 'proponente',
    //   limit: 10,
    //   display: 'bemFormatado',
    //   source: imoveis.ttAdapter(),
    //   templates: {
    //       header: '<h4 class="source-name">Pesquisa por Proponente</h4>',
    //       empty: [
    //         '<h4 class="source-name">Pesquisa por Proponente</h4>' +
    //         '<div class="empty-message">' +
    //           'Nenhum resultado encontrado.' +
    //         '</div>'
    //       ].join('\n'),
    //       suggestion: Handlebars.compile('<li>CHB: {{numeroBem}} - Endereço: {{enderecoCompleto}} - Nome: {{nomeProponente}} - CPF/CNPJ: {{cpfCnpjProponente}}</li>')
    //   }
    // },
    // {
    //   name: 'ex-mutuario',
    //   limit: 10,
    //   display: 'numeroBem',
    //   source: imoveis.ttAdapter(),
    //   updater: function (selectedName) {  
    //     window.location.href =[ selectedName ]+".php";  
    //         },
    //   templates: {
    //       header: '<h4 class="source-name">Pesquisa por Ex-Mutuário</h4>',
    //       empty: [
    //         '<h4 class="source-name">Pesquisa por Ex-Mutuário</h4>' +
    //         '<div class="empty-message">' +
    //           'Nenhum resultado encontrado.' +
    //         '</div>'
    //       ].join('\n'),
    //       suggestion: Handlebars.compile('<li>CHB: {{numeroBem}} - Endereço: {{enderecoCompleto}} - Nome: {{nomeExMutuario}} - CPF/CNPJ: {{cpfCnpjExMutuario}}</li>')
    //   }
    // },
  );

  $("#formPesquisa").submit(function (){
      var chb = $(".typeahead").val();
      $(this).attr('action', '/consulta-bem-imovel/' + chb);
  });

});