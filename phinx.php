<?php
return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/{data/migrations,vendor/mauriciopiber/**/migrations,,vendor/mauriciopiber/**/data/migrations}',
    ***REMOVED***,
    'environments' => [
        'default_database' => 'DEVELOPMENT',
        'default_migration_table' => 'migrations',
        'DEVELOPMENT' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ***REMOVED***,
        'TESTING' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ***REMOVED***,
        'STAGING' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ***REMOVED***,
        'PRODUCTION' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ***REMOVED***,
    ***REMOVED***,
***REMOVED***;
