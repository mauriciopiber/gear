<?php
namespace GearTest\ModuleTest\DocsTest;

use GearBaseTest\AbstractTestCase;
use Gear\Module\Docs\DocsTrait;

/**
 * @group Gear
 * @group Docs
 */
class DocsTraitTest extends AbstractTestCase
{
    use DocsTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getDocs()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Module\Docs\Docs')->reveal();
        $this->setDocs($mocking);
        $this->assertEquals($mocking, $this->getDocs());
    }
}
