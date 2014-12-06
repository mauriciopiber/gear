<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\PiberNetwork\Pages\ModuleMainPage::$URL);
$I->see(
    'Piber Network module was created sucessfull with Gear Engine Version 0.1.10',
    \PiberNetwork\Pages\ModuleMainPage::$moduleName
);
