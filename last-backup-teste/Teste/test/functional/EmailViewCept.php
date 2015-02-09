<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \FunctionalTester($scenario);
\TesteTest\LoginCommons::logMeIn($I);

$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\Teste\Pages\EmailViewPage::$URL);
$I->see(
    'Email',
    '#pageTitle'
);

\TesteTest\LoginCommons::logMeOut($I);
