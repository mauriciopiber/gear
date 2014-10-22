<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class IndexControllerTest extends AbstractConsoleControllerTestCase
{
    const PROJECT_CREATE = 'gear project create %s %s %s';
    const PROJECT_DELETE = 'gear project delete %s %s %s';
    const MODULE_CREATE  = 'gear module create %s';
    const MODULE_DELETE  = 'gear module delete %s';
    const DB_CREATE      = 'gear db create %s --table=%s';

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

        $this->indexController = $controllerManager->get('Gear\Controller\Index');
    }

    /**
     * @group buceta
     */
    public function testCreateProject()
    {
        $mockProjectService = $this->getMockBuilder('Gear\Service\ProjectService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('create')
        ->willReturn('Projeto criado com sucesso');

        $this->indexController->setProjectService($mockProjectService);

        $this->dispatch(sprintf(self::PROJECT_CREATE, 'piber', 'piber.gear.dev', 'git@piber.com'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('project');
        $this->assertMatchedRouteName('gear-project');

    }

    /**
     * @group rev3
     */
    public function testDeleteProject()
    {
        $mockProjectService = $this->getMockBuilder('Gear\Service\ProjectService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('delete')
        ->willReturn('Projeto deletado com sucesso');

        $this->indexController->setProjectService($mockProjectService);

        $this->dispatch(sprintf(self::PROJECT_DELETE, 'piber', 'piber.gear.dev', 'git@piber.com'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('project');
        $this->assertMatchedRouteName('gear-project');

    }

    /**
     * @group rev3
     */
    public function testCreateTbFromTable()
    {
        $mockDbService = $this->getMockBuilder('Gear\Service\Constructor\DbService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockDbService->expects($this->any())
        ->method('create')
        ->willReturn('Administrador da Tabela gerado com sucesso');

        $this->indexController->setDbService($mockDbService);

        $this->dispatch(sprintf(self::DB_CREATE, 'piber', 'module'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('db');
        $this->assertMatchedRouteName('gear-db');
    }

    /**
     * @group buceta

    public function testCreateModule()
    {

        $mockModuleService = $this->getMockBuilder('Gear\Service\Module\ModuleService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockModuleService->expects($this->any())
        ->method('createEmptyModule')
        ->willReturn('Módulo criado com sucesso');


        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TesteModule'));

        $mockConfig->expects($this->any())
        ->method('getModuleFolder')
        ->will($this->returnValue($this->testDir));

        $mockModuleService->setConfig($mockConfig);

        $this->indexController->setModuleService($mockModuleService);

        $this->dispatch(sprintf(self::MODULE_CREATE, 'piber'));
        $this->assertConsoleOutputContains('Módulo criado com sucesso');
    }
 */
    /**
     * @group buceta

    public function testDeleteModule()
    {

        $mockModuleService = $this->getMockBuilder('Gear\Service\Module\ModuleService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockModuleService->expects($this->any())
        ->method('delete')
        ->willReturn('Módulo deletado com sucesso');


        $mockConfig = $this->getMockBuilder('Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TesteModule'));



        $mockModuleService->setConfig($mockConfig);


        $this->indexController->setModuleService($mockModuleService);

        $this->dispatch(sprintf(self::MODULE_DELETE, 'piber'));
        $this->assertConsoleOutputContains('Módulo deletado com sucesso');
    }
    */
    /**
     * @group buceta
     */
    public function testVersion()
    {
        $mockVersionService = $this->getMockBuilder('Gear\Service\VersionService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockVersionService->expects($this->any())
        ->method('get')
        ->willReturn('0.1.3');

        $this->indexController->setVersionService($mockVersionService);

        $this->dispatch('gear -v');
        $this->assertConsoleOutputContains('0.1.3');
        $this->assertTrue(true);
    }

    public function getModulesFolder()
    {
        return realpath(__DIR__);
    }



  /*   public function testGearSrcCreateForm()
    {
        $this->dispatch('gear page create TesteModule');
        $this->assertConsoleOutputContains('Página criado com sucesso.');
    }
 */
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
