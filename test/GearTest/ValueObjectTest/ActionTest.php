<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ActionTest extends AbstractGearTest
{
    public function testCreateServiceFromArray()
    {
        $actionParam = array(
        	'name' => 'myAction',
            'route' => 'myRoute',
            'role' => 'myRole'
        );

        $action = new \Gear\ValueObject\Action($actionParam);

        $name = $action->getName();
        $route = $action->getRoute();
        $role = $action->getRole();
        $controller = $action->getController();

        $this->assertEquals('myAction', $name);
        $this->assertEquals('myRoute', $route);
        $this->assertEquals('myRole', $role);
        $this->assertEquals(null, $controller);
    }
}
