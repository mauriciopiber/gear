<?php

$config = require_once __DIR__.'/../env.config.php';

return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => sprintf('mysql:dbname=%s;host=%s', $config['database'***REMOVED***, $config['host'***REMOVED***),
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'eventmanager' => 'orm_default',
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => $config['host'***REMOVED***,
                    'port' => '3306',
                    'dbname' => $config['database'***REMOVED***,
                    'charset' => 'utf8'
                )
            )
        ),
        'configuration' => array(
        	'orm_default' => array(
        	    'metadata_cache' => 'filesystem', // 2
        	    'query_cache' => 'filesystem', // 3
        	    'result_cache' => 'filesystem', // 4
        	    'hydration_cache' => 'filesystem', // 5
            )
        ),
    ),
    'phinx' => array(
        'adapter' => 'mysql',
        'host' => $config['host'***REMOVED***,
        'name'=> 'seller'
    ),
    'jenkins' => [
        'integrate' => [
            'git' => 'git@bitbucket.org:mauriciopiber/gear.git',
            'label' => 'Gear',
            'name' => 'gear',
            'folder' => '/var/www/gear'
        ***REMOVED***
    ***REMOVED***,
    'zfctwig' => [
        'environment_options' => [
            'debug' => true,
        ***REMOVED***
    ***REMOVED***
);
