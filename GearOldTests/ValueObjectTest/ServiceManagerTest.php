<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ServiceManagerTest extends AbstractGearTest
{
    public function serviceManager()
    {
        return array(
        	array('factories', '%s\Controller\IndexControllerFactory'),
            array('invokables', '%s\Controller\MegaController'),
        );
    }

    public function serviceManagerFilter()
    {
        return array(
        	array('factorie', 'IndexController'),
            array('factories', 'IndexController'),
            array('ashdfuasdf', 'TwoController'),
            array('invokables', 'ThreeController')
        );
    }

    /**
     * @dataProvider serviceManagerFilter
     */
    public function testCreateServiceWithFilter($service, $object)
    {
        $data = array(
            'service' => $service,
            'object' => $object
        );

        try {

            $serviceValue = new \Gear\ValueObject\ServiceManager($data);
            $this->assertInstanceOf('Gear\ValueObject\ServiceManager', $serviceValue);
        } catch (\Exception $exception) {
            $this->setExpectedException('InvalidArgumentException');
            throw $exception;
        }

    }

    /**
     * @dataProvider serviceManager
     * @param unknown $service
     * @param unknown $object
     */

    public function testCreateServiceFromArrayWithoutDependes($service, $object)
    {
        $data = array(
            'service' => $service,
            'object' => $object
        );

        $serviceValue = new \Gear\ValueObject\ServiceManager($data);


        $this->assertEquals($serviceValue->getService(), $service);
        $this->assertEquals($serviceValue->getObject(), $object);


        $exchangeArray = $serviceValue->extract();

        $this->assertEquals($exchangeArray['service'***REMOVED***, $service);
        $this->assertEquals($exchangeArray['object'***REMOVED***, $object);

    }
}