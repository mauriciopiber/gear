<?php return array (
  'modules' =>
  array (
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
