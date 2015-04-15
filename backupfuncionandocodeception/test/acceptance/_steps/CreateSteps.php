<?php
namespace Teste\AcceptanceTester;

class CreateSteps extends \Teste\AcceptanceTester
{
    public function verifyOnPage($class, $label)
    {
        $I = $this;
        $instance = new $class;
        $I->amOnPage($instance::$URL);
        $I->see('Criar '.$label);
    }

    public function verifyCreateSuccessful($class)
    {
        $I = $this;
        $instance = new $class;

        $I->click($instance::$submit);
        $I->see('Sucesso! Os dados foram salvos corretamente.');

        $editPage = str_replace('CreatePage', 'EditPage', $class);
        $instanceEdit = new $editPage;
        $I->seeCurrentUrlEquals($instanceEdit::$URL.'/31/1');
    }


}