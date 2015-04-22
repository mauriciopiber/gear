<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\ViewSteps
*/
class ColumnsViewCest extends \Column\Functional\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'columns',
            array(
                'column_date' => '2015-04-22',
                'column_datetime' => '2015-04-22 00:37:43',
                'column_time' => '00:37:43',
                'column_int' => '1600',
                'column_tinyint' => '1',
                'column_decimal' => '1600.16',
                'column_varchar' => 'columnVarchar1600',
                'column_longtext' => 'columnLongtext1600',
                'column_text' => 'columnText1600',
                'column_datetime_pt_br' => '2015-04-22 00:37:43',
                'column_date_pt_br' => '2015-04-22',
                'column_decimal_pt_br' => '1600.16',
                'column_int_checkbox' => '1',
                'column_tinyint_checkbox' => '1',
                'column_varchar_email' => 'columnVarcharEmail1600',
                'column_varchar_password_verify' => 'columnVarcharPasswordVerify1600',
                'column_varchar_unique_id' => 'columnVarcharUniqueId1600',
                'column_varchar_upload_image' => 'columnVarcharUploadImage1600',
                'column_foreign_key' => '1',
                'created' => '2015-04-22 00:37:43',
                'created_by' => 2
            )
        );

        parent::_before($I);
    }

    public function returnToListWithId(FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to view without id');
        $I->amOnPage(\Column\Pages\ColumnsViewPage::$URL);
        $I->see(
            'Columns',
            \Column\Pages\ColumnsViewPage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ColumnsViewPage::$URL.'/'.$this->fixture);
        $I->verifyBreadcrumb(
            '\Column\Pages\ColumnsViewPage',
            'Column',
            'Columns',
            'Visualizar'
        );
    }

    public function verifyLabelsInRightPosition(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ColumnsViewPage::$URL.'/'.$this->fixture);
        $I->see('ID', \Column\Pages\ColumnsViewPage::getLabelByIndex(1));
        $I->see('Column Date', \Column\Pages\ColumnsViewPage::getLabelByIndex(2));
        $I->see('Column Datetime', \Column\Pages\ColumnsViewPage::getLabelByIndex(3));
        $I->see('Column Time', \Column\Pages\ColumnsViewPage::getLabelByIndex(4));
        $I->see('Column Int', \Column\Pages\ColumnsViewPage::getLabelByIndex(5));
        $I->see('Column Tinyint', \Column\Pages\ColumnsViewPage::getLabelByIndex(6));
        $I->see('Column Decimal', \Column\Pages\ColumnsViewPage::getLabelByIndex(7));
        $I->see('Column Varchar', \Column\Pages\ColumnsViewPage::getLabelByIndex(8));
        $I->see('Column Longtext', \Column\Pages\ColumnsViewPage::getLabelByIndex(9));
        $I->see('Column Text', \Column\Pages\ColumnsViewPage::getLabelByIndex(10));
        $I->see('Column Datetime Pt Br', \Column\Pages\ColumnsViewPage::getLabelByIndex(11));
        $I->see('Column Date Pt Br', \Column\Pages\ColumnsViewPage::getLabelByIndex(12));
        $I->see('Column Decimal Pt Br', \Column\Pages\ColumnsViewPage::getLabelByIndex(13));
        $I->see('Column Int Checkbox', \Column\Pages\ColumnsViewPage::getLabelByIndex(14));
        $I->see('Column Tinyint Checkbox', \Column\Pages\ColumnsViewPage::getLabelByIndex(15));
        $I->see('Column Varchar Email', \Column\Pages\ColumnsViewPage::getLabelByIndex(16));
        $I->see('Column Varchar Password Verify', \Column\Pages\ColumnsViewPage::getLabelByIndex(17));
        $I->see('Column Varchar Unique', \Column\Pages\ColumnsViewPage::getLabelByIndex(18));
        $I->see('Column Varchar Upload Image', \Column\Pages\ColumnsViewPage::getLabelByIndex(19));
        $I->see('Column Foreign Key', \Column\Pages\ColumnsViewPage::getLabelByIndex(20));
    }

    public function verifyValuesInRithPosition(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ColumnsViewPage::$URL.'/'.$this->fixture);
        $I->see($this->fixture, \Column\Pages\ColumnsViewPage::getValueByIndex(1));
        $I->see('2015-04-22', \Column\Pages\ColumnsViewPage::getValueByIndex(2));
        $I->see('2015-04-22 00:37:43', \Column\Pages\ColumnsViewPage::getValueByIndex(3));
        $I->see('00:37:43', \Column\Pages\ColumnsViewPage::getValueByIndex(4));
        $I->see('1600', \Column\Pages\ColumnsViewPage::getValueByIndex(5));
        $I->see('1', \Column\Pages\ColumnsViewPage::getValueByIndex(6));
        $I->see('1600.16', \Column\Pages\ColumnsViewPage::getValueByIndex(7));
        $I->see('columnVarchar1600', \Column\Pages\ColumnsViewPage::getValueByIndex(8));
        $I->see('columnLongtext1600', \Column\Pages\ColumnsViewPage::getValueByIndex(9));
        $I->see('columnText1600', \Column\Pages\ColumnsViewPage::getValueByIndex(10));
        $I->see('22/04/2015 00:37:43', \Column\Pages\ColumnsViewPage::getValueByIndex(11));
        $I->see('22/04/2015', \Column\Pages\ColumnsViewPage::getValueByIndex(12));
        $I->see('R$ 1600,16', \Column\Pages\ColumnsViewPage::getValueByIndex(13));
        $I->see('1', \Column\Pages\ColumnsViewPage::getValueByIndex(14));
        $I->see('1', \Column\Pages\ColumnsViewPage::getValueByIndex(15));
        $I->see('columnVarcharEmail1600', \Column\Pages\ColumnsViewPage::getValueByIndex(16));
        $I->see('columnVarcharPasswordVerify1600', \Column\Pages\ColumnsViewPage::getValueByIndex(17));
        $I->see('columnVarcharUniqueId1600', \Column\Pages\ColumnsViewPage::getValueByIndex(18));
        $I->see('columnVarcharUploadImage1600', \Column\Pages\ColumnsViewPage::getValueByIndex(19));
        $I->see('1', \Column\Pages\ColumnsViewPage::getValueByIndex(20));
    }
}
