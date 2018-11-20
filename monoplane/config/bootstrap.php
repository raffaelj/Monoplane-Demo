<?php

// $app->monoplane['version'] = time();// for CSS reload while developing
$app->monoplane['version'] = '0.1.0';

// set slug name, default: '_id'
$app->monoplane['slug'] = 'slug';

// set startpage
$app->monoplane['startpage'] = 'info';

// site definitions via singleton
$options = [
  'lang' => $app->param('lang') ?? ($_SESSION['lang'] ?? null)
];
$app->monoplane['site'] = $app->module('singletons')->getData('config', $options);

// set definitions for contact form
$app->monoplane['contactform'] = [
    'form'  => 'contact',
    'route' => '/contact',
    'anchor' => '#contact',
    'session_expire' => 120
];

// width of featured image
$app->monoplane['featured_image_width'] = 500;

// select theme
// $app->monoplane['theme'] = 'raffaelj';
$app->monoplane['theme'] = 'sakura';
// $app->monoplane['theme'] = 'classless-creative-portfolio';
// $app->monoplane['theme'] = 'classless-wardrobe';

// custom CSS
$app->monoplane['customcss'] = '
a.logo:hover {
  border:none;
}
a.logo img {
  -webkit-transition: background-image .2s ease-in-out;
  transition: background-image .2s ease-in;
}
a.logo img:hover {
  background-image: url(' . BASE_URL . '/' . ADMINFOLDER . '/storage/uploads/2018/11/18/5bf1cc148a410monoplane-logo_bg.svg);
  background-size: contain;
  -webkit-transition: background-image .2s ease-in-out;
  transition: background-image .2s ease-in;
}
';
