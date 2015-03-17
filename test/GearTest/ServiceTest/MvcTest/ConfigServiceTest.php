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

    public function setUp()
    {
        parent::setUp();

        $this->mockRequest(array('gear' => true, 'service' => true));
        $this->moduleService->setRequest($this->request);
        $this->moduleService->setConfig($this->config);
        $jsonService = $this->getServiceLocator()->get('jsonService');
        $jsonService->setConfig($this->config);
        $jsonService->setModule($this->structure);
        $this->moduleService->setJsonService($jsonService);
        $this->createMockModule();
        $this->service = $this->bootstrap->getServiceLocator()->get('configService');
        $this->fixSchema();
        $this->service->setGearSchema($this->gearService);
        $this->service->setConfig($this->config);
    }
    /**
     * @group ConfigTest
     */
    public function testServiceManagerMerge()
    {
        $src = new \Gear\ValueObject\Src(array(
        	'name' => 'SingleService',
            'type' => 'Service'
        ));

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

        $this->unloadModule();
    }

    /**
     * @group ConfigTest
     */
    public function testMergeServiceManagerWithoutSuffix()
    {
        $src = new \Gear\ValueObject\Src(array(
            'name' => 'Single',
            'type' => 'Service'
        ));

        $this->service->getGearSchema()->insertSrc($src->export());

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);

        $this->assertEquals('Single', $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***['name'***REMOVED***);
        $this->assertEquals('Service', $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***['type'***REMOVED***);

        $this->service->mergeServiceManagerConfig();

        $servicemanager = $this->service->getServiceManager();

        $invokables = $servicemanager['invokables'***REMOVED***;

        $this->assertArrayHasKey('TestModule\Service\Single', $invokables);
        $this->assertContains('TestModule\Service\Single', $invokables);
        $this->assertEquals('TestModule\Service\Single', $invokables['TestModule\Service\Single'***REMOVED***);

        $this->unloadModule();
    }

    /**
     * @group ConfigTest
     */
    public function testMergeServiceManagerEntityWithoutSuffix()
    {
        $src = new \Gear\ValueObject\Src(array(
            'name' => 'Single',
            'type' => 'Entity'
        ));

        $this->service->getGearSchema()->insertSrc($src->export());

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);

        $this->assertEquals('Single', $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***['name'***REMOVED***);
        $this->assertEquals('Entity', $json[$this->config->getModule()***REMOVED***['src'***REMOVED***[0***REMOVED***['type'***REMOVED***);

        $this->service->mergeServiceManagerConfig();

        $servicemanager = $this->service->getServiceManager();

        $invokables = $servicemanager['invokables'***REMOVED***;

        $this->assertArrayHasKey('TestModule\Entity\Single', $invokables);
        $this->assertContains('TestModule\Entity\Single', $invokables);
        $this->assertEquals('TestModule\Entity\Single', $invokables['TestModule\Entity\Single'***REMOVED***);

        $this->unloadModule();
    }

    /**
     * @group ConfigTest
     */
    public function testServiceManagerCreationByDb()
    {

        $db = new \Gear\ValueObject\Db(array('table' => 'Piber'));


        $this->service->getGearSchema()->insertDb($db);

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);

        $this->assertEquals('Piber', $json[$this->config->getModule()***REMOVED***['db'***REMOVED***[0***REMOVED***['table'***REMOVED***);

        $this->service->mergeServiceManagerConfig();

        $servicemanager = $this->service->getServiceManager();


        $factories  = $servicemanager['factories'***REMOVED***;
        $invokables = $servicemanager['invokables'***REMOVED***;

        $this->assertCount(2, $factories);

        $this->assertArrayHasKey('TestModule\Factory\PiberFactory', $factories);
        $this->assertContains('TestModule\Factory\PiberFactory', $factories);
        $this->assertEquals('TestModule\Factory\PiberFactory', $factories['TestModule\Factory\PiberFactory'***REMOVED***);

        $this->assertArrayHasKey('TestModule\Form\Search\PiberSearchForm', $factories);
        $this->assertContains('TestModule\Factory\PiberSearchFactory', $factories);
        $this->assertEquals('TestModule\Factory\PiberSearchFactory', $factories['TestModule\Form\Search\PiberSearchForm'***REMOVED***);

        $this->assertCount(7, $invokables);

        $this->assertArrayHasKey('TestModule\Entity\Piber', $invokables);
        $this->assertContains('TestModule\Entity\Piber', $invokables);
        $this->assertEquals('TestModule\Entity\Piber', $invokables['TestModule\Entity\Piber'***REMOVED***);

        $this->assertArrayHasKey('TestModule\Repository\PiberRepository', $invokables);
        $this->assertContains('TestModule\Repository\PiberRepository', $invokables);
        $this->assertEquals('TestModule\Repository\PiberRepository', $invokables['TestModule\Repository\PiberRepository'***REMOVED***);

        $this->assertArrayHasKey('TestModule\Service\PiberService', $invokables);
        $this->assertContains('TestModule\Service\PiberService', $invokables);
        $this->assertEquals('TestModule\Service\PiberService', $invokables['TestModule\Service\PiberService'***REMOVED***);

        $this->assertArrayHasKey('TestModule\Filter\PiberFilter', $invokables);
        $this->assertContains('TestModule\Filter\PiberFilter', $invokables);
        $this->assertEquals('TestModule\Filter\PiberFilter', $invokables['TestModule\Filter\PiberFilter'***REMOVED***);

        $this->assertArrayHasKey('TestModule\Form\PiberForm', $invokables);
        $this->assertContains('TestModule\Form\PiberForm', $invokables);
        $this->assertEquals('TestModule\Form\PiberForm', $invokables['TestModule\Form\PiberForm'***REMOVED***);

        $this->assertArrayHasKey('TestModule\Fixture\PiberFixture', $invokables);
        $this->assertContains('TestModule\Fixture\PiberFixture', $invokables);
        $this->assertEquals('TestModule\Fixture\PiberFixture', $invokables['TestModule\Fixture\PiberFixture'***REMOVED***);

        $this->assertArrayHasKey('TestModule\SearchForm\PiberSearchForm', $invokables);
        $this->assertContains('TestModule\SearchForm\PiberSearchForm', $invokables);
        $this->assertEquals('TestModule\SearchForm\PiberSearchForm', $invokables['TestModule\SearchForm\PiberSearchForm'***REMOVED***);

        $this->unloadModule();
    }

    /**
     * @group UploadImage
     */
    public function testConfigUploadImage()
    {
        $this->assertTrue(true);
    }
}
