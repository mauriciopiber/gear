<?php
namespace TestUpload\Functional;

use TestUpload\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy TestUpload\FunctionalTester\CreateSteps
*/
class TestUploadImageCreateCest extends \TestUpload\Functional\AbstractCest
{
    public function onPage(FunctionalTester $I)
    {
        $I->wantTo('Test Access Create Email');
        $I->amOnPage(\TestUpload\Pages\TestUploadImageCreatePage::$URL);
        $I->see(
            'Criar Test Upload Image',
            \TestUpload\Pages\TestUploadImageCreatePage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\TestUpload\Pages\TestUploadImageCreatePage::$URL);
        $I->verifyBreadcrumb(
            '\TestUpload\Pages\TestUploadImageCreatePage',
            'Test Upload',
            'Test Upload Image',
            'Criar'
        );
    }
}
