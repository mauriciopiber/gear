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

        $this->mockRequest(array('repository' => true, 'unit' => true, 'gear' => true));

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
     * @number 0
     * @group RepositoryEnd
     */
    public function testCreateRepositoryWithDb()
    {
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

        $this->mockModule();

        $this->mockDbService();

        $this->dbService->create();


        $this->reflectionAbstractRepository();
        $this->reflectionPiberRepository();
        $this->reflectionAbstractTestCase();
        $this->reflectionAbstractRepositoryTest();
        $this->reflectionPiberRepositoryTest();

        $this->unloadModule();
    }

    /**
     * @number 1
     * @group RepositoryEnd
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

        $this->assertTrue($abstractClass->isAbstract());

        $repositoryClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewClass', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\MyNewClass', $repositoryClass->getName());
        $this->assertFalse($repositoryClass->isAbstract());

        $this->assertFalse($repositoryClass->getParentClass());
        //$this->assertEquals($repositoryClass->getParentClass()->getName(), 'TestModule\Repository\AbstractRepository');

        $this->unloadModule();
    }


    /**
     * @number 2
     * @group RepositoryEnd
     */

    public function testCreateRepositoryWithSrcAbstractTrue()
    {
        $result = $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyClassAbstract', 'type' => 'Repository', 'abstract' => true)));

        $this->assertNotFalse($result);
        $this->assertNotNull($result);
        $this->assertFileExists($result);

        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\MyClassAbstract', $this->config->getModule()));
        $this->assertTrue($abstractClass->isAbstract());

        $this->assertEquals('TestModule\Repository\MyClassAbstract', $abstractClass->getName());

        $this->unloadModule();
    }

    /**
     * @number 3
     * @group RepositoryEnd
     */

    public function testCreateRepositoryWithSrcADependency()
    {
        $result = $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyClassDependency', 'type' => 'Repository', 'dependency' => 'Repository\CustomDependency')));

        $this->assertNotFalse($result);
        $this->assertNotNull($result);
        $this->assertFileExists($result);


        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\MyClassDependency', $this->config->getModule()));

        $this->assertEquals('TestModule\Repository\MyClassDependency', $abstractClass->getName());


        $this->assertTrue($abstractClass->hasMethod('setCustomDependencyRepository'));
        $this->assertTrue($abstractClass->hasMethod('getCustomDependencyRepository'));

        $this->unloadModule();
    }

    /**
     * @number 4
     * @group RepositoryEnd4
     */

    public function testCreateRepositoryWithSrcDb()
    {
        $mockMetadata = $this->mockMetadata();

        $this->service->setMetadata($mockMetadata);

        $db = new \Gear\ValueObject\Db(array('table' => 'Piber', 'tableObject' => $this->mockTable()));

        $this->service->setInstance($db);

        $this->fixSchema();
        $mappingService = $this->bootstrap->getServiceLocator()->get('RepositoryService\MappingService');
        $mappingService->setInstance($db);
        $mappingService->setGearSchema($this->gearService);

        $this->service->setMappingService($mappingService);


        $mockRepositoryTestService = $this->getMockSingleClass('Gear\Service\Test\RepositoryTestService', array('introspectFromTable', 'createAbstract'));
        $mockRepositoryTestService->expects($this->any())
        ->method('introspectFromTable')
        ->willReturn(true);

        $mockRepositoryTestService->expects($this->any())
        ->method('createAbstract')
        ->willReturn(true);

        $this->service->setServiceLocator($this->bootstrap->getServiceLocator());
        $this->service->setRepositoryTestService($mockRepositoryTestService);

        $result = $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyNewDb', 'type' => 'Repository', 'db' => $db)));

        $this->assertNotFalse($result);
        $this->assertNotNull($result);
        $this->assertFileExists($result);


        $abstractFile = sprintf(
            '%s/%s/src/%s/Repository/AbstractRepository.php',
            \Gear\Service\ProjectService::getProjectFolder(),
            $this->config->getModule(),
            $this->config->getModule()
        );

        //arquivo!
        $this->assertFileExists($abstractFile);

        /**
           @TODO logo aqui devemos arrumar o node fix 1.
         */
        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewDb', $this->config->getModule()));

        $this->assertEquals('TestModule\Repository\MyNewDb', $abstractClass->getName());

        $this->unloadModule();
    }

    /**
     * @number 5
     * @group RepositoryEnd2
     */
    public function testCreateRepositoryDbWithDbGearImage()
    {
        $mockMetadata = $this->mockMetadata();

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

        $this->mockModule();

        $this->mockDbService();

        $this->dbService->create();


        $repositoryClass = new \ReflectionClass('\TestModule\Repository\PiberRepository');
        $this->assertEquals('TestModule\Repository\PiberRepository', $repositoryClass->getName());
        $this->assertEquals($repositoryClass->getParentClass()->getName(), 'TestModule\Repository\AbstractRepository');


        $this->reflectionAbstractRepository();
        $this->reflectionAbstractTestCase();
        $this->reflectionAbstractRepositoryTest();
        $this->reflectionPiberRepositoryTest();
/*
        $this->assertTrue($repositoryClass->hasMethod('getUploadSize'));
        $this->assertTrue($repositoryClass->hasMethod('getUploadDir'));
        $this->assertTrue($repositoryClass->hasMethod('getRefDir'));
        $this->assertTrue($repositoryClass->hasMethod('getImagemService'));
      */

        $this->unloadModule();
    }




    /**
     * @number 6
     * @group Repository


    public function testCreateRepositoryWithCustomExtends()
    {
        $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyNewAbstract', 'type' => 'Repository', 'abstract' => true)));

        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewAbstract', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\MyNewAbstract', $abstractClass->getName());


        $this->service->create(new \Gear\ValueObject\Src(array('name' => 'MyNewClass', 'type' => 'Repository', 'extends' => 'MyNewAbstract')));

        $repositoryClass = new \ReflectionClass(sprintf('\%s\Repository\MyNewClass', $this->config->getModule()));
        $this->assertEquals('TestModule\Repository\MyNewClass', $repositoryClass->getName());

        //$this->assertEquals($repositoryClass->getParentClass()->getName(), 'TestModule\Repository\MyNewAbstract');

        $this->unloadModule();
    }*/


    public function mockMetadata()
    {
        $mockMetadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getTable', 'getColumns'));
        $mockMetadata->expects($this->any())
        ->method('getTable')
        ->willReturn($this->mockTable());

        $mockMetadata->expects($this->any())
        ->method('getColumns')
        ->willReturn($this->getMockColumns());

        return $mockMetadata;
    }

    public function mockModule()
    {
        $this->moduleService->getTestService()->setConfig($this->config);
        $this->moduleService->setRequest($this->request);
        $this->moduleService->setConfig($this->config);
        $this->moduleService->createLight();
    }

    public function mockDbService()
    {
        $this->dbService = $this->getServiceLocator()->get('dbService');

        $realDb =  array('table' => 'Piber', 'tableObject' => $this->mockTable(), 'columns' => array('varchar_piber' => 'upload-image'));

        $this->mockRequest(
            $realDb
        );

        $this->dbService->setRequest($this->request);

        $this->mockAllServices($this->dbService, array('setRepositoryService'));
        $this->fixSchema();
        $this->dbService->setGearSchema($this->gearService);
        $this->dbService->setMetadata($this->mockMetadata());


        $mockRepository = $this->getMockSingleClass('Gear\Service\Mvc\RepositoryService', array('getInstance', 'getMetadata', 'getMappingService'));
        $dbMock = new \Gear\ValueObject\Db($realDb);

        $mockRepository->expects($this->any())->method('getInstance')->willReturn($dbMock);

        $mappingService = $this->bootstrap->getServiceLocator()->get('RepositoryService\MappingService');
        $mappingService->setInstance($dbMock);

        $mockRepository->expects($this->any())->method('getMappingService')->willReturn($mappingService);


        $mockRepository->expects($this->any())->method('getMetadata')->willReturn($this->mockMetadata());
        $mockRepository->setServiceLocator($this->bootstrap->getServiceLocator());
        $this->dbService->setRepositoryService($mockRepository);


        $repositoryTest = $this->bootstrap->getServiceLocator()->get('repositoryTestService');
        $repositoryTest->setMetadata($this->mockMetadata());
        $this->dbService->getRepositoryService()->setRepositoryTestService($repositoryTest);
    }





    public function reflectionAbstractRepository()
    {
        $repositoryClass = new \ReflectionClass('\TestModule\Repository\AbstractRepository');
        $this->assertEquals('TestModule\Repository\AbstractRepository', $repositoryClass->getName());

        $this->assertTrue($repositoryClass->isAbstract());

        $this->assertTrue($repositoryClass->hasMethod('delete'));
        $this->assertTrue($repositoryClass->hasMethod('extract'));
        $this->assertTrue($repositoryClass->hasMethod('factory'));
        $this->assertTrue($repositoryClass->hasMethod('getAliase'));
        $this->assertTrue($repositoryClass->hasMethod('getBetweenType'));
        $this->assertTrue($repositoryClass->hasMethod('getDoctrineHydrator'));
        $this->assertTrue($repositoryClass->hasMethod('getEntityManager'));
        $this->assertTrue($repositoryClass->hasMethod('getFilter'));
        $this->assertTrue($repositoryClass->hasMethod('getMapReferences'));
        $this->assertTrue($repositoryClass->hasMethod('getOrder'));
        $this->assertTrue($repositoryClass->hasMethod('getOrderBy'));
        $this->assertTrue($repositoryClass->hasMethod('getOrderByMap'));
        $this->assertTrue($repositoryClass->hasMethod('getQuery'));
        $this->assertTrue($repositoryClass->hasMethod('getRepository'));
        $this->assertTrue($repositoryClass->hasMethod('getRepositoryName'));
        $this->assertTrue($repositoryClass->hasMethod('getGearAdminHydrator'));
        $this->assertTrue($repositoryClass->hasMethod('getSelect'));
        $this->assertTrue($repositoryClass->hasMethod('getServiceLocator'));
        $this->assertTrue($repositoryClass->hasMethod('getUser'));
        $this->assertTrue($repositoryClass->hasMethod('getWhereBetweenByType'));
        $this->assertTrue($repositoryClass->hasMethod('hasLikeFilter'));
        $this->assertTrue($repositoryClass->hasMethod('hydrate'));
        $this->assertTrue($repositoryClass->hasMethod('persist'));
        $this->assertTrue($repositoryClass->hasMethod('selectAll'));
        $this->assertTrue($repositoryClass->hasMethod('selectById'));
        $this->assertTrue($repositoryClass->hasMethod('selectOneBy'));
        $this->assertTrue($repositoryClass->hasMethod('setEntityManager'));
        $this->assertTrue($repositoryClass->hasMethod('setFilter'));
        $this->assertTrue($repositoryClass->hasMethod('setOrder'));
        $this->assertTrue($repositoryClass->hasMethod('setOrderBy'));
        $this->assertTrue($repositoryClass->hasMethod('setQuery'));
        $this->assertTrue($repositoryClass->hasMethod('setServiceLocator'));
        $this->assertTrue($repositoryClass->hasMethod('setUpBetween'));
        $this->assertTrue($repositoryClass->hasMethod('setUpJoin'));
        $this->assertTrue($repositoryClass->hasMethod('setUpLike'));
        $this->assertTrue($repositoryClass->hasMethod('setUpOrder'));
        $this->assertTrue($repositoryClass->hasMethod('setUpWhere'));

        return $repositoryClass;
    }

    public function reflectionPiberRepository()
    {
        $repositoryClass = new \ReflectionClass('\TestModule\Repository\PiberRepository');
        $this->assertEquals('TestModule\Repository\PiberRepository', $repositoryClass->getName());
        $this->assertEquals($repositoryClass->getParentClass()->getName(), 'TestModule\Repository\AbstractRepository');

        $this->assertFalse($repositoryClass->isAbstract());

        $this->assertTrue($repositoryClass->hasMethod('getAliase'));
        $this->assertTrue($repositoryClass->hasMethod('getMapReferences'));
        $this->assertTrue($repositoryClass->hasMethod('getRepositoryName'));
        $this->assertTrue($repositoryClass->hasMethod('insert'));
        $this->assertTrue($repositoryClass->hasMethod('selectById'));
        $this->assertTrue($repositoryClass->hasMethod('update'));

        return $repositoryClass;

    }

    public function reflectionAbstractTestCase()
    {

        $repositoryClass = new \ReflectionClass('\TestModuleTest\AbstractTest');
        $this->assertEquals('TestModuleTest\AbstractTest', $repositoryClass->getName());
        $this->assertEquals($repositoryClass->getParentClass()->getName(), 'PHPUnit_Framework_TestCase');

        $this->assertTrue($repositoryClass->isAbstract());

        return $repositoryClass;
    }

    public function reflectionAbstractRepositoryTest()
    {

        $repositoryClass = new \ReflectionClass('\TestModuleTest\RepositoryTest\AbstractRepositoryTest');
        $this->assertEquals('TestModuleTest\RepositoryTest\AbstractRepositoryTest', $repositoryClass->getName());
        $this->assertEquals($repositoryClass->getParentClass()->getName(), 'TestModuleTest\AbstractTest');


        $this->assertFalse($repositoryClass->isAbstract());

        return $repositoryClass;

    }

    public function reflectionPiberRepositoryTest()
    {
        $repositoryClass = new \ReflectionClass('\TestModuleTest\RepositoryTest\PiberRepositoryTest');
        $this->assertEquals('TestModuleTest\RepositoryTest\PiberRepositoryTest', $repositoryClass->getName());
        $this->assertEquals($repositoryClass->getParentClass()->getName(), 'TestModuleTest\AbstractTest');


        $this->assertFalse($repositoryClass->isAbstract());

        return $repositoryClass;
    }



}
