<?php
namespace Column\Acceptance;

use Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Column\AcceptanceTester\EditSteps
 */
class ForeignKeysEditCest extends \Column\Acceptance\AbstractCest
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
                'created' => '2015-04-22 00:37:48',
                'created_by' => 2
            )
        );
        parent::_before($I);
    }

    public function editSuccessful(AcceptanceTester $I)
    {
        $I->wantTo('Edit Foreign Keys Successful');

        $I->verifyOnPage(
            'Column\Pages\ForeignKeysEditPage',
            'Foreign Keys - '.$this->fixture,
            $this->fixture
        );

        $I->verifySubmitAndReturnSuccessful('Column\Pages\ForeignKeysEditPage', $this->fixture);

        $I->seeInField(\Column\Pages\ForeignKeysEditPage::$name, 'name999');

        $I->fillField(\Column\Pages\ForeignKeysEditPage::$name, 'name1500');

        $I->verifySubmitAndReturnSuccessful('Column\Pages\ForeignKeysEditPage', $this->fixture);

        $I->seeInField(\Column\Pages\ForeignKeysEditPage::$name, 'name1500');

    }
}
