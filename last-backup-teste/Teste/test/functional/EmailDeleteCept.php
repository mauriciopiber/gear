<?php

/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
\TesteTest\LoginCommons::logMeIn($I);

$I->haveInDatabase('email', array('remetente' => 'remetenteparadeletar', 'destino' => 'destino', 'assunto' => 'assunto', 'mensagem' => 'mensagem', 'created' => '2015-02-05 12:00:00', 'created_by' => 1));

$I->wantTo('See the message of module creation was sucessfull');

$I->amOnPage(\Teste\Pages\EmailDeletePage::$URL);
$I->see(
    'Email',
    '#pageTitle'
);

$I->click(
    \Teste\Pages\EmailListPage::$filterBtn
);

$I->click(
    \Teste\Pages\EmailListPage::$filterSearchBtn
);

$I->see('remetenteparadeletar', \Teste\Pages\EmailListPage::getTableItem(1));

$I->click('#emailTable > tbody > tr:nth-child(1) td:nth-child(6) form > a', array());
$I->waitForElement('.modal-title', 3);
$I->see('Deletar Email', '.modal-title');
$I->see('Desejas realmente deletar Email?', '.modal-body p');

$I->click('Delete');
$I->see('Sucesso! Deletado.');
$I->dontSee('remetenteparadeletar', \Teste\Pages\EmailListPage::getTableItem(1));

//se certifica que elemento existe na tela
//clica em deletar determinado elemento
//clica em confirmação
//verifica se o elemento foi removido da listagem
//verifica se apareceu mensagem de removido com sucesso.


\TesteTest\LoginCommons::logMeOut($I);

