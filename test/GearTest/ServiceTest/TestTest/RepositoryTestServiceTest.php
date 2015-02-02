<?php
namespace GearTest\ServiceTest\TestServiceTest;


use GearTest\ServiceTest\AbstractServiceTest;

/**
 * @group column
 * @author piber
 *
 */
class RepositoryTestServiceTest extends AbstractServiceTest
{

    public function setUp()
    {
        parent::setUp();
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
        $service = $this->bootstrap->getServiceLocator()->get('repositoryTestService');
        $service->setModule($this->structure);
        $service->setConfig($this->config);
        $service->setTemplateService($this->templateService);

        $this->mockRequest(array('repository' => true, 'unit' => true));

        $this->moduleService->setRequest($this->request);

        $module = $this->moduleService->createLight();

        $location = $service->createAbstract();

        die();
        $this->assertNotFalse($location);
        $this->assertNotEmpty($location);

        $abstractClass = new \ReflectionClass(sprintf('%sTest/RepositoryTest/%s', $this->config->getModule(), 'AbstractRepositoryTest'));

        $this->moduleService->unregisterModule();
    }

}
