<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use Gear\Diagnostic\ComposerServiceTrait;

/**
 * @group Service
 */
class ComposerServiceTest extends AbstractTestCase
{
    use ComposerServiceTrait;

    /**
     * @group Gear
     * @group ComposerService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getComposerService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ComposerService
    */
    public function testGet()
    {
        $composerService = $this->getComposerService();
        $this->assertInstanceOf('Gear\Diagnostic\ComposerService', $composerService);
    }

    /**
     * @group Gear
     * @group ComposerService
    */
    public function testSet()
    {
        $mockComposerService = $this->getMockSingleClass(
            'Gear\Diagnostic\ComposerService'
        );
        $this->setComposerService($mockComposerService);
        $this->assertEquals($mockComposerService, $this->getComposerService());
    }
}
