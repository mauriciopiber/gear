<?php return array (
  'modules' =>
  array (
      'Zend\Router',
      'Zend\Mvc\Console',
      'Gear\Util',
      'Gear\Schema',
      'Gear\Config',
      'Gear\Console',
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
