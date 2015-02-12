<?php

/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 * @guy AcceptanceTester\CreateSteps
 */
class EmailCreateCest
{
    public function _before(\AcceptanceTester $I)
    {
        \TesteTest\LoginCommons::logMeIn($I);
    }

    public function _after(\AcceptanceTester $I)
    {
        \TesteTest\LoginCommons::logMeOut($I);
    }

    public function createSuccessful(\AcceptanceTester $I)
    {
        $I->wantTo('Create Email Successful');

        $I->verifyOnPage('\Teste\Pages\EmailCreatePage', 'Email');
        $I->fillField(\Teste\Pages\EmailEditPage::$remetente, 'remetente1200');
        $I->fillField(\Teste\Pages\EmailEditPage::$destino, 'destino1200');
        $I->fillField(\Teste\Pages\EmailEditPage::$assunto, 'assunto1200');
        $I->fillField(\Teste\Pages\EmailEditPage::$mensagem, 'mensagem1200');
        $I->verifyCreateSuccessful('\Teste\Pages\EmailCreatePage', 'Email');
        $I->seeInField(\Teste\Pages\EmailEditPage::$remetente, 'remetente1200');
        $I->seeInField(\Teste\Pages\EmailEditPage::$destino, 'destino1200');
        $I->seeInField(\Teste\Pages\EmailEditPage::$assunto, 'assunto1200');
        $I->seeInField(\Teste\Pages\EmailEditPage::$mensagem, 'mensagem1200');
    }
}
