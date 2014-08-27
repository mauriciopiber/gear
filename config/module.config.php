<?php
namespace Gear;
return array(
    'controllers' => array(
        'invokables' => array(
            'Gear\Controller\Index' => 'Gear\Controller\IndexController',
            'gear' => 'Gear\Controller\IndexController',
         ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'gear' => __DIR__ . '/../view',
        ),
    ),
	'router' => array(
		'routes' => array(
			'gear' => array(
			    'type'    => 'segment',
			    'options' => array(
			        'route'    => '/gear[/***REMOVED***[:action***REMOVED***[/:id***REMOVED***',
			        'constraints' => array(
			            'action' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
			            'id'     => '[0-9***REMOVED***+',
			        ),
			        'defaults' => array(
			            'controller' => 'Gear\Controller\Index',
			            'action'     => 'index',
			        ),
			    ),
			),

		),
	),
    'doctrine' => array(
        'driver' => array(
            /* This is where you can change the Mapping Driver */
            'orm_default' => array(
                'drivers' => array(
                    //'Application\Entity' => 'application_entities_annotation'
                    /* uncomment the next line to use YAML Driver*/
                    'Gear\Entity' => 'application_entities_yaml'
                    /* uncomment the next line to use XML Driver*/
                    //'Application\Entity' => 'application_entities_xml'
                ),
            ),
            /* YamlDriver Example */
            'application_entities_yaml' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'paths' => array(__DIR__ . '/../src/' .__NAMESPACE__.  '/Yml')
            ),

        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'gear-create-module' => array(
                    'options' => array(
                        'route' => 'gear create module <project> <path> <module>',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreatemodule'
                        ),
                    ),
                ),
                'create-create-crud' => array(
                    'options' => array(
                        'route' => 'gear create crud <project> <path> <module> [<table_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreatecrud'
                        ),
                    ),
                ),
                'create-create-pages' => array(
                    'options' => array(
                        'route' => 'gear create pages <project> <path> <module> [<table_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreatepages'
                        ),
                    ),
                ),
                'gear-create-entities' => array(
                    'options' => array(
                        'route' => 'gear create entities <project> <path> <module> [<table_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreateentities'
                        ),
                    ),
                ),
                'gear-create-project' => array(
                    'options' => array(
                        'route' => 'gear create project <project> <path> ',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreateproject'
                        ),
                    ),
                ),
                'gear-create-file' => array(
                    'options' => array(
                        'route' => 'gear create file <project> <path> <module> <file> [<table>***REMOVED*** [<table_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreatefile'
                        ),
                    ),
                ),
                'gear-create-lego' => array(
                    'options' => array(
                        'route' => 'gear create lego <project> <path> <module> <piece> [<table>***REMOVED*** [<table_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreatelego'
                        ),
                    ),
                ),
                'gear-create-crud-unique' => array(
                    'options' => array(
                        'route' => 'gear create crud-unique <project> <path> <module> <table> [<table_prefix>***REMOVED*** [<exclude>***REMOVED*** ',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreatecrudunique'
                        ),
                    ),
                ),
                'gear-db-import-manager' => array(
                    'options' => array(
                        'route' => 'gear import manager <project> <path> <module> [<table_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'importmanager'
                        ),
                    ),
                ),
                'gear-db-import-rule' => array(
                    'options' => array(
                        'route' => 'gear import rule <project> <path> <module> [<table_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'rulemanager'
                        ),
                    ),
                ),
                'gear-db-clear-rule' => array(
                    'options' => array(
                        'route' => 'gear clear rule <project> <path>',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'ruleclear'
                        ),
                    ),
                ),
                'gear-db-add-rule' => array(
                    'options' => array(
                        'route' => 'gear add rule <project> <module> <controllerTo> <actionTo> <role>',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'add'
                        ),
                    ),
                ),
                'gear-db-normalize' => array(
                    'options' => array(
                        'route' => 'gear normalize [<table_prefix>***REMOVED*** [<table_exclude>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'normalizedb'
                        ),
                    ),
                ),
                'gear-db-drop-i18n' => array(
                    'options' => array(
                        'route' => 'gear drop i18n [<i18n_prefix>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'dropi18n'
                        ),
                    ),
                ),

            ),
        ),
    ),
);