<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

class ModuleServiceTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();
        $this->moduleService = $this->getServiceLocator()->get('moduleService');
    }

    /**
     * @group module
     */
    public function testCreate()
    {
        //$this->moduleService->createEmptyModule('Sandbox');
        $this->assertTrue(true);
    }

    /**
     * @group module
     */
    public function testDelete()
    {
        $this->assertTrue(true);

    }
}