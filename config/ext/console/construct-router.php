<?php
return [
    'router' => [
        'routes' => [
            /** 3.3 */
            'gear-module-constructor-controller' => [
                'options' => [
                    'route' => 'gear module controller create <module> [<basepath>***REMOVED*** --name= [--extends=***REMOVED*** [--type=***REMOVED*** [--namespace=***REMOVED*** [--dependency=***REMOVED*** [--object=***REMOVED*** [--db=***REMOVED*** [--columns=***REMOVED*** [--service=***REMOVED*** ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Controller',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.4 */
            'gear-module-constructor-activity' => [
                'options' => [
                    'route' => 'gear module activity create <module> [<basepath>***REMOVED*** <parent>  [--template=***REMOVED*** --name= [--route=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED*** [--controllerNamespace=***REMOVED*** '.implode(' ',$globalOptions),
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Action',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.5 */
            'gear-module-constructor-test' => [
                'options' => [
                    'route' => 'gear module test create <module>  [<basepath>***REMOVED*** --suite= --target= ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Test',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.6 */
            'gear-module-constructor-view' => [
                'options' => [
                    'route' => 'gear module view create <module>  [<basepath>***REMOVED*** --target= ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\View',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,

            /** Constructor */
            /** 3.1 */
            'gear-db' => [
                'options' => [
                    'route' => 'gear module db create <module> [<basepath>***REMOVED*** --table= [--user=***REMOVED*** [--default-role=***REMOVED*** [--columns=***REMOVED*** [--namespace=***REMOVED*** [--service=***REMOVED***' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Db',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.2 */
            'gear-app-create' => [
                'options' => [
                    'route' => 'gear module app create <module> [<basepath>***REMOVED*** --type= --name= [--namespace=***REMOVED*** [--db=***REMOVED*** [--dependency=***REMOVED*** ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Constructor\App\AppController',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.2 */
            'gear-src-create' => [
                'options' => [
                    'route' => 'gear module src create <module> [<basepath>***REMOVED*** --type= --name= [--namespace=***REMOVED*** [--service=***REMOVED*** [--template=***REMOVED*** [--implements=***REMOVED*** [--abstract***REMOVED*** [--dependency==***REMOVED*** [--extends=***REMOVED*** [--db=***REMOVED*** [--columns=***REMOVED***' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Src',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.2 */
            'gear-src' => [
                'options' => [
                    'route' => 'gear module src delete <module> [<basepath>***REMOVED*** --name= --type= [--namespace=***REMOVED*** ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Src',
                        'action' => 'delete'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.2 */
            'gear-src-free' => [
                'options' => [
                    'route' => 'gear module src create <module> --name= --namespace= [--dependency==***REMOVED*** [--extends=***REMOVED*** ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Src',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
        ***REMOVED***
    ***REMOVED***
***REMOVED***;
