<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ControllerTest extends AbstractGearTest
{
    /**
     * @group rev2
     */
    public function testStdClassToController()
    {
        $stdClass = new \StdClass();
        $stdClass->controller = 'controller';
        $stdClass->invokable = '%s\Controller\route';

        $controller = new \Gear\ValueObject\Controller($stdClass);

        $this->assertInstanceOf('Gear\ValueObject\Controller', $controller);

        $name = $controller->getName();
        $invokable = $controller->getInvokable();
        $action = $controller->getAction();


        $this->assertEquals('controller', $name);
        $this->assertEquals('%s\Controller\route', $invokable);
        $this->assertEquals(array(), $action);
    }

    public function testCreateControllerFromArrayUsingHydrate()
    {
        $controllerParams = array(
        	'name' => 'MeuController',
            'invokable' => '%s\Controller\Meu'
        );

        $controller = new \Gear\ValueObject\Controller($controllerParams);

        $this->assertEquals($controller->getName(), 'MeuController');
        $this->assertEquals($controller->getInvokable(), '%s\Controller\Meu');

        $extract = $controller->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['name'***REMOVED***, 'MeuController');
        $this->assertEquals($extract['invokable'***REMOVED***, '%s\Controller\Meu');
    }
}
