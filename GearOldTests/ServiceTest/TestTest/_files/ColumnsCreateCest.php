<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;
use Column\Pages\ColumnsEditPage;

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
        $I->executeJS(
            sprintf('$("%s").val(\'%s\');', ColumnsEditPage::$columnDate, '2016-01-01')
        );
        $I->executeJS(
            sprintf('$("%s").val(\'%s\');', ColumnsEditPage::$columnDatetime, '2016-01-01 01:01:01')
        );
        $I->executeJS(
            sprintf('$("%s").val(\'%s\');', ColumnsEditPage::$columnTime, '01:01:01')
        );
        $I->fillField(ColumnsEditPage::$columnInt, '1200');
        $I->fillField(ColumnsEditPage::$columnTinyint, '1');
        $I->fillField(ColumnsEditPage::$columnDecimal, '1200.12');
        $I->fillField(ColumnsEditPage::$columnVarchar, 'columnVarchar1200');
        $I->fillField(ColumnsEditPage::$columnLongtext, 'columnLongtext1200');
        $I->executeJS(
            sprintf('$("%s").val(\'%s\');', ColumnsEditPage::$columnDatetimePtBr, '01/01/2016 01:01:01')
        );
        $I->executeJS(
            sprintf('$("%s").val(\'%s\');', ColumnsEditPage::$columnDatePtBr, '01/01/2016')
        );
        $I->fillField(ColumnsEditPage::$columnDecimalPtBr, '1200.12');
        $I->checkOption(ColumnsEditPage::$columnIntCheckbox);
        $I->checkOption(ColumnsEditPage::$columnTinyintCheckbox);
        $I->fillField(
            ColumnsEditPage::$columnVarcharEmail,
            'column.varchar.email1200@gmail.com'
        );
        $I->fillField(
            ColumnsEditPage::$columnVarcharPasswordVerify,
            'columnVarcharPasswordVerify1200'
        );
        $I->fillField(
            ColumnsEditPage::$columnVarcharPasswordVerifyVerify,
            'columnVarcharPasswordVerify1200'
        );
        $I->selectOption(ColumnsEditPage::$columnForeignKey, 1);

        $I->verifyCreateSuccessful(
            'Column\Pages\ColumnsCreatePage',
            'Columns'
        );
    }
}
