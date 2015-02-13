<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\ListSteps
*/
class EmailDeleteCest extends \FunctionalTester\AbstractCest
{
    public function returnToListWithoutId(\FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to delete without id');
        $I->amOnPage(\Teste\Pages\EmailDeletePage::$URL);
        $I->see(
            'Email',
            \Teste\Pages\EmailDeletePage::$title
        );
    }
}