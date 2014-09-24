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
        'template_map' => array(
            'tests/_bootstrap'                   => __DIR__ . '/../src/Gear/Template/Tests/_bootstrap.phtml',

            'tests/GuyTester'                    => __DIR__ . '/../src/Gear/Template/Tests/GuyTester.phtml',

            'tests/acceptance.suite.yml'         => __DIR__ . '/../src/Gear/Template/Tests/acceptance.suite.yml.phtml',
            'tests/acceptanceTester'             => __DIR__ . '/../src/Gear/Template/Tests/Acceptance/AcceptanceTester.phtml',
            'tests/acceptanceHelper'             => __DIR__ . '/../src/Gear/Template/Tests/Support/AcceptanceHelper.phtml',
            'tests/acceptance/_bootstrap'        => __DIR__ . '/../src/Gear/Template/Tests/Acceptance/_bootstrap.phtml',

            'tests/functional.suite.yml'         => __DIR__ . '/../src/Gear/Template/Tests/functional.suite.yml.phtml',
            'tests/functionalTester'             => __DIR__ . '/../src/Gear/Template/Tests/Functional/FunctionalTester.phtml',
            'tests/functionalHelper'             => __DIR__ . '/../src/Gear/Template/Tests/Support/FunctionalHelper.phtml',
            'tests/functional/_bootstrap'        => __DIR__ . '/../src/Gear/Template/Tests/Functional/_bootstrap.phtml',

            'tests/unit.suite.yml'               => __DIR__ . '/../src/Gear/Template/Tests/unit.suite.yml.phtml',
            'tests/unitTester'             => __DIR__ .'/../src/Gear/Template/Tests/Unit/UnitTester.phtml',
            'tests/unitHelper'             => __DIR__ . '/../src/Gear/Template/Tests/Support/UnitHelper.phtml',
            'tests/unit/_bootstrap'              => __DIR__ . '/../src/Gear/Template/Tests/Unit/_bootstrap.phtml',

            'tests/ZendServiceLocator/construct' => __DIR__ . '/../src/Gear/Service/Test/construct.phtml',

            'tests/codeception.yml'              => __DIR__ . '/../src/Gear/Template/Tests/codeception.yml.phtml',


        )
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
        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'eventmanager' => 'orm_default',
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'zf2-module-security',
                    'charset' => 'utf8'
                )
            )
        ),
        'driver' => array(
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            ),
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            )
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'gear' => array(
                    'options' => array(
                        'route' => 'gear -v',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gear'
                        ),
                    ),
                ),
                'gear-module-build' => array(
	                'options' => array(
                	    'route' => 'gear module build <module> <build>',
                        'defaults' => array(
	                	    '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearmodulebuild'
	                    )
	                )
                ),
                'gear-module-create' => array(
                    'options' => array(
                        'route' => 'gear module create <module>',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearmodulecreate'
                        ),
                    ),
                ),
                'gear-module-delete' => array(
                    'options' => array(
                        'route' => 'gear module delete <module>',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearmoduledelete'
                        ),
                    ),
                ),
                'gear-module-add' => array(
                    'options' => array(
                        'route' => 'gear module add-config <module>',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearaddconfigmodule'
                        ),
                    ),
                ),
                'gear-module-del' => array(
                    'options' => array(
                        'route' => 'gear module del-config <module>',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'geardelconfigmodule'
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
                        'route' => 'gear create project <project> <path>',
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
                        'route' => 'gear create crud-unique <project> <path> <module> <table> [<table_prefix>***REMOVED*** [<exclude>***REMOVED***',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Gear\Controller',
                            'controller' => 'Gear\Controller\Index',
                            'action' => 'gearcreatecrudunique'
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
