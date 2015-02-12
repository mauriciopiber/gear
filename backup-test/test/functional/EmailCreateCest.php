<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\CreateSteps
*/
class EmailCreateCest
{
    public function _before(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }

    public function onPage(\FunctionalTester $I)
    {
        $I->wantTo('Test Access Create Email');
        $I->amOnPage(\Teste\Pages\EmailCreatePage::$URL);
        $I->see(
            'Email',
            '#pageTitle'
        );
    }

}