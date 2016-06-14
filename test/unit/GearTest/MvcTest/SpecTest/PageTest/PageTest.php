<?php
namespace GearTest\MvcTest\SpecTest\PageTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Spec\Page\PageTrait;

/**
 * @group Service
 */
class PageTest extends AbstractTestCase
{
    use PageTrait;

    /**
     * @group Gear
     * @group Page
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPage()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group Page
    */
    public function testGet()
    {
        $page = $this->getPage();
        $this->assertInstanceOf('Gear\Mvc\Spec\Page\Page', $page);
    }

    /**
     * @group Gear
     * @group Page
    */
    public function testSet()
    {
        $mockPage = $this->getMockSingleClass(
            'Gear\Mvc\Spec\Page\Page'
        );
        $this->setPage($mockPage);
        $this->assertEquals($mockPage, $this->getPage());
    }
}
