<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\ViewSteps
*/
class EmailViewCest
{
    public function _before(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }


    public function returnToListWithId(\FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to view without id');
        $I->amOnPage(\Teste\Pages\EmailViewPage::$URL);
        $I->see(
            'Email',
            '#pageTitle'
        );
    }
}
