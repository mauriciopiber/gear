<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\ListSteps
*/
class EmailDeleteCest
{
    public function _before(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }

    public function returnToListWithoutId(\FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to delete without id');
        $I->amOnPage(\Teste\Pages\EmailDeletePage::$URL);
        $I->see(
            'Email',
            '#pageTitle'
        );
    }
}