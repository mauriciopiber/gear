<?php
namespace TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class ViewSteps extends \TestUpload\AcceptanceTester\AcceptanceSteps
{
    public function verifyOnPage($class, $label, $idToView)
    {
        $I = $this;
        $instance = new $class;

        $I->amOnPage($instance::$URL.'/'.$idToView);
        $I->see('Visualizar '.$label.' - '.$idToView);
    }
}
