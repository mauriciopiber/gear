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
                        'controller' => 'Gear\Module',
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
                        'controller' => 'Gear\Module',
                        'action' => 'module-as-project'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.2 */
            'gear-module-delete' => [
                'options' => [
                    'route' => 'gear module delete <module> ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'delete'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

            /** 2.4 */
            'gear-module-load' => [
                'options' => [
                    'route' => 'gear module load <module> [--before=***REMOVED*** [--after=***REMOVED***',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'load'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.5 */
            'gear-module-unload' => [
                'options' => [
                    'route' => 'gear module unload <module>',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'unload'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.9 */
            'gear-module-entities' => [
                'options' => [
                    'route' => 'gear module entities <module>',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'entities'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 2.10 */
            'gear-module-entity' => [
                'options' => [
                    'route' => 'gear module entity <module> --entity=',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'entity'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-module-diagnostic' => array(
                'options' => array(
                     'route' => 'gear module diagnostic <module> [<basepath>***REMOVED*** [--cli***REMOVED***',
                    'defaults' => array(
                        'controller' => 'Gear\Module',
                        'action' => 'diagnostic'
                    )
                )
            ),
			'gear-module-upgrade' => array(
                'options' => array(
                    'route' => 'gear module upgrade <module> [--Y***REMOVED***',
                    'defaults' => array(
                        'controller' => 'Gear\Module',
                        'action' => 'upgrade'
                    )
                )
            ),
            'gear-module-autoload' => array(
                'options' => array(
                    'route' => 'gear module dump-autoload <module>',
                    'defaults' => array(
                        'controller' => 'Gear\Module',
                        'action' => 'dump-autoload'
                    )
                )
            ),
           'gear-module-fixture' => [
                'options' => [
                    'route' => 'gear module fixture <module> [--append***REMOVED*** [--reset-increment***REMOVED***',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'fixture'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

        ***REMOVED***
    ***REMOVED***
***REMOVED***;
