<?php
namespace TestUpload\Acceptance;

use TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy TestUpload\AcceptanceTester\CreateSteps
 */
class TestUploadImageCreateCest extends \TestUpload\Acceptance\AbstractCest
{
    public function createSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Create Test Upload Image Successful');

        $I->verifyOnPage('TestUpload\Pages\TestUploadImageCreatePage', 'Test Upload Image');
        $I->fillField(\TestUpload\Pages\TestUploadImageEditPage::$image, 'image1200');
        $I->verifyCreateSuccessful('TestUpload\Pages\TestUploadImageCreatePage', 'Test Upload Image');
        $I->seeInField(\TestUpload\Pages\TestUploadImageEditPage::$image, 'image1200');
    }
}
