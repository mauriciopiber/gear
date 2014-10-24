<?php
namespace GearTest\ConstructorTest;

use GearTest\AbstractGearTest;

class ControllerTest extends AbstractGearTest
{
    public function testCreateControllerFromArrayUsingHydrate()
    {
        $controllerParams = array(
        	'name' => 'MeuController',
            'invokable' => '%s\Controller\Meu',
            'actions' => array('hua', 'huadsf', 'husasdfadf0')
        );

        $controller = new \Gear\Constructor\ValueObject\Controller($controllerParams);

        $this->assertEquals($controller->getName(), 'MeuController');
        $this->assertEquals($controller->getInvokable(), '%s\Controller\Meu');
        $this->assertEquals($controller->getActions(), array('hua', 'huadsf', 'husasdfadf0'));

        $extract = $controller->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['name'***REMOVED***, 'MeuController');
        $this->assertEquals($extract['invokable'***REMOVED***, '%s\Controller\Meu');
        $this->assertEquals($extract['actions'***REMOVED***, array('hua', 'huadsf', 'husasdfadf0'));
    }
}
