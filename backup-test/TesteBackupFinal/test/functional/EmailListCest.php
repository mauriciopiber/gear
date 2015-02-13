<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\ListSteps
*/
class EmailListCest extends \FunctionalTester\AbstractCest
{
    public function structure(\FunctionalTester $I)
    {
        $I->wantTo('Test Access List Email');
        $I->amOnPage(\Teste\Pages\EmailListPage::$URL);
        $I->see(
            'Email',
            \Teste\Pages\EmailListPage::$title
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
