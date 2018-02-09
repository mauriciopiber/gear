<?php
return [
    'factories' => [
        'Gear\Module\BasicModuleStructure' => 'Gear\Module\BasicModuleStructureFactory',
        'Gear\Module\Diagnostic'      => 'Gear\Module\Diagnostic\DiagnosticServiceFactory',
        'Gear\Module\Construct'       => 'Gear\Module\ConstructServiceFactory',
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
    'aliases' => [
        'moduleStructure'             => 'Gear\Module\BasicModuleStructure',
    ***REMOVED***
***REMOVED***;