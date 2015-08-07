#!/bin/bash
projectDir=${1}


echo "
<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));
//define('ZF_CLASS_CACHE', 'data/cache/classes.php.cache'); if (file_exists(ZF_CLASS_CACHE)) require_once ZF_CLASS_CACHE;

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url(\$_SERVER['REQUEST_URI'***REMOVED***, PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
" > $projectDir/public/index.php

echo "
vendor/*
data/DoctrineModule/cache/*
data/DoctrineORMModule/Proxy/*
data/cache/configcache/*
data/logs/*
build/*
composer.phar
.buildpath
.project
" > .gitignore