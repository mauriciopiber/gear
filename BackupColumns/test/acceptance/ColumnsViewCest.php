<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\ViewSteps
 */
class ColumnsViewCest extends \Column\Acceptance\AbstractCest
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
                'column_datetime' => '2015-04-22 00:37:43',
                'column_time' => '00:37:43',
                'column_int' => '1300',
                'column_tinyint' => '1',
                'column_decimal' => '1300.13',
                'column_varchar' => 'columnVarchar1300',
                'column_longtext' => 'columnLongtext1300',
                'column_text' => 'columnText1300',
                'column_datetime_pt_br' => '2015-04-22 00:37:43',
                'column_date_pt_br' => '2015-04-22',
                'column_decimal_pt_br' => '1300.13',
                'column_int_checkbox' => '1',
                'column_tinyint_checkbox' => '1',
                'column_varchar_email' => 'columnVarcharEmail1300',
                'column_varchar_password_verify' => 'columnVarcharPasswordVerify1300',
                'column_varchar_unique_id' => 'columnVarcharUniqueId1300',
                'column_varchar_upload_image' => 'columnVarcharUploadImage1300',
                'column_foreign_key' => '1',
                'created' => '2015-04-22 00:37:43',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function viewSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('View Columns Successful');
        $I->verifyOnPage('Column\Pages\ColumnsViewPage', 'Columns', $this->fixture);
        $I->see('Columns');
        $I->see('Column Date');
        $I->see('Column Datetime');
        $I->see('Column Time');
        $I->see('Column Int');
        $I->see('Column Tinyint');
        $I->see('Column Decimal');
        $I->see('Column Varchar');
        $I->see('Column Longtext');
        $I->see('Column Text');
        $I->see('Column Datetime Pt Br');
        $I->see('Column Date Pt Br');
        $I->see('Column Decimal Pt Br');
        $I->see('Column Int Checkbox');
        $I->see('Column Tinyint Checkbox');
        $I->see('Column Varchar Email');
        $I->see('Column Varchar Password Verify');
        $I->see('Column Varchar Unique');
        $I->see('Column Varchar Upload Image');
        $I->see('Column Foreign Key');
        $I->see('2015-04-22');
        $I->see('2015-04-22 00:37:43');
        $I->see('00:37:43');
        $I->see('1300');
        $I->see('1');
        $I->see('1300.13');
        $I->see('columnVarchar1300');
        $I->see('columnLongtext1300');
        $I->see('columnText1300');
        $I->see('22/04/2015 00:37:43');
        $I->see('22/04/2015');
        $I->see('R$ 1300,13');
        $I->see('1');
        $I->see('1');
        $I->see('columnVarcharEmail1300');
        $I->see('columnVarcharPasswordVerify1300');
        $I->see('columnVarcharUniqueId1300');
        $I->see('columnVarcharUploadImage1300');
        $I->see('1');
    }
}
