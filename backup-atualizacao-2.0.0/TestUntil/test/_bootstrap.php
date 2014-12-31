<?php
// This is global bootstrap for autoloading
include 'ZendServiceLocator.php';

$zendServiceLocator = new \TestUntil\ZendServiceLocator();

\Codeception\Util\Autoload::registerSuffix('Tester', __DIR__);
\Codeception\Util\Autoload::registerSuffix('Page', __DIR__.DIRECTORY_SEPARATOR.'Pages');
\Codeception\Util\Autoload::registerSuffix('Steps', __DIR__.DIRECTORY_SEPARATOR.'_steps');
