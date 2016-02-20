<?php
namespace GearTest\Util\Vector;

use GearBaseTest\AbstractTestCase;
use Gear\Util\Vector\ArrayServiceTrait;

/**
 * @group Array
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

        $arrayService = new \Gear\Util\Vector\ArrayService();

        $oldArray = [
            'a', 'b', 'c', 'd', 'e', 'f'
        ***REMOVED***;

        $replace = [
            'aa', 'bb', 'cc', 'dd'
        ***REMOVED***;

        $expected = [
            'a', 'b', 'c', 'aa', 'bb', 'cc', 'dd', 'e', 'f'
        ***REMOVED***;


        $this->assertEquals($expected, $arrayService->replaceLine($oldArray, 3, $replace));
    }


    public function testMove()
    {
        $arrayService = new \Gear\Util\Vector\ArrayService();

        $oldArray = [
            'a', 'b', 'c', 'd', 'e', 'f'
        ***REMOVED***;

        $replace = [
            'aa', 'bb', 'cc', 'dd'
        ***REMOVED***;

        $expected = [
            'a', 'b', 'c', 'aa', 'bb', 'cc', 'dd','d', 'e', 'f'
        ***REMOVED***;

        $this->assertEquals($expected, $arrayService->moveArray($oldArray, 3, $replace));
    }

}
