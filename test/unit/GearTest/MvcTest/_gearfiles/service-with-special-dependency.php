<?php
return [
    'name' => 'MySrcWithSpecialDependency',
    'type' => 'Service',
    'dependency' => [
        [
            'aliase' => 'GearBase\Util\String',
            'class' => '\GearBase\Util\String\StringService'
        ***REMOVED***,
        [
            'aliase' => 'console',
            'class' => '\Zend\Console\Adapter\Posix',
            'ig_t' => true
       ***REMOVED***,
        [
            'class' => '\Zend\Db\Adapter\Adapter',
            'ig_t' => true
       ***REMOVED***
    ***REMOVED***,
    'namespace' => 'BestNamespace',
    'service' => 'factories'
***REMOVED***;