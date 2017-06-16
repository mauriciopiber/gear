<?php
namespace GearTest\ColumnTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Column\ColumnManager;

/**
 * @group Service
 */
class ColumnManagerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->columnManager = new ColumnManager([***REMOVED***);
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Column\ColumnManager', $this->columnManager);
    }
}
