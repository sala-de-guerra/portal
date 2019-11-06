// var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
// 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
// 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
// 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
// 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
// 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
// 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
// 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
// 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
// ];

// var states = new Bloodhound({
//     datumTokenizer: Bloodhound.tokenizers.whitespace,
//     queryTokenizer: Bloodhound.tokenizers.whitespace,
//     // `states` is an array of state names defined in "The Basics"
//     local: states
//   });

// $('.typeahead').typeahead({
//     minLength: 3,
//     highlight: true
//   },
//   {
//     name: 'cpf_cnpj_ex_mutuario',
//     source: '.json'
//   },
//   {
//     name: 'cpf_cnpj_proponente',
//     source: '.json'
//   },
//   {
//     name: 'numero_bem',
//     source: '.json'
//   },
//   {
//     name: 'endereco',
//     source: '.json'
//   },
//   {
//     name: 'classificado',
//     source: '.json'
//   },
//   {
//     name: 'states',
//     source: states
//   });

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
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
  ];
  
  $('.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1
  },
  {
    name: 'states',
    limit: 10,
    source: substringMatcher(states),
    templates: {
        header: '<h3 class="source-name">Estados</h3>'
    }
  });
});

// $(document).ready(function(){
//     // Defining the local dataset
//     var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];
    
//     // Constructing the suggestion engine
//     var cars = new Bloodhound({
//         datumTokenizer: Bloodhound.tokenizers.whitespace,
//         queryTokenizer: Bloodhound.tokenizers.whitespace,
//         local: cars
//     });
    
//     // Initializing the typeahead
//     $('.typeahead').typeahead({
//         hint: true,
//         highlight: true, /* Enable substring highlighting */
//         minLength: 1 /* Specify minimum characters required for showing suggestions */
//     },
//     {
//         name: 'cars',
//         source: cars
//     });
// });