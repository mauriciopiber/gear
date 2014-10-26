<?php
namespace GearGest\ConstructorTest;

use GearTest\AbstractGearTest;

class ControllerTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getServiceLocator()->get('controllerConstructor');
    }


    public function tearDown()
    {
        parent::tearDown();
    }

    public function testAssertServiceManager()
    {
        $this->assertInstanceOf('Gear\Service\Constructor\ControllerService', $this->service);
    }


}