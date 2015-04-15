<?php
include 'ZendServiceLocator.php';
// This is global bootstrap for autoloading
$zendServiceLocator = new \Teste\ZendServiceLocator();
\Codeception\Util\Autoload::addNamespace('Teste\Pages', __DIR__.DIRECTORY_SEPARATOR.'_pages');
require_once '_support/LoginCommons.php';
