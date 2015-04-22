<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\ListSteps
 */
class ForeignKeysListCest extends \Column\Acceptance\AbstractCest
{
    public function listSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('List Foreign Keys Successful');
        $I->verifyOnPage('\Column\Pages\ForeignKeysListPage', 'Foreign Keys');
        $I->verifyHeadTable('\Column\Pages\ForeignKeysListPage', 3);
        $I->verifyFirstListing('\Column\Pages\ForeignKeysListPage');
        $I->verifyFilterByLike('\Column\Pages\ForeignKeysListPage');
        $I->verifyResetFilter('\Column\Pages\ForeignKeysListPage');
        $I->verifyPaginator('\Column\Pages\ForeignKeysListPage');
        $I->verifyOrdenationById('\Column\Pages\ForeignKeysListPage');
    }
}
