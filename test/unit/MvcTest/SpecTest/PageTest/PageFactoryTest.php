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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Mvc\Spec\Page\PageFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\Spec\Page\Page', $instance);
    }
}
