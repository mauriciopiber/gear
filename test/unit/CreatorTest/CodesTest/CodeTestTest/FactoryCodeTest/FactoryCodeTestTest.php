<?php
namespace GearTest\CreatorTest\CodesTest\CodeTestTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\Dir\DirService;
use Gear\Util\String\StringService;
use Gear\Util\Vector\ArrayService;

/**
 * @group Service
 */
class FactoryCodeTestTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->service = new FactoryCodeTest(
            $this->prophesize(ModuleStructure::class)->reveal(),
            $this->prophesize(StringService::class)->reveal(),
            $this->prophesize(DirService::class)->reveal(),
            $this->prophesize(ArrayService::class)->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest', $this->service);
    }
}
