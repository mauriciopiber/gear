<?php

/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
\TesteTest\LoginCommons::logMeIn($I);

$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\Teste\Pages\EmailListPage::$URL);


/** Table */

$I->seeNumberOfElements(\Teste\Pages\EmailListPage::$tableHead, 6);

$I->see('Ações', \Teste\Pages\EmailListPage::$tableHeadActions);

$I->seeNumberOfElements(\Teste\Pages\EmailListPage::$tableBodyRows, 10);


$I->see('30Remetente', \Teste\Pages\EmailListPage::getTableItem(1));
$I->see('21Remetente', \Teste\Pages\EmailListPage::getTableItem(10));

$I->see('26Assunto', \Teste\Pages\EmailListPage::getTableRowColumn(5, 4));

$I->seeElement('#emailTable > tbody > tr:nth-child(1) td:nth-child(6) a:nth-child(1)');
$I->seeElement('#emailTable > tbody > tr:nth-child(1) td:nth-child(6) a:nth-child(2)');
$I->seeElement('#emailTable > tbody > tr:nth-child(1) td:nth-child(6) form');


$I->dontSeeElement('#emailTable > tbody > tr:nth-child(1) td:nth-child(6) a:nth-child(3)');
$I->dontSeeElement('#emailTable > tbody > tr:nth-child(1) td:nth-child(6) form:nth-child(2)');


$I->seeLink('a','/teste/email/visualizar/30');
$I->seeLink('a','/teste/email/editar/30');
$I->dontSeeLink('a','/teste/email/editar/31');
$I->dontSeeLink('a','/teste/email/editar/20');
/**
 * Aqui a pica é bem dinâmica mesmo.
*/

//cada perfil terá uma proposta diferente de teste funcional.
//all -> primeiro.
//strict -> igual primeiro, mas também deve verificar se não deixa ver/editar/excluir.
//low-strict deve checar se realmente não exibe editar/excluir e realmente não deixa editar/exluir.


$I->see(
    'Email',
    \Teste\Pages\EmailListPage::$title
);

$I->see(
    'Criar',
    \Teste\Pages\EmailListPage::$createBtn
);

/** Breadscrumb */

$I->see(
    'Teste',
    \Teste\Pages\EmailListPage::$breadscrumbModule
);

$I->see(
    'Email',
    \Teste\Pages\EmailListPage::$breadscrumbController
);

$I->see(
    'Listar',
    \Teste\Pages\EmailListPage::$breadscrumbAction
);

$I->seeNumberOfElements(\Teste\Pages\EmailListPage::$breadscrumbList, 3);

/** Filter */

$I->see(
    'Exibir Filtro',
    \Teste\Pages\EmailListPage::$filterBtn
);

$I->click(\Teste\Pages\EmailListPage::$filterBtn);

$I->see(
    'Esconder Filtro',
    \Teste\Pages\EmailListPage::$filterBtn
);

$I->seeInField(

    \Teste\Pages\EmailListPage::$filterSearchBtn,
    'Pesquisar'
);

$I->seeInField(
    \Teste\Pages\EmailListPage::$filterClearBtn,
    'Limpar'
);

$I->seeInField(
    \Teste\Pages\EmailListPage::$filterLikeField,
    ''
);

/** Paginator */

$I->see(
    'Mostrando 1 até 10 de 30 entradas',
    \Teste\Pages\EmailListPage::$paginatorCount
);

$I->see(
    '<<',
    \Teste\Pages\EmailListPage::$paginatorOne
);

$I->see(
    '1',
    \Teste\Pages\EmailListPage::$paginatorTwo
);
$I->seeLink('1',\Teste\Pages\EmailListPage::$URL);

$I->see(
    '2',
    \Teste\Pages\EmailListPage::$paginatorThree
);
$I->seeLink('2',\Teste\Pages\EmailListPage::$URL);

$I->see(
    '3',
    \Teste\Pages\EmailListPage::$paginatorFour
);

$I->seeLink('3',\Teste\Pages\EmailListPage::$URL);

$I->see(
    '>>',
    \Teste\Pages\EmailListPage::$paginatorFive
);

$I->seeNumberOfElements(\Teste\Pages\EmailListPage::$paginatorList, 5);

\TesteTest\LoginCommons::logMeOut($I);

