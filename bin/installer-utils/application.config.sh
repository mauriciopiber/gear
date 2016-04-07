#!/bin/bash
projectDir=${1}

echo "Create Application Config"
echo ""
echo "<?php
return array(
    'modules' => array(
        'Gear',
    ),
    'module_listener_options' => array(
		'config_cache_enabled' => true,
        'config_cache_key' => '2245023265ae4cf87d02c8b6ba991139',
        'cache_dir' => __DIR__.'/../data/cache/configcache',
        'module_map_cache_enabled' => true,
        'module_map_cache_key' => '496fe9daf9baed5ab03314f04518b928',
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);" > $projectDir/config/application.config.php
echo ""
echo -n "[OK***REMOVED***"
echo ""

echo "Projeto configurado com a aplicação $projectDir/config/application.config.php."
echo -n "[OK***REMOVED***"