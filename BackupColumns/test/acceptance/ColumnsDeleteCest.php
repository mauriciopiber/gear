<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\DeleteSteps
 */
class ColumnsDeleteCest extends \Column\Acceptance\AbstractCest
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
                'created' => '2015-04-22 00:37:43',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function deleteSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Delete Columns Successful');
        $I->verifyCanViewBeforeDelete(
            'Column\Pages\ColumnsDeletePage',
            'Columns',
            $this->fixture
        );
        $I->verifyFilterInstanceBeforeDelete('Column\Pages\ColumnsDeletePage', 999);
        $I->verifyDeleteSuccessfulFromTableIndex(
            'Column\Pages\ColumnsDeletePage',
            'Columns',
            12
        );
    }
}
