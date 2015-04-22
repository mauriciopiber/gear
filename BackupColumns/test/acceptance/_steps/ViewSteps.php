<?php
namespace Column\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class ViewSteps extends \Column\AcceptanceTester\AcceptanceSteps
{
    public function verifyOnPage($class, $label, $idToView)
    {
        $I = $this;
        $instance = new $class;

        $I->amOnPage($instance::$URL.'/'.$idToView);
        $I->see('Visualizar '.$label.' - '.$idToView);
    }
}
