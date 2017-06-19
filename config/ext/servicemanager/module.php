<?php
return [
    'factories' => [
        'moduleStructure'             => 'Gear\Module\BasicModuleStructureFactory',
        'Gear\Module\Diagnostic'      => 'Gear\Module\Diagnostic\DiagnosticServiceFactory',
        'Gear\Module\Construct'       => 'Gear\Module\ConstructServiceFactory',
    ***REMOVED***,
    'invokables' =>
    [
        'Gear\Module\Construct'       => 'Gear\Module\ConstructService',
        'Gear\Module\Codeception'     => 'Gear\Module\CodeceptionService',
        'scriptService'               => 'Gear\Script\ScriptService',
        'Gear\Module\Test'            => 'Gear\Module\TestService',
        'Gear\Module\Composer'        => 'Gear\Module\ComposerService',
        'Gear\Module\Node\Package'    => 'Gear\Module\Node\Package',
        'Gear\Module\Node\Gulpfile'   => 'Gear\Module\Node\Gulpfile',
        'Gear\Module\Node\Protractor' => 'Gear\Module\Node\Protractor',
        'Gear\Module\Node\Karma'      => 'Gear\Module\Node\Karma',
    ***REMOVED***

***REMOVED***;