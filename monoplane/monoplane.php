<?php

// include custom defines
if (file_exists('defines.php')) include('defines.php');

// Monoplane defines
if (!defined('ADMINFOLDER'))        define('ADMINFOLDER', 'cockpit');

if (!defined('MONOPLANE_ROOT'))     define('MONOPLANE_ROOT', str_replace(DIRECTORY_SEPARATOR, '/', realpath(__DIR__)));
if (!defined('DOCS_ROOT'))          define('DOCS_ROOT', dirname(MONOPLANE_ROOT));
if (!defined('BASE_ROOT'))          define('BASE_ROOT', dirname(DOCS_ROOT));

$BASE_URL = dirname(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH));
if (!defined('BASE_URL'))           define('BASE_URL', $BASE_URL === '/' ? '' : $BASE_URL);
if (!defined('ROUTE')) define('ROUTE', preg_replace('#'.preg_quote(BASE_URL, '#').'#', '', parse_url(@$_SERVER['REQUEST_URI'], PHP_URL_PATH), 1));// suppress warning in cli install script with "@"


// include custom cockpit defines for weird symlinked windows environments
if (file_exists(__DIR__.'/cockpit_defines.php')) include(__DIR__.'/cockpit_defines.php');


// include cockpit, now `$cockpit` and `cockpit()` are available
if (file_exists(DOCS_ROOT . '/' . ADMINFOLDER . '/bootstrap.php')) {
    require_once(DOCS_ROOT . '/' . ADMINFOLDER . '/bootstrap.php');
} else {
    echo "Cockpit doesn't exist.";
    die;
}

// register monoplane modules
$cockpit->loadModules(__DIR__.'/modules');
