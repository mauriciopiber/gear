<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\TestUntil\Pages\ModuleMainPage::$URL);
$I->see(
    'Test Until module was created sucessfull with Gear Engine Version 0.1.22',
    \TestUntil\Pages\ModuleMainPage::$moduleName
);
