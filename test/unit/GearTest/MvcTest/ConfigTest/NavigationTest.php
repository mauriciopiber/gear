<?php
namespace GearTest\MvcTest\ConfigTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Config\NavigationTrait;

/**
 * @group Mvc
 * @group Mvc-Config
 */
class NavigationTest extends AbstractTestCase
{
    use NavigationTrait;

    public function testOk()
    {
        $this->assertTrue(true);
    }
}