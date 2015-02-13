<?php

/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 * @guy AcceptanceTester\DeleteSteps
 */
class EmailDeleteCest extends \AcceptanceTester\AbstractCest
{
    protected $fixture;

    public function _before(\AcceptanceTester $I)
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

    public function deleteSuccessful(\AcceptanceTester $I)
    {
        $I->wantTo('Delete Email Successful');
        $I->verifyCanViewBeforeDelete('\Teste\Pages\EmailDeletePage', 'Email', $this->fixture);
        $I->verifyFilterInstanceBeforeDelete('\Teste\Pages\EmailDeletePage', 999);
        $I->verifyDeleteSuccessfulFromTableIndex('\Teste\Pages\EmailDeletePage', 'Email');
    }
}
