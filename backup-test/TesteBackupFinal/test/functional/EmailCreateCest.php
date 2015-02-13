<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\CreateSteps
*/
class EmailCreateCest extends \FunctionalTester\AbstractCest
{
    public function onPage(\FunctionalTester $I)
    {
        $I->wantTo('Test Access Create Email');
        $I->amOnPage(\Teste\Pages\EmailCreatePage::$URL);
        $I->see(
            'Email',
            \Teste\Pages\EmailCreatePage::$title
        );
    }

    public function breadcrumb(\FunctionalTester $I)
    {
        $I->amOnPage(\Teste\Pages\EmailCreatePage::$URL);
        $I->verifyBreadcrumb('\Teste\Pages\EmailCreatePage', 'Teste', 'Email', 'Criar');
    }
}
