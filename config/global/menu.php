<?php

return array(
    // Documentation menu
    'documentation' => array(
        // Getting Started
        array(
            'heading' => 'Getting Started',
        ),

        // Overview
        array(
            'title' => 'Overview',
            'path'  => 'documentation/getting-started/overview',
        ),

        // Build
        array(
            'title' => 'Build',
            'path'  => 'documentation/getting-started/build',
        ),

        array(
            'title'      => 'Multi-demo',
            'attributes' => array("data-mv-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/getting-started/multi-demo/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Build',
                        'path'   => 'documentation/getting-started/multi-demo/build',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // File Structure
        array(
            'title' => 'File Structure',
            'path'  => 'documentation/getting-started/file-structure',
        ),

        // Customization
        array(
            'title'      => 'Customization',
            'attributes' => array("data-mv-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'SASS',
                        'path'   => 'documentation/getting-started/customization/sass',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Javascript',
                        'path'   => 'documentation/getting-started/customization/javascript',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Dark skin
        array(
            'title' => 'Dark Mode Version',
            'path'  => 'documentation/getting-started/dark-mode',
        ),

        // RTL
        array(
            'title' => 'RTL Version',
            'path'  => 'documentation/getting-started/rtl',
        ),

        // Troubleshoot
        array(
            'title' => 'Troubleshoot',
            'path'  => 'documentation/getting-started/troubleshoot',
        ),

        // Changelog
        array(
            'title'            => 'Changelog <span class="badge badge-changelog badge-light-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">v' . theme()->getVersion() . '</span>',
            'breadcrumb-title' => 'Changelog',
            'path'             => 'documentation/getting-started/changelog',
        ),

        // References
        array(
            'title' => 'References',
            'path'  => 'documentation/getting-started/references',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // Configuration
        array(
            'heading' => 'Configuration',
        ),

        // General
        array(
            'title' => 'General',
            'path'  => 'documentation/configuration/general',
        ),

        // Menu
        array(
            'title' => 'Menu',
            'path'  => 'documentation/configuration/menu',
        ),

        // Page
        array(
            'title' => 'Page',
            'path'  => 'documentation/configuration/page',
        ),

        // Page
        array(
            'title' => 'Add NPM Plugin',
            'path'  => 'documentation/configuration/npm-plugins',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // General
        array(
            'heading' => 'General',
        ),

        // DataTables
        array(
            'title'      => 'DataTables',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array("data-mv-menu-trigger" => "click"),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/general/datatables/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Remove demos
        array(
            'title' => 'Remove Demos',
            'path'  => 'documentation/general/remove-demos',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // HTML Theme
        array(
            'heading' => 'HTML Theme',
        ),

        array(
            'title' => 'Components',
            'path'  => '//preview.keenthemes.com/metronic8/qsmart/documentation/base/utilities.html',
        ),

        array(
            'title' => 'Documentation',
            'path'  => '//preview.keenthemes.com/metronic8/qsmart/documentation/getting-started.html',
        ),
    ),

    // Main menu
    'main'          => array(
        //// Dashboard
        array(
            'title' => 'Dashboard',
            'permission' => 'view dashboard',
            'path'  => '',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

        //// HOME
        array(
            'title' => 'Home',
            'permission' => 'view client-wizard',
            'path'  => 'home',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/general/gen001.svg", "svg-icon-2"),
        ),
        //// History
        array(
            'title' => 'History',
            // 'permission' => 'view client-history',
            'path'  => 'token/history',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/coding/cod002.svg", "svg-icon-2"),
        ),
        //// Modules
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Ticketing</span>',
            'permission'  => 'view token',
        ),

        // Ticketing
        array(
            'title' => 'Token',
            'permission' => 'view token',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/abstract/abs027.svg", "svg-icon-2"),
            'path'  => '#',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-mv-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Token List',
                        'path'   => 'token/current',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Active Tokens',
                        'permission'  => 'view token-cards',
                        'path'   => 'token/current/card',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'      => 'Auto Token',
                        'permission' => 'run auto-token',
                        'path'       => 'token/auto',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',

                    ),
                ),
            ),
        ),


        // Reports    
        array(
            'title' => 'Reports',
            'permission' => 'view report',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/graphs/gra010.svg", "svg-icon-2"),
            'path'  => '#',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-mv-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Reports',
                        'path'   => 'reports',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Scheduled Reports',
                        'path'   => 'reports/scheduled',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
        //// VIP LIST
        array(
            'title' => 'Alerts',
            'permission' => 'view alert',
            'path'  => 'alerts/list',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/general/gen007.svg", "svg-icon-2"),
        ),
        //// VIP LIST
        array(
            'title' => 'VIPs',
            'permission' => 'view viplist',
            'path'  => 'viplist/list',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/general/gen020.svg", "svg-icon-2"),
        ),
        //// BLACKLIST
        array(
            'title' => 'Blacklist',
            'permission' => 'view blacklist',
            'path'  => 'blacklist/list',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/general/gen050.svg", "svg-icon-2"),
        ),
        // Configuration
        array(
            'title' => 'Configuration',
            'permission' => 'view configuration',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/abstract/abs015.svg", "svg-icon-2"),
            'path'  => '#',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-mv-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'      => 'Business Categories',
                        'path'       => 'category/list',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Companies',
                        'path'   => 'company/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Location',
                        'path'   => 'location/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    // array(
                    //     'title'  => 'Alerts',
                    //     'path'   => 'alerts/list',
                    //     'bullet' => '<span class="bullet bullet-dot"></span>',
                    // ),
                    // array(
                    //     'title'  => 'VIP List',
                    //     'path'   => 'viplist/list',
                    //     'bullet' => '<span class="bullet bullet-dot"></span>',
                    // ),
                    // array(
                    //     'title'  => 'Blacklist',
                    //     'path'   => 'blacklist/list',
                    //     'bullet' => '<span class="bullet bullet-dot"></span>',
                    // ),
                    array(
                        'title'      => 'Users',
                        'path'       => 'apps/user-management/users/list',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'      => 'Roles',
                        'path'       => 'apps/user-management/roles/list',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'      => 'Permissions',
                        'path'       => 'apps/user-management/permissions',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'      => 'System',
                        'path'       => 'settings/system',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Separator
        array(
            'content' => '<div class="separator mx-1 my-4"></div>',
        ),


        // Calendar
        //  array(
        //     'title' => 'Calendar',            
        //     'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/general/gen014.svg", "svg-icon-2"),
        //     'path'  => 'apps/calendar',
        // ),
        // Messaging
        // array(
        //     'title' => 'SMS',
        //     'permission'=> 'view configuration',
        //     'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/communication/com007.svg", "svg-icon-2"),
        //     'path'  => 'sms',

        // ),
        // Settings
        array(
            'title' => 'Settings',
            'permission' => 'view configuration',
            'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/general/gen019.svg", "svg-icon-2"),
            'path'  => '#',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-mv-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'SMS',
                        'path'   => 'sms/setting',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),

                ),
            ),
        ),
        // Account
        array(
            'title'      => 'Account',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("qsmart/media/icons/duotune/communication/com006.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-mv-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    // array(
                    //     'title'  => 'Overview',
                    //     'path'   => 'account/overview',
                    //     'bullet' => '<span class="bullet bullet-dot"></span>',
                    // ),
                    array(
                        'title'  => 'Settings',
                        'path'   => 'account/settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),

                ),
            ),
        ),
    ),

    // Horizontal menu
    'horizontal'    => array(
        // Dashboard
        array(
            'title'   => 'Dashboard',
            'path'    => '',
            'classes' => array('item' => 'me-lg-1'),
        ),

        // Resources
        array(
            'title'      => 'Resources',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-mv-menu-trigger'   => "click",
                'data-mv-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    // Documentation
                    array(
                        'title' => 'Documentation',
                        'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/abstract/abs027.svg", "svg-icon-2"),
                        'path'  => 'documentation/getting-started/overview',
                    ),

                    // Changelog
                    array(
                        'title' => 'Changelog v' . theme()->getVersion(),
                        'icon'  => theme()->getSvgIcon("qsmart/media/icons/duotune/general/gen005.svg", "svg-icon-2"),
                        'path'  => 'documentation/getting-started/changelog',
                    ),
                ),
            ),
        ),

        // Account
        array(
            'title'      => 'Account',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-mv-menu-trigger'   => "click",
                'data-mv-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'account/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Settings',
                        'path'   => 'account/settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'      => 'Security',
                        'path'       => '#',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        'attributes' => array(
                            'link' => array(
                                "title"             => "Coming soon",
                                "data-bs-toggle"    => "tooltip",
                                "data-bs-trigger"   => "hover",
                                "data-bs-dismiss"   => "click",
                                "data-bs-placement" => "right",
                            ),
                        ),
                    ),
                ),
            ),
        ),

        // System
        array(
            'title'      => 'System',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-mv-menu-trigger'   => "click",
                'data-mv-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
                        'title'      => 'Settings',
                        'path'       => '#',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        'attributes' => array(
                            'link' => array(
                                "title"             => "Coming soon",
                                "data-bs-toggle"    => "tooltip",
                                "data-bs-trigger"   => "hover",
                                "data-bs-dismiss"   => "click",
                                "data-bs-placement" => "right",
                            ),
                        ),
                    ),
                    array(
                        'title'  => 'Audit Log',
                        'path'   => 'log/audit',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'System Log',
                        'path'   => 'log/system',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
    ),
);
