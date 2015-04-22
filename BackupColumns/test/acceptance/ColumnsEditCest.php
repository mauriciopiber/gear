<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\EditSteps
 */
class ColumnsEditCest extends \Column\Acceptance\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'columns',
            array(
                'column_date' => '2015-04-22',
                'column_datetime' => '2015-04-22 00:37:42',
                'column_time' => '00:37:42',
                'column_int' => '999',
                'column_tinyint' => '1',
                'column_decimal' => '999.99',
                'column_varchar' => 'columnVarchar999',
                'column_longtext' => 'columnLongtext999',
                'column_text' => 'columnText999',
                'column_datetime_pt_br' => '2015-04-22 00:37:42',
                'column_date_pt_br' => '2015-04-22',
                'column_decimal_pt_br' => '999.99',
                'column_int_checkbox' => '1',
                'column_tinyint_checkbox' => '1',
                'column_varchar_email' => 'columnVarcharEmail999',
                'column_varchar_password_verify' => 'columnVarcharPasswordVerify999',
                'column_varchar_unique_id' => 'columnVarcharUniqueId999',
                'column_varchar_upload_image' => 'columnVarcharUploadImage999',
                'column_foreign_key' => '1',
                'created' => '2015-04-22 00:37:42',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function editSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Edit Columns Successful');

        $I->verifyOnPage(
            'Column\Pages\ColumnsEditPage',
            'Columns - '.$this->fixture,
            $this->fixture
        );

        $I->verifySubmitAndReturnSuccessful('Column\Pages\ColumnsEditPage', $this->fixture);

        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDate, '2015-04-22');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatetime, '2015-04-22 00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnTime, '00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnInt, '999');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnTinyint, '1');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarchar, 'columnVarchar999');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnLongtext, 'columnLongtext999');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatetimePtBr, '22/04/2015 00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatePtBr, '22/04/2015');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharEmail, 'columnVarcharEmail999');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharPasswordVerify, 'columnVarcharPasswordVerify999');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharUniqueId, 'columnVarcharUniqueId999');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharUploadImage, 'columnVarcharUploadImage999');
        $I->seeCheckboxIsChecked(\Column\Pages\ColumnsEditPage::$columnIntCheckbox);
        $I->seeCheckboxIsChecked(\Column\Pages\ColumnsEditPage::$columnTinyintCheckbox);
        $I->seeOptionIsSelected(\Column\Pages\ColumnsEditPage::$columnForeignKey, '1');

        $I->fillField(\Column\Pages\ColumnsEditPage::$columnInt, '1500');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnTinyint, '1');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnDecimal, '1500.15');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarchar, 'columnVarchar1500');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnLongtext, 'columnLongtext1500');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnDecimalPtBr, '1500.15');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharEmail, 'columnVarcharEmail1500');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharPasswordVerify, 'columnVarcharPasswordVerify1500');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharUniqueId, 'columnVarcharUniqueId1500');
        $I->fillField(\Column\Pages\ColumnsEditPage::$columnVarcharUploadImage, 'columnVarcharUploadImage1500');
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDate, '2015-04-22'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDatetime, '2015-04-22 00:37:42'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnTime, '00:37:42'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDatetimePtBr, '22/04/2015 00:37:42'));
        $I->executeJS(sprintf('$("%s").val(\'%s\');', \Column\Pages\ColumnsEditPage::$columnDatePtBr, '22/04/2015'));
        $I->checkOption(\Column\Pages\ColumnsEditPage::$columnIntCheckbox);
        $I->checkOption(\Column\Pages\ColumnsEditPage::$columnTinyintCheckbox);
        $I->selectOption(\Column\Pages\ColumnsEditPage::$columnForeignKey, 1);

        $I->verifySubmitAndReturnSuccessful('Column\Pages\ColumnsEditPage', $this->fixture);

        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDate, '2015-04-22');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatetime, '2015-04-22 00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnTime, '00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnInt, '1500');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnTinyint, '1');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarchar, 'columnVarchar1500');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnLongtext, 'columnLongtext1500');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatetimePtBr, '22/04/2015 00:37:42');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnDatePtBr, '22/04/2015');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharEmail, 'columnVarcharEmail1500');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharPasswordVerify, 'columnVarcharPasswordVerify1500');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharUniqueId, 'columnVarcharUniqueId1500');
        $I->seeInField(\Column\Pages\ColumnsEditPage::$columnVarcharUploadImage, 'columnVarcharUploadImage1500');
        $I->seeCheckboxIsChecked(\Column\Pages\ColumnsEditPage::$columnIntCheckbox);
        $I->seeCheckboxIsChecked(\Column\Pages\ColumnsEditPage::$columnTinyintCheckbox);
        $I->seeOptionIsSelected(\Column\Pages\ColumnsEditPage::$columnForeignKey, '1');

    }
}
