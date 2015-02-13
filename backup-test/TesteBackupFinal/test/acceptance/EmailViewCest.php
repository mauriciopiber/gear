<?php
/**
 * @SuppressWarning(PHPMD)
 * @guy AcceptanceTester\ViewSteps
 */
class EmailViewCest extends \AcceptanceTester\AbstractCest
{
    protected $fixture;

    public function _before(\AcceptanceTester $I)
    {
        $this->fixture = $I->haveInDatabase(
            'email',
            array(
                'remetente' => 'remetente1300',
                'destino' => 'destino1300',
                'assunto' => 'assunto1300',
                'mensagem' => 'mensagem1300',
                'created' => '2015-02-12 08:10:52',
                'created_by' => 1
            )
        );
        parent::_before($I);
    }

    public function viewSuccessful(\AcceptanceTester $I)
    {
        $I->wantTo('View Email Successful');
        $I->verifyOnPage('\Teste\Pages\EmailViewPage', 'Email', $this->fixture);

        $I->see('Email');
        $I->see('Remetente');
        $I->see('Destino');
        $I->see('Assunto');
        $I->see('Mensagem');
        $I->see('remetente1300');
        $I->see('destino1300');
        $I->see('assunto1300');
        $I->see('mensagem1300');
    }
}
