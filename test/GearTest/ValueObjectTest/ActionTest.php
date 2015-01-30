<?php

namespace GearTest\ValueObjectTest;

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

        $this->assertInstanceOf('Gear\ValueObject\AbstractHydrator', $action);

        $name = $action->getName();
        $route = $action->getRoute();
        $role = $action->getRole();

        $this->assertEquals('MyAction', $name);
        $this->assertEquals('myRoute', $route);
        $this->assertEquals('myRole', $role);

    }



}

