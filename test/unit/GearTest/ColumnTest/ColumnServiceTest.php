<?php
namespace GearTest\ColumnTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\ColumnServiceTrait;

/**
 * @group Service
 * @group module
 * @group module-column
 * @group module-column-service
 */
class ColumnServiceTest extends AbstractTestCase
{
    use ColumnServiceTrait;

    /**
     * @group Gear
     * @group ColumnService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getColumnService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ColumnService
    */
    public function testGet()
    {
        $columnService = $this->getColumnService();
        $this->assertInstanceOf('Gear\Column\ColumnService', $columnService);
    }

    /**
     * @group Gear
     * @group ColumnService
    */
    public function testSet()
    {
        $mockColumnService = $this->getMockSingleClass(
            'Gear\Column\ColumnService'
        );
        $this->setColumnService($mockColumnService);
        $this->assertEquals($mockColumnService, $this->getColumnService());
    }


    public function testFactoryColumns()
    {

    }
}
