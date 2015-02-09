<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \AcceptanceTester($scenario);
\TesteTest\LoginCommons::logMeIn($I);

$I->wantTo('See the message of module creation was sucessfull');
$I->amOnPage(\Teste\Pages\EmailCreatePage::$URL);
$I->see('Email');

\TesteTest\LoginCommons::logMeOut($I);
