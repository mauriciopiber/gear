<?php
namespace Gear\ServiceTest\Module;

use GearTest\AbstractGearTest;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;
use Zend\Console\Request;
use Zend\Mvc\MvcEvent;
use Gear\Service\AbstractService;
use GearTest\ServiceTest\AbstractServiceTest;

class ModuleServiceTest extends AbstractServiceTest
{
    protected $structure;

    protected $moduleService;

    const MODULE = 'TestModule';

    public function setUp()
    {
        parent::setUp();
    }


    public function tearDown()
    {
        if (isset($this->structure) && is_dir($this->structure->getMainFolder())) {
            $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
            $dirService->rmDir($this->structure->getMainFolder());
        }
        parent::tearDown();
    }

    public function testModuleServiceByServiceLocator()
    {
        $this->assertInstanceOf('Gear\Service\Module\ModuleService', $this->moduleService);
    }

    public function testHasInjectedCorrectlyFileService()
    {

        $fileService = $this->moduleService->getFileService();
        $this->assertInstanceOf('Gear\Service\Filesystem\FileService', $fileService);
    }

    public function testHasInjectedCorrectlyDirService()
    {
        $stringService = $this->moduleService->getDirService();
        $this->assertInstanceOf('Gear\Service\Filesystem\DirService', $stringService);
    }

    public function testCreateLighModule()
    {
        $this->request    = new Request();

        $this->params = new \Zend\Stdlib\Parameters();

        $this->request->setParams($this->params);

        $this->moduleService->setRequest($this->request);
        $this->moduleService->setConfig($this->config);

        $templateService = $this->getMockSingleClass('Gear\Service\TemplateService', array('getRenderer'));

        $resolver = $this->bootstrap
        ->getServiceManager()
        ->get('Zend\View\Resolver\TemplatePathStack');

        $renderer = new \Zend\View\Renderer\PhpRenderer();
        $renderer->setResolver($resolver);

        $templateService->expects($this->any())
        ->method('getRenderer')
        ->willReturn($renderer);

        $this->bootstrap->getServiceManager()->setAllowOverride(true);

        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('templateService', $templateService);

        $this->structure = new \Gear\ValueObject\BasicModuleStructure();
        $this->structure->setConfig($this->config);
        $this->structure->prepare();

        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');

        $string = $this->bootstrap->getServiceLocator()->get('stringService');

        $this->structure->setDirService($dirService);
        $this->structure->setStringService($string);


        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('moduleStructure', $this->structure);


        $this->moduleService->setModule($this->structure);
        $module = $this->moduleService->createLight();

        $this->assertFileExists($this->structure->getMainFolder());

        $this->assertFileExists($this->structure->getConfigFolder().'/module.config.php');

        $this->assertFileExists($this->structure->getMainFolder().'/Module.php');
        $this->assertFileExists($this->structure->getSrcModuleFolder().'/Module.php');


        $applicationConfig = $this->moduleService->getApplicationConfigArray();

        $this->assertContains($this->config->getModule(), $applicationConfig['modules'***REMOVED***);

        $oReflectionClass = new \ReflectionClass('TestModule\Module');


        $this->assertEquals('TestModule\Module', $oReflectionClass->getName());

        $this->assertTrue($oReflectionClass->hasMethod('getLocation'));
        $this->assertTrue($oReflectionClass->hasMethod('getConfig'));
        $this->assertTrue($oReflectionClass->hasMethod('getAutoloaderConfig'));


        $this->moduleService->unregisterModule();
    }


 /*    public function testRegisterModule()
    {
        $register = $this->moduleService->registerModule();
        $modules = $this->moduleService->getApplicationConfigArray();
        $this->assertTrue(in_array('Application', $modules['modules'***REMOVED***));
    }

    public function testUnregisterModule()
    {
        $register = $this->moduleService->unregisterModule();
        $modules = $this->moduleService->getApplicationConfigArray();
        $this->assertTrue(!in_array('Application', $modules['modules'***REMOVED***));
    }

    public function testLoadModule()
    {
        $register = $this->moduleService->load();
        $modules = $this->moduleService->getApplicationConfigArray();
        $this->assertTrue(in_array('Application', $modules['modules'***REMOVED***));
    }

    public function testUnloadModule()
    {
        $register = $this->moduleService->unload();
        $modules = $this->moduleService->getApplicationConfigArray();
        $this->assertTrue(!in_array('Application', $modules['modules'***REMOVED***));
    }

    public function testloadBeforeModule()
    {
        $data = array('before' => 'Gear');
        $register = $this->moduleService->loadBefore($data);
        $modules = $this->moduleService->getApplicationConfigArray();
        $this->assertTrue(in_array('Application', $modules['modules'***REMOVED***));
    } */

}
