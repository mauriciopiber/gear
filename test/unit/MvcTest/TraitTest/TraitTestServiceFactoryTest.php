<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;

/**
 * @group mvc-trait
 */
class TraitTestServiceFactoryTest extends TestCase
{
    public function testCreateTraitTest()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $stringService = $this->prophesize('GearBase\Util\String\StringService');
        $this->serviceLocator->get('GearBase\Util\String')->willReturn($stringService->reveal())->shouldBeCalled();

        $fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
        $this->serviceLocator->get('Gear\Creator\FileCreator\FileCreator')->willReturn($fileCreator)->shouldBeCalled();

        $codeTest = $this->prophesize('Gear\Creator\CodeTest');
        $this->serviceLocator->get('Gear\Creator\CodeTest')->willReturn($codeTest)->shouldBeCalled();

        $traitTest = new \Gear\Mvc\TraitTestServiceFactory();

        $diagnostic = $traitTest->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\TraitTestService', $diagnostic);
    }
}
