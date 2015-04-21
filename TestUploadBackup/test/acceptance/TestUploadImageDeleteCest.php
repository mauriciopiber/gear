<?php
namespace TestUpload\Acceptance;

use TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy TestUpload\AcceptanceTester\DeleteSteps
 */
class TestUploadImageDeleteCest extends \TestUpload\Acceptance\AbstractCest
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

    public function deleteSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Delete Test Upload Image Successful');
        $I->verifyCanViewBeforeDelete(
            'TestUpload\Pages\TestUploadImageDeletePage',
            'Test Upload Image',
            $this->fixture
        );
        $I->verifyFilterInstanceBeforeDelete('TestUpload\Pages\TestUploadImageDeletePage', 999);
        $I->verifyDeleteSuccessfulFromTableIndex(
            'TestUpload\Pages\TestUploadImageDeletePage',
            'Test Upload Image',
            2
        );
    }
}
