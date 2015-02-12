<?php
namespace AcceptanceTester;

class EditSteps extends \AcceptanceTester
{
    public function verifyOnPage($class, $label, $idEdit)
    {
        $I = $this;
        $instance = new $class;
        $I->amOnPage($instance::$URL.'/'.$idEdit);
        $I->see('Editar '.$label);
    }

    public function verifySubmitAndReturnSuccessful($class, $idEdit)
    {
        $I = $this;
        $instance = new $class;

        $I->click($instance::$submit);
        $I->seeCurrentUrlEquals($instance::$URL.'/'.$idEdit.'/1');
        $I->see('Sucesso! Os dados foram salvos corretamente.');
    }
}
