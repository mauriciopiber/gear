<?php
namespace TestUpload\Acceptance;

use TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy TestUpload\AcceptanceTester\EditSteps
 */
class TestUploadImageEditCest extends \TestUpload\Acceptance\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'test_upload_image',
            array(
                'image' => 'image999',
                'created' => '2015-04-21 01:28:07',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function editSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Edit Test Upload Image Successful');

        $I->verifyOnPage(
            'TestUpload\Pages\TestUploadImageEditPage',
            'Test Upload Image - '.$this->fixture,
            $this->fixture
        );

        $I->verifySubmitAndReturnSuccessful('TestUpload\Pages\TestUploadImageEditPage', $this->fixture);

        $I->seeInField(\TestUpload\Pages\TestUploadImageEditPage::$image, 'image999');

        $I->fillField(\TestUpload\Pages\TestUploadImageEditPage::$image, 'image1500');

        $I->verifySubmitAndReturnSuccessful('TestUpload\Pages\TestUploadImageEditPage', $this->fixture);

        $I->seeInField(\TestUpload\Pages\TestUploadImageEditPage::$image, 'image1500');

    }
}
