<?php

/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
\TesteTest\LoginCommons::logMeIn($I);

$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\Teste\Pages\EmailCreatePage::$URL);
$I->see(
    'Email',
    '#pageTitle'
);

$I->seeInField(\Teste\Pages\EmailCreatePage::$remetente, '');
$I->seeInField(\Teste\Pages\EmailCreatePage::$destino, '');
$I->seeInField(\Teste\Pages\EmailCreatePage::$assunto, '');
$I->seeInField(\Teste\Pages\EmailCreatePage::$mensagem, '');

$I->fillField(\Teste\Pages\EmailCreatePage::$remetente, 'novo remetente');
$I->fillField(\Teste\Pages\EmailCreatePage::$destino, 'novo destino');
$I->fillField(\Teste\Pages\EmailCreatePage::$assunto, 'novo assunto');
$I->fillField(\Teste\Pages\EmailCreatePage::$mensagem, 'nova mensagem');

$I->click(\Teste\Pages\EmailCreatePage::$submit);

$I->seeCurrentUrlEquals(\Teste\Pages\EmailEditPage::$URL.'/31/1');

$I->seeInField(\Teste\Pages\EmailCreatePage::$remetente, 'novo remetente');
$I->seeInField(\Teste\Pages\EmailCreatePage::$destino, 'novo destino');
$I->seeInField(\Teste\Pages\EmailCreatePage::$assunto, 'novo assunto');
$I->seeInField(\Teste\Pages\EmailCreatePage::$mensagem, 'nova mensagem');


\TesteTest\LoginCommons::logMeOut($I);
