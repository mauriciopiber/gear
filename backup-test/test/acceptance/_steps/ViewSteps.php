<?php
namespace AcceptanceTester;

class ViewSteps extends \AcceptanceTester
{
    public function verifyOnPage($class, $label, $idToView)
    {
        $I = $this;
        $instance = new $class;

        $I->amOnPage($instance::$URL.'/'.$idToView);
        $I->see('Visualizar '.$label.' - '.$idToView);
    }
}
