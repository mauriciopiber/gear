<?php
namespace GearTest\CreatorTest\CodesTest\CodeTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Codes\Code\FactoryCode\FactoryCode;

/**
 * @group Service
 */
class FactoryCodeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = new FactoryCode();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Creator\Codes\Code\FactoryCode\FactoryCode', $this->service);
    }
}
