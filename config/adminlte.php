<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'EasyDoc',

    'title_prefix' => ' EasyDoc - ',

    'title_postfix' => ' Gestão de conteúdo',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => 'EasyDoc',

    'logo_mini' => 'EasyDoc',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'purple',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'admin/home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'SITE',
        [
            'text' => 'Home',
            'url'  => 'admin/home',
            'icon' => 'home'
        ],
        [
            'text' => 'Folders',
            'url'  => 'admin/folder',
            'icon' => 'folder',
            'can' => 'read_folders'
         ],
        [
            'text' => 'Pesquisar',
            'url'  => 'admin/search',
            'icon' => 'search',
            'can'  => 'read_pesquisar'
        ],
        [
            'text' => 'Arquivos',
            'url'  => 'admin/files',
            'icon' => 'newspaper-o',
            'can'  => 'read_arquivos'
        ],
        [
            'text' => 'Organizações',
            'url'  => 'admin/organizacoes',
            'icon' => 'cube',
            'can'  => 'read_organizacoes'
        ],
        [
            'text' => 'Categorias de organização',
            'url'  => 'admin/catorganizacoes',
            'icon' => 'cubes',
            'can'  => 'read_catorganizacoes'
        ],
        [
            'text' => 'Categorias',
            'url'  => 'admin/categorias',
            'icon' => 'sitemap',
            'can'  => 'read_categorias'
        ],
        [
            'text' => 'Subcategorias',
            'url'  => 'admin/subcategorias',
            'icon' => 'tags',
            'can'  => 'read_subcategorias'
        ],
        [
            'text' => 'Tags',
            'url'  => 'admin/tags',
            'icon' => 'tag',
            'can'  => 'read_tags'
        ],
        [
            'text' => 'Meses',
            'url'  => 'admin/months',
            'icon' => 'calendar-check-o',
            'can'  => 'read_meses'
        ],
        [
            'text' => 'Anos',
            'url'  => 'admin/years',
            'icon' => 'calendar-check-o',
            'can'  => 'read_anos'
        ],
        [
            'text' => 'Relatórios',
            'url'  => 'admin/reports',
            'icon' => 'pie-chart',
            'can'  => 'read_relatorios'
        ],
        [
            'text' => 'Logs',
            'url'  => 'admin/logs',
            'icon' => 'archive',
            'can'  => 'read_logs'
        ],
        'GESTÃO',
        [
            'text' => 'Usuários',
            'url'  => 'admin/users',
            'icon' => 'user',
            'can'  => 'read_usuarios'
        ],
        [
            'text' => 'Grupos',
            'url'  => 'admin/roles',
            'icon' => 'group',
            'can'  => 'read_grupos'
        ],
        [
            'text' => 'Módulos',
            'url'  => 'admin/modules',
            'icon' => 'gear',
            'can'  => 'read_modulos'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
        'inputmask'  => true,
        'maskmoney'  => true,
        'validate'   => true,
        'datepicker' => true
    ],
];
