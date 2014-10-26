<?php
namespace Gear\ServiceTest\Module;

use GearTest\AbstractGearTest;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

class ModuleServiceTest extends AbstractControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../../config/application.config.php');

        parent::setUp();

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $moduleService = $this->getApplicationServiceLocator()->get('moduleService');

        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('Application'));

        $moduleService->setConfig($mockConfig);

        $this->moduleService = $moduleService;
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

    public function testRegisterModule()
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
    }

}
