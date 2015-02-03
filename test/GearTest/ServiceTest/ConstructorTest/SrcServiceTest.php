<?php
namespace GearTest\ServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;

class SrcServiceTest extends AbstractServiceTest
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getServiceLocator()->get('srcService');

        $this->mockRequest(array('service' => true, 'repository' => true, 'unit' => true, 'gear' => true));
        $this->moduleService->setModule($this->structure);

        $jsonService = $this->getServiceLocator()->get('jsonService');

        $jsonService->setConfig($this->config);
        $jsonService->setModule($this->structure);

        $this->moduleService->setJsonService($jsonService);

        $this->jsonService = $jsonService;



        $this->createMockModule();

    }


    public function tearDown()
    {

        unset($this->service);
        parent::tearDown();
    }


    /**
     * @group single
     */
    public function testCreateSrcRepositoryCustomName()
    {
        $this->mockRequest(
            array(
                'name' => 'PiberRepository',
                'type' => 'Repository'
            )
        );

        $this->service->setRequest($this->request);
        $this->service->setModule($this->structure);
        $this->service->setJsonService($this->jsonService);

        $gearService = $this->getServiceLocator()->get('Gear\Schema');

        $gearService->setName('schema/module.json');
        $gearService->setConfig($this->config);

        $this->service->setGearSchema($gearService);

        $this->service->create();

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);

        $this->assertArrayHasKey('src', $json[$this->config->getModule()***REMOVED***);

        $src = $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***;

        $this->assertArrayHasKey('name', $src);
        $this->assertArrayHasKey('type', $src);

        $this->assertEquals('PiberRepository', $src['name'***REMOVED***);
        $this->assertEquals('Repository', $src['type'***REMOVED***);

        $this->unloadModule();
    }

    public function testCreateRepositoryWithoutSuffix()
    {
        $this->mockRequest(
            array(
                'name' => 'Piber',
                'type' => 'Repository'
            )
        );

        $this->service->setRequest($this->request);
        $this->service->setModule($this->structure);
        $this->service->setJsonService($this->jsonService);

        $gearService = $this->getServiceLocator()->get('Gear\Schema');

        $gearService->setName('schema/module.json');
        $gearService->setConfig($this->config);

        $this->service->setGearSchema($gearService);

        $this->service->create();

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);

        $this->assertArrayHasKey('src', $json[$this->config->getModule()***REMOVED***);

        $src = $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***;

        $this->assertArrayHasKey('name', $src);
        $this->assertArrayHasKey('type', $src);

        $this->assertEquals('Piber', $src['name'***REMOVED***);
        $this->assertEquals('Repository', $src['type'***REMOVED***);

        $this->unloadModule();
    }

    public function testCreateService()
    {
        $this->mockRequest(
            array(
                'name' => 'PiberService',
                'type' => 'Service'
            )
        );

        $this->service->setRequest($this->request);
        $this->service->setModule($this->structure);
        $this->service->setJsonService($this->jsonService);

        $gearService = $this->getServiceLocator()->get('Gear\Schema');

        $gearService->setName('schema/module.json');
        $gearService->setConfig($this->config);

        $this->service->setGearSchema($gearService);

        $this->service->create();

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);

        $this->assertArrayHasKey('src', $json[$this->config->getModule()***REMOVED***);

        $src = $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***;

        $this->assertArrayHasKey('name', $src);
        $this->assertArrayHasKey('type', $src);

        $this->assertEquals('PiberService', $src['name'***REMOVED***);
        $this->assertEquals('Service', $src['type'***REMOVED***);

        $this->unloadModule();
    }

}