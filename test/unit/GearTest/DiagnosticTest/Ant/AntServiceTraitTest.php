<?php
namespace GearTest\DiagnosticTest\AntTest;

use GearBaseTest\AbstractTestCase;
use Gear\Diagnostic\Ant\AntServiceTrait;

/**
 * @group Gear
 * @group Diagnostic
 * @group AntService
 */
class AntServiceTraitTest extends AbstractTestCase
{
    use AntServiceTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getAntService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Diagnostic\Ant\AntService')->reveal();
        $this->setAntService($mocking);
        $this->assertEquals($mocking, $this->getAntService());
    }
}
