<?php
namespace GearTest\ServiceTest;

use GearTest\AbstractTestCase;
use Zend\Console\Request;

abstract class AbstractServiceTest extends AbstractTestCase
{
    protected $structure;

    protected $config;

    protected $moduleService;

    protected $templateService;

    const MODULE = 'TestModule';
    /**
     * Set up config for boilerplate module, to use to test files and configs on gear
     * should be removed on tearDown.
     */
    public function setUp()
    {
        parent::setUp();

        $this->bootstrap = new \GearTest\Bootstrap();
        $this->setServiceLocator($this->bootstrap->getServiceManager());
        $this->bootstrap->getServiceManager()->setAllowOverride(true);

        $this->mockConfig();
        $this->mockStructure();
        $this->mockTemplateService();

        $this->mockRequest();
        $this->mockModuleService();

        $this->bootstrap->getServiceManager()->setAllowOverride(false);

    }

    public function tearDown()
    {

        if (isset($this->structure) && is_dir($this->structure->getMainFolder())) {
            $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
            $dirService->rmDir($this->structure->getMainFolder());
        }
        unset($this->config);
        unset($this->moduleService);
        unset($this->templateService);
        unset($this->structure);
        unset($this->bootstrap);
        unset($this->request);

        parent::tearDown();
    }


    public function createMockModule()
    {
        $this->moduleService->setRequest($this->request);
        $this->moduleService->setModule($this->structure);
        $this->moduleService->createLight();
    }

    public function unloadModule()
    {
        $this->moduleService->unregisterModule();
    }


    public function mockConfig()
    {
        $this->config = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->setMethods(array('getModule'))->getMock();
        $this->config->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TestModule'));


        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('moduleConfig', $this->config);
        //$this->getServiceLocator()->get('serviceManager')->setService('moduleConfig', $this->config);
    }


    public function mockStructure()
    {

        $this->structure = new \Gear\ValueObject\BasicModuleStructure();
        $this->structure->setConfig($this->config);
        $this->structure->prepare();
        $this->structure->setDirService($this->bootstrap->getServiceLocator()->get('dirService'));
        $this->structure->setStringService($this->bootstrap->getServiceLocator()->get('stringService'));
        $this->bootstrap->getServiceManager()->setAllowOverride(true);
        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('moduleStructure', $this->structure);
    }

    public function mockTemplateService()
    {
        $this->templateService = new \Gear\Service\TemplateService();

        $resolver = $this->bootstrap
        ->getServiceManager()
        ->get('Zend\View\Resolver\TemplatePathStack');

        $renderer = new \Zend\View\Renderer\PhpRenderer();
        $renderer->setResolver($resolver);

        $this->templateService->setRenderer($renderer);

        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('templateService', $this->templateService);

        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('Gear\Service\Template', $this->templateService);
    }

    public function mockModuleService()
    {
        unset($this->moduleService);
        $this->moduleService = $this->getServiceLocator()->get('moduleService');
        $this->moduleService->setRequest($this->request);
        $this->moduleService->setConfig($this->config);
        $this->moduleService->setModule($this->structure);
    }

    public function mockRequest($params = array())
    {
        $this->params = new \Zend\Stdlib\Parameters();

        if (count($params)>0) {
            foreach ($params as $name => $value) {
                $this->params->set($name, $value);
            }
        }

        $this->request    = new Request();
        $this->request->setParams($this->params);
    }
}