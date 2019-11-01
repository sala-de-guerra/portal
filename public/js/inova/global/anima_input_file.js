//Função global que inclui a animação que mostra o nome e tamanho dos arquivos carregados no input file

function _animaInputFile() {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, ''),
            totalSize = 0;

        $(input).each(function() {
            for (var i = 0; i < this.files.length; i++) {
                totalSize += this.files[i].size / 1024;
            }
        });

        if (totalSize <= tamanhoMaximo) {
            totalSizeKb = (Math.round(totalSize * 100) / 100) + ' kb no total';
            input.trigger('fileselect', [numFiles, label, totalSizeKb]);
        }
        else {
            alert('O tamanho máximo para upload de arquivos foi excedido');
        }
    });
  
    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label, totalSizeKb) {
  
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' arquivos selecionados, ' + totalSizeKb : label + ', ' + totalSizeKb;
  
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
  
        });
    });
    
  };

  // FUNÇÃO QUE PROIBE DAR UPLOAD EM ARQUIVOS QUE NÃO SEJAM OS PERMITIDOS

  function _tiposArquivosPermitidos() {

    $('input[type="file"]').change(function () {
        var ext = this.value.split('.').pop().toLowerCase();
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'pdf':
            case '7z':
            case 'zip':
            case 'rar':
            case 'doc':
            case 'docx':
                $('#submitBtn').attr('disabled', false);
                
                break;
            default:
                $('#submitBtn').attr('disabled', true);
                alert('O tipo de arquivo selecionado não é aceito. Favor carregar um arquivo de imagem, PDF, Word ou Zip.');
                this.value = '';
        }
    });

  };

