<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\CreateSteps
*/
class ColumnsCreateCest extends \Column\Functional\AbstractCest
{
    public function onPage(FunctionalTester $I)
    {
        $I->wantTo('Test Access Create Email');
        $I->amOnPage(\Column\Pages\ColumnsCreatePage::$URL);
        $I->see(
            'Criar Columns',
            \Column\Pages\ColumnsCreatePage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ColumnsCreatePage::$URL);
        $I->verifyBreadcrumb(
            '\Column\Pages\ColumnsCreatePage',
            'Column',
            'Columns',
            'Criar'
        );
    }
}
