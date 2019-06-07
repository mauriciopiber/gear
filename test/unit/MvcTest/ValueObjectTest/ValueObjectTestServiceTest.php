<?php
namespace GearTest\MvcTest\ValueObjectTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\ValueObject\ValueObjectTestService;

/**
 * @group Service
 */
class ValueObjectTestServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->stringService = $this->prophesize('Gear\Util\String\StringService');
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->codeTest = $this->prophesize('Gear\Creator\CodeTest');

        $this->service = new ValueObjectTestService(
            $this->stringService->reveal(),
            $this->fileCreator->reveal(),
            $this->module->reveal(),
            $this->codeTest->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Mvc\ValueObject\ValueObjectTestService', $this->service);
    }
}
