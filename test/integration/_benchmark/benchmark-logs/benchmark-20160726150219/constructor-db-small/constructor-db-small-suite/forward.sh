/var/www/gear-package/gear/test/integration/benchmark/constructor-db-small/constructor-db-small-suite
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:09:57[22;39m[0;49m
[22;39m[42mScript ended by 0.179 at 26/07/2016 15:09:57[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:09:57[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDb" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbNotNull" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUnique" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUniqueNotNull" criado.[22;39m[0;49m
[22;39m[42mScript ended by 52.204 at 26/07/2016 15:10:50[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:    PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:    /var/www/gear-package/my-module/test/phpunit-benchmark.xml

...............................................................  63 / 339 ( 18%)
............................................................... 126 / 339 ( 37%)
............................................................... 189 / 339 ( 55%)
............................................................... 252 / 339 ( 74%)
............................................................... 315 / 339 ( 92%)
........................

You should really fix these slow tests (>500ms)...
 1. 5812ms to run MyModuleTest\ServiceTest\AllColumnsDbServiceTest:testDelete
 2. 3253ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testCantCreateWithWrongImage
 3. 3123ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
 4. 3090ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testCreateSuccess
 5. 3061ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteAfterEditOk
 6. 3020ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testEditAfterCreateOk
 7. 2688ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListDisplaySuccessfulWithValidId
 8. 2680ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenViewDisplaySuccessfulWithValidId
 9. 2665ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testCreateSuccess
 10. 2565ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testDeleteAfterEditOk
 11. 2473ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteSucessfullAndRedirectToListWithFailNotFound
 12. 2435ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenViewDisplaySuccessfulWithValidId
 13. 2334ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testEditAfterCreateOk
 14. 2306ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenListDisplaySuccessfulWithValidId
 15. 2301ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidId
 16. 2291ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testViewSucessfullAndRedirectToListWithFailNotFound
 17. 2161ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenEditRedirectWithInvalidIdToListing
 18. 2100ms to run MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest:testDeleteNoExistData
 19. 1877ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testCantCreateWithWrongImage
 20. 1857ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testCreateSuccess
 21. 1854ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenListRedirectSuccessfulPRGWithValidId
 22. 1827ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenCreateDisplaySuccessful
 23. 1699ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testEditAfterCreateOk
 24. 1683ms to run MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest:testSelectAllCacheWithCache
 25. 1641ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testDeleteAfterEditOk
...and there are 58 more above your threshold hidden from view

XHProf runs: 339
 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a7aae048c&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a7ab0c4ac&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7ac102f6&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a7ac7a3e5&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7acf3919&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a7ad71c8f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7adeeda6&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a7af0512b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a7b00332e&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7b0b2cf2&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7b128305&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7b1de6c0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7b22feba&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a7b371a0f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7b464709&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7b54708d&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a7b5db6e6&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a7b70768a&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a7b81850b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithoutIdReturnToList
   http://10.10.10.99:8888?run=5797a7b863908&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithInvalidIdReturnToList
   http://10.10.10.99:8888?run=5797a7b901b37&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageReturnPRGPlugin
   http://10.10.10.99:8888?run=5797a7b99bb34&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageProcessSuccess
   http://10.10.10.99:8888?run=5797a7ba4cd07&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a7bb3a842&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a7bb6e2c9&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a7bba2973&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7bcaf6e6&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a7bd60c76&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7bdafabf&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a7be47b55&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7bedfed5&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a7bf85ea0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a7c02b5ff&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7c0df17c&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7c14516d&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7c1e01e0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7c252ede&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a7c3be8d4&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7c51113a&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7c630f63&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a7c7056ab&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a7c833ab6&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a7c954387&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a7ca440af&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a7ca66953&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a7ca8b9cf&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7cbbd2b1&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a7cce6305&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7cd63fff&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a7ce6cb78&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7cf0d946&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a7cfa2b31&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a7d02ccc0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7d13fa75&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7d1a8bd0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7d2b5259&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7d31a337&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a7d4eef4c&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7d66b3af&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7d7d9668&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a7d92c9b9&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a7db0606a&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a7dce114b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a7de8da8b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a7deb14fc&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a7deda342&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7e0b3553&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a7e20cfa4&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7e279b96&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a7e40233f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7e4bd2d0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a7e553f56&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a7e5f27a8&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7e772faa&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7e7d2309&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7e954a98&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7e9bf6f4&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a7ecd95d8&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7ef5af92&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7f202fdc&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a7f3d840d&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a7f63b046&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a7f97eac3&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a7fc1aca8&source=MyModule

 * MyModuleTest\ControllerTest\IndexControllerFactoryTest::testCreateFactory
   http://10.10.10.99:8888?run=5797a7fca1fd4&source=MyModule

 * MyModuleTest\ControllerTest\IndexControllerTest::testIndexAction
   http://10.10.10.99:8888?run=5797a7fcc8a08&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a7fd0bd26&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a7fd4f77c&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7fe1ffd6&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a7fe77a77&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateWithoutArgumentsRedirectToCreate
   http://10.10.10.99:8888?run=5797a7ff214a4&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7ff71686&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a8019cab3&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a80259fa9&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a802f36c1&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a80391f9f&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a80615122&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a806891ce&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a808d3b53&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a8094f8ab&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a80c011db&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a80edc1d6&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a811925f3&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a813e0232&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
   http://10.10.10.99:8888?run=5797a8170dfe9&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a81a16e2d&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a81d29e16&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbNotNullTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a81d75cbe&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbNotNullTest::testGetterInitiateByNull
   http://10.10.10.99:8888?run=5797a81d91f46&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbNotNullTest::testSetterAndGet with data set #0
   http://10.10.10.99:8888?run=5797a81dbfb0f&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a81de1cb6&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbTest::testGetterInitiateByNull
   http://10.10.10.99:8888?run=5797a81e0a04d&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbTest::testSetterAndGet with data set #0
   http://10.10.10.99:8888?run=5797a81e251fb&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbUniqueNotNullTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a81e4147e&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbUniqueNotNullTest::testGetterInitiateByNull
   http://10.10.10.99:8888?run=5797a81e5edf4&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbUniqueNotNullTest::testSetterAndGet with data set #0
   http://10.10.10.99:8888?run=5797a81e84a6b&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbUniqueTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a81ea35d8&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbUniqueTest::testGetterInitiateByNull
   http://10.10.10.99:8888?run=5797a81ec1c82&source=MyModule

 * MyModule\MyModuleTest\EntityTest\AllColumnsDbUniqueTest::testSetterAndGet with data set #0
   http://10.10.10.99:8888?run=5797a81edca60&source=MyModule

 * MyModule\MyModuleTest\EntityTest\IntForeignKeyTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a81f04034&source=MyModule

 * MyModule\MyModuleTest\EntityTest\IntForeignKeyTest::testGetterInitiateByNull
   http://10.10.10.99:8888?run=5797a81f1e261&source=MyModule

 * MyModule\MyModuleTest\EntityTest\IntForeignKeyTest::testSetterAndGet with data set #0
   http://10.10.10.99:8888?run=5797a81f41d5f&source=MyModule

 * MyModule\MyModuleTest\EntityTest\UploadImageTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a81f80fce&source=MyModule

 * MyModule\MyModuleTest\EntityTest\UploadImageTest::testGetterInitiateByNull
   http://10.10.10.99:8888?run=5797a81fb3f41&source=MyModule

 * MyModule\MyModuleTest\EntityTest\UploadImageTest::testSetterAndGet with data set #0
   http://10.10.10.99:8888?run=5797a81fe26b1&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbFilterTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a8201e1f9&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbFilterTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a82045564&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbFilterTest::testGetInputFilter
   http://10.10.10.99:8888?run=5797a8207776c&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbFilterTest::testReturnTrueWithValidPost with data set #0
   http://10.10.10.99:8888?run=5797a820bacd3&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbNotNullFilterTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a820d804d&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbNotNullFilterTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8210c653&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbNotNullFilterTest::testGetInputFilter
   http://10.10.10.99:8888?run=5797a8213aba9&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbNotNullFilterTest::testReturnTrueWithValidPost with data set #0
   http://10.10.10.99:8888?run=5797a8217b754&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueFilterTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a82196860&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueFilterTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a821b27ed&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueFilterTest::testGetInputFilter
   http://10.10.10.99:8888?run=5797a821d74a2&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueFilterTest::testReturnTrueWithValidPost with data set #0
   http://10.10.10.99:8888?run=5797a8221596f&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueNotNullFilterTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a822332d4&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueNotNullFilterTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8224dfb4&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueNotNullFilterTest::testGetInputFilter
   http://10.10.10.99:8888?run=5797a8226fbb4&source=MyModule

 * MyModuleTest\FilterTest\AllColumnsDbUniqueNotNullFilterTest::testReturnTrueWithValidPost with data set #0
   http://10.10.10.99:8888?run=5797a8229dae6&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a822bf486&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a822d8c6f&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testGetInputFilter
   http://10.10.10.99:8888?run=5797a8230c538&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testGetRequiredInvalidPost
   http://10.10.10.99:8888?run=5797a82339bac&source=MyModule

 * MyModuleTest\FilterTest\IntForeignKeyFilterTest::testReturnTrueWithValidPost with data set #0
   http://10.10.10.99:8888?run=5797a8235d70f&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a823931c5&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a823bcea1&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbNotNullFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a823e44b0&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbNotNullFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a82415813&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbUniqueFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a8243ea35&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbUniqueFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a824726c3&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbUniqueNotNullFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a824aaaef&source=MyModule

 * MyModuleTest\FormTest\AllColumnsDbUniqueNotNullFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a824d6526&source=MyModule

 * MyModuleTest\FormTest\IntForeignKeyFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a8250ba3a&source=MyModule

 * MyModuleTest\FormTest\IntForeignKeyFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8252dfa9&source=MyModule

 * MyModule\AllColumnsDbNotNullSearchFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a82550763&source=MyModule

 * MyModule\AllColumnsDbNotNullSearchFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8256ad40&source=MyModule

 * MyModule\AllColumnsDbSearchFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a82587eb1&source=MyModule

 * MyModule\AllColumnsDbSearchFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a825a4ae6&source=MyModule

 * MyModule\AllColumnsDbUniqueNotNullSearchFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a825c3055&source=MyModule

 * MyModule\AllColumnsDbUniqueNotNullSearchFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a825dd2df&source=MyModule

 * MyModule\AllColumnsDbUniqueSearchFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a82603113&source=MyModule

 * MyModule\AllColumnsDbUniqueSearchFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8261bb42&source=MyModule

 * MyModule\IntForeignKeySearchFormTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a8263f5cb&source=MyModule

 * MyModule\IntForeignKeySearchFormTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8265c614&source=MyModule

 * Teste\MyModuleTest\ModuleTest::testLocation
   http://10.10.10.99:8888?run=5797a8265ead1&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a8267ac5c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a82694c16&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a826c9c3a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a826e65bc&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a82713f39&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a8273840b&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a82751b6f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a8296cbc1&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectOneByIdAllColumnsDbNotNull
   http://10.10.10.99:8888?run=5797a82a2df7f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectOneByVarcharUploadImageNotNull
   http://10.10.10.99:8888?run=5797a82a554d2&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectOneByVarcharEmailNotNull
   http://10.10.10.99:8888?run=5797a82a73d57&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbNotNullASC
   http://10.10.10.99:8888?run=5797a82ace6d4&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbNotNullDESC
   http://10.10.10.99:8888?run=5797a82af3829&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageNotNullASC
   http://10.10.10.99:8888?run=5797a82b2c2ef&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageNotNullDESC
   http://10.10.10.99:8888?run=5797a82b4fbba&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharEmailNotNullASC
   http://10.10.10.99:8888?run=5797a82b7a238&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testSelectAllOrderByVarcharEmailNotNullDESC
   http://10.10.10.99:8888?run=5797a82baa2bb&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a82bde7f1&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a82c11001&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a82c308ca&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a82c4e80c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbNotNullRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a82c73898&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a82c8db7e&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a82caca9f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a82cd97eb&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a82d0ee8b&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a82d2bdeb&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a82d46580&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a82da3ab8&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a82dc76a4&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectOneByIdAllColumnsDb
   http://10.10.10.99:8888?run=5797a82df0519&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectOneByVarcharUploadImage
   http://10.10.10.99:8888?run=5797a82e19fbb&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectOneByVarcharEmail
   http://10.10.10.99:8888?run=5797a82e38b7c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByIdAllColumnsDbASC
   http://10.10.10.99:8888?run=5797a82e595ff&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByIdAllColumnsDbDESC
   http://10.10.10.99:8888?run=5797a82e8d2c9&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharUploadImageASC
   http://10.10.10.99:8888?run=5797a82ebaa25&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharUploadImageDESC
   http://10.10.10.99:8888?run=5797a82ee6cae&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharEmailASC
   http://10.10.10.99:8888?run=5797a82f13971&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testSelectAllOrderByVarcharEmailDESC
   http://10.10.10.99:8888?run=5797a82f33ce1&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a82f6701a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a82f99582&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a82fc44fa&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a82fe703a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a83017101&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a830311be&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8304b8d6&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a8308a374&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a830acbe2&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a830cc858&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a830ea402&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a8311082c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a8312fab7&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectOneByIdAllColumnsDbUniqueNotNull
   http://10.10.10.99:8888?run=5797a83154189&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectOneByVarcharUploadImageUniqueNotNull
   http://10.10.10.99:8888?run=5797a8317f756&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectOneByVarcharEmailUniqueNotNull
   http://10.10.10.99:8888?run=5797a831a6d50&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueNotNullASC
   http://10.10.10.99:8888?run=5797a831d3f9e&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueNotNullDESC
   http://10.10.10.99:8888?run=5797a8327013a&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueNotNullASC
   http://10.10.10.99:8888?run=5797a83296cb3&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueNotNullDESC
   http://10.10.10.99:8888?run=5797a832c0df2&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharEmailUniqueNotNullASC
   http://10.10.10.99:8888?run=5797a832e682f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testSelectAllOrderByVarcharEmailUniqueNotNullDESC
   http://10.10.10.99:8888?run=5797a8331721d&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a8333f803&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a83367a3b&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a83389945&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a833a5c2f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueNotNullRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a833c8671&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a833eb407&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8341149c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a83447548&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a83470a08&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a8349d721&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a834ce15d&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a834ecf76&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a835194b8&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectOneByIdAllColumnsDbUnique
   http://10.10.10.99:8888?run=5797a835475b0&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectOneByVarcharUploadImageUnique
   http://10.10.10.99:8888?run=5797a8356d992&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectOneByVarcharEmailUnique
   http://10.10.10.99:8888?run=5797a8358dbff&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueASC
   http://10.10.10.99:8888?run=5797a835b27a1&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByIdAllColumnsDbUniqueDESC
   http://10.10.10.99:8888?run=5797a835dd223&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueASC
   http://10.10.10.99:8888?run=5797a836195ba&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharUploadImageUniqueDESC
   http://10.10.10.99:8888?run=5797a8364134f&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharEmailUniqueASC
   http://10.10.10.99:8888?run=5797a836632bd&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testSelectAllOrderByVarcharEmailUniqueDESC
   http://10.10.10.99:8888?run=5797a83694ece&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a836c8b5c&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a8370bc70&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a8372fc80&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a83757791&source=MyModule

 * MyModuleTest\RepositoryTest\AllColumnsDbUniqueRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a8378c0fe&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a837c143b&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a837e16dc&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAll
   http://10.10.10.99:8888?run=5797a8380989a&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilter
   http://10.10.10.99:8888?run=5797a83826891&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllWithBasicFilterFoundNone
   http://10.10.10.99:8888?run=5797a83841b45&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnEntity
   http://10.10.10.99:8888?run=5797a83862157&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectByIdReturnNull
   http://10.10.10.99:8888?run=5797a838843bf&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteNoExistData
   http://10.10.10.99:8888?run=5797a838a7ed3&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797a838c5f02&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyASC
   http://10.10.10.99:8888?run=5797a838ed952&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testSelectAllOrderByIdIntForeignKeyDESC
   http://10.10.10.99:8888?run=5797a83924650&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testCreateNewData
   http://10.10.10.99:8888?run=5797a839621db&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testUpdateExistData
   http://10.10.10.99:8888?run=5797a83990518&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTest::testDeleteExistData
   http://10.10.10.99:8888?run=5797a839b6748&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a839da335&source=MyModule

 * MyModuleTest\RepositoryTest\IntForeignKeyRepositoryTraitTest::testSet
   http://10.10.10.99:8888?run=5797a83a0c9fe&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a83a2e7e4&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a83a4cc53&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSetAllColumnsDbNotNullRepository
   http://10.10.10.99:8888?run=5797a83a737d5&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testGetAllColumnsDbNotNullRepository
   http://10.10.10.99:8888?run=5797a83a91856&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a83ada8cb&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a83b45e73&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a83b6d743&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a83b90408&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectOneByIdAllColumnsDbNotNull
   http://10.10.10.99:8888?run=5797a83bbf9d1&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectOneByVarcharUploadImageNotNull
   http://10.10.10.99:8888?run=5797a83befe09&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testSelectOneByVarcharEmailNotNull
   http://10.10.10.99:8888?run=5797a83c24c7d&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a83c90768&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a83cded16&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbNotNullServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a83d1db1b&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a83d49f3c&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a83d63a09&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSetAllColumnsDbRepository
   http://10.10.10.99:8888?run=5797a83d8ad8e&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testGetAllColumnsDbRepository
   http://10.10.10.99:8888?run=5797a83da999d&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a83ded63d&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a83e517f4&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a83e78728&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a83e9e57c&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectOneByIdAllColumnsDb
   http://10.10.10.99:8888?run=5797a83ee2cf6&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectOneByVarcharUploadImage
   http://10.10.10.99:8888?run=5797a83f0fb58&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testSelectOneByVarcharEmail
   http://10.10.10.99:8888?run=5797a83f2ad7a&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a83f6719c&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a83fc15c6&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a8459aa62&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a845beb50&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a845e1356&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSetAllColumnsDbUniqueNotNullRepository
   http://10.10.10.99:8888?run=5797a84613293&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testGetAllColumnsDbUniqueNotNullRepository
   http://10.10.10.99:8888?run=5797a8462fcdb&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a847c22ad&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a8497b2a6&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a84a59683&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a84a9f85b&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectOneByIdAllColumnsDbUniqueNotNull
   http://10.10.10.99:8888?run=5797a84abf656&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectOneByVarcharUploadImageUniqueNotNull
   http://10.10.10.99:8888?run=5797a84ae06e5&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testSelectOneByVarcharEmailUniqueNotNull
   http://10.10.10.99:8888?run=5797a84b1907d&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a84bdb8bb&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a84c5acd4&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueNotNullServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a84c94b83&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a84cc0637&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a84cefb22&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSetAllColumnsDbUniqueRepository
   http://10.10.10.99:8888?run=5797a84d4ccb9&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testGetAllColumnsDbUniqueRepository
   http://10.10.10.99:8888?run=5797a84d71856&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a84daccf8&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a84e2469c&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a84e3d435&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a84e59794&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectOneByIdAllColumnsDbUnique
   http://10.10.10.99:8888?run=5797a84e82ebd&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectOneByVarcharUploadImageUnique
   http://10.10.10.99:8888?run=5797a84eb9c8d&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testSelectOneByVarcharEmailUnique
   http://10.10.10.99:8888?run=5797a84eec016&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a84f5f58a&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a84fc0c0f&source=MyModule

 * MyModuleTest\ServiceTest\AllColumnsDbUniqueServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a85000f8f&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testServiceLocator
   http://10.10.10.99:8888?run=5797a8502c44b&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCallUsingServiceLocator
   http://10.10.10.99:8888?run=5797a8504f7aa&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797a8507e91b&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetIntForeignKeyRepository
   http://10.10.10.99:8888?run=5797a85229581&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSetSelectAllCache
   http://10.10.10.99:8888?run=5797a8529b74c&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectAllCacheWithCache
   http://10.10.10.99:8888?run=5797a85366102&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testGetMappingInfo
   http://10.10.10.99:8888?run=5797a85391057&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectById
   http://10.10.10.99:8888?run=5797a853b4d9c&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testSelectOneByIdIntForeignKey
   http://10.10.10.99:8888?run=5797a853d50fd&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testCreate
   http://10.10.10.99:8888?run=5797a854257b9&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testUpdate
   http://10.10.10.99:8888?run=5797a8546bf27&source=MyModule

 * MyModuleTest\ServiceTest\IntForeignKeyServiceTest::testDelete
   http://10.10.10.99:8888?run=5797a854a2357&source=MyModule




Time: 2.84 minutes, Memory: 817.50MB

OK (339 tests, 1675 assertions)
