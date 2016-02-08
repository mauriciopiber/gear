<?php
$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');
$options = implode(' ', $globalOptions);
return [
    'router' => [
        'routes' => [
            /** Module */
            /** 2.1 */
            'gear-module-create' => [
                'options' => [
                    'route' => 'gear module create <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED*** ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

        	/** Module */
            /** 2.1 */
            'gear-module-as-project-create' => [
                'options' => [
                    'route' => 'gear module-as-project create <module> <basepath> ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'module-as-project'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
        	/** Module */
        		/** 2.1 */
    		'gear-module-angular' => [
                'options' => [
					'route' => 'gear module create angular <module> ' . $options,
					'defaults' => [
							'__NAMESPACE__' => 'Gear\Module\Controller',
							'controller' => 'Gear\Controller\Module',
							'action' => 'create-angular'
					***REMOVED***
				***REMOVED***
    		***REMOVED***,
            /** 2.3 */
            'gear-module-light' => [
                'options' => [
                    'route' => 'gear module create <module> --light [--ci***REMOVED*** [--build=***REMOVED*** [--doctrine***REMOVED*** [--doctrine-fixture***REMOVED*** [--unit***REMOVED*** [--codeception***REMOVED*** [--gear***REMOVED*** ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'light'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.2 */
            'gear-module-delete' => [
                'options' => [
                    'route' => 'gear module delete <module> ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'delete'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

            /** 2.4 */
            'gear-module-load' => [
                'options' => [
                    'route' => 'gear module load <module> [--before=***REMOVED*** [--after=***REMOVED***',
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'load'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.5 */
            'gear-module-unload' => [
                'options' => [
                    'route' => 'gear module unload <module>',
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'unload'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.6 */
            'gear-module-build' => [
                'options' => [
                    'route' => 'gear module build <module> [--trigger=***REMOVED*** [--domain=***REMOVED***',
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'build'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

            /** 2.9 */
            'gear-module-entities' => [
                'options' => [
                    'route' => 'gear module entities <module>',
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'entities'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.10 */
            'gear-module-entity' => [
                'options' => [
                    'route' => 'gear module entity <module> --entity=',
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'entity'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

            /** Constructor */
            /** 3.1 */
            'gear-db' => [
                'options' => [
                    'route' => 'gear module db create <module> [<basepath>***REMOVED*** --table= [--user=***REMOVED*** [--default-role=***REMOVED*** [--columns=***REMOVED*** ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'db'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.2 */
            'gear-src-create' => [
                'options' => [
                    'route' => 'gear module src create <module> [<basepath>***REMOVED*** --type= --name= [--template=***REMOVED*** [--abstract***REMOVED*** [--dependency==***REMOVED*** [--extends=***REMOVED*** [--db=***REMOVED*** [--columns=***REMOVED***' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'src-create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.2 */
            'gear-src' => [
                'options' => [
                    'route' => 'gear module src delete <module> [<basepath>***REMOVED*** --name= --type= [--namespace=***REMOVED*** ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'src-delete'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.2 */
            'gear-src-free' => [
                'options' => [
                    'route' => 'gear module src create <module> --name= --namespace= [--dependency==***REMOVED*** [--extends=***REMOVED*** ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'src'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.3 */
            'gear-controller' => [
                'options' => [
                    'route' => 'gear module controller create <module> [<basepath>***REMOVED*** --name= [--object=***REMOVED*** [--db=***REMOVED*** [--columns***REMOVED*** [--service=***REMOVED*** ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'controller'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.4 */
            'gear-activity' => [
                'options' => [
                    'route' => 'gear module activity create <module> [<basepath>***REMOVED*** <parent>  [--template=***REMOVED*** [--model=***REMOVED*** --name= [--routeHttp=***REMOVED*** [--routeConsole=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED*** '.implode(' ',$globalOptions),
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'action'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-console-controller' => [
                'options' => [
                    'route' => 'gear module console controller create <module> [<basepath>***REMOVED*** --name= [--object=***REMOVED*** [--db=***REMOVED*** [--columns***REMOVED*** [--service=***REMOVED*** ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'console-controller'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.4 */
            'gear-console-activity' => [
                'options' => [
                    'route' => 'gear module console activity create <module> [<basepath>***REMOVED*** <parent> [--template=***REMOVED*** [--model=***REMOVED*** --name= [--routeHttp=***REMOVED*** [--routeConsole=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED*** '.$options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'console-action'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

            /** 3.5 */
            'gear-test' => [
                'options' => [
                    'route' => 'gear module test create <module>  [<basepath>***REMOVED*** --suite= --target= ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'test'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.6 */
            'gear-view' => [
                'options' => [
                    'route' => 'gear module view create <module>  [<basepath>***REMOVED*** --target= ' . $options,
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Constructor\Controller',
                        'controller' => 'Gear\Controller\Constructor',
                        'action' => 'view'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
			'gear-module-upgrade' => array(
                'options' => array(
                    'route' => 'gear module upgrade <module> [--Y***REMOVED***',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Project\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'upgrade'
                    )
                )
            ),
            'gear-module-autoload' => array(
                'options' => array(
                    'route' => 'gear module dump-autoload <module>',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'dump-autoload'
                    )
                )
            ),
           'gear-module-fixture' => [
                'options' => [
                    'route' => 'gear module fixture <module> [--append***REMOVED*** [--reset-increment***REMOVED***',
                    'defaults' => [
                        '__NAMESPACE__' => 'Gear\Module\Controller',
                        'controller' => 'Gear\Controller\Module',
                        'action' => 'fixture'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
        ***REMOVED***
    ***REMOVED***
***REMOVED***;
