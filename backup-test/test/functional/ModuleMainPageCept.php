<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\Teste\Pages\ModuleMainPage::$URL);
$I->see(
    'Teste module was created sucessfull with Gear Engine Version 0.1.23',
    \Teste\Pages\ModuleMainPage::$moduleName
);
