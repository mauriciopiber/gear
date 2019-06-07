<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group mvc-trait
 */
class TraitTestServiceFactoryTest extends TestCase
{
    public function testCreateTraitTest()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $stringService = $this->prophesize('Gear\Util\String\StringService');
        $this->container->get('Gear\Util\String\StringService')->willReturn($stringService->reveal())->shouldBeCalled();

        $fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
        $this->container->get('Gear\Creator\FileCreator\FileCreator')->willReturn($fileCreator)->shouldBeCalled();

        $codeTest = $this->prophesize('Gear\Creator\CodeTest');
        $this->container->get('Gear\Creator\CodeTest')->willReturn($codeTest)->shouldBeCalled();

        $traitTest = new \Gear\Mvc\TraitTestServiceFactory();

        $diagnostic = $traitTest->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Mvc\TraitTestService', $diagnostic);
    }
}
