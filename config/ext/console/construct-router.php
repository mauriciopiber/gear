<?php
return [
    'router' => [
        'routes' => [

            /** 3.3 */
            'gear-module-constructor-controller' => [
                'options' => [
                    'route' => 'gear module controller create <module> [<basepath>***REMOVED*** --name= [--type=***REMOVED*** [--object=***REMOVED*** [--db=***REMOVED*** [--columns***REMOVED*** [--service=***REMOVED*** ' . $options,
                    'defaults' => [
                        'controller' => 'Gear\Module\Constructor\Controller',
                        'action' => 'create'
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED***,
            /** 3.4 */
            'gear-module-constructor-activity' => [
                'options' => [
                    'route' => 'gear module activity create <module> [<basepath>***REMOVED*** <parent>  [--template=***REMOVED*** --name= [--route=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED*** '.implode(' ',$globalOptions),
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
        ***REMOVED***
    ***REMOVED***
***REMOVED***;
