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