<?php
namespace GearTest\IntegrationTest\UtilTest\ColumnsTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Integration\Util\Columns\ColumnsTrait;

/**
 * @group Gear
 * @group Columns
 * @group Service
 */
class ColumnsTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use ColumnsTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Integration\Util\Columns\Columns');
        $serviceManager->setService('Gear\Integration\Util\Columns\Columns', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getColumns();
        $this->assertInstanceOf('Gear\Integration\Util\Columns\Columns', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Integration\Util\Columns\Columns')->reveal();
        $this->setColumns($mocking);
        $this->assertEquals($mocking, $this->getColumns());
    }
}
