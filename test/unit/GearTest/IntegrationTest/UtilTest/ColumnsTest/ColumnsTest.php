<?php
namespace GearTest\IntegrationTest\UtilTest\ColumnsTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Util\Columns\Columns;

/**
 * @group Service
 */
class ColumnsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = new Columns();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Util\Columns\Columns', $this->service);
    }
}
