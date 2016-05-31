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
    public function testCreateTraitTest()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $stringService = $this->prophesize('GearBase\Util\String\StringService');
        $this->serviceLocator->get('GearBase\Util\String')->willReturn($stringService->reveal())->shouldBeCalled();

        $fileCreator = $this->prophesize('Gear\Creator\File');
        $this->serviceLocator->get('Gear\FileCreator')->willReturn($fileCreator)->shouldBeCalled();

        $traitTest = new \Gear\Mvc\TraitTestServiceFactory();

        $diagnostic = $traitTest->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Mvc\TraitTestService', $diagnostic);
    }
}
