<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\ViewSteps
*/
class ForeignKeysViewCest extends \Column\Functional\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        $this->fixture = $I->haveInDatabase(
            'foreign_keys',
            array(
                'name' => 'name1600',
                'created' => '2015-04-22 00:37:49',
                'created_by' => 2
            )
        );

        parent::_before($I);
    }

    public function returnToListWithId(FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to view without id');
        $I->amOnPage(\Column\Pages\ForeignKeysViewPage::$URL);
        $I->see(
            'Foreign Keys',
            \Column\Pages\ForeignKeysViewPage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ForeignKeysViewPage::$URL.'/'.$this->fixture);
        $I->verifyBreadcrumb(
            '\Column\Pages\ForeignKeysViewPage',
            'Column',
            'Foreign Keys',
            'Visualizar'
        );
    }

    public function verifyLabelsInRightPosition(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ForeignKeysViewPage::$URL.'/'.$this->fixture);
        $I->see('ID', \Column\Pages\ForeignKeysViewPage::getLabelByIndex(1));
        $I->see('Name', \Column\Pages\ForeignKeysViewPage::getLabelByIndex(2));
    }

    public function verifyValuesInRithPosition(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ForeignKeysViewPage::$URL.'/'.$this->fixture);
        $I->see($this->fixture, \Column\Pages\ForeignKeysViewPage::getValueByIndex(1));
        $I->see('name1600', \Column\Pages\ForeignKeysViewPage::getValueByIndex(2));
    }
}
