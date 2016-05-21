<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Module
 */
class ConstructServiceTest extends AbstractTestCase
{
    public function testConstruct()
    {
        $construct = new \Gear\Module\ConstructService();

        $constructed = $construct->construct();

        $this->assertTrue($constructed);
    }
}