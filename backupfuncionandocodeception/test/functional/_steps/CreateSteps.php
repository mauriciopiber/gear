<?php
namespace Teste\FunctionalTester;

class CreateSteps extends \Teste\FunctionalTester
{
    public function verifyBreadcrumb($class, $module, $controller, $action)
    {
        $instance = new $class;
        $I = $this;

        $I->see($module, $instance::getBreadcrumbByIndex(1));
        $I->see($controller, $instance::getBreadcrumbByIndex(2));
        $I->see($action, $instance::getBreadcrumbByIndex(3));
        $I->seeNumberOfElements($instance::$breadscrumb, 3);
    }
}