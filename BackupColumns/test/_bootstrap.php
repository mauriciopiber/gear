<?php
// This is global bootstrap for autoloading
include 'ZendServiceLocator.php';

$zendServiceLocator = new \Column\ZendServiceLocator();

\Codeception\Util\Autoload::register('Column\Pages', 'Page', __DIR__.DIRECTORY_SEPARATOR.'Pages');
require_once '_support/LoginCommons.php';
