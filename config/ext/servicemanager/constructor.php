<?php
return [
    'factories' => [
        Gear\Constructor\Src\SrcConstructor::class        => Gear\Constructor\Src\SrcConstructorFactory::class,
        Gear\Constructor\Db\DbConstructor::class         => Gear\Constructor\Db\DbServiceFactory::class,
        Gear\Constructor\Action\ActionConstructor::class     => Gear\Constructor\Action\ActionConstructorFactory::class,
        Gear\Constructor\Controller\ControllerConstructor::class => Gear\Constructor\Controller\ControllerConstructorFactory::class,
    ***REMOVED***,
    'invokables' => [
        'Gear\Module\Constructor\App'        => 'Gear\Constructor\App\AppService',
    ***REMOVED***
***REMOVED***;