<?php
namespace TestUpload\Functional;

use TestUpload\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy TestUpload\FunctionalTester\ListSteps
*/
class TestUploadImageListCest extends \TestUpload\Functional\AbstractCest
{
    public function structure(FunctionalTester $I)
    {
        $I->wantTo('Test Access List Email');
        $I->amOnPage(\TestUpload\Pages\TestUploadImageListPage::$URL);


        $I->see(
            'Test Upload Image',
            \TestUpload\Pages\TestUploadImageListPage::$title
        );

        $I->seeNumberOfElements(\TestUpload\Pages\TestUploadImageListPage::$tableHeadRow, 2);
        $I->seeNumberOfElements(\TestUpload\Pages\TestUploadImageListPage::$tableBodyRow, 10);


        $I->see(
            'Criar',
            \TestUpload\Pages\TestUploadImageListPage::$createBtn
        );

        $I->verifyBreadcrumb(
            '\TestUpload\Pages\TestUploadImageListPage',
            'Test Upload',
            'Test Upload Image',
            'Listar'
        );

        $I->verifyFilter('\TestUpload\Pages\TestUploadImageListPage');
        $I->verifyPaginator('\TestUpload\Pages\TestUploadImageListPage');
    }
}
