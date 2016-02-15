<?php
namespace GearTest\MvcTest\ConfigTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Config\NavigationManagerTrait;

/**
 * @group Mvc
 * @group Mvc-Config
 */
class NavigationTest extends AbstractTestCase
{
    use NavigationManagerTrait;

    public function testOk()
    {
        $this->assertTrue(true);
    }
}