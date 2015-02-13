<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\EditSteps
*/
class EmailEditCest extends \FunctionalTester\AbstractCest
{
    protected $fixture;

    public function _before(\FunctionalTester $I)
    {
        $this->fixture = $I->haveInDatabase(
            'email',
            array(
                'remetente' => 'remetente999',
                'destino' => 'destino999',
                'assunto' => 'assunto999',
                'mensagem' => 'mensagem999',
                'created' => '2015-02-12 08:10:52',
                'created_by' => 1
            )
        );
        parent::_before($I);
    }

    public function onPage(\FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to edit without id');
        $I->amOnPage(\Teste\Pages\EmailEditPage::$URL);
        $I->see(
            'Email',
            \Teste\Pages\EmailEditPage::$title
        );
    }

    public function breadcrumb(\FunctionalTester $I)
    {
        $I->amOnPage(\Teste\Pages\EmailEditPage::$URL.'/'.$this->fixture);
        $I->verifyBreadcrumb('\Teste\Pages\EmailEditPage', 'Teste', 'Email', 'Editar');
    }
}