<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\DeleteSteps
 */
class ForeignKeysDeleteCest extends \Column\Acceptance\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'foreign_keys',
            array(
                'name' => 'name999',
                'created' => '2015-04-22 00:37:49',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function deleteSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Delete Foreign Keys Successful');
        $I->verifyCanViewBeforeDelete(
            'Column\Pages\ForeignKeysDeletePage',
            'Foreign Keys',
            $this->fixture
        );
        $I->verifyFilterInstanceBeforeDelete('Column\Pages\ForeignKeysDeletePage', 999);
        $I->verifyDeleteSuccessfulFromTableIndex(
            'Column\Pages\ForeignKeysDeletePage',
            'Foreign Keys',
            3
        );
    }
}
