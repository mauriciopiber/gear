<?php
// This is global bootstrap for autoloading
include 'ZendServiceLocator.php';

$zendServiceLocator = new \TestUpload\ZendServiceLocator();

\Codeception\Util\Autoload::register('TestUpload\Pages', 'Page', __DIR__.DIRECTORY_SEPARATOR.'Pages');
require_once '_support/LoginCommons.php';
