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
    public function testCallService()
    {
        $service = $this->bootstrap->getServiceLocator()->get('repositoryService');
        $this->assertInstanceOf('Gear\Service\Mvc\RepositoryService', $service);
    }

    public function testCreateAbstractRepository()
    {
        $service = $this->bootstrap->getServiceLocator()->get('repositoryService');
        $service->setModule($this->structure);
        $service->setConfig($this->config);
        $service->setTemplateService($this->templateService);


        $this->mockRequest(array('repository' => true, 'unit' => true));

        $this->moduleService->setRequest($this->request);

        $this->moduleService->setModule($this->structure);
        $this->moduleService->createLight();

        $service->getAbstract();

        $abstractClass = new \ReflectionClass(sprintf('\%s\Repository\AbstractRepository', $this->config->getModule()));

        $this->assertEquals('TestModule\Repository\AbstractRepository', $abstractClass->getName());


        $this->moduleService->unregisterModule();

    }
}
