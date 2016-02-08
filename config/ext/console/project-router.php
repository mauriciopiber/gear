<?php
$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');
$options = " ".implode(' ', $globalOptions);
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
            'gear-config' => array(
                'options' => array(
                    'route' => 'gear project config --host= --dbname=  --username= --password= --environment= --dbms=',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'config'
                    )
                )
            ),
            'gear-global' => array(
                'options' => array(
                    'route' => 'gear project global --host= --dbname=  --dbms= --environment= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'global'
                    )
                )
            ),
            'gear-local' => array(
                'options' => array(
                    'route' => 'gear project local --username= --password= ' . implode(' ', $globalOptions),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Project',
                        'action' => 'local'
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
        ***REMOVED***
    ***REMOVED***
***REMOVED***;
