<?php
namespace TestUpload\Acceptance;

use TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy TestUpload\AcceptanceTester\ListSteps
 */
class TestUploadImageListCest extends \TestUpload\Acceptance\AbstractCest
{
    public function listSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('List Test Upload Image Successful');
        $I->verifyOnPage('\TestUpload\Pages\TestUploadImageListPage', 'Test Upload Image');
        $I->verifyHeadTable('\TestUpload\Pages\TestUploadImageListPage', 2);
        $I->verifyFirstListing('\TestUpload\Pages\TestUploadImageListPage');
        $I->verifyFilterByLike('\TestUpload\Pages\TestUploadImageListPage');
        $I->verifyResetFilter('\TestUpload\Pages\TestUploadImageListPage');
        $I->verifyPaginator('\TestUpload\Pages\TestUploadImageListPage');
        $I->verifyOrdenationById('\TestUpload\Pages\TestUploadImageListPage');
    }
}
