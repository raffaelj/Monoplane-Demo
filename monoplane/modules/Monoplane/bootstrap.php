<?php

// overwrite registry values to match root path
$app->set('route',      ROUTE);
$app->set('base_url',   BASE_URL);        // pathToUrl() with ":" and @base
$app->set('base_route', BASE_URL);        // for reroute() and route()
$app->set('docs_root',  DOCS_ROOT . '/'); // for pathToUrl() without ":", assets ('#uploads' etc.)

// set path
$app->path('views',   __DIR__ . '/views');
$app->path('themes',  __DIR__ . '/themes');
$app->path('root',    MONOPLANE_ROOT);

// pass custom layout file to LimeExtra
$app->layout = 'views:default.php';


// include Controller
require_once('Controller/Monoplane.php');

// include binds, events and defaults
include('binds.php');
include('events.php');
include('defaults.php');


// init + load i18n
$app('i18n')->locale = $app->retrieve('i18n', 'en');
$locale = $app->param('lang') ?? ($_SESSION['lang'] ?? null);

if ($translationspath = $app->path(MONOPLANE_ROOT . "/config/i18n/{$locale}.php")) {
    $app('i18n')->locale = $locale;
    $app('i18n')->load($translationspath, $locale);
}
// load i18n from FormValidation addon
if ($translationspath = $app->path("#config:formvalidation/i18n/{$locale}.php")) {
    $app('i18n')->locale = $locale;
    $app('i18n')->load($translationspath, $locale);
}


$app->module('monoplane')->extend([

    'thumbnail' => function($options) {

        // return relative path of thumbnail

        $thumb_url = $this->app->module('cockpit')->thumbnail($options);

        return BASE_URL . mb_substr($thumb_url, mb_strlen($this->app['site_url']));

    }

]);

// load custom bootstrap.php to overwrite default options
if ($custombootfile = $app->path('root:config/bootstrap.php')) {
    include($custombootfile);
}


// echo '<pre>' . print_r(realpath($_SERVER['DOCUMENT_ROOT']), true) . '</pre>';
// echo '<pre>' . print_r(get_defined_constants(true)['user'], true) . '</pre>';
// echo '<pre>' . print_r($app, true) . '</pre>';
// echo '<pre>' . print_r($app->paths(), true) . '</pre>';
// echo '<pre>' . print_r($app->config, true) . '</pre>';
// $vars = [
    // 'route' => $app['route'],
    // 'base_url' => $app['base_url'],
    // 'base_route' => $app['base_route'],
    // 'base_host' => $app['base_host'],
    // 'base_port' => $app['base_port'],
    // 'docs_root' => $app['docs_root'],
    // 'site_url' => $app['site_url'],
// ];

// echo '<pre>' . print_r($vars, true) . '</pre>';

