<?php
namespace GearTest\ServiceTest\TestServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class RepositoryTestServiceTest extends AbstractGearTest
{

    public function setUp()
    {
        parent::setUp();


 /*        $moduleService = $this->getServiceLocator()->get('moduleService');
        $moduleService->create(); */
    }

    public function tearDown()
    {

        parent::tearDown();
    }

    public function testCallService()
    {
        $service = $this->bootstrap->getServiceLocator()->get('repositoryTestService');
        $this->assertInstanceOf('Gear\Service\Test\RepositoryTestService', $service);
    }

    public function testTemplateByServiceManager()
    {
        $resolver = $this->bootstrap
        ->getServiceManager()
        ->get('Zend\View\Resolver\TemplatePathStack');

        $renderer = new \Zend\View\Renderer\PhpRenderer();
        $renderer->setResolver($resolver);

        $template = 'template/test/unit/repository/abstract.phtml';

        $resolve = $resolver->resolve($template);

        $this->assertNotFalse($resolve);

        $html = $renderer->render($template, array());

        $this->assertNotEmpty($html);
    }

    public function testCreateAbstractRepositoryTest()
    {
        $templateService = $this->getMockSingleClass('Gear\Service\TemplateService', array('getRenderer'));

         $resolver = $this->bootstrap
        ->getServiceManager()
        ->get('Zend\View\Resolver\TemplatePathStack');

        $renderer = new \Zend\View\Renderer\PhpRenderer();
        $renderer->setResolver($resolver);

        $templateService->expects($this->any())
        ->method('getRenderer')
        ->willReturn($renderer);

        $mockStructure = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getRepositoryFolder'));
        $mockStructure->expects($this->any())
        ->method('getRepositoryFolder')
        ->willReturn(__DIR__.'/../../_tempfiles');

        $mockConfig = $this->getMockSingleClass('Gear\ValueObject\Config\Config', array('getModule'));
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->willReturn('MyTestingModule');

        $service = $this->bootstrap->getServiceLocator()->get('repositoryTestService');
        $service->setModule($mockStructure);
        $service->setConfig($mockConfig);
        $service->setTemplateService($templateService);

        $location = $service->createAbstract();

        $this->assertNotFalse($location);
        $this->assertNotEmpty($location);
    }

}
