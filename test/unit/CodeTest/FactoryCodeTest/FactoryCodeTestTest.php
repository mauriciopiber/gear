<?php
namespace GearTest\CodeTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Code\FactoryCode\FactoryCodeTest;
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
        $this->assertInstanceOf('Gear\Code\FactoryCode\FactoryCodeTest', $this->service);
    }
}