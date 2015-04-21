<?php
namespace TestUpload\Acceptance;

use TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy TestUpload\AcceptanceTester\ViewSteps
 */
class TestUploadImageViewCest extends \TestUpload\Acceptance\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'test_upload_image',
            array(
                        'image' => 'image1300',
                'created' => '2015-04-21 01:28:07',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function viewSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('View Test Upload Image Successful');
        $I->verifyOnPage('TestUpload\Pages\TestUploadImageViewPage', 'Test Upload Image', $this->fixture);
        $I->see('Test Upload Image');
        $I->see('Image');
        $I->see('image1300');
    }
}
