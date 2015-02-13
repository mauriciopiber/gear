<?php

/**
* @SuppressWarning(PHPMD)
* @guy FunctionalTester\ViewSteps
*/
class EmailViewCest extends \FunctionalTester\AbstractCest
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

    public function returnToListWithId(\FunctionalTester $I)
    {
        $I->wantTo('Test return to list when try to view without id');
        $I->amOnPage(\Teste\Pages\EmailViewPage::$URL);
        $I->see(
            'Email',
            \Teste\Pages\EmailViewPage::$title
        );
    }

    public function breadcrumb(\FunctionalTester $I)
    {
        $I->amOnPage(\Teste\Pages\EmailViewPage::$URL.'/'.$this->fixture);
        $I->verifyBreadcrumb('\Teste\Pages\EmailViewPage', 'Teste', 'Email', 'Visualizar');
    }

    public function verifyLabelsInRightPosition(\FunctionalTester $I)
    {
        $I->amOnPage(\Teste\Pages\EmailViewPage::$URL.'/'.$this->fixture);

        $I->see('ID', \Teste\Pages\EmailViewPage::getLabelByIndex(1));
        $I->see('Remetente', \Teste\Pages\EmailViewPage::getLabelByIndex(2));
        $I->see('Destino', \Teste\Pages\EmailViewPage::getLabelByIndex(3));
        $I->see('Assunto', \Teste\Pages\EmailViewPage::getLabelByIndex(4));
        $I->see('Mensagem', \Teste\Pages\EmailViewPage::getLabelByIndex(5));
    }

    public function verifyValuesInRithPosition(\FunctionalTester $I)
    {
        $I->amOnPage(\Teste\Pages\EmailViewPage::$URL.'/'.$this->fixture);

        $I->see($this->fixture, \Teste\Pages\EmailViewPage::getValueByIndex(1));
        $I->see('remetente999', \Teste\Pages\EmailViewPage::getValueByIndex(2));
        $I->see('destino999', \Teste\Pages\EmailViewPage::getValueByIndex(3));
        $I->see('assunto999', \Teste\Pages\EmailViewPage::getValueByIndex(4));
        $I->see('mensagem999', \Teste\Pages\EmailViewPage::getValueByIndex(5));
    }
}
