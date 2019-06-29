<?php
namespace GearTest\MvcTest\ValueObjectTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Code\CodeTest;
use Gear\Mvc\ValueObject\ValueObjectTestService;
use GearTest\UtilTestTrait;

/**
 * @group Service
 */
class ValueObjectTestServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->stringService = $this->prophesize(StringService::class);
        $this->fileCreator = $this->prophesize(FileCreator::class);
        $this->module = $this->prophesize(ModuleStructure::class);
        $this->codeTest = $this->prophesize(CodeTest::class);

        $this->service = new ValueObjectTestService(
            $this->module->reveal(),
            $this->fileCreator->reveal(),
            $this->stringService->reveal(),
            $this->codeTest->reveal(),
            $this->createTableService(),
            $this->createInjector()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Mvc\ValueObject\ValueObjectTestService', $this->service);
    }
}
