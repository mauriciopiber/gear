#!/bin/bash
projectDir=${1}

echo "Create Application Config"
echo ""
echo "<?php
return array(
    'modules' => array(
    	'DoctrineModule',
    	'DoctrineORMModule',
    	'ZendDeveloperTools',
    	'ZfcBase',
    	'ZfcUser',
    	'ZfcUserDoctrineORM',
    	'AssetManager',
        'Gear',
        'Security',
        'ImagemUpload'
    ),
    'module_listener_options' => array(
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