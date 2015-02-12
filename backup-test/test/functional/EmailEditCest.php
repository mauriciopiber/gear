<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\EditSteps
*/
class EmailEditCest
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
        $I->wantTo('Test return to list when try to edit without id');
        $I->amOnPage(\Teste\Pages\EmailEditPage::$URL);
        $I->see(
            'Email',
            '#pageTitle'
        );

    }
}