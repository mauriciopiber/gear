<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\ViewSteps
 */
class ForeignKeysViewCest extends \Column\Acceptance\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(AcceptanceTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'foreign_keys',
            array(
                        'name' => 'name1300',
                'created' => '2015-04-22 00:37:49',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function viewSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('View Foreign Keys Successful');
        $I->verifyOnPage('Column\Pages\ForeignKeysViewPage', 'Foreign Keys', $this->fixture);
        $I->see('Foreign Keys');
        $I->see('Name');
        $I->see('name1300');
    }
}
