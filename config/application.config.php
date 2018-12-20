<?php
$modules = [
    'Gear\Version',
    'Gear\Util',
    'Gear\Console',
    'Gear\Schema',
    'Gear\Config',
    'Gear'
***REMOVED***;

if (getenv('PHINX_ENVIRONMENT') !== 'PRODUCTION') {
    $modules = array_merge([
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
        'Gear\Deploy',
        'Gear\Jenkins',
        'Gear\Jira',
    ***REMOVED***, $modules);
}

return [
    'modules' => $modules,
    'module_listener_options' => [
        'module_paths' => [
            '../.',
            './vendor',
        ***REMOVED***,
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ***REMOVED***,
    ***REMOVED***,
***REMOVED***; ?>
