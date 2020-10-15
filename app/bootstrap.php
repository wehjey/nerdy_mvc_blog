<?php

/**
 * Framework bootstrap file
 */

// Load config file
require_once 'config/app.php';
require_once 'config/database.php';
require_once 'helpers/url_helpers.php';

// Autoload core libraries
spl_autoload_register(
    function ($className) {
        require_once 'libs/'. $className. '.php';
    }
);