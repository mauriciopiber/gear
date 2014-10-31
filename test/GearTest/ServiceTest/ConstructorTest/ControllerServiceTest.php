<?php   /**
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

class ControllerServiceTest extends AbstractGearTest
{
    public function setUp()
    {
        parent::setUp();

        $this->getServiceLocator()->setAllowOverride(true);
        $this->getServiceLocator()->setService('moduleConfig', $this->getMockConfig());

        $this->service = $this->getServiceLocator()->get('ControllerConstructor');
        $this->service->setConfig($this->getMockConfig());
        $this->service->setTemplateService($this->getMockTemplate());
        $this->service->getJsonService()->setConfig($this->getMockConfig());
    }


    public function createControllerData()
    {
        return array(
        	array('Carros', '%s\Controller\Carros'),
            array('Latas', '%s\Controller\Latas'),
            array('Dinheiro', '%s\Controller\Dinheiro'),
            array('Bmw', '%s\Controller\Bmw'),
        );
    }

     * @dataProvider createControllerData
     * @param unknown $nome
     * @param unknown $object

    public function testCreateController($nome, $object)
    {

        $data = array(
        	'name' => $nome,
            'object' => $object
        );


        //aqui evento é disparado.

        $controllerCreated = $this->service->create($data);

        $this->assertTrue($controllerCreated);
    }

}*/