<?php

$globalOptions = array('[--verbose|-v***REMOVED***');

return array(
    'router' => array(
        'routes' => array(
            /**
             * Project
             */
            'gear-project' => array(
                'options' => array(
                    'route' => 'gear project create <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= --username= --password=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'project'
                    )
                )
            ),
            'gear-project-autoload' => array(
                'options' => array(
                    'route' => 'gear project dump-autoload',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'dump-autoload'
                    )
                )
            ),
            'gear-module-jenkins' => array(
                'options' => array(
                    'route' => 'gear module jenkins <module> <job-template> <path>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'jenkins'
                    )
                )
            ),
            'gear-project-jenkins' => array(
                'options' => array(
                    'route' => 'gear project jenkins',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'jenkins'
                    )
                )
            ),
            'gear-project-build' => array(
                'options' => array(
                    'route' => 'gear project build [--trigger=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'build'
                    )
                )
            ),
            'gear-project-push' => array(
                'options' => array(
                    'route' => 'gear project push --description=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'push'
                    )
                )
            ),
            'gear-project-fixture' => array(
                'options' => array(
                    'route' => 'gear project fixture [--append***REMOVED*** [--reset-autoincrement***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'fixture'
                    )
                )
            ),
            'gear-global' => array(
                'options' => array(
                    'route' => 'gear project (setUpGlobal):toDo --host= --dbname=  --dbms= --environment= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'global'
                    )
                )
            ),
            'gear-local' => array(
                'options' => array(
                    'route' => 'gear project (setUpLocal):toDo --username= --password= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'local'
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
            'gear-module-fixture' => array(
                'options' => array(
                    'route' => 'gear module fixture <module> [--append***REMOVED*** [--reset-increment***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'fixture'
                    )
                )
            ),
            /** Module */
            /** 2.1 */
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
            /** 2.2 */
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
            /** 2.3 */
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
            /** 2.4 */
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
            /** 2.5 */
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
            /** 2.6 */
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
            /** 2.7 */
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
            /** 2.8 */
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
            /** 2.9 */
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
            /** 2.10 */
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

            /** Constructor */
            /** 3.1 */
            'gear-db' => array(
                'options' => array(
                    'route' => 'gear module db (create|delete):toDo <module> --table= [--user=***REMOVED*** [--default-role=***REMOVED*** [--columns=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'db'
                    )
                )
            ),
            /** 3.2 */
            'gear-src' => array(
                'options' => array(
                    'route' => 'gear module src (create|delete):toDo <module> --type= --name= [--abstract***REMOVED*** [--dependency==***REMOVED*** [--extends=***REMOVED*** [--db=***REMOVED*** [--columns=***REMOVED***'.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'src'
                    )
                )
            ),
            /** 3.3 */
            'gear-controller' => array(
                'options' => array(
                    'route' => 'gear module controller (create|delete):toDo <module> --name= --object= [--service=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'controller'
                    )
                )
            ),
            /** 3.4 */
            'gear-activity' => array(
                'options' => array(
                    'route' => 'gear module activity (create|delete):toDo <module> <parent> [--template=***REMOVED*** --name= [--routeHttp=***REMOVED*** [--routeConsole=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED***',// '.implode(' ',$globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'action'
                    )
                )
            ),
            /** 3.5 */
            'gear-test' => array(
                'options' => array(
                    'route' => 'gear module test (create|delete):toDo <module> --suite= --target= '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'test'
                    )
                )
            ),
            /** 3.6 */
            'gear-view' => array(
                'options' => array(
                    'route' => 'gear module view (create|delete):toDo <module> --target= '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'view'
                    )
                )
            ),
            'gear-database-mysql2sqlite' => array(
                'options' => array(
                    'route' => 'gear database mysql2sqlite --from= --target=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'mysql2sqlite'
                    )
                )
            ),

            'gear-database-analyse' => array(
                'options' => array(
                    'route' => 'gear database analyse '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'analyse-database'
                    )
                )
            ),
            'gear-database-analyse-table' => array(
                'options' => array(
                    'route' => 'gear database analyse table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'analyse-table'
                    )
                )
            ),
            'gear-database-fix' => array(
                'options' => array(
                    'route' => 'gear database fix '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'fix-database'
                    )
                )
            ),
            'gear-database-fix-table' => array(
                'options' => array(
                    'route' => 'gear database fix table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'fix-table'
                    )
                )
            ),
            'gear-clear-table' => array(
                'options' => array(
                    'route' => 'gear database clear table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'clear-table'
                    )
                )
            ),
            'gear-database-autoincrement' => array(
                'options' => array(
                    'route' => 'gear database autoincrement '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'autoincrement-database'
                    )
                )
            ),
            'gear-database-autoincrement-table' => array(
                'options' => array(
                    'route' => 'gear database autoincrement table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'autoincrement-table'
                    )
                )
            ),

            'gear-database-order' => array(
                'options' => array(
                    'route' => 'gear database order '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'get-order'
                    )
                )
            ),
            'gear-database-create-table' => array(
                'options' => array(
                    'route' => 'gear database create table <name> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'create-table'
                    )
                )
            ),
            'gear-database-create-column' => array(
                'options' => array(
                    'route' => 'gear database create column <table> <name> <type> [--limit=***REMOVED*** [--null=***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'create-column'
                    )
                )
            ),
            'gear-database-create-constraint' => array(
                'options' => array(
                    'route' => 'gear database create constraint <table> <column> <constraintType> <refTable> <refColumn> <updateRule> <deleteRule> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'create-constraint'
                    )
                )
            ),
            'gear-database-drop-table' => array(
                'options' => array(
                    'route' => 'gear database drop table <table> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'drop-table'
                    )
                )
            ),
            'gear-database-drop-column' => array(
                'options' => array(
                    'route' => 'gear database drop column <table> <name> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'drop-column'
                    )
                )
            ),
            'gear-database-drop-constraint' => array(
                'options' => array(
                    'route' => 'gear database drop constraint <table> <column> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'drop-column'
                    )
                )
            ),
            'gear-database-mysql-load' => array(
                'options' => array(
                    'route' => 'gear database mysql load <location> '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'mysql-load'
                    )
                )
            ),
            'gear-database-mysq-dump' => array(
                'options' => array(
                    'route' => 'gear database mysql dump <location> [<name>***REMOVED*** '.implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'mysql-dump'
                    )
                )
            ),
        ),
    )
);
