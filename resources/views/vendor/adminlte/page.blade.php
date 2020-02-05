@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body',
    (config('adminlte.sidebar_mini', true) === true ?
        'sidebar-mini ' :
        (config('adminlte.sidebar_mini', true) == 'md' ?
         'sidebar-mini sidebar-mini-md ' : '')
    ) .
    (config('adminlte.layout_topnav') || View::getSection('layout_topnav') ? 'layout-top-nav ' : '') .
    (config('adminlte.layout_boxed') ? 'layout-boxed ' : '') .
    (!config('adminlte.layout_topnav') && !View::getSection('layout_topnav') ?
        (config('adminlte.layout_fixed_sidebar') ? 'layout-fixed ' : '') .
        (config('adminlte.layout_fixed_navbar') === true ?
            'layout-navbar-fixed ' :
            (isset(config('adminlte.layout_fixed_navbar')['xs']) ? (config('adminlte.layout_fixed_navbar')['xs'] == true ? 'layout-navbar-fixed ' : 'layout-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['sm']) ? (config('adminlte.layout_fixed_navbar')['sm'] == true ? 'layout-sm-navbar-fixed ' : 'layout-sm-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['md']) ? (config('adminlte.layout_fixed_navbar')['md'] == true ? 'layout-md-navbar-fixed ' : 'layout-md-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['lg']) ? (config('adminlte.layout_fixed_navbar')['lg'] == true ? 'layout-lg-navbar-fixed ' : 'layout-lg-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['xl']) ? (config('adminlte.layout_fixed_navbar')['xl'] == true ? 'layout-xl-navbar-fixed ' : 'layout-xl-navbar-not-fixed ') : '')
        ) .
        (config('adminlte.layout_fixed_footer') === true ?
            'layout-footer-fixed ' :
            (isset(config('adminlte.layout_fixed_footer')['xs']) ? (config('adminlte.layout_fixed_footer')['xs'] == true ? 'layout-footer-fixed ' : 'layout-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['sm']) ? (config('adminlte.layout_fixed_footer')['sm'] == true ? 'layout-sm-footer-fixed ' : 'layout-sm-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['md']) ? (config('adminlte.layout_fixed_footer')['md'] == true ? 'layout-md-footer-fixed ' : 'layout-md-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['lg']) ? (config('adminlte.layout_fixed_footer')['lg'] == true ? 'layout-lg-footer-fixed ' : 'layout-lg-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['xl']) ? (config('adminlte.layout_fixed_footer')['xl'] == true ? 'layout-xl-footer-fixed ' : 'layout-xl-footer-not-fixed ') : '')
        )
        : ''
    ) .
    (config('adminlte.sidebar_collapse') || View::getSection('sidebar_collapse') ? 'sidebar-collapse ' : '') .
    (config('adminlte.right_sidebar') && config('adminlte.right_sidebar_push') ? 'control-sidebar-push ' : '') .
    config('adminlte.classes_body')
)

@section('body_data',
(config('adminlte.sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light' ? 'data-scrollbar-theme=' . config('adminlte.sidebar_scrollbar_theme')  : '') . ' ' . (config('adminlte.sidebar_scrollbar_auto_hide', 'l') != 'l' ? 'data-scrollbar-auto-hide=' . config('adminlte.sidebar_scrollbar_auto_hide')   : ''))

@section('body')
    <div class="wrapper">
        @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
        <nav class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.topnav_color', 'navbar-white navbar-light')}}">
            <div class="{{config('adminlte.classes_topnav_container', 'container')}}">
                @if(config('adminlte.logo_img_xl'))
                    <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand logo-switch">
                        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_class', 'brand-image-xl')}} logo-xs">
                        <img src="{{ asset(config('adminlte.logo_img_xl')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                    </a>
                @else
                    <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand {{ config('adminlte.classes_brand') }}">
                        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
                        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </span>
                    </a>
                @endif

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="nav navbar-nav">
                        @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    </ul>
                </div>
            @else
            <nav class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.classes_topnav', 'navbar-white navbar-light')}}">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link menu-hamburguer" data-widget="pushmenu" href="#" @if(config('adminlte.sidebar_collapse_remember')) data-enable-remember="true" @endif @if(!config('adminlte.sidebar_collapse_remember_no_transition')) data-no-transition-after-reload="false" @endif @if(config('adminlte.sidebar_collapse_auto_size')) data-auto-collapse-size="{{config('adminlte.sidebar_collapse_auto_size')}}" @endif>
                            <i class="fas fa-bars"></i>
                            <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <form class="form-inline tt-responsive" id="formPesquisa">
                            <div class="input-group">
                                <input class="form-control form-control-navbar typeahead tt-responsive" type="text" name="" placeholder="Pesquise um imóvel pelo CHB, endereço, dados do proponente ou do ex-mutuário.">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit"> <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </form>
                    </li> -->
                    @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    @yield('content_top_nav_left')
                </ul>
            @endif
                <ul class="navbar-nav ml-auto @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))order-1 order-md-3 navbar-no-expand @endif">
                    @yield('content_top_nav_right')
                    @if(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <i class="fa fa-fw fa-power-off"></i> {{ __('adminlte::adminlte.log_out') }}
                            </a>
                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                @if(config('adminlte.logout_method'))
                                    {{ method_field(config('adminlte.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                    @if(config('adminlte.right_sidebar'))
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-widget="control-sidebar" @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false" @endif @if(config('adminlte.right_sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light') data-scrollbar-theme="{{config('adminlte.right_sidebar_scrollbar_theme')}}" @endif @if(config('adminlte.right_sidebar_scrollbar_auto_hide', 'l') != 'l') data-scrollbar-auto-hide="{{config('adminlte.right_sidebar_scrollbar_auto_hide')}}" @endif>
                                <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item mx-1">
                        <a href="#" id="btnFullscreen" class="nav-link" title="Modo tela cheia">
                            <i class="fas fa-lg fa-expand"></i>
                        </a>
                    </li>

                    <li class="nav-item mx-1">
                        <a href="#" id="btnFullscreenOff" class="nav-link" title="Sair do modo tela cheia" style="display:none;">
                            <i class="fas fa-lg fa-compress-arrows-alt"></i>
                        </a>
                    </li>

                    @if (in_array(session()->get('acessoEmpregadoPortal'), ['GESTOR', 'DESENVOLVEDOR']))
                        <li class="nav-item mx-1 dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="far fa-lg fa-bell"></i>
                                <span class="badge badge-warning navbar-badge">{{ session()->get('totalAcoesPendentesGestor') }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">Notificações</span>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/estoque-imoveis/distrato">
                                    <i class="fas fa-envelope mr-2"></i>
                                    {{ session()->get('demandasDistratoPendentesParecerGestor') }} distratos para enviar.
                                </a>
                            </div>
                        </li>
                    @endIf

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <img src="https://permissoes.correio.corp.caixa.gov.br/ThumbPhoto/C079436_AD.jpg" class="user-image" alt="User Image" onError="this.src='{{ asset('images/userSemFoto.jpg') }}';">
                            -->
                            <img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula={{ session()->get('matricula') }}" class="user-image img-circle elevation-2" alt="Foto do Usuário" onerror="this.src='{{ asset('/img/question-mark.png') }}';">
                            <!-- {{-- backup <img src="http://tedx.caixa/lib/asp/foto.asp?Matricula={{session()->get('matricula')}}" class="user-image" alt="User Image" onerror="this.src='{{ asset('images/userSemFoto.jpg') }}';">  --}} -->
                            <span class="d-none d-md-inline">{{ session()->get('primeiroNome') }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right absolute">
                            <a class="dropdown-item">
                                <div class="media">
                                    <img src="http://www.sr2576.sp.caixa/2017/foto.asp?matricula={{ session()->get('matricula') }}" class="user-image-dropdown img-circle" alt="Foto do Usuário" onerror="this.src='{{ asset('/img/question-mark.png') }}';">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title ">{{ session()->get('nomeCompleto') }}</h3>
                                        <p class="text-sm">{{ session()->get('matricula') }} - {{ session()->get('nomeFuncao') }}</p>
                                        <p class="text-sm">UNIDADE: {{ session()->get('codigoLotacaoAdministrativa') }}</p>
                                        <p class="text-sm">{{ session()->get('acessoEmpregadoEsteiraComex') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </li>

                    <!-- <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="/img/question-mark.png" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right absolute">
                            <li class="user-header bg-primary">
                                <img src="/img/question-mark.png" class="img-circle elevation-2" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                        </ul>
                    </li> -->
                </ul>
                @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
                    </nav>
                @endif
            </nav>
        @if(!config('adminlte.layout_topnav') && !View::getSection('layout_topnav'))
        <aside class="main-sidebar {{config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')}}">
            @if(config('adminlte.logo_img_xl'))
                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="brand-link logo-switch">
                    <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_class', 'brand-image-xl')}} logo-xs">
                    <img src="{{ asset(config('adminlte.logo_img_xl')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                </a>
            @else
                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="brand-link {{ config('adminlte.classes_brand') }}">
                    <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="brand-image" style="opacity: .8">
                    <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                        {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                    </span>
                </a>
            @endif
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column {{config('adminlte.classes_sidebar_nav', '')}}" data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{config('adminlte.sidebar_nav_animation_speed')}}" @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                </nav>
            </div>
            <!-- <div class="d-flex justify-content-center" style="position:relative; bottom:3rem;">
                <img src="{{ asset('img/LogoGilie.png') }}" alt="Logo Gilie" style="max-height: 50px;">
            </div> -->
        </aside>
        @endif

        <div class="content-wrapper">
            @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
            <div class="container">
            @endif

            <div class="content-header">
                <div class="{{config('adminlte.classes_content_header', 'container-fluid')}}">
                    @yield('content_header')
                </div>
            </div>

            <div class="content">
                <div class="{{config('adminlte.classes_content', 'container-fluid')}}">
                    @yield('content')
                </div>
            </div>
            @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
            </div>
            @endif
        </div>

        <footer class="main-footer">

            <div class="row">
                <div class="col-sm-2 d-flex justify-content-center">
                    <img src="{{ asset('img/LogoGilie.png') }}" alt="Logo Gilie" style="max-height: 40px;">
                </div>

                <div class="col-sm-7">
                    <b class="float-left m-2">2020 - GILIE/SP - Gerência de Alienar Bens Móveis e Imóveis</b>
                </div>
                <div class="col-sm-3">
                    <b class="float-right m-2">Data da atualização: {{ session('dataAtualizacaoBaseSimov') }}</b>
                </div>
            </div>

        </footer>


        @hasSection('footer')
        <footer class="main-footer">
            
            @yield('footer')

        </footer>
        @endif

        @if(config('adminlte.right_sidebar'))
            <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
        @endif

    </div>
@stop

@section('adminlte_js')

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/global/formata_datatable.js') }}"></script>
    <script src="{{ asset('js/global/toggle_fullscreen.js') }}"></script>

    @stack('js')
    @yield('js')
@stop
