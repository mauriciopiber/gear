#!/bin/bash

echo "
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:    PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:    /var/www/gear-package/my-module/test/phpunit-benchmark.xml

..FF.........FSSSSF..SSS

You should really fix these slow tests (>500ms)...
 1. 795ms to run MyModuleTest\ControllerTest\AllColumnsDbControllerTest:testWhenFilterWithoutData
 2. 764ms to run MyModuleTest\ControllerTest\AllColumnsDbControllerTest:testCreateSuccess
 3. 758ms to run MyModuleTest\ControllerTest\AllColumnsDbControllerTest:testWhenListDisplaySuccessful
 4. 663ms to run MyModuleTest\ControllerTest\AllColumnsDbControllerTest:testWhenFilterWithoutDataWithPRG
 5. 581ms to run MyModuleTest\ControllerTest\AllColumnsDbControllerTest:testWhenCreateDisplaySuccessful
 6. 512ms to run MyModuleTest\ControllerTest\AllColumnsDbControllerTest:testAccessUploadImageWithInvalidIdReturnToList


XHProf runs: 17
 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetService
   http://10.10.10.99:8888?run=57974af4dc3b7&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetForm
   http://10.10.10.99:8888?run=57974af519c9f&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=57974af5abb4d&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=57974af604482&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=57974af64d107&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=57974af6b8145&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=57974af78142d&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=57974af858273&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=57974af909781&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=57974af9659e1&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=57974af9bbc22&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=57974afa43c3c&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=57974afa9034d&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=57974afb67f4f&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=57974afbdbae7&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithoutIdReturnToList
   http://10.10.10.99:8888?run=57974afc44ff5&source=MyModule

 MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithInvalidIdReturnToList
   http://10.10.10.99:8888?run=57974afcc5d0b&source=MyModule




Time: 9.04 seconds, Memory: 128.25MB

There were 4 failures:

1) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessful
Failed asserting response code "200", actual status code is "500"

/var/www/gear-package/my-module/vendor/zendframework/zend-test/src/PHPUnit/Controller/AbstractControllerTestCase.php:417
/var/www/gear-package/my-module/test/unit/MyModuleTest/ControllerTest/AllColumnsDbControllerTest.php:92
/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

2) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
Failed asserting response code "303", actual status code is "500"

/var/www/gear-package/my-module/vendor/zendframework/zend-test/src/PHPUnit/Controller/AbstractControllerTestCase.php:417
/var/www/gear-package/my-module/test/unit/MyModuleTest/ControllerTest/AllColumnsDbControllerTest.php:107
/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

3) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess
Failed asserting response code "302", actual status code is "500"

/var/www/gear-package/my-module/vendor/zendframework/zend-test/src/PHPUnit/Controller/AbstractControllerTestCase.php:417
/var/www/gear-package/my-module/test/unit/MyModuleTest/ControllerTest/AllColumnsDbControllerTest.php:279
/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

4) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCantCreateWithWrongImage
Failed asserting response code "200", actual status code is "500"

/var/www/gear-package/my-module/vendor/zendframework/zend-test/src/PHPUnit/Controller/AbstractControllerTestCase.php:417
/var/www/gear-package/my-module/test/unit/MyModuleTest/ControllerTest/AllColumnsDbControllerTest.php:478
/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

--

There were 7 skipped tests:

1) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessfulWithValidId
This test depends on "MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess" to pass.

/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

2) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessfulWithValidId
This test depends on "MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess" to pass.

/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

3) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
This test depends on "MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess" to pass.

/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

4) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testEditAfterCreateOk
This test depends on "MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess" to pass.

/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

5) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageReturnPRGPlugin
This test depends on "MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess" to pass.

/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

6) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageProcessSuccess
This test depends on "MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess" to pass.

/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

7) MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteAfterEditOk
This test depends on "MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess" to pass.

/var/www/gear-package/my-module/vendor/phpunit/phpunit/phpunit:47

FAILURES!
Tests: 17, Assertions: 71, Failures: 4, Skipped: 7.
"
