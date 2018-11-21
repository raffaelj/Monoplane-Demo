<?php

// default data
// overwrite it in `monoplane/config/bootstrap.php`

$app->monoplane = [
    'slug' => '_id',
    'site' => [],
    'theme' => 'raffaelj',
    'pages' => 'pages',
    'startpage' => '5bed483433386215d8000260',// id of page
    'customcss' => '',
    'contactform' => [
        'form'  => 'contact',
        'route' => '/5bef13e3333862070c000361',// "_id" slug
        'anchor' => '#contact',
        'session_expire' => 120
    ],
    'featured_image_width' => 500,
];
