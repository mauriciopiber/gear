<?php
return array(
    'router' => array(
        'routes' => array(
            'gear-version' => array(
                'options' => array(
                    'route' => 'gear -v',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'version'
                    )
                )
            ),
            'gear-project' => array(
                'options' => array(
                    'route' => 'gear project (create|delete) <project> [<host>***REMOVED*** [<git>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'project'
                    )
                )
            ),
            'gear-module' => array(
                'options' => array(
                    'route' => 'gear module (create|delete) <module> [--build***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'module'
                    )
                )
            ),
            'gear-build' => array(
                'options' => array(
                    'route' => 'gear build <module> <build>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'build'
                    )
                )
            ),
            'gear-dump' => array(
                'options' => array(
                    'route' => 'gear dump <module> (json|array)',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'dump'
                    )
                )
            ),
            'gear-src' => array(
                'options' => array(
                    'route' => 'gear src (create|delete) <module> [--type=***REMOVED*** [--name=***REMOVED*** ',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'src'
                    )
                )
            ),
            'create-page' => array(
                'options' => array(
                    'route' => 'gear page (create|delete) <module> [--controllerPage=***REMOVED*** [--actionPage=***REMOVED*** [--routePage=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'page'
                    )
                )
            ),
            /*
            'create-create-crud' => array(
                'options' => array(
                    'route' => 'gear create crud <project> <path> <module> [<table_prefix>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'gearcreatecrud'
                    )
                )
            ),

            'gear-create-entities' => array(
                'options' => array(
                    'route' => 'gear create entities <project> <path> <module> [<table_prefix>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'gearcreateentities'
                    )
                )
            ),
            'gear-create-file' => array(
                'options' => array(
                    'route' => 'gear create file <project> <path> <module> <file> [<table>***REMOVED*** [<table_prefix>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'gearcreatefile'
                    )
                )
            ),
            'gear-create-lego' => array(
                'options' => array(
                    'route' => 'gear create lego <project> <path> <module> <piece> [<table>***REMOVED*** [<table_prefix>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'gearcreatelego'
                    )
                )
            ),
            'gear-create-crud-unique' => array(
                'options' => array(
                    'route' => 'gear create crud-unique <project> <path> <module> <table> [<table_prefix>***REMOVED*** [<exclude>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'gearcreatecrudunique'
                    )
                )
            ),
            'gear-db-import-rule' => array(
                'options' => array(
                    'route' => 'gear import rule <project> <path> <module> [<table_prefix>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'rulemanager'
                    )
                )
            ),
            'gear-db-clear-rule' => array(
                'options' => array(
                    'route' => 'gear clear rule <project> <path>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'ruleclear'
                    )
                )
            ),
            'gear-db-add-rule' => array(
                'options' => array(
                    'route' => 'gear add rule <project> <module> <controllerTo> <actionTo> <role>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'add'
                    )
                )
            ),
            'gear-db-normalize' => array(
                'options' => array(
                    'route' => 'gear normalize [<table_prefix>***REMOVED*** [<table_exclude>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'normalizedb'
                    )
                )
            ),
            'gear-db-drop-i18n' => array(
                'options' => array(
                    'route' => 'gear drop i18n [<i18n_prefix>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'dropi18n'
                    )
                )
            ),
            */
            'happy-dance' => array(
                'options' => array(
                    'route' => 'happy dance [<steps>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller'    => 'Gear\Controller\Happy',
                        'action' => 'dance'
                    ),
                )
            ),
        )

    )
);
