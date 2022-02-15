<?php
return array(
    // Product
    'product' => array(
        'name'        => 'SmartQ',
        'description' => 'SmartQ - Queue Maanagement System',
        'preview'     => 'https://smartq.marquisvirgo.com',
        'home'        => 'https://smartq.marquisvirgo.com',
        'purchase'    => 'https://smartq.marquisvirgo.com',
        'licenses'    => array(
            'terms' => 'https://smartq.marquisvirgo.com',
            'types' => array(
                array(
                    'title'       => 'Regular License',
                    'description' => 'For single end product used by you or one client',
                    'tooltip'     => 'Use, by you or one client in a single end product which end users are not charged for',
                    'price'       => '39',
                ),
                array(
                    'title'       => 'Extended License',
                    'description' => 'For single SaaS app with paying users',
                    'tooltip'     => 'Use, by you or one client, in a single end product which end users can be charged for.',
                    'price'       => '939',
                ),
            ),
        ),
        'demos'       => array(
            'demo1' => array(
                'title'       => 'Demo 1',
                'description' => 'Default Dashboard',
                'published'   => true,
                'thumbnail'   => 'demos/demo1.png',
            ),

        ),
    ),

    // Meta
    'meta'    => array(
        'title'       => 'SmartQ - Dymanic Queue Management Web Application',
        'description' => 'Life\'s too short to wait in lines, book you next appointment with SmartQ QMS',
        'keywords'    => 'mobile queue manager, queue manager caribbean, queue management jamaica, queue management system caribbean',
        'canonical'   => 'https://smartq.marquisvirgo.com/',
    ),

    // General
    'general' => array(
        'website'             => 'https://marquisvirgo.com',
        'about'               => 'https://marquisvirgo.com',
        'contact'             => 'mailto:support@marquisvirgo.com',
        'support'             => 'https://marquisvirgo.com/support',
        'bootstrap-docs-link' => 'https://getbootstrap.com/docs/5.0',
        'licenses'            => 'https://keenthemes.com/licensing',
        'social-accounts'     => array(
            array(
                'name' => 'Youtube', 'url' => 'https://www.youtube.com/c/KeenThemesTuts/videos', 'logo' => 'svg/social-logos/youtube.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Github', 'url' => 'https://github.com/KeenthemesHub', 'logo' => 'svg/social-logos/github.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Twitter', 'url' => 'https://twitter.com/keenthemes', 'logo' => 'svg/social-logos/twitter.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Instagram', 'url' => 'https://www.instagram.com/keenthemes', 'logo' => 'svg/social-logos/instagram.svg', "class" => "h-20px",
            ),

            array(
                'name' => 'Facebook', 'url' => 'https://www.facebook.com/keenthemes', 'logo' => 'svg/social-logos/facebook.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Dribbble', 'url' => 'https://dribbble.com/keenthemes', 'logo' => 'svg/social-logos/dribbble.svg', "class" => "h-20px",
            ),
        ),
    ),

    // Layout
    'layout'  => array(
        // Docs
        'docs'          => array(
            'logo-path'  => array(
                'default' => 'logos/logo-1.svg',
                'dark'    => 'logos/logo-1-dark.svg',
            ),
            'logo-class' => 'h-25px',
        ),

        // Illustration
        'illustrations' => array(
            'set' => 'sketchy-1',
        ),

        // Engage
        'engage'        => array(
            'demos'    => array(
                'enabled'   => true,
                'direction' => 'end',
            ),
            'explore'  => array(
                'enabled'   => true,
                'direction' => 'end',
            ),
            'help'     => array(
                'enabled'   => true,
                'direction' => 'end',
            ),
            'purchase' => array(
                'enabled' => true,
            ),
        ),
    ),

);
