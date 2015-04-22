<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\CreateSteps
 */
class ForeignKeysCreateCest extends \Column\Acceptance\AbstractCest
{
    public function createSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Create Foreign Keys Successful');

        $I->verifyOnPage('Column\Pages\ForeignKeysCreatePage', 'Foreign Keys');
        $I->fillField(\Column\Pages\ForeignKeysEditPage::$name, 'name1200');
        $I->verifyCreateSuccessful('Column\Pages\ForeignKeysCreatePage', 'Foreign Keys');
        $I->seeInField(\Column\Pages\ForeignKeysEditPage::$name, 'name1200');
    }
}
