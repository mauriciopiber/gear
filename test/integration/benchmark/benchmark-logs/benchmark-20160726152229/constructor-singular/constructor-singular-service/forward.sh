/var/www/gear-package/gear/test/integration/benchmark/constructor-singular/constructor-singular-service
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:25:48[22;39m[0;49m
[22;39m[42mScript ended by 0.191 at 26/07/2016 15:25:49[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:25:49[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mScript ended by 2.542 at 26/07/2016 15:25:51[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:	PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:	/var/www/gear-package/my-module/test/phpunit-benchmark.xml

................

XHProf runs: 16
 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab3068a69&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797ab3080fc1&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797ab30ace9b&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797ab30c7cc0&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797ab30f0d3b&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797ab3142d9e&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797ab3166bd1&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797ab319fb16&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797ab31c1cc8&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyASC
   http://10.10.10.99:8888?run=5797ab31ee2c5&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyDESC
   http://10.10.10.99:8888?run=5797ab321e910&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797ab32416ce&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797ab32675cd&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797ab328669e&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797ab32a4c29&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797ab32ec980&source=MyModule




Time: 2.95 seconds, Memory: 50.50MB

OK (16 tests, 36 assertions)
