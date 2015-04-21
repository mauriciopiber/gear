<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new TestUpload\AcceptanceTester($scenario);
$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\TestUpload\Pages\ModuleMainPage::$URL);
$I->see('Test Upload module was created sucessfull with Gear Engine Version 0.1.29');
