<?php
namespace Teste\Functional;

use Teste\FunctionalTester;

/**
 * @SuppressWarnings(PHPMD)
 * @guy Teste\FunctionalTester\CreateSteps
 */
class EmailCreateCest
{
// @codingStandardsIgnoreStart
    public function _before(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        \TesteTest\LoginCommons::logMeIn($I);
    }

// @codingStandardsIgnoreStart
    public function _after(FunctionalTester $I)
    {
// @codingStandardsIgnoreEnd
        \TesteTest\LoginCommons::logMeOut($I);
    }

    public function onPage(FunctionalTester $I)
    {
        $I->wantTo('Test Access Create Email');
        $I->amOnPage(\Teste\Pages\EmailCreatePage::$URL);
        $I->see(
            'Criar Email',
            \Teste\Pages\EmailCreatePage::$title
        );
    }

    public function breadcrumb(FunctionalTester $I)
    {
        $I->amOnPage(\Teste\Pages\EmailCreatePage::$URL);
        $I->verifyBreadcrumb('\Teste\Pages\EmailCreatePage', 'Teste', 'Email', 'Criar');
    }
}