<?php
return [
    'factories' => [
        'moduleStructure'             => 'Gear\Module\BasicModuleStructureFactory',
    ***REMOVED***,
    'invokables' =>
    [
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