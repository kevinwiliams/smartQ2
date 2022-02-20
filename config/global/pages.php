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
                'js' => array(),
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
                'view'  =>  'apps/user-management/permissions',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js'  => array(
                            'js/custom/apps/user-management/permissions/list.js',
                            'js/custom/apps/user-management/permissions/add-permission.js',
                            'js/custom/apps/user-management/permissions/update-permission.js',
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
                                'js/custom/apps/user-management/users/view/view.js',
                                'js/custom/apps/user-management/users/view/update-details.js',
                                'js/custom/apps/user-management/users/view/add-schedule.js',
                                'js/custom/apps/user-management/users/view/add-task.js',
                                'js/custom/apps/user-management/users/view/update-email.js',
                                'js/custom/apps/user-management/users/view/update-password.js',
                                'js/custom/apps/user-management/users/view/update-role.js',
                                'js/custom/apps/user-management/users/view/add-auth-app.js',
                                'js/custom/apps/user-management/users/view/add-one-time-password.js',

                            ),
                        ),
                    ),
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
                                'js/custom/apps/user-management/users/list/table.js',
                                'js/custom/apps/user-management/users/list/export-users.js',
                                'js/custom/apps/user-management/users/list/add.js',

                            ),
                        ),
                    ),
                ),
            ),
            'roles' => array(
                'view' => array(
                    'title'  => 'View Role Details',
                    'assets' => array(
                        'custom' => array(
                            'css' => array(
                                'plugins/custom/datatables/datatables.bundle.css',
                            ),
                            'js' => array(
                                'plugins/custom/datatables/datatables.bundle.js',
                                'js/custom/apps/user-management/users/roles/view.js',
                                'js/custom/apps/user-management/users/roles/update-role.js',

                            ),
                        ),
                    ),
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
                                'js/custom/apps/user-management/users/roles/update-role.js',
                                'js/custom/apps/user-management/users/roles/add.js',

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
