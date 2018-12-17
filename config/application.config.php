<?php return array (
  'modules' =>
  array (
      'DoctrineModule',
      'DoctrineORMModule',
      'DoctrineDataFixtureModule',
      'Gear\Deploy',
      'Gear\Jenkins',
      'Gear\Version',
      'Gear\Console',
      'Gear\Util',
      'Gear\Git',
      'Gear\Schema',
      'Gear\Jira',
      'Gear\Config',
      'Gear'
  ),
  'module_listener_options' =>
  array (
    'module_paths' =>
    array (
        '../.',
        './vendor',
    ),
    'config_glob_paths' =>
    array (
        'config/autoload/{,*.}{global,local}.php',
    ),
  ),
); ?>
