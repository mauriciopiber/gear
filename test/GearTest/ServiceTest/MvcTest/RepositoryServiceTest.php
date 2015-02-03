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
        $this->mockRequest(
            array(

                'repository' => true,
                'service' => true,
                'factory' => true,
                'entity' => true,
                'gear' => true
            )
        );

        $this->moduleService->setRequest($this->request);
        $this->moduleService->createLight();

        $this->dbService = $this->getServiceLocator()->get('dbService');

        $this->mockRequest(
            array(
                'table' => 'Piber',
                'columns' => ''
            )
        );

        $this->dbService->setRequest($this->request);


        $mockMetadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getTable'));
        $mockMetadata->expects($this->any())
        ->method('getTable')
        ->willReturn($this->mockTable());
        $this->dbService->setMetadata($mockMetadata);

        $this->mockAllServices($this->dbService);

        $this->fixSchema();
        $this->dbService->setGearSchema($this->gearService);
        $this->dbService->create();

        $this->unloadModule();
    }


}
