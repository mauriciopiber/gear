<?php
$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');
$options = ' '.implode(' ', $globalOptions);
return [
    'router' => [
        'routes' => [
            'gear-database-mock' => [
                'options' => [
                    'route' => 'gear database mock <module> <table>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'mock-table'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-analyse' => [
                'options' => [
                    'route' => 'gear database analyse' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'analyse-database'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-analyse-table' => [
                'options' => [
                    'route' => 'gear database analyse table <table>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'analyse-table'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-fix' => [
                'options' => [
                    'route' => 'gear database fix' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'fix-database'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-fix-table' => [
                'options' => [
                    'route' => 'gear database fix table <table>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'fix-table'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-clear-table' => [
                'options' => [
                    'route' => 'gear database clear table <table>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'clear-table'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-autoincrement' => [
                'options' => [
                    'route' => 'gear database autoincrement' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'autoincrement-database'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-autoincrement-table' => [
                'options' => [
                    'route' => 'gear database autoincrement table <table>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'autoincrement-table'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

            'gear-database-order' => [
                'options' => [
                    'route' => 'gear database order' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'get-order'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-create-table' => [
                'options' => [
                    'route' => 'gear database create table <name>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'create-table'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-create-column' => [
                'options' => [
                    'route' => 'gear database create column <table> <name> <type> [--limit=***REMOVED*** [--null=***REMOVED***' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'create-column'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-create-constraint' => [
                'options' => [
                    'route' => 'gear database create constraint <table> <column> <constraintType> <refTable> <refColumn> <updateRule> <deleteRule>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'create-constraint'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-drop-table' => [
                'options' => [
                    'route' => 'gear database drop table <table>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'drop-table'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-drop-column' => [
                'options' => [
                    'route' => 'gear database drop column <table> <name>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'drop-column'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-drop-constraint' => [
                'options' => [
                    'route' => 'gear database drop constraint <table> <column>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'drop-column'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-mysql-load' => [
                'options' => [
                    'route' => 'gear database load <location>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'mysql-load'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-mysq-dump' => [
                'options' => [
                    'route' => 'gear database dump <location> [<name>***REMOVED***' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'mysql-dump'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-module-dump' => [
                'options' => [
                    'route' => 'gear database module dump <module>' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'module-dump'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-database-project-dump' => [
                'options' => [
                    'route' => 'gear database project dump' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Database\Controller',
                        'controller' => 'Gear\Controller\Db',
                        'action' => 'project-dump'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
        ***REMOVED***
    ***REMOVED***
***REMOVED***;