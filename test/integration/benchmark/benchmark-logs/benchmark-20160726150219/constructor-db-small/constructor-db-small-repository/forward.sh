/var/www/gear-package/gear/test/integration/benchmark/constructor-db-small/constructor-db-small-repository
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:04:57[22;39m[0;49m
[22;39m[42mScript ended by 0.163 at 26/07/2016 15:04:57[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:04:57[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDb" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbNotNull" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUnique" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUniqueNotNull" criado.[22;39m[0;49m
[22;39m[42mScript ended by 50.595 at 26/07/2016 15:05:48[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:	PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:	/var/www/gear-package/my-module/test/phpunit-benchmark.xml

...............................................................  63 / 104 ( 60%)
.........................................

XHProf runs: 104
 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a67d1f422&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a67d4764c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a67d85a4b&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a67dab281&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a67dd85f5&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a67e14aa7&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a67e3e774&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a67e7c24b&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectOneByIdAllColumnsDbNotNull
   http://10.10.10.99:8888?run=5797a67e9e16c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectOneByVarcharUploadImageNotNull
   http://10.10.10.99:8888?run=5797a67eb902c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectOneByVarcharEmailNotNull
   http://10.10.10.99:8888?run=5797a67edf4b6&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbNotNullASC
   http://10.10.10.99:8888?run=5797a67f1d9e0&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbNotNullDESC
   http://10.10.10.99:8888?run=5797a67f4b261&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageNotNullASC
   http://10.10.10.99:8888?run=5797a67f79890&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageNotNullDESC
   http://10.10.10.99:8888?run=5797a67fa8ad3&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharEmailNotNullASC
   http://10.10.10.99:8888?run=5797a67fd3b2f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharEmailNotNullDESC
   http://10.10.10.99:8888?run=5797a68000c30&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a680247f7&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a6804f3cf&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a68071948&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a68092f09&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a680bd590&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a680da8a9&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a68103724&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a681480f8&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a681742b6&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a68199e91&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a681c2207&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a681e1310&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a682124a2&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectOneByIdAllColumnsDb
   http://10.10.10.99:8888?run=5797a6823a5fe&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectOneByVarcharUploadImage
   http://10.10.10.99:8888?run=5797a68264365&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectOneByVarcharEmail
   http://10.10.10.99:8888?run=5797a68292675&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByIdAllColumnsDbASC
   http://10.10.10.99:8888?run=5797a682bc9a0&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByIdAllColumnsDbDESC
   http://10.10.10.99:8888?run=5797a682ee248&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharUploadImageASC
   http://10.10.10.99:8888?run=5797a683290ff&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharUploadImageDESC
   http://10.10.10.99:8888?run=5797a68350774&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharEmailASC
   http://10.10.10.99:8888?run=5797a68374ba5&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharEmailDESC
   http://10.10.10.99:8888?run=5797a6839798c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a683be1ef&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a683e7c8a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a6842004f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a68447886&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a68473b8a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a68491607&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a684aacab&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a684f2ad7&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a6851e66a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a6853dbe2&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a68558e9e&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a6857fc71&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a685a7dae&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectOneByIdAllColumnsDbUniqueNotNull
   http://10.10.10.99:8888?run=5797a685d00de&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectOneByVarcharUploadImageUniqueNotNull
   http://10.10.10.99:8888?run=5797a685ebe05&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectOneByVarcharEmailUniqueNotNull
   http://10.10.10.99:8888?run=5797a6861380e&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueNotNullASC
   http://10.10.10.99:8888?run=5797a686359c7&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueNotNullDESC
   http://10.10.10.99:8888?run=5797a68656a6c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueNotNullASC
   http://10.10.10.99:8888?run=5797a6867acb5&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueNotNullDESC
   http://10.10.10.99:8888?run=5797a6869b126&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharEmailUniqueNotNullASC
   http://10.10.10.99:8888?run=5797a686c01da&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharEmailUniqueNotNullDESC
   http://10.10.10.99:8888?run=5797a686ef9cc&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a6872de03&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a6875cb95&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a6878bbc7&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a687b45e5&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a687eb931&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a68823c69&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a68849698&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a688ae54a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a688cdba9&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a688edd98&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a689169f0&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a68931384&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a6894f597&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectOneByIdAllColumnsDbUnique
   http://10.10.10.99:8888?run=5797a6896dc40&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectOneByVarcharUploadImageUnique
   http://10.10.10.99:8888?run=5797a68989eb8&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectOneByVarcharEmailUnique
   http://10.10.10.99:8888?run=5797a689af8f5&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueASC
   http://10.10.10.99:8888?run=5797a689d81df&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueDESC
   http://10.10.10.99:8888?run=5797a68a09ddb&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueASC
   http://10.10.10.99:8888?run=5797a68a2f457&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueDESC
   http://10.10.10.99:8888?run=5797a68a56a14&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharEmailUniqueASC
   http://10.10.10.99:8888?run=5797a68a779c2&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharEmailUniqueDESC
   http://10.10.10.99:8888?run=5797a68a97c3f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a68abaf51&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a68ae3541&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a68b0ed66&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a68b2d134&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a68b52c38&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a68b79a01&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a68ba180d&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a68bc5131&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a68be0aa3&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a68c0c706&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a68c2b4ff&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a68c48838&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a68c63e6b&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797a68c7f2aa&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyASC
   http://10.10.10.99:8888?run=5797a68ca1dda&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyDESC
   http://10.10.10.99:8888?run=5797a68ccb99e&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a68d08227&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a68d4c941&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a68d70acf&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a68d9ab21&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a68dcb06d&source=MyModule




Time: 17.57 seconds, Memory: 198.00MB

OK (104 tests, 388 assertions)
