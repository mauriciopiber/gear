<?php
namespace GearTest\MvcTest\SpecTest\PageTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group Page
 */
class PageFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Mvc\Spec\Page\PageFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\Spec\Page\Page', $instance);
    }
}
