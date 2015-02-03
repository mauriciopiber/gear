<?php
namespace GearTest\ServiceTest\MvcServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;

/**
 * @group column
 * @author piber
 *
 */
class RepositoryServiceTest extends AbstractServiceTest
{
    public function setUp()
    {
        parent::setUp();

        $service = $this->bootstrap->getServiceLocator()->get('repositoryService');
        $service->setModule($this->structure);
        $service->setConfig($this->config);
        $service->setTemplateService($this->templateService);

        $this->mockRequest(array('repository' => true, 'unit' => true));

        $this->createMockModule();


        $mockTest = $this->getMockSingleClass(
            'Gear\Service\Test\RepositoryTestService',
            array(
                'createAbstract', 'createFromSrc', 'introspectFromTable'
            )
        );

        $mockTest->expects($this->any())->method('createAbstract')->willReturn(true);
        $mockTest->expects($this->any())->method('createFromSrc')->willReturn(true);
        $mockTest->expects($this->any())->method('introspectFromTable')->willReturn(true);

        $service->setRepositoryTestService($mockTest);

        $this->service = $service;

    }

    public function testCallService()
    {
        $service = $this->bootstrap->getServiceLocator()->get('repositoryService');
        $this->assertInstanceOf('Gear\Service\Mvc\RepositoryService', $service);
    }

    /**
     * @group Repository
     */
    public function testCreateAbstractRepository()
    {
        $this->service->getAbstract();

        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\AbstractRepository', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\AbstractRepository', $abstractClass->getName());

        $this->unloadModule();
    }


    /**
     * @group Repository
     */

    public function testCreateRepositoryWithSrcAbstractTrue()
    {
        $result = $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyNewClass', 'type' => 'Repository', 'abstract' => true)));

        $this->assertNotFalse($result);
        $this->assertNotNull($result);
        $this->assertFileExists($result);

        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewClass', $this->config->getModule()));

        $this->assertEquals('TestModule\Repository\MyNewClass', $abstractClass->getName());

        $this->unloadModule();
    }

    /**
     * @group RepositoryTest2
     * @group Repository
     */

    public function testCreateRepositoryWithSrcDefault()
    {
        $result = $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyNewClass', 'type' => 'Repository')));

        $this->assertNotFalse($result);
        $this->assertNotNull($result);
        $this->assertFileExists($result);

        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\AbstractRepository', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\AbstractRepository', $abstractClass->getName());

        $repositoryClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewClass', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\MyNewClass', $repositoryClass->getName());

        $this->unloadModule();
    }

    /**
     * @group Repository
     */

    public function testCreateRepositoryWithCustomAbstractDefault()
    {

        $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyNewAbstract', 'type' => 'Repository', 'abstract' => true)));

        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewAbstract', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\MyNewAbstract', $abstractClass->getName());


        $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyNewClass', 'type' => 'Repository', 'extends' => 'MyNewAbstract')));


        $repositoryClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewClass', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\MyNewClass', $repositoryClass->getName());

        $this->unloadModule();
    }


    /**
     * @group Repository
     */
    public function testCreateRepositoryWithSrcDb()
    {

        $this->unloadModule();
    }

    /**
     * @group Repository
     */
    public function testCreateRepositoryWithDb()
    {

        $mockMetadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getTable', 'getColumns'));
        $mockMetadata->expects($this->any())
        ->method('getTable')
        ->willReturn($this->mockTable());

        $mockMetadata->expects($this->any())
        ->method('getColumns')
        ->willReturn($this->getMockColumns());

        $this->mockRequest(
            array(

                'repository' => true,
                'service' => true,
                'factory' => true,
                'entity' => true,
                'unit' => true,
                'gear' => true
            )
        );

        $this->moduleService->getTestService()->setConfig($this->config);

        $this->moduleService->setRequest($this->request);
        $this->moduleService->setConfig($this->config);
        $this->moduleService->createLight();

        $this->dbService = $this->getServiceLocator()->get('dbService');

        $this->mockRequest(
            array('table' => 'Piber', 'tableObject' => $this->mockTable())
        );

        $this->dbService->setRequest($this->request);

        $this->mockAllServices($this->dbService, array('setRepositoryService'));
        $this->fixSchema();
        $this->dbService->setGearSchema($this->gearService);
        $this->dbService->setMetadata($mockMetadata);


        $mockRepository = $this->getMockSingleClass('Gear\Service\Mvc\RepositoryService', array('getInstance', 'getMetadata', 'getMappingService'));
        $dbMock = new \Gear\ValueObject\Db(array('table' => 'Piber', 'tableObject' => $this->mockTable()));

        $mockRepository->expects($this->any())->method('getInstance')->willReturn($dbMock);

        $mappingService = $this->bootstrap->getServiceLocator()->get('RepositoryService\MappingService');
        $mappingService->setInstance($dbMock);

        $mockRepository->expects($this->any())->method('getMappingService')->willReturn($mappingService);


        $mockRepository->expects($this->any())->method('getMetadata')->willReturn($mockMetadata);
        $mockRepository->setServiceLocator($this->bootstrap->getServiceLocator());
        $this->dbService->setRepositoryService($mockRepository);


        $repositoryTest = $this->bootstrap->getServiceLocator()->get('repositoryTestService');
        $repositoryTest->setMetadata($mockMetadata);
        $this->dbService->getRepositoryService()->setRepositoryTestService($repositoryTest);

        $this->dbService->create();

        $repositoryClass = new \ReflectionClass('\TestModule\Repository\AbstractRepository');
        $this->assertEquals('TestModule\Repository\AbstractRepository', $repositoryClass->getName());

        $repositoryClass = new \ReflectionClass('\TestModule\Repository\PiberRepository');
        $this->assertEquals('TestModule\Repository\PiberRepository', $repositoryClass->getName());


        $repositoryClass = new \ReflectionClass('\TestModuleTest\AbstractTest');
        $this->assertEquals('TestModuleTest\AbstractTest', $repositoryClass->getName());

        $repositoryClass = new \ReflectionClass('\TestModuleTest\RepositoryTest\AbstractRepositoryTest');
        $this->assertEquals('TestModuleTest\RepositoryTest\AbstractRepositoryTest', $repositoryClass->getName());

        $repositoryClass = new \ReflectionClass('\TestModuleTest\RepositoryTest\PiberRepositoryTest');
        $this->assertEquals('TestModuleTest\RepositoryTest\PiberRepositoryTest', $repositoryClass->getName());

        $this->unloadModule();
    }


}
