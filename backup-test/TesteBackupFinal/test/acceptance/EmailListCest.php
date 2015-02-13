<?php
/**
 * @SuppressWarning(PHPMD)
 * @guy AcceptanceTester\ListSteps
 */
class EmailListCest extends \AcceptanceTester\AbstractCest
{
    public function listSuccessful(\AcceptanceTester $I)
    {
        $I->wantTo('List Email Successful');
        $I->verifyOnPage('\Teste\Pages\EmailListPage', 'Email');
        $I->verifyHeadTable('\Teste\Pages\EmailListPage', 6);
        $I->verifyFirstListing('\Teste\Pages\EmailListPage');
        $I->verifyFilterByLike('\Teste\Pages\EmailListPage');
        $I->verifyResetFilter('\Teste\Pages\EmailListPage');
        $I->verifyPaginator('\Teste\Pages\EmailListPage');
        $I->verifyOrdenationById('\Teste\Pages\EmailListPage');

    }
}
