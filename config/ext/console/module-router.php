<?php
$globalOptions = ['[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***'***REMOVED***;
$options = implode(' ', $globalOptions);
return [
    'router' => [
        'routes' => [
          /** Module */
            /** 2.1 */
            'gear-module-as-project-create' => [
                'options' => [
                    'route' => 'gear module create <module>'
                    . ' <basepath> [--type=***REMOVED*** [--force***REMOVED*** [--staging=***REMOVED*** [--namespace=***REMOVED***' . $options,
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
            'gear-module-diagnostic' => [
                'options' => [
                     'route' => 'gear module diagnostic [<module>***REMOVED*** [<basepath>***REMOVED*** [--type=***REMOVED*** [--just=***REMOVED***',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'diagnostic'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-module-upgrade' => [
                'options' => [
                    'route' => 'gear module upgrade [<module>***REMOVED*** [<basepath>***REMOVED*** [--type=***REMOVED*** [--force***REMOVED*** [--just=***REMOVED***',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'upgrade'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            'gear-module-construct' => [
                'options' => [
                    'route' => 'gear module construct <module> [<basepath>***REMOVED*** [--file=***REMOVED***',
                    'defaults' => [
                        'controller' => 'Gear\Module',
                        'action' => 'construct'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
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
