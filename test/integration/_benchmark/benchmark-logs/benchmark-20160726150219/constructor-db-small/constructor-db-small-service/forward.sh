/var/www/gear-package/gear/test/integration/benchmark/constructor-db-small/constructor-db-small-service
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:06:06[22;39m[0;49m
[22;39m[42mScript ended by 0.234 at 26/07/2016 15:06:07[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:06:07[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDb" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbNotNull" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUnique" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUniqueNotNull" criado.[22;39m[0;49m
[22;39m[42mScript ended by 44.929 at 26/07/2016 15:06:52[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:    PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:    /var/www/gear-package/my-module/test/phpunit-benchmark.xml

................................................................. 65 / 68 ( 95%)
...

You should really fix these slow tests (>500ms)...
 1. 667ms to run MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest:testDelete
 2. 520ms to run MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest:testSelectAllCacheWithCache
 3. 502ms to run MyModuleTest\ServiceTest\AllColumnsDbServiceTest:testDelete


XHProf runs: 68
 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a6bd3a284&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a6bd54d6e&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSetAllColumnsDbNotNullRepository
   http://10.10.10.99:8888?run=5797a6bd77581&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testGetAllColumnsDbNotNullRepository
   http://10.10.10.99:8888?run=5797a6bd9c55f&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a6bdef0d7&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a6be6f38f&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a6be889af&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a6bea34f8&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectOneByIdAllColumnsDbNotNull
   http://10.10.10.99:8888?run=5797a6bebc77e&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectOneByVarcharUploadImageNotNull
   http://10.10.10.99:8888?run=5797a6bed8a11&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectOneByVarcharEmailNotNull
   http://10.10.10.99:8888?run=5797a6bf0a447&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a6bf55295&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a6bfa59dd&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a6c056aa1&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a6c0795dc&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a6c09a750&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSetAllColumnsDbRepository
   http://10.10.10.99:8888?run=5797a6c0b455f&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testGetAllColumnsDbRepository
   http://10.10.10.99:8888?run=5797a6c0d1367&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a6c115280&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a6c18dcb0&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a6c1ade3e&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a6c1d5680&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectOneByIdAllColumnsDb
   http://10.10.10.99:8888?run=5797a6c2293b2&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectOneByVarcharUploadImage
   http://10.10.10.99:8888?run=5797a6c2476c8&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectOneByVarcharEmail
   http://10.10.10.99:8888?run=5797a6c274458&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a6c2beabf&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a6c328962&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a6c3a6e10&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a6c3d26b7&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a6c3f25eb&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSetAllColumnsDbUniqueNotNullRepository
   http://10.10.10.99:8888?run=5797a6c4343b6&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testGetAllColumnsDbUniqueNotNullRepository
   http://10.10.10.99:8888?run=5797a6c4586f4&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a6c4ae59b&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a6c53c74a&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a6c5619c7&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a6c58fda3&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectOneByIdAllColumnsDbUniqueNotNull
   http://10.10.10.99:8888?run=5797a6c5b2e2e&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectOneByVarcharUploadImageUniqueNotNull
   http://10.10.10.99:8888?run=5797a6c5e2618&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectOneByVarcharEmailUniqueNotNull
   http://10.10.10.99:8888?run=5797a6c613937&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a6c65d4cc&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a6c6a70d3&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a6c6ee441&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a6c7236e8&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a6c74440f&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSetAllColumnsDbUniqueRepository
   http://10.10.10.99:8888?run=5797a6c77032f&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testGetAllColumnsDbUniqueRepository
   http://10.10.10.99:8888?run=5797a6c78d5c4&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a6c7b466a&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a6c8338ae&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a6c85fdb1&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a6c881345&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectOneByIdAllColumnsDbUnique
   http://10.10.10.99:8888?run=5797a6c8c74d1&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectOneByVarcharUploadImageUnique
   http://10.10.10.99:8888?run=5797a6c8f2733&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectOneByVarcharEmailUnique
   http://10.10.10.99:8888?run=5797a6c93eca9&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a6c97c684&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a6c9cffc2&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a6ca19fd3&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a6ca3e368&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a6ca5f71a&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797a6ca826dd&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797a6caa00f4&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a6cac8df4&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a6cb23bad&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a6cb42f5e&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a6cb63a21&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797a6cb8af18&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a6cbb7f1c&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a6cbee606&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a6cc31f4d&source=MyModule




Time: 15.86 seconds, Memory: 145.00MB

OK (68 tests, 310 assertions)
