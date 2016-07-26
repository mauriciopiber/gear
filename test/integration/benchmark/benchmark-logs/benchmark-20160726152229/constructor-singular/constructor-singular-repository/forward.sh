/var/www/gear-package/gear/test/integration/benchmark/constructor-singular/constructor-singular-repository
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:25:41[22;39m[0;49m
[22;39m[42mScript ended by 0.155 at 26/07/2016 15:25:42[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:25:42[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mScript ended by 2.253 at 26/07/2016 15:25:44[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:	PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:	/var/www/gear-package/my-module/test/phpunit-benchmark.xml

............

You should really fix these slow tests (>500ms)...
 1. 515ms to run MyModuleTest\ServiceTest\IntForeignKeyServiceTest:testSelectAllCacheWithCache


XHProf runs: 12
 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab2996785&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab29bcc66&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797ab29e3057&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797ab2a0dedc&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797ab2a71c12&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797ab2b041b3&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797ab2b2d847&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797ab2b526c6&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797ab2b6eeec&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCreate
   http://10.10.10.99:8888?run=5797ab2bb8ae0&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797ab2c24e55&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testDelete
   http://10.10.10.99:8888?run=5797ab2c5cfdd&source=MyModule




Time: 3.66 seconds, Memory: 45.75MB

OK (12 tests, 30 assertions)
