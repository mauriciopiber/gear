<?php
namespace TestUpload\Functional;

use TestUpload\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy TestUpload\FunctionalTester\ViewSteps
*/
class TestUploadImageViewCest extends \TestUpload\Functional\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'test_upload_image',
            array(
                'image' => 'image1600',
                'created' => '2015-04-21 01:28:08',
                'created_by' => 2
            )
        );

        parent::_before($I);
    }

    public function returnToListWithId(FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to view without id');
        $I->amOnPage(\TestUpload\Pages\TestUploadImageViewPage::$URL);
        $I->see(
            'Test Upload Image',
            \TestUpload\Pages\TestUploadImageViewPage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\TestUpload\Pages\TestUploadImageViewPage::$URL.'/'.$this->fixture);
        $I->verifyBreadcrumb(
            '\TestUpload\Pages\TestUploadImageViewPage',
            'Test Upload',
            'Test Upload Image',
            'Visualizar'
        );
    }

    public function verifyLabelsInRightPosition(FunctionalTester $I)
    {
        $I->amOnPage(\TestUpload\Pages\TestUploadImageViewPage::$URL.'/'.$this->fixture);
        $I->see('ID', \TestUpload\Pages\TestUploadImageViewPage::getLabelByIndex(1));
        $I->see('Image', \TestUpload\Pages\TestUploadImageViewPage::getLabelByIndex(2));
    }

    public function verifyValuesInRithPosition(FunctionalTester $I)
    {
        $I->amOnPage(\TestUpload\Pages\TestUploadImageViewPage::$URL.'/'.$this->fixture);
        $I->see($this->fixture, \TestUpload\Pages\TestUploadImageViewPage::getValueByIndex(1));
        $I->see('image1600', \TestUpload\Pages\TestUploadImageViewPage::getValueByIndex(2));
    }
}
