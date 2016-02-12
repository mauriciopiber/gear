<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarnings(PHPMD)
 */

$I = new \FunctionalTester\RegisterSteps($scenario);
$I->emailAlreadyRegisted('email1@gmail.com');
$I->passwordLenghtMax();
$I->passwordLenghtMin();
$I->validLabels();
$I->required();
$I->invalidEmail('piber', 'piber');
$I->checkPasswordEquals('1234567');
$I->checkEmailEquals('alemao@gmail.com');
