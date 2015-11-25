<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

class Env {

    public static $dev = 'gear.dev';

    public static function define() {
        $environment = getenv('PHINX_ENVIRONMENT');

        if (empty($environment)) {
            define('PHINX_ENVIRONMENT', 'development');
            return;
        }

        if (!in_array($environment, ['development', 'testing'***REMOVED***)) {
            throw new \Exception('Não é seguro iniciar o sistema com o enviroment definido incorretamente: '.$environment);
        }

        define('PHINX_ENVIRONMENT', $environment);
        return;

    }
}


Env::define();

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'***REMOVED***, PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
