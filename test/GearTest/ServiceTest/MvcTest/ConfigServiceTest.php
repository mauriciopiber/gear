<?php
namespace GearTest\ServiceTest\MvcServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;

/**
 * @group column
 * @author piber
 *
 */
class ConfigServiceTest extends AbstractServiceTest
{
    /**
     * @group ConfigTest
     */
    public function testServiceManagerMerge()
    {
        $this->mockRequest(array('gear' => true, 'service' => true));
        $this->moduleService->setRequest($this->request);
        $this->moduleService->setConfig($this->config);
        $jsonService = $this->getServiceLocator()->get('jsonService');
        $jsonService->setConfig($this->config);
        $jsonService->setModule($this->structure);
        $this->moduleService->setJsonService($jsonService);
        $this->createMockModule();



        $this->service = $this->bootstrap->getServiceLocator()->get('configService');


        $src = new \Gear\ValueObject\Src(array(
        	'name' => 'SingleService',
            'type' => 'Service'
        ));

        $this->fixSchema();
        $this->service->setGearSchema($this->gearService);
        $this->service->setConfig($this->config);


        $this->service->getGearSchema()->insertSrc($src->export());

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);


        $this->assertEquals('SingleService', $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***['name'***REMOVED***);
        $this->assertEquals('Service', $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***['type'***REMOVED***);


        $this->service->mergeServiceManagerConfig();


        $servicemanager = $this->service->getServiceManager();

        $invokables = $servicemanager['invokables'***REMOVED***;


        $this->assertArrayHasKey('TestModule\Service\SingleService', $invokables);
        $this->assertContains('TestModule\Service\SingleService', $invokables);
        $this->assertEquals('TestModule\Service\SingleService', $invokables['TestModule\Service\SingleService'***REMOVED***);


        //adicionar src a algum json

        //rodar config::servicemanagermerge


        //verificar array do service manager pra identificar chaves criadas.


        $this->unloadModule();

    }

    /**
     * @group ConfigTest
     */
    public function testServiceManagerCreationBySingleSrc()
    {

    }


    /**
     * @group ConfigTest
     */
    public function testServiceManagerCreationByDb()
    {

    }
}
