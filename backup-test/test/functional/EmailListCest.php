<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\ListSteps
*/
class EmailListCest
{
    public function _before(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\FunctionalTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }

    public function structure(\FunctionalTester $I)
    {
        $I->wantTo('Test Access List Email');
        $I->amOnPage(\Teste\Pages\EmailListPage::$URL);
        $I->see(
            'Email',
            '#pageTitle'
        );

        $I->seeNumberOfElements(\Teste\Pages\EmailListPage::$tableHeadRow, 6);
        $I->seeNumberOfElements(\Teste\Pages\EmailListPage::$tableBodyRow, 10);

        $I->see(
            'Email',
            \Teste\Pages\EmailListPage::$title
        );

        $I->see(
            'Criar',
            \Teste\Pages\EmailListPage::$createBtn
        );

        $I->verifyBreadcrumb('\Teste\Pages\EmailListPage', 'Teste', 'Email', 'Listar');
        $I->verifyFilter('\Teste\Pages\EmailListPage');
        $I->verifyPaginator('\Teste\Pages\EmailListPage');
    }
}
