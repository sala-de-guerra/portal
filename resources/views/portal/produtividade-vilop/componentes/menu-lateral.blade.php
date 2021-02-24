@section('menu-lateral')
<!-- menu -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
            <a href="https://portal.gilie.des.sp.caixa/produtividade-vilop" class="brand-link bg-primary">
                <img src="https://portal.gilie.des.sp.caixa/img/vilop_novo_logo.png" alt="CAIXA" class="brand-image ml-1" style="opacity: .8">
                <span class="brand-text font-weight-light ">
                    <h3>Produtividade</h3>
                </span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">
                        {{-- <li class="header">MENU INICIAL</li> --}}
                        <li class="nav-item menu-open">
                            
                            <a class="nav-link " href="#">
                                <i class="fas fa-lg fa-fw fa-chart-bar mr-2 "></i>
                                <p>Indicadores <i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item ">
                                    <a class="nav-link " href="/produtividade-vilop">                    
                                        <i class="far fa-fw fa-circle "></i>
                                        <p>Formulário de Pesquisa</p>
                                    </a>
                                </li>    
                                <li class="nav-item ">
                                    <a class="nav-link " href="/produtividade-vilop/lista-unidades/lista">                    
                                        <i class="far fa-fw fa-circle "></i>
                                        <p>Pesquisas entregues</p>
                                    </a>
                                </li> 
                                <li class="nav-item ">
                                    <a class="nav-link " href="/produtividade-vilop/atividades-em-lote/upload">                    
                                        <i class="far fa-fw fa-circle "></i>
                                        <p>Importar dados</p>
                                    </a>
                                </li>  

                                {{-- <li class="nav-item ">
                                    <a class="nav-link " href="/produtividade-vilop/dashboard/dash">                    
                                        <i class="far fa-fw fa-circle "></i>
                                        <p>Indicadores</p>
                                    </a>
                                </li>    --}}
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
<!-- fim menu -->
@endsection
