<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new Column\AcceptanceTester($scenario);
$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\Column\Pages\ModuleMainPage::$URL);
$I->see('Column module was created sucessfull with Gear Engine Version 0.1.30');
