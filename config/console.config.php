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
            /** Module */
            'gear-module' => array(
                'options' => array(
                    'route' => 'gear module (create|delete):toDo <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--layoutName=***REMOVED*** [--no-layout***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'module'
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
            'gear-module-push' => array(
                'options' => array(
                    'route' => 'gear module (push):toDo <module> --description=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'push'
                    )
                )
            ),
            'gear-project-push' => array(
                'options' => array(
                    'route' => 'gear project (push):toDo --description=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'push'
                    )
                )
            ),
            /**
             * Build
             */
            'gear-build' => array(
                'options' => array(
                    'route' => 'gear (build):toDo <module> [--trigger=***REMOVED*** [--domain=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Build',
                        'action' => 'build'
                    )
                )
            ),
            /** Project */
            'gear-project' => array(
                'options' => array(
                    'route' => 'gear project (create|delete):toDo <project> [<host>***REMOVED*** [<git>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'project'
                    )
                )
            ),
            'gear-global' => array(
                'options' => array(
                    'route' => 'gear project (setUpGlobal):toDo --host= --dbname=  --dbms= --environment= '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'global'
                    )
                )
            ),
            'gear-deploy' => array(
                'options' => array(
                    'route' => 'gear project (deploy):toDo <environment>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'deploy'
                    )
                )
            ),
            'gear-local' => array(
                'options' => array(
                    'route' => 'gear project (setUpLocal):toDo --username= --password= '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'local'
                    )
                )
            ),
            'gear-entities' => array(
                'options' => array(
                    'route' => 'gear project (setUpEntities):toDo <module>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'entities'
                    )
                )
            ),
            'gear-entity' => array(
                'options' => array(
                    'route' => 'gear project (setUpEntity):toDo <module> --entity=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'entity'
                    )
                )
            ),
            'gear-mysql' => array(
                'options' => array(
                    'route' => 'gear project (setUpMysql):toDo --dbname= --username= --password=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'mysql'
                    )
                )
            ),
            'gear-sqlite' => array(
                'options' => array(
                    'route' => 'gear project (setUpSqlite):toDo --dbname= --dump= [--username=***REMOVED*** [--password=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'sqlite'
                    )
                )
            ),
            'gear-environment' => array(
                'options' => array(
                    'route' => 'gear project (setUpEnvironment):toDo --environment=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'environment'
                    )
                )
            ),
            'gear-config' => array(
                'options' => array(
                    'route' => 'gear project (setUpConfig):toDo --host= --dbname=  --username= --password= --environment= --dbms=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'config'
                    )
                )
            ),

            'gear-acl' => array(
                'options' => array(
                    'route' => 'gear project (setUpAcl):toDo [<withReset>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'acl'
                    )
                )
            ),
            'gear-dump' => array(
                'options' => array(
                    'route' => 'gear project dump <module> [--json***REMOVED*** [--array***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'dump'
                    )
                )
            ),
            /** Constructor */
            'gear-controller' => array(
                'options' => array(
                    'route' => 'gear controller (create|delete):toDo <module> --name= --object= [--service=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'controller'
                    )
                )
            ),
            'gear-activity' => array(
                'options' => array(
                    'route' => 'gear activity (create|delete):toDo <module> <parent> [--template=***REMOVED*** --name= [--routeHttp=***REMOVED*** [--routeConsole=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED***',// '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'action'
                    )
                )
            ),
            'gear-src' => array(
                'options' => array(
                    'route' => 'gear src (create|delete):toDo <module> --type= --name= [--dependency==***REMOVED*** [--extends***REMOVED*** [--db=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'src'
                    )
                )
            ),
            'gear-db' => array(
                'options' => array(
                    'route' => 'gear db (create|delete):toDo <module> --table= [--default-role=***REMOVED*** [--columns=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'db'
                    )
                )
            ),
            'gear-analyse' => array(
                'options' => array(
                    'route' => 'gear analyse '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'analyse'
                    )
                )
            ),
            'gear-fix-table' => array(
                'options' => array(
                    'route' => 'gear fix-table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'fix-table'
                    )
                )
            ),
            'gear-fix-database' => array(
                'options' => array(
                    'route' => 'gear fix-database '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'fix-database'
                    )
                )
            ),
            'gear-test' => array(
                'options' => array(
                    'route' => 'gear test (create|delete):toDo <module> --suite= --target= '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'test'
                    )
                )
            ),
            'gear-view' => array(
                'options' => array(
                    'route' => 'gear view (create|delete):toDo <module> --target= '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'view'
                    )
                )
            ),
        ),
    )
);
