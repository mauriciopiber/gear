<?php
namespace GearTest\Util\Vector;

use GearBaseTest\AbstractTestCase;
use Gear\Util\Vector\ArrayServiceTrait;

/**
 * @group Service
 */
class ArrayServiceTest extends AbstractTestCase
{
    use ArrayServiceTrait;

    /**
     * @group Gear
     * @group ArrayService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getArrayService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ArrayService
    */
    public function testGet()
    {
        $arrayService = $this->getArrayService();
        $this->assertInstanceOf('Gear\Util\Vector\ArrayService', $arrayService);
    }

    /**
     * @group Gear
     * @group ArrayService
    */
    public function testSet()
    {
        $mockArrayService = $this->getMockSingleClass(
            'Gear\Util\Vector\ArrayService'
        );
        $this->setArrayService($mockArrayService);
        $this->assertEquals($mockArrayService, $this->getArrayService());
    }


    public function testReplaceLine()
    {

    }


    public function testMove()
    {

    }

}
