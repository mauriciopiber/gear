<?php
return [
    'name' => 'MySrcWithSpecialDependency',
    'type' => 'Repository',
    'dependency' => require __DIR__.'/special-dependency.php',
    'namespace' => 'FastestNamespace',
    'service' => 'factories'
***REMOVED***;