<?php

$globalOptions = array('[--verbose|-v***REMOVED***');

return array(
    'router' => array(
        'routes' => array(
            'gear-version' => array(
                'options' => array(
                    'route' => 'gear (--version|-v):toDo',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Gear',
                        'action' => 'version'
                    )
                )
            ),
            'gear-news' => array(
                'options' => array(
                    'route' => 'gear (news):toDo',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Gear',
                        'action' => 'news'
                    )
                )
            ),
            'gear-module' => array(
                'options' => array(
                    'route' => 'gear module (create|delete):toDo <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED*** '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'module'
                    )
                )
            ),
            'gear-build' => array(
                'options' => array(
                    'route' => 'gear (build):toDo <module> --build= [--domain=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Build',
                        'action' => 'build'
                    )
                )
            ),
            'gear-load' => array(
                'options' => array(
                    'route' => 'gear (load|unload):toDo <module> [--before=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'load'
                    )
                )
            ),
            'gear-project' => array(
                'options' => array(
                    'route' => 'gear project (create|delete):toDo <project> [<host>***REMOVED*** [<git>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'project'
                    )
                )
            ),

            'gear-global' => array(
                'options' => array(
                    'route' => 'gear (setUpGlobal):toDo --host= --dbname=  --dbms= --environment= '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'global'
                    )
                )
            ),
            'gear-local' => array(
                'options' => array(
                    'route' => 'gear (setUpLocal):toDo --username= --password= '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'local'
                    )
                )
            ),
            'gear-environment' => array(
                'options' => array(
                    'route' => 'gear (setUpEnvironment):toDo --environment=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'environment'
                    )
                )
            ),
            'gear-sqlite' => array(
                'options' => array(
                    'route' => 'gear sqlite (create|delete):toDo --db= --dump= [--username=***REMOVED*** [--password=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'sqlite'
                    )
                )
            ),
            'gear-config' => array(
                'options' => array(
                    'route' => 'gear config --host= --database=  --username= --password= --environment= --dbms=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'config'
                    )
                )
            ),

            'gear-acl' => array(
                'options' => array(
                    'route' => 'gear (acl):toDO',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'acl'
                    )
                )
            ),
            'gear-dump' => array(
                'options' => array(
                    'route' => 'gear dump <module> [--json***REMOVED*** [--array***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'dump'
                    )
                )
            ),
            'gear-mysql' => array(
                'options' => array(
                    'route' => 'gear mysql --database= --username= --password=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'mysql'
                    )
                )
            ),
            'gear-controller' => array(
                'options' => array(
                    'route' => 'gear controller (create|delete):toDo <module> --name= --invokable= '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'controller'
                    )
                )
            ),
            'gear-action' => array(
                'options' => array(
                    'route' => 'gear action (create|delete):toDo <module> <controllerName> --name= [--route=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED*** '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'action'
                    )
                )
            ),
            'gear-src' => array(
                'options' => array(
                    'route' => 'gear src (create|delete):toDo <module> --type= --name= [--dependency==***REMOVED*** [--extends***REMOVED*** [--db=***REMOVED*** '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'src'
                    )
                )
            ),
            'gear-db' => array(
                'options' => array(
                    'route' => 'gear db (create|delete):toDo <module> --table= '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'db'
                    )
                )
            ),
            'create-page' => array(
                'options' => array(
                    'route' => 'gear page (create|delete):toDo <module> --controllerName= --controllerInvokable= --actionName= [--actionRoute=***REMOVED*** [--actionRole=***REMOVED*** [--actionDependency=***REMOVED*** '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Index',
                        'action' => 'page'
                    )
                )
            ),
        ),
    )
);
