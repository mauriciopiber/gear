<?php
namespace GearTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class IndexControllerTest extends AbstractConsoleControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php');

        parent::setUp();

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);


        $controllerManager = $this->getApplication()
        ->getServiceManager()
        ->get('controllermanager');

        $indexController = $controllerManager->get('Gear\Controller\Index');

        $mockModuleService = $this->getMockBuilder('Gear\Service\Mvc\ModuleTest')
        ->disableOriginalConstructor()
        ->getMock();

        $mockPageService = $this->getMockBuilder('Gear\Service\PageService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockPageService->expects($this->any())
        ->method('create')
        ->willReturn('Página criada com sucesso.');

        $mockPageService->expects($this->any())
        ->method('delete')
        ->willReturn('Página deletada com sucesso.');



        /*
        $this->getApplication()
        ->getServiceManager()
        ->get('controllermanager')->setService('Gear\Controller\Index', $indexController);
        */

    }

    public function getModulesFolder()
    {
        return realpath(__DIR__);
    }


    /**
     * @group rev
     */
    public function testVersion()
    {
        $this->dispatch('gear -v');
        $this->assertConsoleOutputContains('0.1.0');
    }

    public function testGearSrcCreateForm()
    {
        $this->dispatch('gear page create TesteModule');
        $this->assertConsoleOutputContains('Página criado com sucesso.');
    }

    public function testGearSrcCreateFilter()
    {

    }

    public function testGearSrcCreateFactory()
    {

    }

    public function testGearSrcCreateRepository()
    {

    }

    public function testGearSrcCreateEntity()
    {

    }

    public function testGearSrcCreateValueObject()
    {

    }
}
