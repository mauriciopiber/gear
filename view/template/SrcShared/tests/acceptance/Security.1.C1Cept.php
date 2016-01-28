<?php
/**
 * @author Maurício Piber Fão
 * @SuppressWarning(PHPMD)
 */
$I = new \AcceptanceTester\RegisterSteps($scenario);
$I->wantTo('Register a new user');
$I->register(
    'mauriciopiber@gmail.com',
    'mauriciopiber@gmail.com',
    'pibernetwork',
    'pibernetwork'
);
$I->activationSent('mauriciopiber@gmail.com');
$I->activeByEmail();
$I->logOn('mauriciopiber@gmail.com');
