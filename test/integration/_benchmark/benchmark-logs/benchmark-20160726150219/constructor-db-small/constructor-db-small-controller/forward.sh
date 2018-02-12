/var/www/gear-package/gear/test/integration/benchmark/constructor-db-small/constructor-db-small-controller
Module As Project CLI
Deletar schema de módulo MyModule
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mCreating new module MyModule 26/07/2016 15:07:09[22;39m[0;49m
[22;39m[42mScript ended by 0.155 at 26/07/2016 15:07:09[22;39m[0;49m
[0;37m[0;49m
[22;39m[0;49m
[22;39m[41mConstruct MyModule 26/07/2016 15:07:09[22;39m[0;49m
[22;39m[42mDb tabela "IntForeignKey" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDb" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbNotNull" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUnique" criado.[22;39m[0;49m
[22;39m[42mDb tabela "AllColumnsDbUniqueNotNull" criado.[22;39m[0;49m
[22;39m[42mScript ended by 45.551 at 26/07/2016 15:07:54[22;39m[0;49m
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:    PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:    /var/www/gear-package/my-module/test/phpunit-benchmark.xml

...............................................................  63 / 106 ( 59%)
...........................................

You should really fix these slow tests (>500ms)...
 1. 3328ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testCreateSuccess
 2. 3311ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testEditAfterCreateOk
 3. 3130ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenViewDisplaySuccessfulWithValidId
 4. 3068ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteAfterEditOk
 5. 2822ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testCreateSuccess
 6. 2698ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
 7. 2639ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testCantCreateWithWrongImage
 8. 2612ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testCreateSuccess
 9. 2473ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidId
 10. 2451ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListDisplaySuccessfulWithValidId
 11. 2425ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testEditAfterCreateOk
 12. 2373ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testViewSucessfullAndRedirectToListWithFailNotFound
 13. 2261ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testDeleteAfterEditOk
 14. 2170ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteSucessfullAndRedirectToListWithFailNotFound
 15. 2156ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testViewSucessfullAndRedirectToListWithFailNotFound
 16. 2079ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenEditRedirectWithInvalidIdToListing
 17. 2028ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenListRedirectSuccessfulPRGWithValidId
 18. 2012ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenListDisplaySuccessfulWithValidId
 19. 1975ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenViewDisplaySuccessfulWithValidId
 20. 1810ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testWhenViewDisplaySuccessfulWithValidId
 21. 1789ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testEditAfterCreateOk
 22. 1789ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testWhenListDisplaySuccessfulWithValidId
 23. 1732ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenCreateDisplaySuccessful
 24. 1729ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenEditRedirectWithInvalidIdToListing
 25. 1699ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testCantCreateWithWrongImage
...and there are 52 more above your threshold hidden from view

XHProf runs: 106
 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a6fba7aa4&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a6fbd4290&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a6fd5dfde&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a6fdc4d19&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a6fe19bc7&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a6fe7a524&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a6ff2c7b0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a6ffb4ae8&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a70040330&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a700a6580&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a700efb4e&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a701a32bd&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a701f4151&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a70320168&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a703e52f2&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a704c6f2f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a705532bf&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a7066494b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a7076157c&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithoutIdReturnToList
   http://10.10.10.99:8888?run=5797a707bbad1&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithInvalidIdReturnToList
   http://10.10.10.99:8888?run=5797a7085b41c&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageReturnPRGPlugin
   http://10.10.10.99:8888?run=5797a709018f6&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageProcessSuccess
   http://10.10.10.99:8888?run=5797a709b7bcb&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a70aa6d78&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a70ad4f14&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a70b03277&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a70bd8f3f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a70c976a4&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a70cef096&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a70dc15ed&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a70eac4aa&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a70f7f020&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a71047b11&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a71139864&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a711cac0a&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a712dca5d&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a71352cbb&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a714b64f5&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7163a7b3&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a71788ccb&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a71881a4d&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a719d508c&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a71b8f10b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a71ce760b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a71d1985d&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a71d48cf7&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a71e8fd5e&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a71fc731d&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a72073a81&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a7218fad7&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a722539d3&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a72307b84&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a723b1543&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a724cab67&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7253b516&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a7269d0f3&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a727226eb&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a729bb905&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a72baf28b&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a72da5d1a&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a72f4e965&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a7314269e&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a732f1e4e&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a73498629&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a734bca0f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a734df3ee&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a736a4e5f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a7384bdd1&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a738e3b50&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a73aa6169&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a73b67bc0&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a73be90de&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a73c7f8dc&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a73e0b020&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a73ef3047&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a74129818&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a741c1f85&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a745229fc&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7475166f&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a749741d6&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a74b7e9e3&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a74deb0c2&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=5797a75098ac1&source=MyModule

 * MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a752dc988&source=MyModule

 * MyModuleTest\ControllerTest\IndexControllerTest::testIndexAction
   http://10.10.10.99:8888?run=5797a75335c52&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetService
   http://10.10.10.99:8888?run=5797a75358457&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797a7537ed0b&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797a7542ecba&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797a75488eaf&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateWithoutArgumentsRedirectToCreate
   http://10.10.10.99:8888?run=5797a75539258&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=5797a75596c09&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=5797a757adfec&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=5797a75865c24&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797a758e5916&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797a7597ac9b&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a75ba7b49&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797a75c30769&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797a75e908b8&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797a75f06ae7&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797a761d2daf&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a7647d84e&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797a767a1233&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797a76a24888&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
   http://10.10.10.99:8888?run=5797a76cd3768&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797a7705ed07&source=MyModule

 * MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=5797a77372dec&source=MyModule




Time: 2.01 minutes, Memory: 457.00MB

OK (106 tests, 692 assertions)
