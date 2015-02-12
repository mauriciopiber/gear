<?php

/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 * @guy AcceptanceTester\DeleteSteps
 */
class EmailDeleteCest
{
    public function _before(\AcceptanceTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\AcceptanceTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }

    public function deleteSuccessful(\AcceptanceTester $I)
    {
        $I->wantTo('Delete Email Successful');

        $idToDelete = $I->haveInDatabase(
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

        $I->verifyCanViewBeforeDelete('\Teste\Pages\EmailDeletePage', 'Email', $idToDelete);
        $I->verifyFilterInstanceBeforeDelete('\Teste\Pages\EmailDeletePage', 999);
        $I->verifyDeleteSuccessfulFromTableIndex('\Teste\Pages\EmailDeletePage', 'Email');
    }
}
