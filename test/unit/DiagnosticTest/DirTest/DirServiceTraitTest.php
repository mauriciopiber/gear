<?php
namespace GearTest\DiagnosticTest\DirTest;

use GearBaseTest\AbstractTestCase;
use Gear\Diagnostic\Dir\DirServiceTrait;

/**
 * @group Gear
 * @group Diagnostic
 * @group DirService
 */
class DirServiceTraitTest extends AbstractTestCase
{
    use DirServiceTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getDirDiagnosticService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Diagnostic\Dir\DirService')->reveal();
        $this->setDirDiagnosticService($mocking);
        $this->assertEquals($mocking, $this->getDirDiagnosticService());
    }
}
