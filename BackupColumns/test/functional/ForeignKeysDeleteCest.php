<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\ListSteps
*/
class ForeignKeysDeleteCest extends \Column\Functional\AbstractCest
{
    public function returnToListWithoutId(FunctionalTester $I)
    {
        $I->wantTo('Foreign Keys Test return to list when try to delete without id');
        $I->amOnPage(\Column\Pages\ForeignKeysDeletePage::$URL);
        $I->see(
            'Foreign Keys',
            \Column\Pages\ForeignKeysDeletePage::$title
        );
    }
}
