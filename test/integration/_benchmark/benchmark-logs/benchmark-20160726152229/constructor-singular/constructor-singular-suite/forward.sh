/var/www/gear-package/gear/test/integration/benchmark/constructor-singular/constructor-singular-suite
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:26:09[22;39m[0;49m
[22;39m[42mScript ended by 0.162 at 26/07/2016 15:26:09[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:26:10[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mScript ended by 2.453 at 26/07/2016 15:26:12[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:    PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:    /var/www/gear-package/my-module/test/phpunit-benchmark.xml

................................................................

You should really fix these slow tests (>500ms)...
 1. 753ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testCreateSuccess
 2. 683ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteAfterEditOk
 3. 636ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testEditAfterCreateOk
 4. 559ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
 5. 518ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListDisplaySuccessfulWithValidId
 6. 515ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenCreateDisplaySuccessful
 7. 511ms to run MyModuleTest\ServiceTest\IntForeignKeyServiceTest:testUpdate


XHProf runs: 64
 * MyModuleTest\ControllerTest\IndexControllerFactoryTest::testCreateFactory
   http://10.10.10.99:8888?run=5797ab45294b8&source=MyModule

 * MyModuleTest\ControllerTest\IndexControllerTest::testIndexAction
   http://10.10.10.99:8888?run=5797ab4550d70&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetService
   http://10.10.10.99:8888?run=5797ab457590f&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797ab4595ee8&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab4622b83&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797ab465e653&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateWithoutArgumentsRedirectToCreate
   http://10.10.10.99:8888?run=5797ab46bb95e&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab470c2cd&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797ab4771e3c&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab47e308c&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797ab485c5fa&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797ab48d2517&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797ab4931372&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab4970da3&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797ab49cc51c&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797ab4a2466a&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797ab4ae00af&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797ab4b70f81&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797ab4c013e8&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797ab4c61f95&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
   http://10.10.10.99:8888?run=5797ab4d09ef7&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797ab4da8cf2&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797ab4e6b142&source=MyModule

 * MyModule\MyModuleTest\EntityTest\IntForeignKeyTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab4e9476f&source=MyModule

 * MyModule\MyModuleTest\EntityTest\IntForeignKeyTest::testGetterInitiateByNull
   http://10.10.10.99:8888?run=5797ab4ebaaec&source=MyModule

 * MyModule\MyModuleTest\EntityTest\IntForeignKeyTest::testSetterAndGet with data set #0
   http://10.10.10.99:8888?run=5797ab4ee0bf2&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab4f0fb03&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab4f2e48e&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testGetInputFilter
   http://10.10.10.99:8888?run=5797ab4f55d4e&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testGetRequiredInvalidPost
   http://10.10.10.99:8888?run=5797ab4f7760a&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testReturnTrueWithValidPost with data set #0
   http://10.10.10.99:8888?run=5797ab4f99b40&source=MyModule

 * MyModuleTest\FormTest\IntForeignKeyFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab4fb6870&source=MyModule

 * MyModuleTest\FormTest\IntForeignKeyFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab4fd8181&source=MyModule

 * MyModule\IntForeignKeySearchFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab5001fc5&source=MyModule

 * MyModule\IntForeignKeySearchFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab501d31b&source=MyModule

 * Teste\MyModuleTest\ModuleTest::testLocation
   http://10.10.10.99:8888?run=5797ab502965b&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab5043b03&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab50653f1&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797ab5090f13&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797ab50b86b7&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797ab50e15b0&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797ab51161e9&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797ab5132da9&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797ab5173614&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797ab5198eef&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyASC
   http://10.10.10.99:8888?run=5797ab51c1aba&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyDESC
   http://10.10.10.99:8888?run=5797ab51eb21e&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797ab521cf67&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797ab5240497&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797ab526754d&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab52822e0&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797ab529fd7e&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab52ba35e&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab52dbed7&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797ab53110d4&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797ab532dde2&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797ab535bc28&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797ab53a2e32&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797ab53c5dc9&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797ab53e198e&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797ab540ae31&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCreate
   http://10.10.10.99:8888?run=5797ab5453df3&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797ab54d3485&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testDelete
   http://10.10.10.99:8888?run=5797ab551dd1b&source=MyModule




Time: 16.48 seconds, Memory: 165.75MB

OK (64 tests, 220 assertions)
