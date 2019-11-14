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

    'title' => 'GILIE/SP',
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

    'logo' => '<b>Portal</b>    GILIE',
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
    'layout_fixed_footer' => null,

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

        [
            'text'        => 'Sobre a GILIE',
            'url'         => '/sobre',
            'icon'        => false,
        ],
        [
            'text'        => 'Dúvidas Frequentes',
            'url'         => '/faq',
            'icon'        => false,
        ],
        [
            'text'        => 'Orientações',
            'url'         => '/orientacoes',
            'icon'        => false,
        ],



        ['header' => 'IMÓVEIS CAIXA'],
        [
            'text' => 'Preparar e Ofertar',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-sign',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],
        [
            'text' => 'Pagamentos e Averbação',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-dollar-sign',
            'submenu' => [
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],

        ],
        [
            'text'    => 'Contratação',
            'icon'    => 'fas fa-fw fa-file-contract',
            'submenu' => [
                [
                    'text' => 'Controle de Contratação',
                    'url'  => '/controle-contratacao',
                ],
                [
                    'text' => 'Distrato',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],

        ['header' => 'PENHOR'],
        [
            'text' => 'Preparar e Ofertar',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-sign',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],
        [
            'text' => 'Pagamentos e Averbação',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-dollar-sign',
            'submenu' => [
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],

        ],
        [
            'text'    => 'Contratação',
            'icon'    => 'fas fa-fw fa-file-contract',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],

        ['header' => 'Gerencial'],
        [
            'text'       => 'Perfis de Acesso',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'Requisitos do projeto',
            'icon_color' => 'yellow',
        ],

        [
            'text'    => 'Indicadores',
            'icon'    => 'fas fa-fw fa-chart-bar',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_two',
                    'url'  => '#',
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
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
