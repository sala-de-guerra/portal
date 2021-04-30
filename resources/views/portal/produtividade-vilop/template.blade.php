
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="B43pngcClSBXSKFjHR8ZheK6Uxy2lNk0YDl4wWRU">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <title>Produtividade Vilop</title>
        
    <link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/vendor/overlayScrollbars/css/OverlayScrollbars.min.css"> 
    <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet" href="/plugins/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="/plugins/DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/plugins/typeahead/typeahead.css">
    <link rel="stylesheet" href="/css/main.css">

<style>



</style>


</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed "  >

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-primary navbar-dark">
            <ul class="navbar-nav col">
                <li class="nav-item">
                    <a class="nav-link menu-hamburguer" data-widget="pushmenu" href="#"   >
                        <i class="fas fa-bars"></i>
                        <span class="sr-only">Trocar navegação</span>
                    </a>
                </li>
            </ul>

            <form class="form-inline m-0" id="buscaCGC" action="" method="post">
                            {{ csrf_field() }}
                            <div class="input-group nav-search-bar">
                                <input class="form-control form-control-navbar" type="text"  autocomplete="off" id="pesquisar-unidades" name="numeroCGC" placeholder="Pesquise por CGC" title="Digite o código da unidade que se pretende buscar..." required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"  title="Pesquisar"> <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </form>


            <ul class="navbar-nav ml-auto ">                                        
                <li class="nav-item d-none d-sm-block mx-1 ml-4">
                    <a href="#" id="btnFullscreen" class="nav-link px-0" title="Modo tela cheia">
                        <i class="fas fa-lg fa-expand"></i>
                    </a>
                </li>

                <li class="nav-item d-none d-sm-block mx-1">
                    <a href="#" id="btnFullscreenOff" class="nav-link px-0" title="Sair do modo tela cheia" style="display:none;">
                        <i class="fas fa-lg fa-compress-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item dropdown user-menu mx-1">
                
                </li>
                    
                    
                <li class="nav-item dropdown user-menu mx-1">
                    <a href="#" class="nav-link dropdown-toggle p-0" data-toggle="dropdown">
                        <img src='{{ asset('/img/perfil-sem-foto.png') }}' class="user-image img-circle elevation-2 m-0" alt="Foto do Usuário" onerror="this.src='{{ asset('/img/question-mark.png') }}';">
                        <span class="d-none d-md-inline">{{ session()->get('primeiroNome') }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right absolute">
                        <a class="dropdown-item">
                            <div class="media">
                                <img src='{{ asset('/img/perfil-sem-foto.png') }}' class="user-image-dropdown img-circle" alt="Foto do Usuário" onerror="this.src='{{ asset('/img/question-mark.png') }}';">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title ">{{ session()->get('nomeCompleto') }}</h3>
                                    <p class="text-sm">{{ session()->get('matricula') }} - {{ session()->get('nomeFuncao') }}</p>
                                    <p class="text-sm">UNIDADE: </p> <p class="text-sm" id="lotacao">{{ session()->get('codigoLotacaoAdministrativa') }}</p>
                                    <p class="text-sm" id="perfil">{{ session()->get('acessoEmpregadoPortal') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>         
                </li>
            </ul>
        </nav>
<!-- fim navbar -->

{{-- Menu lateral --}}

@yield('menu-lateral')
        
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            
                                @yield('saudacao')
                            
                        </div>
                        <div class="col-sm-3">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/produtividade-vilop"> Produtividade Vilop</a> </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- conteudo -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        @yield('conteudo')

                        {{-- @yield('form-criar-microatividade') --}}

                    </div>
                </div>
            </div>
        
            <!-- fim conteudo -->

            

            <footer class="main-footer ">
                <div class="float-right d-none d-sm-block">
                    <b>Versão:</b> em validação
                </div>
                <img src="/img/logo_vilop_colorido.png">
                <strong>2021 | Grupo de Trabalho: Indicadores de Produtividade Vilop </strong> 
            </footer>
        </div>
    </div>

        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="/plugins/jquery-ui/ui.datepicker-pt-BR.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="/plugins/numeral/numeral.min.js"></script>
        <script src="/plugins/numeral/locales/pt-br.min.js"></script>
        <script src="/plugins/masks/jquery.mask.min.js"></script>
        <script src="/plugins/moment/moment-with-locales.min.js"></script>
        <script src="/js/global/FormataDataClass.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script src="/js/global/summernote-pt-BR.min.js"></script>
        <script src="/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="/vendor/adminlte/dist/js/adminlte.min.js"></script>
        <script src="/plugins/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="/plugins/DataTables/dataTables.fixedColumns.min.js"></script>
        <script src="/js/global/formata_datatable.js"></script>
        <script src="/js/global/toggle_fullscreen.js"></script>
        <script src="/js/global/copy_to_clipboard.js"></script>
        <script>
            
            $('#buscaCGC').submit( function(e) {
            e.preventDefault();
            var $input = $(this).find('[name=numeroCGC]');
            window.location = `/produtividade-vilop/${$input.val()}`
            })
           
        </script>

        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>


          @yield('js')
</body>
</html>
