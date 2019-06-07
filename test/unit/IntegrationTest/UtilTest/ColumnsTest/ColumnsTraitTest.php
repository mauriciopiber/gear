<?php
namespace GearTest\IntegrationTest\UtilTest\ColumnsTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\Columns\ColumnsTrait;

/**
 * @group Gear
 * @group Columns
 * @group Service
 */
class ColumnsTraitTest extends TestCase
{

    use ColumnsTrait;

    public function testGet()
    {
        $serviceLocator = $this->getColumns();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\Columns\Columns')->reveal();
        $this->setColumns($mocking);
        $this->assertEquals($mocking, $this->getColumns());
    }
}
