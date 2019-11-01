$(document).ready(function() {

//Declaração de variáveis dos inputs de arquivos, para carregar múltiplos como array.
    // var invoiceImpAnt = '';
    // var dadosImpAnt = '';
    // var autSrImpAnt = '';

    // var invoiceImp = '';
    // var embarqueImp = '';
    // var di = '';
    // var dadosImp = '';
    // var autSrImp = '';

    // var invoiceExpAnt = '';
    // var autSrExpAnt = '';
   
    // var invoiceExp = '';
    // var embarqueExp = '';
    // var due = '';
    // var autSrExp = '';

    // $('input[type="file"]').change(function () {
    //     var ext = this.value.split('.').pop().toLowerCase();
    //     switch (ext) {
    //         case 'jpg':
    //         case 'jpeg':
    //         case 'png':
    //         case 'pdf':
    //             $('#submitBtn').attr('disabled', false);
                
    //             break;
    //         default:
    //             $('#submitBtn').attr('disabled', true);
    //             alert('O tipo de arquivo selecionado não é aceito. Favor carregar um arquivo de imagem ou PDF.');
    //             this.value = '';
    //     }
    // });

//     $("#formCadastroContratacao").submit(function postCadastro() {

//     tipoOperacao = $('#tipoOperacao').val();
//     switch (tipoOperacao) {

//     case '1':

//     alert = "Nenhuma operação foi selecionada.";

//     break;

//     case '2': //-Tipo 2 é Pronto Importação Antecipado

//     submit = {
//         cpf: $('#cpf').val(),
//         cnpj: $('#cnpj').val(),
//         nomeCliente: $('#nomeCliente').val(),
//         tipoOperacao: $('#tipoOperacao').val(),
//         tipoMoeda: $('#tipoMoeda').val(),
//         valorOperacao: $('#valorOperacao').val(),
//         dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
//         responsavelAtual: $('#matricula').val(),

//         //-puxa dados bancarios beneficiário Antecipado
//         nomeBeneficiario: $('#iban1').val(),
//         nomeBanco: $('#iban2').val(),
//         iban: $('#iban3').val(),
//         agContaBeneficiario: $('#iban4').val(),
//         //
//         //-puxa arquivos de Pronto Importação Antecipado
//         invoiceImpAnt: $('#uploadInvoice').map(function(){return $(this).val();}).get(),
//         dadosImpAnt: $('#uploadDadosBancarios').map(function(){return $(this).val();}).get(),
//         autSrImpAnt: $('#uploadAutorizacaoSr').map(function(){return $(this).val();}).get(),
//         //
//         } //- Fecha submit case 2

//         break;

//     case '3': //-Tipo 3 é Pronto Importação

//     submit = {
//         cpf: $('#cpf').val(),
//         cnpj: $('#cnpj').val(),
//         nomeCliente: $('#nomeCliente').val(),
//         tipoOperacao: $('#tipoOperacao').val(),
//         tipoMoeda: $('#tipoMoeda').val(),
//         valorOperacao: $('#valorOperacao').val(),
//         dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
//         responsavelAtual: $('#matricula').val(),


//         //-puxa dados bancarios beneficiário 
//         nomeBeneficiario: $('#iban1').val(),
//         nomeBanco: $('#iban2').val(),
//         iban: $('#iban3').val(),
//         agContaBeneficiario: $('#iban4').val(),
//         //        

//         //-puxa arquivos de Pronto Importação
//         invoiceImp: $('#uploadInvoice').val(),
//         embarqueImp: $('#uploadConhecimento').val(),
//         di: $('#uploadDi').val(),
//         dadosImp: $('#uploadDadosBancarios').val(),
//         autSrImp: $('#uploadAutorizacaoSr').val(),
//         //
//         }//- Fecha submit case 3

//         break;

//     case '4': //-Tipo 3 é Pronto Exportação Antecipado

//     submit = {
//         cpf: $('#cpf').val(),
//         cnpj: $('#cnpj').val(),
//         nomeCliente: $('#nomeCliente').val(),
//         tipoOperacao: $('#tipoOperacao').val(),
//         tipoMoeda: $('#tipoMoeda').val(),
//         valorOperacao: $('#valorOperacao').val(),
//         dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
//         responsavelAtual: $('#matricula').val(),

//         //-puxa arquivos de Pronto Exportação Antecipado
//         invoiceExpAnt: $('#uploadInvoice').val(),
//         autSrExpAnt: $('#uploadAutorizacaoSr').val(),
//         //
//         }//- Fecha submit case 4

//         break;

//     case '5': //-Tipo 3 é Pronto Exportação

//     submit = {
//         cpf: $('#cpf').val(),
//         cnpj: $('#cnpj').val(),
//         nomeCliente: $('#nomeCliente').val(),
//         tipoOperacao: $('#tipoOperacao').val(),
//         tipoMoeda: $('#tipoMoeda').val(),
//         valorOperacao: $('#valorOperacao').val(),
//         dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
//         responsavelAtual: $('#matricula').val(),

//         //-puxa arquivos de Pronto Exportação
//         invoiceExp: $('#uploadInvoice').val(),
//         embarqueExp: $('#uploadConhecimento').val(),
//         due: $('#uploadDue').val(),
//         autSrExp: $('#uploadAutorizacaoSr').val(),
//         //
//         } // fecha submit case 5

// }; // fecha switch


// $('#formCadastroContratacao').on('submit', function(e){
//     e.preventDefault();
//     var formData = new FormData($(this).get(0)); // Creating a formData using the form.
//     $.ajax({
//         method: 'post',
//         url: 'backend/post_teste2.php',
//         dataType: 'json',
//         cache: false,
//         processData: false, // Important!
//         contentType: false, // Important! I set dataType above as Json
//         data: formData, // Important! The formData should be sent this way and not as a dict.
//         // beforeSend: function(xhr){xhr.setRequestHeader('X-CSRFToken', "{{csrf_token}}");},
//         success: function(data, textStatus) {
//             console.log(data);
//             console.log(formData);
//             console.log(textStatus);
//         },
//         error: function (textStatus, errorThrown) {
//             console.log(errorThrown);
//             console.log(textStatus);
//             console.log(errorThrown);
//         }
//     });
// });
}); // fecha document ready


$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
    }); 

// $(':file').on('change', function () {
//     var file = this.files[0];
    
//     if (file.size > 1024) {
//         alert('max upload size is 1k');
//     }
    
//     // Also see .name, .type
//     });

$('form#formCadastroContratacao').submit(function(e){
    e.preventDefault();
    // $("#tipoOperacao").each(function(){
    //     if($.trim(this.value) == ""){
    //         alert('É necessário selecionar uma modalidade de demanda.');
    //     } 
    //     else {

              //-puxa arquivos de Pronto Importação Antecipado
            // var uploadInvoice = $('#uploadInvoice').map(function(){return $(this).val();}).get();
            // uploadConhecimento: $('#uploadConhecimento').map(function(){return $(this).val();}).get();
            // uploadDi: $('#uploadDi').map(function(){return $(this).val();}).get();
            // uploadDue: $('#uploadDue').map(function(){return $(this).val();}).get();
            // uploadDadosBancarios: $('#uploadDadosBancarios').map(function(){return $(this).val();}).get();
            // uploadAutorizacaoSr: $('#uploadAutorizacaoSr').map(function(){return $(this).val();}).get();

    // submit = {
    //     cpf: $('#cpf').val(),
    //     cnpj: $('#cnpj').val(),
    //     nomeCliente: $('#nomeCliente').val(),
    //     tipoOperacao: $('#tipoOperacao').val(),
    //     tipoMoeda: $('#tipoMoeda').val(),
    //     valorOperacao: $('#valorOperacao').val(),
    //     dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
    //     responsavelAtual: $('#matricula').val(),

    //     uploadInvoice: $('#uploadInvoice').map(function(){return $(this).val();}).get(),
    //     uploadConhecimento: $('#uploadConhecimento').map(function(){return $(this).val();}).get(),
    //     uploadDi: $('#uploadDi').map(function(){return $(this).val();}).get(),
    //     uploadDue: $('#uploadDue').map(function(){return $(this).val();}).get(),
    //     uploadDadosBancarios: $('#uploadDadosBancarios').map(function(){return $(this).val();}).get(),
    //     uploadAutorizacaoSr: $('#uploadAutorizacaoSr').map(function(){return $(this).val();}).get(),
        
    //     //-puxa arquivos de Pronto Exportação
    //     //
    //     }; // fecha submit case 5

    //     console.log(submit);

            // var formData = new FormData($('#formCadastroContratacao').get(0)); // Creating a formData using the form.
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: '../../js/contratacao/backend/post_teste.php',
                dataType: 'json',
                processData: false,
                contentType: 'application/json',
                data: JSON.stringify({

                    cpf: $('#cpf').val(),
                    cnpj: $('#cnpj').val(),
                    nomeCliente: $('#nomeCliente').val(),
                    tipoOperacao: $('#tipoOperacao').val(),
                    tipoMoeda: $('#tipoMoeda').val(),
                    valorOperacao: $('#valorOperacao').val(),
                    dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
                    responsavelAtual: $('#matricula').val(),

                    uploadInvoice: $('#uploadInvoice').val(), //map(function(){return $(this).val();}).get(),
                    uploadConhecimento: $('#uploadConhecimento').val(), //map(function(){return $(this).val();}).get(),
                    uploadDi: $('#uploadDi').val(), //map(function(){return $(this).val();}).get(),
                    uploadDue: $('#uploadDue').val(), //map(function(){return $(this).val();}).get(),
                    uploadDadosBancarios: $('#uploadDadosBancarios').val(), //map(function(){return $(this).val();}).get(),
                    uploadAutorizacaoSr: $('#uploadAutorizacaoSr').val(), //map(function(){return $(this).val();}).get(),
                 
                }), // Important! The formData should be sent this way and not as a dict.
                // beforeSend: function(xhr){xhr.setRequestHeader('X-CSRFToken', "{{csrf_token}}");},
                success: function() {
                    console.log(data);
                    // console.log(formData);
                    console.log(textStatus);
                    alert("Demanda cadastrada com sucesso.");
                    // return window.location.replace = "/esteiracomex/distribuir/demandas";

                },
                error: function () {
                    console.log(errorThrown);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert("Demanda não cadastrada.");
                    // return window.location.replace = "/esteiracomex/distribuir/demandas";

                }
            });
        // }
    // })
});  




    // var form_data = new FormData();
    // var ins = document.getElementById('multiFiles').files.length;
    // for (var x = 0; x < ins; x++) {
    //     form_data.append("files[]", document.getElementById('multiFiles').files[x]);
    // }
    // $.ajax({
    //     url: '/backend/post_teste.php', // point to server-side PHP script 
    //     dataType: 'text', // what to expect back from the PHP script
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     data: form_data,
    //     type: 'post',
    //     success: function (response) {
    //         $('#msg').html(response); // display success response from the PHP script
    //     },
    //     error: function (response) {
    //         $('#msg').html(response); // display error response from the PHP script
    //     }
    // });






// $.each($('input[type="file"]').lenght, function(i=0, value) {

    
// var filename = this.value;
// console.log(filename);
// var valid_extensions = /(\.jpg|\.jpeg|\.gif)$/i;   
// if(valid_extensions.test(filename))
// {

// }
// else
// {
//    alert('O tipo de arquivo selecionado não é aceito. Favor carregar um arquivo de imagem ou PDF.');
// }
// });


    // linha = montaLinhaTabelaProdutos(produto);
    // $('#tabelaProdutos>tbody').append(linha);
    



// }); // fecha função postCadastro

