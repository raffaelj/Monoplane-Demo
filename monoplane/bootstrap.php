<?php

// defines
if (file_exists('defines.php')) include('defines.php');

// Monoplane defines
if (!defined('ADMINFOLDER'))        define('ADMINFOLDER', 'cockpit');

// monoplane is in root or in subdir of root
if (!defined('BASE_ROOT'))          define('BASE_ROOT', str_replace(DIRECTORY_SEPARATOR, '/', realpath(file_exists(__DIR__.'/index.php') ? dirname(__DIR__) : dirname(dirname(__DIR__)))));
if (!defined('DOCS_ROOT'))          define('DOCS_ROOT', str_replace(DIRECTORY_SEPARATOR, '/', realpath(file_exists(__DIR__.'/index.php') ? __DIR__ : dirname(__DIR__))));
$BASE_URL = dirname(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH));
if (!defined('BASE_URL'))           define('BASE_URL', $BASE_URL === '/' ? '' : $BASE_URL); // needs check if isset SCRIPT_NAME...
if (!defined('ROUTE')) define('ROUTE', preg_replace('#'.preg_quote(BASE_URL, '#').'#', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1));


// defines
if (file_exists(__DIR__.'/cockpit_defines.php')) include(__DIR__.'/cockpit_defines.php');

// include cockpit
require_once(realpath(dirname(__DIR__)) . '/' . ADMINFOLDER . '/bootstrap.php');

$cockpit->set('route', ROUTE);
$cockpit->set('base_url', BASE_URL);// pathToUrl() with ":" and @base
$cockpit->set('base_route', BASE_URL);// for reroute() and route
$cockpit->set('docs_root', DOCS_ROOT . '/');// for pathToUrl() without ":", assets ('#uploads' etc.)

// set path
$cockpit->path('views', __DIR__ . '/views');
$cockpit->path('themes', __DIR__ . '/themes');

// pass custom layout file to LimeExtra
$cockpit->layout = 'views:default.php';


// $cockpit->registerModule('monoplane', __DIR__);

// include Controller
require_once('Controller/Monoplane.php');

// include binds
include('binds.php');

// include layout events
include('events.php');

// create empty method to prevent overloading, can be filled via index.php
$cockpit->monoplane = [
    'slug' => null,
    'site' => [],
    'theme' => null,
    'pages' => null
];

// init + load i18n
$cockpit('i18n')->locale = $cockpit->retrieve('i18n', 'en');
// $locale = $cockpit->module('cockpit')->getUser('i18n', $cockpit('i18n')->locale);
$locale = $cockpit->param('lang') ?? ($_SESSION['lang'] ?? null);

if ($translationspath = $cockpit->path(__DIR__ . "/config/i18n/{$locale}.php")) {
    $cockpit('i18n')->locale = $locale;
    $cockpit('i18n')->load($translationspath, $locale);
}
// load i18n from FormValidation addon
if ($translationspath = $cockpit->path("#config:formvalidation/i18n/{$locale}.php")) {
    $cockpit('i18n')->locale = $locale;
    $cockpit('i18n')->load($translationspath, $locale);
}

$cockpit->module('cockpit')->extend([
    'thumb' => function($options) {

        $thumb_url = $this->app->module('cockpit')->thumbnail($options);

        return BASE_URL . mb_substr($thumb_url, mb_strlen($this->app['site_url']));

    }
]);


// echo '<pre>' . print_r(realpath($_SERVER['DOCUMENT_ROOT']), true) . '</pre>';
// echo '<pre>' . print_r(get_defined_constants(true)['user'], true) . '</pre>';
// echo '<pre>' . print_r($cockpit->config, true) . '</pre>';
// $vars = [
    // 'route' => $cockpit['route'],
    // 'base_url' => $cockpit['base_url'],
    // 'base_route' => $cockpit['base_route'],
    // 'base_host' => $cockpit['base_host'],
    // 'base_port' => $cockpit['base_port'],
    // 'docs_root' => $cockpit['docs_root'],
    // 'site_url' => $cockpit['site_url'],
// ];

// echo '<pre>' . print_r($vars, true) . '</pre>';

