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

        $this->mockRequest(array('repository' => true, 'unit' => true, 'ci' => true));

        $this->moduleService->setRequest($this->request);


        $testService = $this->bootstrap->getServiceLocator()->get('testService');

        $testService->setConfig($this->config);

        $this->moduleService->setTestService($testService);


        $module = $this->moduleService->createLight();

        $location = $service->createAbstract();

        $this->assertNotFalse($location);
        $this->assertNotEmpty($location);

        $abstractClass = new \ReflectionClass('\TestModuleTest\AbstractTest');

        $this->assertEquals($abstractClass->getName(), 'TestModuleTest\AbstractTest');

        $this->assertTrue($abstractClass->hasMethod('getMockAbstractClass'));
        $this->assertTrue($abstractClass->hasMethod('getMockAuthenticationAdapter'));
        $this->assertTrue($abstractClass->hasMethod('getMockAuthenticationService'));
        $this->assertTrue($abstractClass->hasMethod('getMockIdentifier'));
        $this->assertTrue($abstractClass->hasMethod('getMockSingleClass'));
        $this->assertTrue($abstractClass->hasMethod('getMockZfcUserAuthentication'));
        $this->assertTrue($abstractClass->hasMethod('getUserByEmail'));


        $repositoryAbstract = new \ReflectionClass(sprintf('\%sTest\RepositoryTest\%s', $this->config->getModule(), 'AbstractRepositoryTest'));

        $this->assertEquals($repositoryAbstract->getName(), 'TestModuleTest\RepositoryTest\AbstractRepositoryTest');

        $this->assertTrue($repositoryAbstract->hasMethod('testDeleteById'));
        $this->assertTrue($repositoryAbstract->hasMethod('testDeleteNull'));
        $this->assertTrue($repositoryAbstract->hasMethod('testExtract'));

        $this->moduleService->unregisterModule();
    }

}
