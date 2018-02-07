<?php
namespace GearTest\MvcTest\SpecTest\PageTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\Page\PageTrait;

/**
 * @group Gear
 * @group Page
 */
class PageTraitTest extends AbstractTestCase
{
    use PageTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getPage()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\Page\Page')->reveal();
        $this->setPage($mocking);
        $this->assertEquals($mocking, $this->getPage());
    }
}
