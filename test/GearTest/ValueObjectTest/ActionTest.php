<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ActionTest extends AbstractGearTest
{
    /**
     * @group rev2
     */
    public function testStdClassToAction()
    {
        $stdClass = new \stdClass();
        $stdClass->name = 'action';
        $stdClass->route = 'route';
        $stdClass->role = 'role';

        $action = new \Gear\ValueObject\Action($stdClass);

        $this->assertInstanceOf('Gear\ValueObject\Action', $action);

        $name = $action->getName();
        $route = $action->getRoute();
        $role = $action->getRole();
        $controller = $action->getController();

        $this->assertEquals('action', $name);
        $this->assertEquals('route', $route);
        $this->assertEquals('role', $role);
        $this->assertEquals(null, $controller);
    }

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
