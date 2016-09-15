<?php

$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');

return array_merge_recursive(array(
    'router' => array(
        'routes' => array(
            'gear-project-cache' => array(
                'options' => array(
                    'route' => 'gear cache renew [--data***REMOVED*** [--memcached***REMOVED***',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'renew-cache'
                    )
                )
            ),
        ),
    ),
),
    require __DIR__.'/console.route.config.php',
    require __DIR__.'/console/module-router.php',
    require __DIR__.'/console/construct-router.php',
    require __DIR__.'/console/project-router.php',
    require __DIR__.'/console/database-router.php'
    );
