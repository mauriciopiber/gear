<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ControllerTest extends AbstractGearTest
{

    public function createController($controllerName, $serviceName, $object)
    {
        $controllerParams = array(
            'name' => $controllerName,
            'service' => $serviceName,
            'object' => $object
        );
        $controller = new \Gear\ValueObject\Controller($controllerParams);
        return $controller;
    }


    public function controllerProvider()
    {
        return array(
        	array('MeuController', 'invokables', '%s\Controller\Meu'),
            array('NovoController', 'invokables', '%s\Controller\Novo'),
            array('PiberController', 'invokables', '%s\Controller\Piber'),
        );
    }

    /**
     * @dataProvider controllerProvider
     */
    public function testCreateControllerFromArrayUsingHydrate($controllerName, $serviceName, $object)
    {
        $controller = $this->createController($controllerName, $serviceName, $object);

        $this->assertEquals($controller->getName(), $controllerName);

        $service = $controller->getService();

        $this->assertInstanceOf('Gear\ValueObject\ServiceManager', $service);
        $this->assertEquals($service->getObject(), $object);
        $this->assertEquals($service->getService(), $serviceName);
    }

    /**
     * @dataProvider controllerProvider
     */
    public function testExtractObject($controllerName, $serviceName, $object)
    {

        $controller = $this->createController($controllerName, $serviceName, $object);

        $extract = $controller->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['name'***REMOVED***, $controllerName);


        $service = $extract['service'***REMOVED***;
        $this->assertInstanceOf('Gear\ValueObject\ServiceManager', $service);


        $exchangeService = $service->extract();

        $this->assertEquals($exchangeService['service'***REMOVED***, $serviceName);
        $this->assertEquals($exchangeService['object'***REMOVED***, $object);
    }

    /**
     * @dataProvider controllerProvider
     */
    public function testExportObject($controllerName, $serviceName, $object)
    {
        $controller = $this->createController($controllerName, $serviceName, $object);

        $dataExport = $controller->export();

        $this->assertEquals($dataExport['name'***REMOVED***, $controllerName);
        $this->assertEquals($dataExport['object'***REMOVED***, $object);
        $this->assertEquals($dataExport['service'***REMOVED***, $serviceName);
    }
}
