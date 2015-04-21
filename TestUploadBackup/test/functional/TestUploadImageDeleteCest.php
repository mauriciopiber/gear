<?php
namespace TestUpload\Functional;

use TestUpload\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy TestUpload\FunctionalTester\ListSteps
*/
class TestUploadImageDeleteCest extends \TestUpload\Functional\AbstractCest
{
    public function returnToListWithoutId(FunctionalTester $I)
    {
        $I->wantTo('Test Upload Image Test return to list when try to delete without id');
        $I->amOnPage(\TestUpload\Pages\TestUploadImageDeletePage::$URL);
        $I->see(
            'Test Upload Image',
            \TestUpload\Pages\TestUploadImageDeletePage::$title
        );
    }
}
