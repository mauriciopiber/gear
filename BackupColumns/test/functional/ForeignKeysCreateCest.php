<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\CreateSteps
*/
class ForeignKeysCreateCest extends \Column\Functional\AbstractCest
{
    public function onPage(FunctionalTester $I)
    {
        $I->wantTo('Test Access Create Email');
        $I->amOnPage(\Column\Pages\ForeignKeysCreatePage::$URL);
        $I->see(
            'Criar Foreign Keys',
            \Column\Pages\ForeignKeysCreatePage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ForeignKeysCreatePage::$URL);
        $I->verifyBreadcrumb(
            '\Column\Pages\ForeignKeysCreatePage',
            'Column',
            'Foreign Keys',
            'Criar'
        );
    }
}
