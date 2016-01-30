<?php
$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');
$options = implode(' ', $globalOptions);
return [
    'router' => [
        'routes' => [
            /**
             * Project
             */
            'gear-project' => array(
                'options' => array(
                    'route' => 'gear project create <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= --username= --password=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'project'
                    )
                )
            ),
            'gear-project-upgrade' => array(
                'options' => array(
                    'route' => 'gear project upgrade [--Y***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'upgrade'
                    )
                )
            ),
            'gear-project-helper' => array(
                'options' => array(
                    'route' => 'gear project helper',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'helper'
                    )
                )
            ),
            'gear-project-diagnostics' => array(
                'options' => array(
                    'route' => 'gear project diagnostics',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'diagnostics'
                    )
                )
            ),
            'gear-project-jenkins' => array(
                'options' => array(
                    'route' => 'gear project jenkins create',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'create-jenkins'
                    )
                )
            ),
            'gear-delete-project-jenkins' => array(
                'options' => array(
                    'route' => 'gear project jenkins delete',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'delete-jenkins'
                    )
                )
            ),
            'gear-project-build' => array(
                'options' => array(
                    'route' => 'gear project build [--trigger=***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'build'
                    )
                )
            ),
            'gear-project-push' => array(
                'options' => array(
                    'route' => 'gear project push --description=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'push'
                    )
                )
            ),
            'gear-project-fixture' => array(
                'options' => array(
                    'route' => 'gear project fixture [--append***REMOVED*** [--reset-autoincrement***REMOVED*** ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'fixture'
                    )
                )
            ),
            'gear-global' => array(
                'options' => array(
                    'route' => 'gear project (setUpGlobal):toDo --host= --dbname=  --dbms= --environment= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'global'
                    )
                )
            ),
            'gear-local' => array(
                'options' => array(
                    'route' => 'gear project (setUpLocal):toDo --username= --password= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'local'
                    )
                )
            ),

            'gear-environment' => array(
                'options' => array(
                    'route' => 'gear project (setUpEnvironment):toDo --environment=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'environment'
                    )
                )
            ),
            'gear-deploy' => array(
                'options' => array(
                    'route' => 'gear project (deploy):toDo <environment>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'deploy'
                    )
                )
            ),
            'gear-project-nfs' => array(
                'options' => array(
                    'route' => 'gear project nfs',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'nfs'
                    )
                )
            ),
            'gear-project-virtualhost' => array(
                'options' => array(
                    'route' => 'gear project virtual-host <environment>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'virtual-host'
                    )
                )
            ),
            'gear-project-git' => array(
                'options' => array(
                    'route' => 'gear project git <git>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'git'
                    )
                )
            ),
            'gear-config' => array(
                'options' => array(
                    'route' => 'gear project (setUpConfig):toDo --host= --dbname=  --username= --password= --environment= --dbms=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'config'
                    )
                )
            ),
           /*  'gear-module-diagnostics' => array(
                'options' => array(
                    'route' => 'gear module diagnostics <module>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Controller',
                        'controller' => 'Gear\Module\Controller\Module',
                        'action' => 'diagnostics'
                    )
                )
            ), */


            'gear-project-autoload' => array(
                'options' => array(
                    'route' => 'gear project dump-autoload',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'dump-autoload'
                    )
                )
            ),

            'gear-project-cache' => array(
                'options' => array(
                    'route' => 'gear cache renew [--data***REMOVED*** [--memcached***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'renew-cache'
                    )
                )
            ),
        ***REMOVED***
    ***REMOVED***
***REMOVED***;
