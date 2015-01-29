<?php

$globalOptions = array('[--verbose|-v***REMOVED***');

return array(
    'router' => array(
        'routes' => array(
            /** Module */
            'gear-module-create' => array(
                'options' => array(
                    'route' => 'gear module create <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'create'
                    )
                )
            ),
            'gear-module-delete' => array(
                'options' => array(
                    'route' => 'gear module delete <module> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'delete'
                    )
                )
            ),
            'gear-module-build' => array(
                'options' => array(
                    'route' => 'gear module build <module> [--trigger=***REMOVED*** [--domain=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'build'
                    )
                )
            ),
            'gear-module-light' => array(
                'options' => array(
                    'route' => 'gear module create <module> --light [--ci***REMOVED*** [--build=***REMOVED*** [--doctrine***REMOVED*** [--doctrine-fixture***REMOVED*** [--unit***REMOVED*** [--codeception***REMOVED*** [--gear***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'light'
                    )
                )
            ),
            'gear-module-load' => array(
                'options' => array(
                    'route' => 'gear module load <module> [--before=***REMOVED*** [--after=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'load'
                    )
                )
            ),
            'gear-module-unload' => array(
                'options' => array(
                    'route' => 'gear module unload <module>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'unload'
                    )
                )
            ),
            'gear-module-push' => array(
                'options' => array(
                    'route' => 'gear module push <module> --description=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'push'
                    )
                )
            ),
            'gear-module-dump' => array(
                'options' => array(
                    'route' => 'gear module dump <module> [--json***REMOVED*** [--array***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'dump'
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
            'gear-mysql2sqlite' => array(
                'options' => array(
                    'route' => 'gear mysql2sqlite --from= --target=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'mysql2sqlite'
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
            'gear-module-entities' => array(
                'options' => array(
                    'route' => 'gear module entities <module>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'entities'
                    )
                )
            ),
            'gear-module-entity' => array(
                'options' => array(
                    'route' => 'gear module entity <module> --entity=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'entity'
                    )
                )
            ),

            'gear-acl' => array(
                'options' => array(
                    'route' => 'gear project (setUpAcl):toDo [<withReset>***REMOVED*** [--user***REMOVED*** [--role***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'acl'
                    )
                )
            ),
            'gear-acl-reset' => array(
                'options' => array(
                    'route' => 'gear project (resetAcl):toDo',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'reset-acl'
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
                    'route' => 'gear src (create|delete):toDo <module> --type= --name= [--abstract***REMOVED*** [--dependency==***REMOVED*** [--extends=***REMOVED*** [--db=***REMOVED*** [--columns=***REMOVED***'.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'src'
                    )
                )
            ),
            'gear-db' => array(
                'options' => array(
                    'route' => 'gear db (create|delete):toDo <module> --table= [--user=***REMOVED*** [--default-role=***REMOVED*** [--columns=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'db'
                    )
                )
            ),
            'gear-analyse-database' => array(
                'options' => array(
                    'route' => 'gear analyse-database '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'analyse-database'
                    )
                )
            ),
            'gear-analyse-table' => array(
                'options' => array(
                    'route' => 'gear analyse-table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'analyse-table'
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
            'gear-clear-table' => array(
                'options' => array(
                    'route' => 'gear clear-table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'clear-table'
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
            'gear-autoincrement-table' => array(
                'options' => array(
                    'route' => 'gear autoincrement-table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'autoincrement-table'
                    )
                )
            ),
            'gear-autoincrement-database' => array(
                'options' => array(
                    'route' => 'gear autoincrement-database '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'autoincrement-database'
                    )
                )
            ),
            'gear-order' => array(
                'options' => array(
                    'route' => 'gear get-order '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'get-order'
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
            'gear-db-table-create' => array(
                'options' => array(
                    'route' => 'gear create column <table> <name> <type> [--limit=***REMOVED*** [--null=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'create-column'
                    )
                )
            ),
            'gear-db-drop-table' => array(
                'options' => array(
                    'route' => 'gear drop table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'drop-table'
                    )
                )
            ),
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
        ),
    )
);
