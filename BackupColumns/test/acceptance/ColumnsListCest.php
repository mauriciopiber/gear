<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\ListSteps
 */
class ColumnsListCest extends \Column\Acceptance\AbstractCest
{
    public function listSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('List Columns Successful');
        $I->verifyOnPage('\Column\Pages\ColumnsListPage', 'Columns');
        $I->verifyHeadTable('\Column\Pages\ColumnsListPage', 12);
        $I->verifyFirstListing('\Column\Pages\ColumnsListPage');
        $I->verifyFilterByLike('\Column\Pages\ColumnsListPage');
        $I->verifyResetFilter('\Column\Pages\ColumnsListPage');
        $I->verifyPaginator('\Column\Pages\ColumnsListPage');
        $I->verifyOrdenationById('\Column\Pages\ColumnsListPage');
    }
}
