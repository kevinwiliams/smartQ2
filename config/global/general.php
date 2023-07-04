<?php
return array(
    // Product
    'product' => array(
        'name'        => 'WaitWise',
        'description' => 'WaitWise - Queue Maanagement System',
        'preview'     => 'https://app.waitwise.io',
        'home'        => 'https://app.waitwise.io',
        'purchase'    => 'https://app.waitwise.io',
        'licenses'    => array(
            'terms' => 'https://app.waitwise.io',
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
            'qsmart' => array(
                'title'       => 'Demo 1',
                'description' => 'Default Dashboard',
                'published'   => true,
                'thumbnail'   => 'demos/qsmart.png',
            ),

        ),
    ),

    // Meta
    'meta'    => array(
        'title'       => 'WaitWise - Dymanic Queue Management Web Application',
        'description' => 'Life\'s too short to wait in lines, book you next appointment with WaitWise QMS',
        'keywords'    => 'mobile queue manager, queue manager caribbean, queue management jamaica, queue management system caribbean',
        'canonical'   => 'https://app.waitwise.io/',
    ),

    // General
    'general' => array(
        'website'             => 'https://waitwise.io',
        'about'               => 'https://waitwise.io',
        'contact'             => 'mailto:support@waitwise.io',
        'support'             => 'https://waitwise.io/support',
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
                'default' => 'logos/sqlogo-ww1.svg',
                'dark'    => 'logos/sqlogo-ww1-dark.svg',
            ),
            'logo-class' => 'h-25px',
        ),

        // Illustration
        'illustrations' => array(
            'set' => 'dozzy-1',
        ),

        // Engage
        'engage'        => array(
            'demos'    => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'explore'  => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'help'     => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'purchase' => array(
                'enabled' => false,
            ),
        ),
    ),

);
