/var/www/gear-package/gear/test/integration/benchmark/constructor-singular/constructor-singular-controller
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:25:55[22;39m[0;49m
[22;39m[42mScript ended by 0.195 at 26/07/2016 15:25:55[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:25:56[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mScript ended by 2.171 at 26/07/2016 15:25:58[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:    PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:    /var/www/gear-package/my-module/test/phpunit-benchmark.xml

......................

You should really fix these slow tests (>500ms)...
 1. 1034ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenCreateDisplaySuccessful
 2. 757ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testCreateSuccess
 3. 739ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenViewDisplaySuccessfulWithValidId
 4. 667ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
 5. 660ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testEditAfterCreateOk
 6. 615ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteAfterEditOk


XHProf runs: 22
 * MyModuleTest\ControllerTest\IndexControllerTest::testIndexAction
   http://10.10.10.99:8888?run=5797ab36a1bf4&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetService
   http://10.10.10.99:8888?run=5797ab36be18d&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797ab36f1579&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab3808ede&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797ab385c39d&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateWithoutArgumentsRedirectToCreate
   http://10.10.10.99:8888?run=5797ab38cc1d7&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab3917450&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797ab396db0e&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab39e87b3&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797ab3a6270d&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797ab3ad68ac&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797ab3b5663a&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab3ba895d&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797ab3c08448&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab3c53c6a&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797ab3d21a78&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797ab3d9eb1a&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797ab3e6b839&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797ab3ed00a9&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
   http://10.10.10.99:8888?run=5797ab3f8cc6c&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797ab403de3e&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797ab40e1c40&source=MyModule




Time: 10.65 seconds, Memory: 108.25MB

OK (22 tests, 125 assertions)
