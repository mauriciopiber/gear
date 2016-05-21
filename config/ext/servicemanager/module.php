<?php
return [
    'factories' => [
        'moduleStructure'             => 'Gear\Module\BasicModuleStructureFactory',
        'Gear\Module\Diagnostic'      => 'Gear\Module\Diagnostic\DiagnosticServiceFactory',
    ***REMOVED***,
    'invokables' =>
    [
        'Gear\Module\Construct'       => 'Gear\Module\ConstructService',
        'codeceptionService'          => 'Gear\Module\CodeceptionService',
        'scriptService'               => 'Gear\Module\ScriptService',
        'testService'                 => 'Gear\Module\TestService',
        'composerService'             => 'Gear\Module\ComposerService',
        'Gear\Module\Node\Package'    => 'Gear\Module\Node\Package',
        'Gear\Module\Node\Gulpfile'   => 'Gear\Module\Node\Gulpfile',
        'Gear\Module\Node\Protractor' => 'Gear\Module\Node\Protractor',
        'Gear\Module\Node\Karma'      => 'Gear\Module\Node\Karma',
    ***REMOVED***

***REMOVED***;