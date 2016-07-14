<?php
namespace GearTest\TableTest\TableServiceTest;

use GearBaseTest\AbstractTestCase;
use Gear\Table\TableService\TableServiceTrait;

/**
 * @group Service
 */
class TableServiceTest extends AbstractTestCase
{
    use TableServiceTrait;

    /**
     * @group Gear
     * @group TableService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTableService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group TableService
    */
    public function testGet()
    {
        $tableService = $this->getTableService();
        $this->assertInstanceOf('Gear\Table\TableService\TableService', $tableService);
    }

    /**
     * @group Gear
     * @group TableService
    */
    public function testSet()
    {
        $mockTableService = $this->getMockSingleClass(
            'Gear\Table\TableService\TableService'
        );
        $this->setTableService($mockTableService);
        $this->assertEquals($mockTableService, $this->getTableService());
    }
}
