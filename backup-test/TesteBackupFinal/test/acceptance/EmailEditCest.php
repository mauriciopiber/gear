<?php
/**
 * @SuppressWarning(PHPMD)
 * @guy AcceptanceTester\EditSteps
 */
class EmailEditCest extends \AcceptanceTester\AbstractCest
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

    public function editSuccessful(\AcceptanceTester $I)
    {
        $I->wantTo('Edit Email Successful');


        $I->verifyOnPage('\Teste\Pages\EmailEditPage', 'Email - '.$this->fixture, $this->fixture);

        $I->verifySubmitAndReturnSuccessful('\Teste\Pages\EmailEditPage', $this->fixture);

        $I->seeInField(\Teste\Pages\EmailEditPage::$remetente, 'remetente999');
        $I->seeInField(\Teste\Pages\EmailEditPage::$destino, 'destino999');
        $I->seeInField(\Teste\Pages\EmailEditPage::$assunto, 'assunto999');
        $I->seeInField(\Teste\Pages\EmailEditPage::$mensagem, 'mensagem999');

        $I->fillField(\Teste\Pages\EmailEditPage::$remetente, 'remetente1500');
        $I->fillField(\Teste\Pages\EmailEditPage::$destino, 'destino1500');
        $I->fillField(\Teste\Pages\EmailEditPage::$assunto, 'assunto1500');
        $I->fillField(\Teste\Pages\EmailEditPage::$mensagem, 'mensagem1500');

        $I->verifySubmitAndReturnSuccessful('\Teste\Pages\EmailEditPage', $this->fixture);

        $I->seeInField(\Teste\Pages\EmailEditPage::$remetente, 'remetente1500');
        $I->seeInField(\Teste\Pages\EmailEditPage::$destino, 'destino1500');
        $I->seeInField(\Teste\Pages\EmailEditPage::$assunto, 'assunto1500');
        $I->seeInField(\Teste\Pages\EmailEditPage::$mensagem, 'mensagem1500');
    }
}
