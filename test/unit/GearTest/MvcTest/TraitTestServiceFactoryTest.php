<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Module
 * @group Mvc
 * @group Trait
 */
class TraitTestServiceFactoryTest extends AbstractTestCase
{
    public function testCreateDiagnostic()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $dirService = $this->prophesize('GearBase\Util\Dir\DirService');
        $this->serviceLocator->get('GearBase\Util\Dir')->willReturn($dirService->reveal())->shouldBeCalled();

        $fileService = $this->prophesize('GearBase\Util\File\FileService');
        $this->serviceLocator->get('GearBase\Util\File')->willReturn($fileService->reveal())->shouldBeCalled();

        $stringService = $this->prophesize('GearBase\Util\String\StringService');
        $this->serviceLocator->get('GearBase\Util\String')->willReturn($stringService->reveal())->shouldBeCalled();

        $traitTest = new \Gear\Mvc\TraitTestServiceFactory();

        $diagnostic = $traitTest->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\TraitTestService', $diagnostic);
    }
}
