<?php
namespace GearTest\TableTest;

use GearBaseTest\AbstractTestCase;
use Gear\Table\MetadataServiceTrait;

/**
 * @group Service
 */
class MetadataServiceTest extends AbstractTestCase
{
    use MetadataServiceTrait;

    /**
     * @group Gear
     * @group MetadataService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getMetadataService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group MetadataService
    */
    public function testGet()
    {
        $metadataService = $this->getMetadataService();
        $this->assertInstanceOf('Gear\Table\MetadataService', $metadataService);
    }

    /**
     * @group Gear
     * @group MetadataService
    */
    public function testSet()
    {
        $mockMetadataService = $this->getMockSingleClass(
            'Gear\Table\MetadataService'
        );
        $this->setMetadataService($mockMetadataService);
        $this->assertEquals($mockMetadataService, $this->getMetadataService());
    }
}
