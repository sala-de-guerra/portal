$(document).ready(function(){

  var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;
  
      // an array that will be populated with substring matches
      matches = [];
  
      // regex used to determine if a string contains the substring `q`
      substrRegex = new RegExp(q, 'i');
  
      // iterate through the pool of strings and for any string that
      // contains the substring `q`, add it to the `matches` array
      $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });
  
      cb(matches);
    };
  };
  
  var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming','Alabama', 
    'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming','Alabama', 
    'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming','Alabama', 
    'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
  ];

  var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen',
  'Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen',
  'Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];

  // var bens = [
  //   {
  //   "numeroBem": "1444406706576",
  //   "endereco": "VIA DAS MAGNOLIAS",
  //   "nomeProponente": "CAMSTROIAMIREEA PJANILA",
  //   "cpfCnpjProponente": "35868830003",
  //   "nomeExMutuario": "MAAMPOORO ELALEIRA RAMCHO DE CLIVS",
  //   "cpfCnpjExMutuario": "26834378997",
  //   "id": "1"
  //   },
  //   {
  //   "numeroBem": "1444407050305",
  //   "endereco": "AVENIDA ANTONIO MATHIAS DE CAMARGO",
  //   "nomeProponente": "CRIACIPNS EOUREATIA DEDASZVAS",
  //   "cpfCnpjProponente": "25858477081",
  //   "nomeExMutuario": "JUOIELANTSTOE RADSSS",
  //   "cpfCnpjExMutuario": "4529323493",
  //   "id": "2"
  //   }
  // ];

  // console.log(bens);


// instantiate the bloodhound suggestion engine
  var engine = new Bloodhound({
      datumTokenizer: function (datum) {
          return Bloodhound.tokenizers.whitespace(datum.title);
      },
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
          url: "js/SampleData.json",
          filter: function (data) {
              //console.log("data", data.response.songs)
              return $.map(data.response.songs, function (song) {
                  return {
                    title: song.title,
                    artistName: song.artist_name
                  };
              });
          }
      }
  });

  var imoveis = new Bloodhound({
    datumTokenizer: function (datum) {
        return Bloodhound.tokenizers.whitespace(datum.numeroBem);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: "js/mock.json",
        filter: function (data) {
            // console.log(data.response.songs);
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


  // initialize the bloodhound suggestion engine
  engine.initialize();
  imoveis.initialize();

  $('.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1
    },
    {
      name: 'states',
      // limit: 10,
      source: substringMatcher(states),
      templates: {
          header: '<h4 class="source-name">Estados</h4>',
          empty: [
            '<h4 class="source-name">Estados</h4>' +
            '<div class="empty-message">' +
              'Nenhum resultado encontrado.' +
            '</div>'
          ]
      }
    },
    {
      name: 'cars',
      // limit: 10,
      source: substringMatcher(cars),
      templates: {
        header: '<h4 class="source-name">Carros</h4>',
        empty: [
          '<h4 class="source-name">Carros</h4>' +
          '<div class="empty-message">' +
            'Nenhum resultado encontrado.' +
          '</div>'
        ]
      }
    },
    // {
    //   name: 'bens',
    //   // limit: 10,
    //   source: substringMatcher(bens),
    //   templates: {
    //     header: '<h4 class="source-name">Imóvel</h4>',
    //     empty: [
    //       '<h4 class="source-name">Imóvel</h4>' +
    //       '<div class="empty-message">' +
    //         'Nenhum resultado encontrado.' +
    //       '</div>'
    //     ]
    //   }
    // },
    {
      name: 'engine',
      // limit: 10,
      display: 'title',
      source: engine.ttAdapter(),
      templates: {
          header: '<h4 class="source-name">Songs</h4>',
          empty: [
            '<h4 class="source-name">Songs</h4>' +
            '<div class="empty-message">' +
              'Nenhum resultado encontrado.' +
            '</div>'
          ].join('\n'),
          suggestion: Handlebars.compile('<p>{{title}} by {{artistName}}</p>')
      }
    },

    {
      name: 'imoveis',
      // limit: 10,
      display: 'numeroBem',
      source: imoveis.ttAdapter(),
      templates: {
          header: '<h4 class="source-name">Imóveis</h4>',
          empty: [
            '<h4 class="source-name">Imóveis</h4>' +
            '<div class="empty-message">' +
              'Nenhum resultado encontrado.' +
            '</div>'
          ].join('\n'),
          suggestion: Handlebars.compile('<p>CHB: {{numeroBem}} - Endereço: {{endereco}}</p>')
      }
    }

  );


});