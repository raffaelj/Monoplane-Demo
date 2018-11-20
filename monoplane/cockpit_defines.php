<?php

if (strpos(__DIR__, ':\\', 1)) { // is windows environment
    
    // Cockpit defines
    // if (!defined('COCKPIT_DIR'))        define('COCKPIT_DIR', DOCS_ROOT . BASE_URL . '/' . ADMINFOLDER);
    if (!defined('COCKPIT_DIR'))        define('COCKPIT_DIR', DOCS_ROOT . '/' . ADMINFOLDER);
    if (!defined('COCKPIT_BASE_URL'))   define('COCKPIT_BASE_URL', BASE_URL . '/' . ADMINFOLDER);
    if (!defined('COCKPIT_BASE_ROUTE')) define('COCKPIT_BASE_ROUTE', COCKPIT_BASE_URL);
    if (!defined('COCKPIT_DOCS_ROOT'))  define('COCKPIT_DOCS_ROOT', COCKPIT_DIR);
    // if (!defined('COCKPIT_DOCS_ROOT'))  define('COCKPIT_DOCS_ROOT', 'test');

    // $COCKPIT_SITE_DIR = dirname(dirname(__DIR__));
    // if (!defined('COCKPIT_SITE_DIR')) define('COCKPIT_SITE_DIR', str_replace(DIRECTORY_SEPARATOR, '/', $COCKPIT_SITE_DIR)); // E:/git

}