<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\ListSteps
*/
class ForeignKeysListCest extends \Column\Functional\AbstractCest
{
    public function structure(FunctionalTester $I)
    {
        $I->wantTo('Test Access List Email');
        $I->amOnPage(\Column\Pages\ForeignKeysListPage::$URL);


        $I->see(
            'Foreign Keys',
            \Column\Pages\ForeignKeysListPage::$title
        );

        $I->seeNumberOfElements(\Column\Pages\ForeignKeysListPage::$tableHeadRow, 3);
        $I->seeNumberOfElements(\Column\Pages\ForeignKeysListPage::$tableBodyRow, 10);


        $I->see(
            'Criar',
            \Column\Pages\ForeignKeysListPage::$createBtn
        );

        $I->verifyBreadcrumb(
            '\Column\Pages\ForeignKeysListPage',
            'Column',
            'Foreign Keys',
            'Listar'
        );

        $I->verifyFilter('\Column\Pages\ForeignKeysListPage');
        $I->verifyPaginator('\Column\Pages\ForeignKeysListPage');
    }
}
