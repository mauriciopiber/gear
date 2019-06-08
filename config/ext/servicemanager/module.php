<?php
return [
    'factories' => [
        'Gear\Module\Structure\ModuleStructure' => 'Gear\Module\Structure\ModuleStructureFactory',
        'Gear\Module\Diagnostic\DiagnosticService'      => 'Gear\Module\Diagnostic\DiagnosticServiceFactory',
        'Gear\Module\ConstructService'       => 'Gear\Module\ConstructServiceFactory',
        'Gear\Module\Composer'        => 'Gear\Module\ComposerServiceFactory',
    ***REMOVED***,
    'invokables' =>
    [
        'Gear\Module\Codeception'     => 'Gear\Module\CodeceptionService',
        'scriptService'               => 'Gear\Script\ScriptService',
        'Gear\Module\Tests'            => 'Gear\Module\Tests\ModuleTestsService',

        'Gear\Module\Node\Package'    => 'Gear\Module\Node\Package',
        'Gear\Module\Node\Gulpfile'   => 'Gear\Module\Node\Gulpfile',
        'Gear\Module\Node\Protractor' => 'Gear\Module\Node\Protractor',
        'Gear\Module\Node\Karma'      => 'Gear\Module\Node\Karma',
    ***REMOVED***,
***REMOVED***;
