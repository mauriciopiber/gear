<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ControllerTest extends AbstractGearTest
{
    /**
     * @group ver2
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
}