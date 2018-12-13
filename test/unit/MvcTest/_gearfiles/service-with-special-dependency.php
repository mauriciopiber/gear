<?php
return [
    'name' => 'MySrcWithSpecialDependency',
    'type' => 'Service',
    'dependency' => require __DIR__.'/special-dependency.php',
    'namespace' => 'BestNamespace',
    'service' => 'factories'
***REMOVED***;