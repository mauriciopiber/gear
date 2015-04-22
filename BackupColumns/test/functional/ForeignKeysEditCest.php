<?php
namespace Column\Functional;

use Column\FunctionalTester;

/**
* @SuppressWarnings(PHPMD)
* @guy Column\FunctionalTester\EditSteps
*/
class ForeignKeysEditCest extends \Column\Functional\AbstractCest
{
    protected $fixture;

// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
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

    public function onPage(FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to edit without id');
        $I->amOnPage(\Column\Pages\ForeignKeysEditPage::$URL.'/'.$this->fixture);
        $I->see(
            'Editar Foreign Keys',
            \Column\Pages\ForeignKeysEditPage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\Column\Pages\ForeignKeysEditPage::$URL.'/'.$this->fixture);
        $I->verifyBreadcrumb(
            '\Column\Pages\ForeignKeysEditPage',
            'Column',
            'Foreign Keys',
            'Editar'
        );
    }
}
