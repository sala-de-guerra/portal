<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'GILIE',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-logo
    |
    */

    'logo' => '<h3><b>Portal</b> GILIE</h3>',
    'logo_img' => 'img/logo-caixa.png',
    'logo_img_alt' => 'CAIXA',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => false,

    /*
    |--------------------------------------------------------------------------
    | Extra Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-primary',
    'classes_brand_text' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-light-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-primary navbar-dark',
    'classes_topnav_nav' => 'navbar-expand-md',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#66-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-urls
    |
    */

    'dashboard_url' => '',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-menu
    |
    */

    'menu' => [
        // [
        //     'text' => 'VILOP',
        //     'url'  => 'http://vilop.caixa/',
        //     'topnav' => true,
        //     'icon' => '',
        // ],
        // [
        //     'text' => 'SULOG',
        //     'url'  => 'http://log.caixa/portal/',
        //     'topnav' => true,
        //     'icon' => '',
        // ],
        // [
        //     'text' => 'GEIPT',
        //     'url'  => 'http://www.geipt.mz.caixa/site/index.asp',
        //     'topnav' => true,
        //     'icon' => '',
        // ],
        // [
        //     'text' => 'GILIE/SP',
        //     'url'  => 'index',
        //     'topnav' => true,
        //     'icon' => '',
        // ],
        // [
        //     'text' => 'blog',
        //     'url'  => 'admin/blog',
        //     'can'  => 'manage-blog',
        // ],
        // [
        //     'text'        => 'Principal',
        //     'url'         => '/index',
        //     'icon'        => 'fas fa-fw fa-home',
        // ],
        // 'ACCOUNT SETTINGS',
        // [
        //     'text' => 'Profile',
        //     'route' => 'admin.profile',
        //     'icon' => 'fas fa-fw fa-user'
        // ],
        // [
        //     'text' => 'Change Password',
        //     'route' => 'admin.password',
        //     'icon' => 'fas fa-fw fa-lock'
        // ],
        // [
        //     'text' => 'Notificações',
            // 'route' => 'admin.password',
        //     'icon' => 'fas fa-flag'
        // ],
        // [
        //     'text'        => 'Sobre a GILIE',
        //     'url'         => '/sobre',
        //     'icon'        => 'fas fa-lg fa-users',
        // ],
        [
            'text'        => 'Área de Atuação',
            'url'         => '/area',
            'icon'        => 'fas fa-lg fa-fw fa-map-marked-alt mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'AGENCIA', 'SR', 'MATRIZ', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
        ],
        [
            'text'        => 'Corretores',
            'url'         => '/corretores',
            'icon'        => 'fas fa-lg fa-fw fa-address-card mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'AGENCIA', 'SR', 'MATRIZ', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
        ],
        [
            'text'        => 'Dúvidas Frequentes',
            'url'         => '/faq',
            'icon'        => 'fas fa-lg fa-fw fa-question-circle mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'AGENCIA', 'SR', 'MATRIZ', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
        ],
        [
            'text'        => 'Orientações',
            'url'         => '/orientacoes',
            'icon'        => 'fas fa-lg fa-fw fa-directions mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'AGENCIA', 'SR', 'MATRIZ', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
        ],
        [
            'text' => 'Atende',
            'icon' => 'fas fa-lg fa-fw fa-headset mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'AGENCIA', 'SR', 'MATRIZ', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
            'submenu' => [
                [
                    'text' => 'Abrir Demanda',
                    // 'icon'    => 'far fa-fw fa-circle mr-2',
                    'url'  => '/atende/abrir',
                    'perfil_acesso' => ['DESENVOLVEDOR','AGENCIA', 'SR', 'MATRIZ', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
                ],
                [
                    'text' => 'Minhas Demandas',
                    // 'icon'    => 'far fa-fw fa-circle mr-2',
                    'url'  => '/atende/minhas-demandas-agencia',
                    'perfil_acesso' => ['AGENCIA', 'SR', 'MATRIZ'],
                ],
                [
                    'text' => 'Minhas Demandas',
                    // 'icon'    => 'far fa-fw fa-circle mr-2',
                    'url'  => '/atende/minhas-demandas',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
                ],
            ],
        ],

        [
            'text' => 'Carga em Lote',
            'icon' => 'fas fa-lg fa-fw fa-cloud-upload-alt mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
            'submenu' => [
                [
                    'text' => 'Averbação Leilão Negativo',
                    // 'icon'    => 'fas fa-lg fa-fw fa-file-signature mr-2',
                   'url'  => 'carga-em-lote/averbacao-leilao-negativo',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
               ],
                 [
                     'text' => 'Controle Arquivos EMGEA',
                     // 'icon'    => 'fas fa-lg fa-fw fa-file-signature mr-2',
                    'url'  => 'carga-em-lote/controle-arquivos',
                     'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')],
                ],
            ],
        ],

        // [
        //     'text'    => 'Carga em Lote',
        //     'icon'    => 'fas fa-lg fa-fw fa-cloud-upload-alt mr-2',
        //     'perfil_acesso' => ['DESENVOLVEDOR'],
        //     'submenu' => [
        //         [
        //             'text' => 'Controle Arquivos EMGEA',
        //             // 'icon'    => 'fas fa-lg fa-fw fa-file-signature mr-2',
        //             'url'  => '/controle-arquivos',
        //             'perfil_acesso' => ['DESENVOLVEDOR'],
        //         ],
        //         [
        //             'text' => 'Leilão Negativo',
        //             // 'icon'    => 'fas fa-lg fa-fw fa-calendar-times mr-2',
        //             'url'  => '',
        //             'perfil_acesso' => ['DESENVOLVEDOR'],
        //         ]
        //     ]
        // ],

        [
            'text'    => 'Contratação',
            'icon'    => 'fas fa-lg fa-fw fa-file-contract mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', env('NOME_NOSSA_UNIDADE'), 'GESTOR'],
            'submenu' => [
                [
                    'text' => 'Acompanhar Contratação',
                    // 'icon'    => 'fas fa-lg fa-fw fa-file-signature mr-2',
                    'url'  => '/estoque-imoveis/acompanha-contratacao',
                    'perfil_acesso' => ['DESENVOLVEDOR', env('NOME_NOSSA_UNIDADE'), 'GESTOR'],
                ],
                [
                    'text' => 'Controle de Distrato',
                    // 'icon'    => 'fas fa-lg fa-fw fa-calendar-times mr-2',
                    'url'  => '/estoque-imoveis/distrato',
                    'perfil_acesso' => ['DESENVOLVEDOR', env('NOME_NOSSA_UNIDADE'), 'GESTOR'],
                ],
                [
                    'text' => 'Fila Única',
                    // 'icon'    => 'fas fa-lg fa-fw fa-calendar-check mr-2',
                    'url'  => '/estoque-imoveis/conformidade-contratacao',
                    'perfil_acesso' => ['DESENVOLVEDOR', env('NOME_NOSSA_UNIDADE'), 'GESTOR'],
                ],
                [
                    'text' => 'TMA',
                    'url'  => '/contratacao/tempo-medio-aquisicao',
                    'perfil_acesso' => ['DESENVOLVEDOR', env('NOME_NOSSA_UNIDADE'), 'GESTOR'], // , 'GESTOR'
                ],

                // [
                //     'text' => 'TMA venda à vista',
                //     'url'  => '/tma/avista',
                //     'perfil_acesso' => ['DESENVOLVEDOR', env('NOME_NOSSA_UNIDADE'), 'GESTOR'], // , 'GESTOR'
                // ],
                // [
                //     'text' => 'TMA venda financiada',
                //     'url'  => '/tma/financiado',
                //     'perfil_acesso' => ['DESENVOLVEDOR', env('NOME_NOSSA_UNIDADE'), 'GESTOR'], // , 'GESTOR'

                // ],

                // [
                //     'text' => 'level_two',
                //     'url'  => '#',
                // ],
                // [
                //     'text' => 'level_two',
                //     'url'  => '#',
                // ],
                // [
                //     'text' => 'level_one',
                //     'url'  => '#',
                // ],
            ],
        ],
        // [
        //     'text'        => 'Fale Conosco',
        //     'url'         => '/fale-conosco/abrir',
        //     'icon'        => 'fas fa-lg fa-fw fa-at mr-2',
        //     'perfil_acesso' => ['DESENVOLVEDOR'],
        // ],
        [
            'text'       => 'Fornecedores',
            'icon'       => 'fas fa-lg fa-fw fa-address-card mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')], //             
            'submenu' => [
                [
                    'text' => 'Despachantes',
                    // 'icon'       => 'fas fa-lg fa-fw fa-id-card-alt mr-2',
                    'url'  => '/fornecedores/controle-despachantes/',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')], // 
                ],
                [
                    'text' => 'Leiloeiros',
                    // 'icon'       => 'fas fa-lg fa-fw fa-gavel mr-2',
                    'url'  => '/fornecedores/controle-leiloeiros/',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')], // 
                ]
    
            ],
        ],

        // [
        //     'text'        => 'Conheça o Projeto',
        //     'url'         => '/projeto',
        //     'icon'        => 'fas fa-lg fa-toolbox',
        // ],


        // ['header' => 'IMÓVEIS CAIXA'],
        // [
        //     'text' => 'Pesquisar Imóvel',
        //     'url'  => '/pesquisar',
        //     'icon' => 'fas fa-lg fa-fw fa-search mr-2',
        //     'perfil_acesso' => ['DESENVOLVEDOR'], // , 'AGENCIA', 'SR', 'MATRIZ', 'GESTOR', env('NOME_NOSSA_UNIDADE')
        // ],
        [
            'text' => 'Preparar e Ofertar',
            'icon' => 'fas fa-lg fa-fw fa-sign mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')], // 
            'submenu' => [
                [
                    'text' => 'Controle de Laudos',
                    // 'icon'    => 'fas fa-lg fa-fw fa-folder-minus mr-2',
                    'url'  => '/preparar-e-ofertar/controle-laudos',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')], // 
                ],
                
                [
                    'text' => 'Leilões Negativos',
                    // 'icon'    => 'fas fa-lg fa-fw fa-folder-minus mr-2',
                    'url'  => '/estoque-imoveis/leiloes-negativos',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR', env('NOME_NOSSA_UNIDADE')], // 
                ]
            ],
        ],
        // [
        //     'text' => 'Pagamentos',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-lg fa-fw fa-dollar-sign',
        //     'submenu' => [
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],

        // ],

        
        // ['header' => 'PENHOR'],
        // [
        //     'text' => 'Preparar e Ofertar',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-lg fa-fw fa-sign',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // [
        //     'text' => 'Pagamentos e Averbação',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-lg fa-fw fa-dollar-sign',
        //     'submenu' => [
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],

        // ],
        // [
        //     'text'    => 'Contratação',
        //     'icon'    => 'fas fa-lg fa-fw fa-file-contract',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_two',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],

        [
            'text'       => 'Gerencial',
            'icon'       => 'fas fa-lg fa-fw fa-users mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR'],
            'submenu' => [
                [
                    'text' => 'Atende sem contrato',
                    // 'icon'       => 'fas fa-lg fa-fw fa-tasks mr-2',
                    'url'  => '/gerencial/gerenciar-atende-generico',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR'],
                ],
                
                [
                    'text' => 'Gestão Atende',
                    // 'icon'       => 'fas fa-lg fa-fw fa-calendar-check mr-2',
                    'url'  => 'gerencial/gestao-atende',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR'],
                ],
                [
                    'text' => 'Gestão de Atividades',
                    // 'icon'       => 'fas fa-lg fa-fw fa-tasks mr-2',
                    'url'  => '/gerencial/gestao-atividades',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR'],
                ],

                [
                    'text' => 'Gestão de Equipes',
                    // 'icon'       => 'fas fa-lg fa-fw fa-users-cog mr-2',
                    'url'  => '/gerencial/gestao-equipes/',
                    'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR'],
                ]
    
            ],
        ],

        [
            'text'    => 'Indicadores',
            'icon'    => 'fas fa-lg fa-fw fa-chart-bar mr-2',
            'perfil_acesso' => ['DESENVOLVEDOR', 'GESTOR'], // , 'GESTOR'
            'submenu' => [
                [
                    'text' => 'Indicadores de Distrato',
                    'url'  => '/indicadores/distrato',
                    'perfil_acesso' => ['DESENVOLVEDOR'], // , 'GESTOR'
                ],
            ],
        ],

        // [
        //     'text'       => 'information',
        //     'icon_color' => 'aqua',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-plugins
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];
