<?php
return [
    'factories' => [
        'Gear\Module\Constructor\Src'        => 'Gear\Constructor\Src\SrcServiceFactory',
        'Gear\Module\Constructor\Db'         => 'Gear\Constructor\Db\DbServiceFactory',
        'Gear\Module\Constructor\Action'     => 'Gear\Constructor\Action\ActionServiceFactory',
        'Gear\Module\Constructor\Controller' => 'Gear\Constructor\Controller\ControllerServiceFactory',
    ***REMOVED***,
    'invokables' => [
        'Gear\Module\Constructor\App'        => 'Gear\Constructor\App\AppService',
    ***REMOVED***
***REMOVED***;