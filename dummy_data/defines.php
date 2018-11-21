<?php

// Windows environment in subdir: http://localhost/dir/cockpit
if (strpos(__DIR__, ':\\', 1)) { // is windows environment
    
    $COCKPIT_SITE_DIR = realpath(dirname(dirname(__DIR__)));
    
    if (strlen($COCKPIT_SITE_DIR) == 3) {

        if (!defined('COCKPIT_SITE_DIR')) define('COCKPIT_SITE_DIR', substr($COCKPIT_SITE_DIR, 0, 2)); // E:

    } else {

        if (!defined('COCKPIT_SITE_DIR')) define('COCKPIT_SITE_DIR', str_replace(DIRECTORY_SEPARATOR, '/', $COCKPIT_SITE_DIR)); // E:/git

    }

}
