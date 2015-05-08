<?php
include 'ServiceLocator.php';

$serviceLocator = new \GearAdmin\ServiceLocator();

\Codeception\Util\Autoload::registerSuffix('Tester', __DIR__);
\Codeception\Util\Autoload::registerSuffix('Page', __DIR__.DIRECTORY_SEPARATOR.'Pages');
\Codeception\Util\Autoload::registerSuffix('Steps', __DIR__.DIRECTORY_SEPARATOR.'_steps');
