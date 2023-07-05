<?php
return array(
    '' => array(
        'title'       => 'Dashboard',
        'description' => '',
        'view'        => 'index',
        'layout'      => array(
            'page-title' => array(
                'description' => true,
                'breadcrumb'  => false,
            ),
        ),
        'assets'      => array(
            'custom' => array(
                'js' => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),
    ),

    'login'           => array(
        'title'  => 'Login',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-in/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),
    'register'        => array(
        'title'  => 'Register',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-up/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),
    'forgot-password' => array(
        'title'  => 'Forgot Password',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/password-reset/password-reset.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),

    'log' => array(
        'audit'  => array(
            'title'  => 'Audit Log',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),
        'system' => array(
            'title'  => 'System Log',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),
    ),

    'account' => array(
        'overview' => array(
            'title'  => 'Account Overview',
            'view'   => 'account/overview/overview',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/widgets.js',
                    ),
                ),
            ),
        ),

        'settings' => array(
            'title'  => 'Account Settings',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
    ),

    'users'         => array(
        'title' => 'User List',

        '*' => array(
            'title' => 'Show User',

            'edit' => array(
                'title' => 'Edit User',
            ),
        ),
    ),

    'sms' => array(
        'title' => 'SMS History',
        'view' => 'sms',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'vendor/datatables/buttons.server-side.js',
                ),

            ),
        ),
        'setting' => array(
            'title' => 'SMS Settings'
        ),

    ),
    'reports'         => array(
        'title' => 'Reports',

        '*' => array(
            'title' => 'Generate Reports',
        ),
        'scheduled' => array(
            'title' => 'Scheduled Reports',
            'view'   => 'scheduledreports/index',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),

                ),
            ),
        ),
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    // 'vendor/datatables/buttons.server-side.js',                  
                ),

            ),
        ),
    ),
    'token' => array(
        'current' => array(
            'title' => 'Token List',
            'view'   => 'token/current',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/token/add.js',
                        'js/custom/token/transfer.js',
                        // 'js/custom/token/delete.js',
                    ),

                ),
            ),
            'card' => array(
                'title' => 'Active Tokens',
                'assets' => array(
                    'custom' => array(
                        'js'  => array(
                            'plugins/custom/tinymce/tinymce.bundle.js',
                            'js/custom/token/add_note.js',
                            'js/custom/token/add_reason_for_visit.js',
                        ),
                    ),
                ),
            ),
        ),
        'auto' => array(
            'title' => 'Auto Token',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),

        'report' => array(
            'title' => 'Tokens Report',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/token/transfer.js',
                        // 'vendor/datatables/buttons.server-side.js',
                    ),
                ),
            ),
        ),
        'performance' => array(
            'title' => 'Officer Performance',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        // 'js/custom/token/delete.js',
                        // 'vendor/datatables/buttons.server-side.js',
                    ),
                ),
            ),
        ),
    ),
    'company' => array(
        'view' => array(
            '*' => array(
                'title'  => 'View Company Details',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            // 'js/custom/user-management/roles/view/view.js',
                            // 'js/custom/user-management/roles/view/update-role.js',

                        ),
                    ),
                ),
            )
        ),
        'list' => array(
            'title'  => 'Company List',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        // 'js/custom/user-management/roles/list/update-role.js',
                        // 'js/custom/user-management/roles/list/add.js',
                        // 'js/custom/user-management/roles/list/delete.js',

                    ),
                ),
            ),
        ),
    ),
    'category' => array(
        'view' => array(
            '*' => array(
                'title'  => 'View Category Details',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            // 'js/custom/user-management/roles/view/view.js',
                            // 'js/custom/user-management/roles/view/update-role.js',

                        ),
                    ),
                ),
            )
        ),
        'list' => array(
            'title'  => 'Category List',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        // 'js/custom/user-management/roles/list/update-role.js',
                        // 'js/custom/user-management/roles/list/add.js',
                        // 'js/custom/user-management/roles/list/delete.js',

                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        'list' => array(
            '*' => array(
                'title'  => 'Location List',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            // 'js/custom/user-management/roles/view/view.js',
                            // 'js/custom/user-management/roles/view/update-role.js',

                        ),
                    ),
                ),
            )
        ),
        'view' => array(
            '*' => array(
                'title'  => 'View Location Details',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            // 'js/custom/user-management/roles/view/view.js',
                            // 'js/custom/user-management/roles/view/update-role.js',

                        ),
                    ),
                ),
            )
        ),
        'department' => array(
            '*' => array(
                'title'  => 'Departments',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            'js/custom/department/add.js',

                        ),
                    ),
                ),
            )
        ),
        'counter' => array(
            '*' => array(
                'title'  => 'Counters',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            'js/custom/counter/add.js',
                            'js/custom/counter/delete.js',
                            // 'vendor/datatables/buttons.server-side.js',
                        ),
                    ),
                ),
            ),
        ),
        'token' => array(
            'setting' => array(
                '*' => array(
                    'title' => 'Token Queue Configuration',
                    'assets' => array(
                        'custom' => array(
                            'css' => array(
                                'plugins/custom/datatables/datatables.bundle.css',
                            ),
                            'js'  => array(
                                'plugins/custom/datatables/datatables.bundle.js',
                            ),
                        ),
                    ),
                ),
            ),

        ),
        'settings' => array(
            'title' => 'App Settings',
            'display' => array(
                '*' => array(
                    'title' => 'Display Settings',
                    'assets' => array(
                        'custom' => array(
                            'js'  => array(
                                'plugins/custom/datatables/datatables.bundle.js',
                            ),
                        ),
                    ),
                ),
            )
        ),
        'staff' => array(
            '*' => array(
                'title'  => 'Staff List',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            // 'js/custom/department/add.js',

                        ),
                    ),
                ),
            )
        ),
        'visitreason' => array(
            '*' => array(
                'title'  => 'Reason for Visit',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            // 'js/custom/department/add.js',

                        ),
                    ),
                ),
            )
        ),
        'openhours' => array(
            '*' => array(
                'title'  => 'Opening Hours',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/flatpickr/flatpickr.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/flatpickr/flatpickr.bundle.js',
                            // 'js/custom/department/add.js',

                        ),
                    ),
                ),
            )
        ),
        'services' => array(
            '*' => array(
                'title'  => 'Services',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js' => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            // 'js/custom/department/add.js',

                        ),
                    ),
                ),
            )
        ),
    ),
    // 'home' => array(
    //     'title' => 'Home',
    //     'home' => array(
    //         '*' => array(
    //             'title'  => 'Home',                
    //         )
    //     ),
    //     'search' => array(
    //         '*' => array(
    //             'title'  => 'Join the Queue',                
    //         )
    //     ),
    //     'current' => array(
    //         '*' => array(
    //             'title'  => 'Your Token',                
    //         )
    //     ),
    //     // 'search' => array(
    //     //     '*' => array(
    //     //         'title'  => 'Location List',                
    //     //     )
    //     // ),
      
    // ),
    //  'in' => array(
    //     'title' => 'Search',

    //     '*' => array(
    //         'title' => 'Search',
    //     ),

    // ),
    // 'settings' => array(
    //     'title' => 'App Settings',
    //     'display' => array(
    //         'title' => 'Display Settings',
    //         'assets' => array(
    //             'custom' => array(
    //                 'js'  => array(
    //                     'plugins/custom/datatables/datatables.bundle.js',
    //                 ),

    //             ),
    //         ),
    //     )
    // ),
    // 'home' => array(
    //     'title' => 'Home',

    //     'home' => array(
    //         'title' => 'Client Token',
    //         // 'assets' => array(
    //         //     'custom' => array(
    //         //         'js'  => array(
    //         //             'js/custom/home/client-token.js',
    //         //         ),

    //         //     ),
    //         // ),
    //     ),
    //     'current' => array(
    //         'title' => 'Your Token'
    //     ),
    //     'search' => array(
    //         'title' => 'Join the Queue'
    //     )
    // ),

    // 'in' => array(
    //     'title' => 'Search',

    //     '*' => array(
    //         'title' => 'Search',
    //     ),

    // ),

    'settings' => array(
        'system' => array(
            'title'  => 'System Configuration',
            'view'   => 'pages/settings/setting',
        ),
    ),
    'apps' => array(
        'calendar' => array(
            'title'  => 'Appointment Scheduler',
            'view'   => 'apps/calendar',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/fullcalendar/fullcalendar.bundle.css',
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/fullcalendar/fullcalendar.bundle.js',
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/widgets.js',
                        'js/custom/apps/calendar/calendar.js'
                    ),

                ),
            ),
        ),
        'user-management' => array(
            'permissions' => array(
                'title' => 'Permissions List',
                'view'  =>  'user-management/permissions',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js'  => array(
                            // 'js/custom/user-management/permissions/list.js',
                            // 'js/custom/user-management/permissions/add-permission.js',
                            // 'js/custom/user-management/permissions/update-permission.js',
                            'plugins/custom/datatables/datatables.bundle.js',
                        ),

                    ),
                ),
            ),
            'users' => array(
                'view' => array(
                    'title'  => 'View User Details',
                    'assets' => array(
                        'custom' => array(
                            'css' => array(
                                'plugins/custom/datatables/datatables.bundle.css',
                            ),
                            'js' => array(
                                'plugins/custom/datatables/datatables.bundle.js',
                                // 'js/custom/user-management/users/view/view.js',
                                // 'js/custom/user-management/users/view/update-details.js',
                                // 'js/custom/user-management/users/view/add-schedule.js',
                                // 'js/custom/user-management/users/view/add-task.js',
                                // 'js/custom/user-management/users/view/update-email.js',
                                // 'js/custom/user-management/users/view/update-password.js',
                                // 'js/custom/user-management/users/view/update-role.js',
                                // 'js/custom/user-management/users/view/add-auth-app.js',
                                // 'js/custom/user-management/users/view/add-one-time-password.js',
                            ),
                        ),
                    ),
                ),
                'edit' => array(
                    '*' => array(
                        'title'  => 'Edit User Details',
                        'assets' => array(
                            'custom' => array(
                                'css' => array(
                                    'plugins/custom/datatables/datatables.bundle.css',
                                ),
                                'js' => array(
                                    'plugins/custom/datatables/datatables.bundle.js',
                                    // 'js/custom/user-management/users/view/view.js',
                                    // 'js/custom/user-management/users/view/update-details.js',
                                    // 'js/custom/user-management/users/view/add-schedule.js',
                                    // 'js/custom/user-management/users/view/add-task.js',
                                    // 'js/custom/user-management/users/view/update-email.js',
                                    // 'js/custom/user-management/users/view/update-password.js',
                                    // 'js/custom/user-management/users/view/update-role.js',
                                    // 'js/custom/user-management/users/view/add-auth-app.js',
                                    // 'js/custom/user-management/users/view/add-one-time-password.js',
                                ),
                            ),
                        ),
                    )
                ),
                'list' => array(
                    'title'  => 'Users List',
                    'assets' => array(
                        'custom' => array(
                            'css' => array(
                                'plugins/custom/datatables/datatables.bundle.css',
                            ),
                            'js' => array(
                                'plugins/custom/datatables/datatables.bundle.js',
                                // 'vendor/datatables/buttons.server-side.js',
                                // 'js/custom/user-management/users/list/table.js',
                                // 'js/custom/user-management/users/list/export-users.js',
                                // 'js/custom/user-management/users/list/add.js',

                            ),
                        ),
                    ),
                ),
            ),
            'roles' => array(
                'view' => array(
                    '*' => array(
                        'title'  => 'View Role Details',
                        'assets' => array(
                            'custom' => array(
                                'css' => array(
                                    'plugins/custom/datatables/datatables.bundle.css',
                                ),
                                'js' => array(
                                    'plugins/custom/datatables/datatables.bundle.js',
                                    // 'js/custom/user-management/roles/view/view.js',
                                    // 'js/custom/user-management/roles/view/update-role.js',

                                ),
                            ),
                        ),
                    )
                ),
                'list' => array(
                    'title'  => 'Roles List',
                    'assets' => array(
                        'custom' => array(
                            'css' => array(
                                'plugins/custom/datatables/datatables.bundle.css',
                            ),
                            'js' => array(
                                'plugins/custom/datatables/datatables.bundle.js',
                                // 'js/custom/user-management/roles/list/update-role.js',
                                'js/custom/user-management/roles/list/add.js',
                                'js/custom/user-management/roles/list/delete.js',

                            ),
                        ),
                    ),
                ),

            )

        ),
    ),
    'alerts' => array(
        'list' => array(
            'title' => 'Alerts',
            'view' => 'list',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/flatpickr/flatpickr.bundle.css',
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/flatpickr/flatpickr.bundle.js',
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),

    ),
    // Documentation pages
    'documentation' => array(
        '*' => array(
            'assets' => array(
                'vendors' => array(
                    'css' => array(
                        'plugins/custom/prismjs/prismjs.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/prismjs/prismjs.bundle.js',
                    ),
                ),
                'custom'  => array(
                    'js' => array(
                        'js/custom/documentation/documentation.js',
                    ),
                ),
            ),

            'layout' => array(
                'base'    => 'docs', // Set base layout: default|docs

                // Content
                'content' => array(
                    'width'  => 'fixed', // Set fixed|fluid to change width type
                    'layout' => 'documentation'  // Set content type
                ),
            ),
        ),

        'getting-started' => array(
            'overview' => array(
                'title'       => 'Overview',
                'description' => '',
                'view'        => 'documentation/getting-started/overview',
            ),

            'build' => array(
                'title'       => 'Gulp',
                'description' => '',
                'view'        => 'documentation/getting-started/build/build',
            ),

            'multi-demo' => array(
                'overview' => array(
                    'title'       => 'Overview',
                    'description' => '',
                    'view'        => 'documentation/getting-started/multi-demo/overview',
                ),
                'build'    => array(
                    'title'       => 'Multi-demo Build',
                    'description' => '',
                    'view'        => 'documentation/getting-started/multi-demo/build',
                ),
            ),

            'file-structure' => array(
                'title'       => 'File Structure',
                'description' => '',
                'view'        => 'documentation/getting-started/file-structure',
            ),

            'customization' => array(
                'sass'       => array(
                    'title'       => 'SASS',
                    'description' => '',
                    'view'        => 'documentation/getting-started/customization/sass',
                ),
                'javascript' => array(
                    'title'       => 'Javascript',
                    'description' => '',
                    'view'        => 'documentation/getting-started/customization/javascript',
                ),
            ),

            'dark-mode' => array(
                'title' => 'Dark Mode Version',
                'view'  => 'documentation/getting-started/dark-mode',
            ),

            'rtl' => array(
                'title' => 'RTL Version',
                'view'  => 'documentation/getting-started/rtl',
            ),

            'troubleshoot' => array(
                'title' => 'Troubleshoot',
                'view'  => 'documentation/getting-started/troubleshoot',
            ),

            'changelog' => array(
                'title'       => 'Changelog',
                'description' => 'version and update info',
                'view'        => 'documentation/getting-started/changelog/changelog',
            ),

            'updates' => array(
                'title'       => 'Updates',
                'description' => 'components preview and usage',
                'view'        => 'documentation/getting-started/updates',
            ),

            'references' => array(
                'title'       => 'References',
                'description' => '',
                'view'        => 'documentation/getting-started/references',
            ),
        ),

        'general' => array(
            'datatables'   => array(
                'overview' => array(
                    'title'       => 'Overview',
                    'description' => 'plugin overview',
                    'view'        => 'documentation/general/datatables/overview/overview',
                ),
            ),
            'remove-demos' => array(
                'title'       => 'Remove Demos',
                'description' => 'How to remove unused demos',
                'view'        => 'documentation/general/remove-demos/index',
            ),
        ),

        'configuration' => array(
            'general'     => array(
                'title'       => 'General Configuration',
                'description' => '',
                'view'        => 'documentation/configuration/general',
            ),
            'menu'        => array(
                'title'       => 'Menu Configuration',
                'description' => '',
                'view'        => 'documentation/configuration/menu',
            ),
            'page'        => array(
                'title'       => 'Page Configuration',
                'description' => '',
                'view'        => 'documentation/configuration/page',
            ),
            'npm-plugins' => array(
                'title'       => 'Add NPM Plugin',
                'description' => 'Add new NPM plugins and integrate within webpack mix',
                'view'        => 'documentation/configuration/npm-plugins',
            ),
        ),
    ),
);
