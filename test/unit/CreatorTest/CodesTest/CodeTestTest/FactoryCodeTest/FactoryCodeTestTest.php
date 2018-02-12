<?php
namespace GearTest\CreatorTest\CodesTest\CodeTestTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest;

/**
 * @group Service
 */
class FactoryCodeTestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = new FactoryCodeTest();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest', $this->service);
    }
}
