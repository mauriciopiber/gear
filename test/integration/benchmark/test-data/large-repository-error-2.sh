#!/bin/bash

echo "
vagrant@gear:/var/www/gear-package/my-module$ vendor/bin/phpunit -c /var/www/gear-package/my-module/test/phpunit-benchmark.xml 
PHP Parse error:  syntax error, unexpected '/', expecting function (T_FUNCTION) in /var/www/gear-package/my-module/test/unit/MyModuleTest/ControllerTest/IndexControllerFactoryTest.php on line 8
PHP Stack trace:
PHP   1. {main}() /var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:0
PHP   2. PHPUnit_TextUI_Command::main() /var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47
PHP   3. PHPUnit_TextUI_Command->run() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/TextUI/Command.php:100
PHP   4. PHPUnit_TextUI_Command->handleArguments() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/TextUI/Command.php:111
PHP   5. PHPUnit_Util_Configuration->getTestSuiteConfiguration() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/TextUI/Command.php:649
PHP   6. PHPUnit_Util_Configuration->getTestSuite() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/Util/Configuration.php:870
PHP   7. PHPUnit_Framework_TestSuite->addTestFiles() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/Util/Configuration.php:959
PHP   8. PHPUnit_Framework_TestSuite->addTestFile() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/Framework/TestSuite.php:409
PHP   9. PHPUnit_Util_Fileloader::checkAndLoad() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/Framework/TestSuite.php:335
PHP  10. PHPUnit_Util_Fileloader::load() /var/www/gear-package/my-module/vendor/phpunit/phpunit/src/Util/Fileloader.php:38
vagrant@gear:/var/www/gear-package/my-module$ 
"