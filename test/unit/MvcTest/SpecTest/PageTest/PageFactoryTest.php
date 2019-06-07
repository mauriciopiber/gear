<?php
namespace GearTest\MvcTest\SpecTest\PageTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group Page
 */
class PageFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $factory = new \Gear\Mvc\Spec\Page\PageFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Mvc\Spec\Page\Page', $instance);
    }
}
