<?php
namespace GearGest\ConstructorTest;

use GearTest\AbstractGearTest;

class ControllerTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getServiceLocator()->get('ConstructorController');
    }


    public function tearDown()
    {
        parent::tearDown();
    }

    public function testAssertServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\ControllerMaker', $this->service);
    }


}