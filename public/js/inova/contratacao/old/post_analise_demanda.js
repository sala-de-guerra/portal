$(document).ready(function() {

    var cpfCnpj = $("#cpfCnpj").html();
    var protocolo = $("#idDemanda").html();
    var i;
    // var urlInvoice = '';
    // var fileInvoice = '';
    // var typeInvoice = '';
    // var urlDi = '';
    // var fileDi = '';
    // var typeDi = '';
    // var urlDue = '';
    // var fileDue = '';
    // var typeDue = '';
    // var urlConhecimento = '';
    // var fileConhecimento = '';
    // var typeConhecimento = '';
    // var urlDados = '';
    // var fileDados = '';
    // var typeDados = '';
    // var urlSr = '';
    // var fileSr = '';
    // var typeSr = '';



    $.ajax({
        type: 'GET',
        url: '../../js/contratacao/tabela_analise_arquivos2.json',
        // data: { get_param: 'value' },
        dataType: 'JSON',
        success: function(data) {
            // var data = (data);
            // $.each(data.categories, function(key, item){
            //     arquivos[key] = item.title;
            // });
            i = data;
            for(i = 0; i < data.lenght; i++) {
                console.log(data[i].url);
            }
            
            console.log(data);



// salvaVariaveis();

$(":file").fileinput({
    fileActionSettings: {
        showRemove: false,
        showUpload: false,
        showZoom: true,
        showDrag: false,
    },
    showBrowse: false,
    theme: 'fa',
    language: 'pt-BR',
    uploadUrl: '../../js/contratacao/upload-teste/',
    minFileCount: 1,
    maxFileCount: 20,
    overwriteInitial: false,
    previewFileIcon: '<i class="fa fa-fw fa-file-o"></i>',
    allowedPreviewExtensions: ["pdf", "doc", "docx", "txt", "zip", "jpg", "png", "jpeg"],
    allowedFileExtensions: ["jpg", "jpeg", "png","pdf"],
    msgInvalidFileExtension: "O tipo de arquivo selecionado não é suportado. Favor selecionar um arquivo de imagem ou PDF." ,

    // accept=".pdf,.doc,.docx,.txt,.zip,.jpg,.gif,.png" 

    initialPreview: [

        '../../js/contratacao/upload-teste/10222222000188/546654/invoice_546654.jpg',
        '../../js/contratacao/upload-teste/10222222000188/546654/di_546654.pdf',
        '../../js/contratacao/upload-teste/10222222000188/546654/conhecimento_546654.docx',
        // urlPreview,
        
        // urlInvoice,
        // urlDi, 
        // urlDue,
        // urlConhecimento,
        // urlDados,
        // urlSr,

            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.jpg',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/di_' + protocolo + '.pdf',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/conhecimento_' + protocolo + '.docx',


            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.jpg',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/di_' + protocolo + '.pdf',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/conhecimento_' + protocolo + '.docx',
            
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.jpeg',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.png',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.pdf',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.rar',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.zip',
            // 'upload-teste/' + cpfCnpj + '/' + protocolo + '/invoice_' + protocolo + '.7z',


            // 'upload-teste/10.222.2220001-88/546654/invoice_546654.jpg',

    ],
    initialPreviewAsData: true, // defaults markup  
    initialPreviewFileType: 'image',
    initialPreviewDownloadUrl: '../../js/contratacao/upload-teste/' + cpfCnpj + '/' + protocolo + '/{filename}',
    initialPreviewConfig: [ 

        data,
        // {caption: 'invoice_' + protocolo + '.pdf', type: 'pdf'},
        // {caption: 'invoice_' + protocolo + '.doc', type: 'office'},
        // {caption: 'invoice_' + protocolo + '.docx', type: 'office'},
        // {caption: 'invoice_' + protocolo + '.txt', type: 'text'},
        // {caption: 'invoice_' + protocolo + '.zip'},
        // {caption: 'invoice_' + protocolo + '.jpg'},
        // {caption: 'invoice_' + protocolo + '.png'},
        // {caption: 'invoice_' + protocolo + '.gif'},

        // {caption: 'di_' + protocolo + '.pdf', type: 'pdf'},
        // {caption: 'di_' + protocolo + '.doc', type: 'office'},
        // {caption: 'di_' + protocolo + '.docx', type: 'office'},
        // {caption: 'di_' + protocolo + '.txt', type: 'text'},
        // {caption: 'di_' + protocolo + '.zip'},
        // {caption: 'di_' + protocolo + '.jpg'},
        // {caption: 'di_' + protocolo + '.png'},
        // {caption: 'di_' + protocolo + '.gif'},

        // {caption: 'conhecimento_' + protocolo + '.doc', type: 'office'},
        // {caption: 'conhecimento_' + protocolo + '.docx', type: 'office'},
        // {caption: 'conhecimento_' + protocolo + '.pdf', type: 'pdf'},
        // {caption: 'conhecimento_' + protocolo + '.txt', type: 'text'},
        // {caption: 'conhecimento_' + protocolo + '.zip'},
        // {caption: 'conhecimento_' + protocolo + '.jpg'},
        // {caption: 'conhecimento_' + protocolo + '.png'},
        // {caption: 'conhecimento_' + protocolo + '.gif'},



        // {caption: 'invoice_' + protocolo + '.jpg'},
        // {caption: 'di_' + protocolo + '.pdf', type: 'pdf'},
        // {caption: 'conhecimento_' + protocolo + '.docx', type: 'office'},
    ],

    // removeFromPreviewOnError: true,
    purifyHtml: true,
    uploadExtraData: { 
        function() {
            return {
            userid: $("#matricula").val(),
            username: $("#matricula").val(),
            responsavelAtual: $('#matricula').val(),

            dataLiquidacao: $('#dataLiquidacao').val(),
            numeroBoleto: $('#numeroBoleto').val(),
            statusGeral: $('#statusGeral').val(),

                    // fazer if

            statusInvoice: $('#statusInvoice').val(),
            statusConhecimento: $('#statusConhecimento').val(),
            statusDiDue: $('#statusDiDue').val(),
            statusDadosBancarios: $('#statusDadosBancarios').val(),
            statusAutorizacaoSr: $('#statusAutorizacaoSr').val(),
            
            observacoesCeopc: $('#observacoesCeopc').val(),
            }; 
        }    
    },
    preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
         previewFileIconSettings: { // configure your icon file extensions
            'doc': '<i class="fa fa-fw fa-file-word-o text-primary"></i>',
            'pdf': '<i class="fa fa-fw fa-file-pdf-o text-danger"></i>',
            'zip': '<i class="fa fa-fw fa-file-zip-o text-muted"></i>',
            // note for these file types below no extension determination logic 
            // has been configured (the keys itself will be used as extensions)
            'jpg': '<i class="fa fa-fw fa-file-image-o text-danger"></i>', 
            'gif': '<i class="fa fa-fw fa-file-image-o text-muted"></i>', 
            'png': '<i class="fa fa-fw fa-file-image-o text-primary"></i>'    
        },
    previewFileExtSettings: { // configure the logic for determining icon file extensions
        'doc': function(ext) {
            return ext.match(/(doc|docx)$/i);
        },
        'xls': function(ext) {
            return ext.match(/(xls|xlsx)$/i);
        },
        'ppt': function(ext) {
            return ext.match(/(ppt|pptx)$/i);
        },
        'zip': function(ext) {
            return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
        },
        'htm': function(ext) {
            return ext.match(/(htm|html)$/i);
        },
        'txt': function(ext) {
            return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
        },
        'mov': function(ext) {
            return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
        },
        'mp3': function(ext) {
            return ext.match(/(mp3|wav)$/i);
        }
    }
// }).on('filesorted', function(e, params) {
//     console.log('File sorted params', params);
// }).on('fileuploaded', function(e, params) {
//     console.log('File uploaded params', params);
});
},
});

$('#formAnaliseDemanda').on('submit', function(e){
    e.preventDefault();
    var formData = new FormData($('#formAnaliseDemanda').get(0)); // Creating a formData using the form.
    $.ajax({
        type: 'POST',
        url: '../../js/contratacao/backend/post_teste_inova.php',
        dataType: 'json',
        cache: false,
        processData: false, // Important!
        contentType: false, // Important! I set dataType above as Json
        data: formData, // Important! The formData should be sent this way and not as a dict.
        // beforeSend: function(xhr){xhr.setRequestHeader('X-CSRFToken', "{{csrf_token}}");},
        success: function(data, textStatus) {
            console.log(data);
            console.log(formData);
            console.log(textStatus);
        },
        error: function (textStatus, errorThrown) {
            console.log(errorThrown);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
});



}) // fim do doc ready

