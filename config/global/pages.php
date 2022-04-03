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

    'admin' => array(
        'sms' => array(
            'title' => 'SMS History',
            'view' => 'admin/sms',
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
        'token' => array(
            'current' => array(
                'title' => 'Token List',
                'view'   => 'admin/token/current',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js'  => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            'js/custom/admin/token/add.js',
                            'js/custom/admin/token/transfer.js',
                            // 'js/custom/admin/token/delete.js',
                        ),

                    ),
                ),
                'card' => array(
                    'title' => 'Active Tokens',
                ),
            ),
            'auto' => array(
                'title' => 'Auto Token'
            ),
            'setting' => array(
                'title' => 'Auto Queue Settings'
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
                            'js/custom/admin/token/transfer.js',
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
                            // 'js/custom/admin/token/delete.js',
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
        'department' => array(
            'title'  => 'Departments',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admin/department/add.js',
                        // 'js/custom/admin/department/edit.js',
                        // 'js/custom/admin/department/delete.js',
                        // 'vendor/datatables/buttons.server-side.js',
                    ),
                ),
            ),
        ),
        'counter' => array(
            'title'  => 'Counters',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js' => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admin/counter/add.js',
                        'js/custom/admin/counter/delete.js',
                        // 'vendor/datatables/buttons.server-side.js',
                    ),
                ),
            ),
        ),
        'settings' => array(
            'title' => 'App Settings',
            'display' => array(
                'title' => 'Display Settings',
                'assets' => array(
                    'custom' => array(
                        'js'  => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                        ),

                    ),
                ),
            )
        ),
        'home' => array(
            'title' => 'Home',

            'home' => array(
                'title' => 'Client Token',
                'assets' => array(
                    'custom' => array(
                        'js'  => array(
                            'js/custom/admin/home/client-token.js',
                        ),

                    ),
                ),
            ),
            'current' => array(
                'title' => 'Your Token'
            )
        )

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
