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
                    'route' => 'gear database fix table <table> [--no-truncate***REMOVED*** ' . $options,
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