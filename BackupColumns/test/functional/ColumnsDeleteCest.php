<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\ListSteps
*/
class ColumnsDeleteCest extends \Column\Functional\AbstractCest
{
    public function returnToListWithoutId(FunctionalTester $I)
    {
        $I->wantTo('Columns Test return to list when try to delete without id');
        $I->amOnPage(\Column\Pages\ColumnsDeletePage::$URL);
        $I->see(
            'Columns',
            \Column\Pages\ColumnsDeletePage::$title
        );
    }
}
