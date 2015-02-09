<?php

/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
\TesteTest\LoginCommons::logMeIn($I);


$I->haveInDatabase('email', array('remetente' => 'remetenteparadeletar', 'destino' => 'destino', 'assunto' => 'assunto', 'mensagem' => 'mensagem', 'created' => '2015-02-05 12:00:00', 'created_by' => 1));

$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\Teste\Pages\EmailEditPage::$URL.'/31');
$I->see(
    'Email',
    '#pageTitle'
);

$I->seeInField(\Teste\Pages\EmailEditPage::$remetente, 'remetenteparadeletar');
$I->seeInField(\Teste\Pages\EmailEditPage::$destino, 'destino');
$I->seeInField(\Teste\Pages\EmailEditPage::$assunto, 'assunto');
$I->seeInField(\Teste\Pages\EmailEditPage::$mensagem, 'mensagem');

$I->fillField(\Teste\Pages\EmailEditPage::$remetente, 'novo2 remetente');
$I->fillField(\Teste\Pages\EmailEditPage::$destino, 'novo2 destino');
$I->fillField(\Teste\Pages\EmailEditPage::$assunto, 'novo2 assunto');
$I->fillField(\Teste\Pages\EmailEditPage::$mensagem, 'nova2 mensagem');

$I->click(\Teste\Pages\EmailEditPage::$submit);

$I->seeCurrentUrlEquals(\Teste\Pages\EmailEditPage::$URL.'/31/1');

$I->seeInField(\Teste\Pages\EmailEditPage::$remetente, 'novo2 remetente');
$I->seeInField(\Teste\Pages\EmailEditPage::$destino, 'novo2 destino');
$I->seeInField(\Teste\Pages\EmailEditPage::$assunto, 'novo2 assunto');
$I->seeInField(\Teste\Pages\EmailEditPage::$mensagem, 'nova2 mensagem');


\TesteTest\LoginCommons::logMeOut($I);

