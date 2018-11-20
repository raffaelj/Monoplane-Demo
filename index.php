<?php

session_start();

/*
  add custom defines here
*/

// load monoplane
require_once('./monoplane/bootstrap.php');

/*
  change settings, overwrite something... here
*/

// site definitions via singleton
$options = [
  'lang' => $cockpit->param('lang') ?? ($_SESSION['lang'] ?? null)
];
$cockpit->monoplane['site'] = $cockpit->module('singletons')->getData('config', $options);

// set slug name, default: '_id'
$cockpit->monoplane['slug'] = 'slug';

// select theme
// $cockpit->monoplane['theme'] = 'raffaelj';
$cockpit->monoplane['theme'] = 'sakura';
// $cockpit->monoplane['theme'] = 'classless-creative-portfolio';
// $cockpit->monoplane['theme'] = 'classless-wardrobe';

$cockpit->monoplane['version'] = time();// for CSS reload debug

// custom CSS
$cockpit->monoplane['customcss'] = '
a.logo img{
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


// set definitions for contact form
$cockpit->monoplane['contactform'] = [
    'form'  => 'contact',
    'route' => '/contact',
    // 'route' => '/5bef13e3333862070c000361',
    'anchor' => '#contact',
    'session_expire' => 120
];

$cockpit->monoplane['featured_image_width'] = 500;

// run app
$cockpit->run();
