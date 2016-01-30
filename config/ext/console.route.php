<?php

$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');

return array_merge_recursive(array(
    'router' => array(
        'routes' => array(
            'gear-config-add' => array(
                'options' => array(
                    'route' => 'gear config add <key> <value> [<file>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Config\Controller',
                        'controller' => 'Gear\Controller\Config',
                        'action' => 'add'
                    )
                )
            ),
            'gear-config-update' => array(
                'options' => array(
                    'route' => 'gear config update <key> <value> [<file>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Config\Controller',
                        'controller' => 'Gear\Controller\Config',
                        'action' => 'update'
                    )
                )
            ),
            'gear-config-show' => array(
                'options' => array(
                    'route' => 'gear config show <key> [<file>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Config\Controller',
                        'controller' => 'Gear\Controller\Config',
                        'action' => 'config'
                    )
                )
            ),
            'gear-config-delete' => array(
                'options' => array(
                    'route' => 'gear config delete <key> [<file>***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Config\Controller',
                        'controller' => 'Gear\Controller\Config',
                        'action' => 'delete'
                    )
                )
            ),






        ),
    ),
),
    require __DIR__.'/console/module-router.php',
    require __DIR__.'/console/project-router.php',
    require __DIR__.'/console/database-router.php'
    );
