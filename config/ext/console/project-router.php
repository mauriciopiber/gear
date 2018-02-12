<?php
$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');
$options = " ".implode(' ', $globalOptions);
return [
    'router' => [
        'routes' => [
            /**
             * Project
             */
            /*
            'gear-create' => array(
                'options' => array(
                    'route' => 'gear project create <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED***'
                    . ' [--database=***REMOVED*** [--username=***REMOVED*** [--password=***REMOVED*** [--basepath=***REMOVED*** [--force***REMOVED***'
                    . ' [--staging=***REMOVED*** [--production=***REMOVED***',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'create'
                    )
                )
            ),
            'gear-delete' => array(
                'options' => array(
                    'route' => 'gear project delete <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= [--basepath=***REMOVED***',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'delete'
                    )
                )
            ),
            'gear-project-upgrade' => array(
                'options' => array(
                    'route' => 'gear project upgrade [--type=***REMOVED*** [--force***REMOVED*** [--just=***REMOVED***',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'upgrade'
                    )
                )
            ),
            'gear-project-diagnostics' => array(
                'options' => array(
                    'route' => 'gear project diagnostic [--just=***REMOVED***',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'diagnostics'
                    )
                )
            ),
*/
            'gear-project-fixture' => array(
                'options' => array(
                    'route' => 'gear project fixture [--append***REMOVED*** [--reset-autoincrement***REMOVED*** ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'fixture'
                    )
                )
            ),
            /*
            'gear-config' => array(
                'options' => array(
                    'route' => 'gear project config --host= --dbname=  --username= --password= --environment= --dbms=',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'config'
                    )
                )
            ),
            'gear-global' => array(
                'options' => array(
                    'route' => 'gear project global --host= --dbname=  --dbms= --environment= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'global'
                    )
                )
            ),
            'gear-local' => array(
                'options' => array(
                    'route' => 'gear project local --username= --password= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'local'
                    )
                )
            ),
            'gear-environment' => array(
                'options' => array(
                    'route' => 'gear project environment --env= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'environment'
                    )
                )
            ),
            'gear-project-nfs' => array(
                'options' => array(
                    'route' => 'gear project nfs',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'nfs'
                    )
                )
            ),
            'gear-project-virtualhost' => array(
                'options' => array(
                    'route' => 'gear project virtual-host <environment>',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'virtual-host'
                    )
                )
            ),
            'gear-project-git' => array(
                'options' => array(
                    'route' => 'gear project git <git>',
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'git'
                    )
                )
            ),
            */
        ***REMOVED***
    ***REMOVED***
***REMOVED***;
