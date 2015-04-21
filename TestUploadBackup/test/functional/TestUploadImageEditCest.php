<?php
namespace TestUpload\Functional;

use TestUpload\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy TestUpload\FunctionalTester\EditSteps
*/
class TestUploadImageEditCest extends \TestUpload\Functional\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'test_upload_image',
            array(
                'image' => 'image999',
                'created' => '2015-04-21 01:28:08',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function onPage(FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to edit without id');
        $I->amOnPage(\TestUpload\Pages\TestUploadImageEditPage::$URL.'/'.$this->fixture);
        $I->see(
            'Editar Test Upload Image',
            \TestUpload\Pages\TestUploadImageEditPage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\TestUpload\Pages\TestUploadImageEditPage::$URL.'/'.$this->fixture);
        $I->verifyBreadcrumb(
            '\TestUpload\Pages\TestUploadImageEditPage',
            'Test Upload',
            'Test Upload Image',
            'Editar'
        );
    }
}
