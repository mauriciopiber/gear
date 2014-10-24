<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

class SrcServiceTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getServiceLocator()->get('srcService');
        $this->module = $this->getServiceLocator()->get('moduleService');
    }


    public function tearDown()
    {
        parent::tearDown();
    }

    public function testCreateStdClass()
    {
        $stdClass = $this->service->createStdClass();
        $this->assertInstanceOf('stdClass', $stdClass);
       // $this->assertObjectHasAttribute('name', $stdClass);
    }
}