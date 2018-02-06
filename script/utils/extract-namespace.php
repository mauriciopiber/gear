<?php
require __DIR__.'/../../init_autoloader.php';

use Gear\Code\NamespaceForward;

$data = file_get_contents(__DIR__.'/../../data/extrat1.txt');

$namespaceForward = new NamespaceForward();

$result = $namespaceForward->format($data);

echo "\n";

foreach ($result['use'***REMOVED*** as $use) {

    echo $use."\n";
}

echo "\n";

echo $result['code'***REMOVED***;

echo "\n";
echo "\n";
