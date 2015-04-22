<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\ListSteps
*/
class ColumnsListCest extends \Column\Functional\AbstractCest
{
    public function structure(FunctionalTester $I)
    {
        $I->wantTo('Test Access List Email');
        $I->amOnPage(\Column\Pages\ColumnsListPage::$URL);


        $I->see(
            'Columns',
            \Column\Pages\ColumnsListPage::$title
        );

        $I->seeNumberOfElements(\Column\Pages\ColumnsListPage::$tableHeadRow, 12);
        $I->seeNumberOfElements(\Column\Pages\ColumnsListPage::$tableBodyRow, 10);


        $I->see(
            'Criar',
            \Column\Pages\ColumnsListPage::$createBtn
        );

        $I->verifyBreadcrumb(
            '\Column\Pages\ColumnsListPage',
            'Column',
            'Columns',
            'Listar'
        );

        $I->verifyFilter('\Column\Pages\ColumnsListPage');
        $I->verifyPaginator('\Column\Pages\ColumnsListPage');
    }
}
