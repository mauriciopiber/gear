<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\CreateSteps
 */
class ColumnsCreateCest extends \Column\Acceptance\AbstractCest
{
    public function createSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Create Columns Successful');

        $I->verifyOnPage('Column\Pages\ColumnsCreatePage', 'Columns');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnInt, '1200');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnTinyint, '1');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnDecimal, '1200.12');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarchar, 'columnVarchar1200');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnLongtext, 'columnLongtext1200');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnDecimalPtBr, '1200.12');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharEmail, 'columnVarcharEmail1200');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharPasswordVerify, 'columnVarcharPasswordVerify1200');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharUniqueId, 'columnVarcharUniqueId1200');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharUploadImage, 'columnVarcharUploadImage1200');
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDate, '2015-04-22'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDatetime, '2015-04-22 00:37:42'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnTime, '00:37:42'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDatetimePtBr, '22/04/2015 00:37:42'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDatePtBr, '22/04/2015'));
        $I->checkOption(\Column\Pages\ColumnsEditPage::$columnIntCheckbox);
        $I->checkOption(\Column\Pages\ColumnsEditPage::$columnTinyintCheckbox);
        $I->selectOption(\Column\Pages\ColumnsEditPage::$columnForeignKey, 1);
        $I->verifyCreateSuccessful('Column\Pages\ColumnsCreatePage', 'Columns');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDate, '2015-04-22');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatetime, '2015-04-22 00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnTime, '00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnInt, '1200');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnTinyint, '1');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarchar, 'columnVarchar1200');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnLongtext, 'columnLongtext1200');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatetimePtBr, '22/04/2015 00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatePtBr, '22/04/2015');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharEmail, 'columnVarcharEmail1200');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharPasswordVerify, 'columnVarcharPasswordVerify1200');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharUniqueId, 'columnVarcharUniqueId1200');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharUploadImage, 'columnVarcharUploadImage1200');
        $I->seeCheckboxIsChecked(\Column\Pages\ColumnsEditPage::$columnIntCheckbox);
        $I->seeCheckboxIsChecked(\Column\Pages\ColumnsEditPage::$columnTinyintCheckbox);
        $I->seeOptionIsSelected(\Column\Pages\ColumnsEditPage::$columnForeignKey, '1');
    }
}
