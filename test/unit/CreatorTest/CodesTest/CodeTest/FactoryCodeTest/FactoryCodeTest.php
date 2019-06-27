<?php
namespace GearTest\CreatorTest\CodesTest\CodeTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Code\FactoryCode\FactoryCode;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\Dir\DirService;
use Gear\Util\String\StringService;

/**
 * @group Service
 */
class FactoryCodeTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->service = new FactoryCode(
            $this->prophesize(ModuleStructure::class)->reveal(),
            $this->prophesize(StringService::class)->reveal(),
            $this->prophesize(DirService::class)->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Code\FactoryCode\FactoryCode', $this->service);
    }
}
