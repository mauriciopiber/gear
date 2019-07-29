<?php

$globalOptions = array('[--verbose|-v***REMOVED***', '[--yes|-y***REMOVED***', '[--cache***REMOVED***', '[--acl***REMOVED***', '[--memcached***REMOVED***');

return array_merge_recursive(
    require __DIR__.'/console/module-router.php',
    require __DIR__.'/console/construct-router.php'
);
