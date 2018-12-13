#!/bin/bash

echo "
Module As Project CLI
Deletar schema de módulo MyModule


Creating new module MyModule 26/07/2016 07:58:28
Script ended by 0.184 at 26/07/2016 07:58:28


Construct MyModule 26/07/2016 07:58:29
Db tabela "IntForeignKey" criado.
Db tabela "AllColumnsDb" criado.
Db tabela "AllColumnsDbNotNull" criado.
Db tabela "AllColumnsDbUnique" criado.
Db tabela "AllColumnsDbUniqueNotNull" criado.
Script ended by 48.196 at 26/07/2016 07:59:17
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

Runtime:    PHP 5.6.22-0+deb8u1 with Xdebug 2.2.5
Configuration:    /var/www/gear-package/my-module/test/phpunit-benchmark.xml

...............................................................  63 / 106 ( 59%)
...........................................

You should really fix these slow tests (>500ms)...
 1. 3617ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteAfterEditOk
 2. 3515ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testCreateSuccess
 3. 3444ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testCreateSuccess
 4. 3408ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testEditAfterCreateOk
 5. 3308ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
 6. 3027ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenViewDisplaySuccessfulWithValidId
 7. 3020ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListRedirectSuccessfulPRGWithValidId
 8. 2912ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenListDisplaySuccessfulWithValidId
 9. 2655ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testCantCreateWithWrongImage
 10. 2617ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testDeleteAfterEditOk
 11. 2568ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testViewSucessfullAndRedirectToListWithFailNotFound
 12. 2525ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testEditAfterCreateOk
 13. 2513ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testWhenEditRedirectWithInvalidIdToListing
 14. 2403ms to run MyModuleTest\ControllerTest\IntForeignKeyControllerTest:testDeleteSucessfullAndRedirectToListWithFailNotFound
 15. 2208ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenViewDisplaySuccessfulWithValidId
 16. 2202ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testCreateSuccess
 17. 2109ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenListDisplaySuccessfulWithValidId
 18. 2079ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testEditAfterCreateOk
 19. 2039ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenListRedirectSuccessfulPRGWithValidId
 20. 2030ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testViewSucessfullAndRedirectToListWithFailNotFound
 21. 1970ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenCreateDisplaySuccessful
 22. 1954ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testCantCreateWithWrongImage
 23. 1948ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testDeleteSucessfullAndRedirectToListWithFailNotFound
 24. 1705ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest:testWhenListRedirectSuccessfulPRGWithValidId
 25. 1651ms to run MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest:testWhenCreateDisplaySuccessfulWithRedirect
...and there are 46 more above your threshold hidden from view

XHProf runs: 106
  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetService
   http://10.10.10.99:8888?run=5797428623811&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testSetForm
   http://10.10.10.99:8888?run=579742865213c&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=579742873fe20&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797428799a61&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=57974287df685&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=579742885495a&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=57974288c2bae&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=579742894577d&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=57974289dec40&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797428a7aa07&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797428abfb18&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797428b4543d&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797428b8cb81&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797428c98399&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797428d68030&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797428e363d7&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797428ec7247&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=5797428faa18f&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=57974290a30d8&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithoutIdReturnToList
   http://10.10.10.99:8888?run=57974290f062b&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testAccessUploadImageWithInvalidIdReturnToList
   http://10.10.10.99:8888?run=5797429184a2b&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageReturnPRGPlugin
   http://10.10.10.99:8888?run=579742922c578&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testPostUploadImageProcessSuccess
   http://10.10.10.99:8888?run=57974293248a5&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=579742941c1e7&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testSetService
   http://10.10.10.99:8888?run=579742944454a&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testSetForm
   http://10.10.10.99:8888?run=5797429466290&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=5797429564e3a&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=5797429608aa2&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=57974296639f0&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=57974297161f1&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=57974297d55cc&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=5797429872fd8&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=5797429914162&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=57974299c0415&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=5797429a2454a&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=5797429ac90bb&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=5797429b31738&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=5797429caf5f9&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797429de7c95&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=5797429f0b646&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=5797429fcae6d&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=579742a10dbd5&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=579742a2739e2&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbNotNullControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=579742a3b7105&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testSetService
   http://10.10.10.99:8888?run=579742a3df925&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testSetForm
   http://10.10.10.99:8888?run=579742a411e3e&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=579742a550dac&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=579742a660ab4&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=579742a6bbf48&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=579742a7cbe3f&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=579742a86917e&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=579742a8e8a51&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=579742a9727ea&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=579742aa8215d&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=579742aae3bfd&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=579742ac22617&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=579742ac93b76&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=579742aeca49a&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=579742b089d86&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=579742b21d27e&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=579742b3cf98c&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=579742b622446&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=579742b81c7b8&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=579742b9b59c5&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testSetService
   http://10.10.10.99:8888?run=579742b9daec3&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testSetForm
   http://10.10.10.99:8888?run=579742ba0e33a&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=579742bc0ad3f&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=579742bdade2b&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=579742be2d3a4&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=579742bfa4c32&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=579742c063a64&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=579742c10e2b6&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=579742c1b5e8b&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=579742c3ac6d0&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=579742c42d1ae&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=579742c6385cb&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=579742c6c9b12&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=579742ca582cb&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=579742cc9fa97&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=579742cf09ffb&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=579742d117ccc&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=579742d39ba10&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testCantCreateWithWrongImage
   http://10.10.10.99:8888?run=579742d64cca8&source=MyModule

  MyModuleTest\ControllerTest\AllColumnsDbUniqueNotNullControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=579742d8e7e7e&source=MyModule

  MyModuleTest\ControllerTest\IndexControllerTest::testIndexAction
   http://10.10.10.99:8888?run=579742d940d6d&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetService
   http://10.10.10.99:8888?run=579742d963d8e&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testSetForm
   http://10.10.10.99:8888?run=579742d9982bc&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessful
   http://10.10.10.99:8888?run=579742da575e8&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenCreateDisplaySuccessfulWithRedirect
   http://10.10.10.99:8888?run=579742dabc08d&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateWithoutArgumentsRedirectToCreate
   http://10.10.10.99:8888?run=579742db635c5&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditDisplaySuccessful
   http://10.10.10.99:8888?run=579742dbae336&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenEditRedirectWithInvalidIdToListing
   http://10.10.10.99:8888?run=579742de3a4f6&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessful
   http://10.10.10.99:8888?run=579742df0a8af&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutData
   http://10.10.10.99:8888?run=579742df95292&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenFilterWithoutDataWithPRG
   http://10.10.10.99:8888?run=579742e03ca60&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=579742e2a2dc4&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenDeleteDisplaySuccessful
   http://10.10.10.99:8888?run=579742e34eab4&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testViewSucessfullAndRedirectToListWithFailNotFound
   http://10.10.10.99:8888?run=579742e5dcda3&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessful
   http://10.10.10.99:8888?run=579742e67348f&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testCreateSuccess
   http://10.10.10.99:8888?run=579742e9e379d&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=579742ed12d06&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenViewDisplaySuccessfulWithValidId
   http://10.10.10.99:8888?run=579742f01e069&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidId
   http://10.10.10.99:8888?run=579742f3277e4&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation
   http://10.10.10.99:8888?run=579742f678d0f&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testEditAfterCreateOk
   http://10.10.10.99:8888?run=579742fa21753&source=MyModule

  MyModuleTest\ControllerTest\IntForeignKeyControllerTest::testDeleteAfterEditOk
   http://10.10.10.99:8888?run=579742fdbbec8&source=MyModule




Time: 2.01 minutes, Memory: 457.00MB

OK (106 tests, 692 assertions)"

