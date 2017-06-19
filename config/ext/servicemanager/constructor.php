<?php
return [
    'factories' => [
        'Gear\Module\Constructor\Src'        => 'Gear\Constructor\Src\SrcServiceFactory',
    ***REMOVED***,
    'invokables' => [
        'Gear\Module\Constructor\Controller' => 'Gear\Constructor\Controller\ControllerService',
        'Gear\Module\Constructor\Action'     => 'Gear\Constructor\Action\ActionService',
        'Gear\Module\Constructor\View'       => 'Gear\Constructor\View\ViewService',
        'Gear\Module\Constructor\Test'       => 'Gear\Constructor\Test\TestService',
        'Gear\Module\Constructor\Db'         => 'Gear\Constructor\Db\DbService',
        'Gear\Module\Constructor\Src'        => 'Gear\Constructor\Src\SrcService',
        'Gear\Module\Constructor\App'        => 'Gear\Constructor\App\AppService',
    ***REMOVED***
***REMOVED***;