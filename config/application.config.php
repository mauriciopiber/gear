<?php return array (
  'modules' =>
  array (
      'DoctrineModule',
      'DoctrineORMModule',
      'DoctrineDataFixtureModule',
      'ZfcTwig',
      'GearBase',
      'GearJson',
      'Gear',
      'GearDeploy',
      'GearVersion'
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
