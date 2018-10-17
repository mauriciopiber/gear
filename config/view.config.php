<?php
return [
    'template_path_stack' => [
        'gear' => __DIR__ . '/../view',
        'template' => __DIR__ . '/../view',
        //'docs' => __DIR__.'/../world'
        'docs-template' => __DIR__.'/../src/Module/Docs'
        //'docs' => __DIR__.'/../src/Module/Docs'
    ***REMOVED***,

    'factories' => [
        'arrayToYml' => 'Gear\Factory\ArrayToYmlHelperFactory',
        'str' => 'Gear\Factory\StrHelperFactory'
    ***REMOVED***
***REMOVED***;
