<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class IndexControllerTest extends AbstractConsoleControllerTestCase
{
    /** project */
    const PROJECT_CREATE = 'gear project create %s %s %s';
    const PROJECT_DELETE = 'gear project delete %s %s %s';
    const ENVIRONMENT    = 'gear setUpEnvironment --environment=%s';
    const GLOBALY        = 'gear setUpGlobal --host="%s" --database="%s" --environment="%s" --dbms="%s"';
    const LOCAL          = 'gear setUpLocal  --username="%s" --password="%s" ';

    /** module **/
    const MODULE_CREATE  = 'gear module create %s';
    const MODULE_DELETE  = 'gear module delete %s';
    const DB_CREATE      = 'gear db create %s --table=%s';
    const DUMP_ARRAY     = 'gear dump %s --json';
    const DUMP_JSON      = 'gear dump %s --array';
    const VERSION        = 'gear -v';
    const NEWS           = 'gear news';
    const ACL            = 'gear acl';
    const MYSQL          = 'gear setUpMysql --database="%s" --username="%s" --password="%s"';
    const CONFIG         = 'gear config --host="%s" --database="%s" --username="%s" --password="%s" --environment="%s" --dbms="%s"';
    const LOAD           = 'gear load %s';
    const UNLOAD         = 'gear unload %s';

    /** gear **/

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

        //$this->testDir = realpath(__DIR__.'/../../temp');
    }

    public function tearDown()
    {
        parent::tearDown();
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        unset($this->indexController);
    }

    /**
     * @group rev9
     */
    public function testDumpSchemaAsArray()
    {
        $mockModuleService = $this->getMockBuilder('Gear\Service\Module\ModuleService')
          ->disableOriginalConstructor()
          ->getMock();
        $mockModuleService->expects($this->any())
          ->method('dump')
          ->willReturn('Módulo criado com sucesso');

        $this->indexController->setModuleService($mockModuleService);

        $this->dispatch(sprintf(self::DUMP_ARRAY, 'TesteModule'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('dump');
        $this->assertMatchedRouteName('gear-dump');
    }

    /**
     * @group rev3
     */
    public function testDumpSchemaAsJson()
    {
        $mockModuleService = $this->getMockBuilder('Gear\Service\Module\ModuleService')
          ->disableOriginalConstructor()
          ->getMock();
        $mockModuleService->expects($this->any())
          ->method('dump')
          ->willReturn('Módulo criado com sucesso');

        $this->indexController->setModuleService($mockModuleService);

        $this->dispatch(sprintf(self::DUMP_JSON, 'TesteModule'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('dump');
        $this->assertMatchedRouteName('gear-dump');
    }

    /**
     * @group buceta
     */
    public function testConfig()
    {
        $mockProjectService = $this->getMockBuilder('Gear\Service\Project')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('setUpEnvironment')
        ->willReturn('Ok');

        $mockProjectService->expects($this->any())
        ->method('setUpGlobal')
        ->willReturn('Ok');

        $mockProjectService->expects($this->any())
        ->method('setUpLocal')
        ->willReturn('Ok');

        $mockProjectService->expects($this->any())
        ->method('getConfig')
        ->willReturn($this->getMockConfig());

        $this->indexController->setProjectService($mockProjectService);

        $url =  sprintf(
                self::CONFIG,
                'host.gear.dev',
                'mydatabase',
                'myusername',
                'mypassword',
                'development',
                'mysql'
            );


        $this->dispatch(
            $url
        );

        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('config');
        $this->assertMatchedRouteName('gear-config');

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

        $mockProjectService->expects($this->any())
        ->method('getConfig')
        ->willReturn($this->getMockConfig());

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
     * @group buceta
     */
    public function testCreateController()
    {
        $mockProjectService = $this->getMockBuilder('Gear\Constructor\ControllerService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('create')
        ->willReturn(true);

        $this->indexController->setProjectService($mockProjectService);

        $this->dispatch('gear controller create Admin --name=MyController --invokable=%s\Controller\My');
        $this->assertModuleName('Gear');

        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('controller');
        $this->assertMatchedRouteName('gear-controller');
        $this->assertResponseStatusCode(0);

    }

    /**
     * @group rev3
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

        $this->dispatch(SELF::VERSION);
        $this->assertConsoleOutputContains('0.1.3');
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('version');
        $this->assertMatchedRouteName('gear-version');

    }

    /**
     * @group rev3
     */
    public function testAcl()
    {
        $mockVersionService = $this->getMockBuilder('Gear\Service\AclService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockVersionService->expects($this->any())
        ->method('loadAcl')
        ->willReturn(array());

        $this->indexController->setAclService($mockVersionService);

        $this->dispatch(SELF::ACL);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('acl');
        $this->assertMatchedRouteName('gear-acl');
        $this->assertResponseStatusCode(1);
        $this->assertApplicationException('InvalidArgumentException');

    }


    /**
     * @group rev3

    public function testConfig()
    {
        $mockProjectService = $this->getMockBuilder('Gear\Service\ProjectService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('setUpEnvironment')
        ->willReturn(array());

        $this->indexController->setProjectService($mockProjectService);

        $this->dispatch(sprintf(SELF::ENVIRONMENT, 'development'));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('environment');
        $this->assertMatchedRouteName('gear-environment');
        $this->assertResponseStatusCode(0);
    }
 */
    /**
     * @group rev3
     */
    public function testEnvironment()
    {
        $mockProjectService = $this->getMockBuilder('Gear\Service\ProjectService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('setUpEnvironment')
        ->willReturn(array());

        $this->indexController->setProjectService($mockProjectService);

        $this->dispatch(sprintf(SELF::ENVIRONMENT, 'development'));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('environment');
        $this->assertMatchedRouteName('gear-environment');
        $this->assertResponseStatusCode(0);
    }

    /**
     * @group rev3
     */
    public function testNews()
    {
        $mockVersionService = $this->getMockBuilder('Gear\Service\VersionService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockVersionService->expects($this->any())
        ->method('getNews')
        ->willReturn('Novidades');

        $this->indexController->setVersionService($mockVersionService);

        $this->dispatch(SELF::NEWS);
        $this->assertConsoleOutputContains('Novidades');
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('news');
        $this->assertMatchedRouteName('gear-news');

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

        $mockProjectService->expects($this->any())
        ->method('getConfig')
        ->willReturn($this->getMockConfig());


        $this->indexController->setProjectService($mockProjectService);

        $this->dispatch(sprintf(self::PROJECT_DELETE, 'piber', 'piber.gear.dev', 'git@piber.com'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('project');
        $this->assertMatchedRouteName('gear-project');

    }

    public function testCreateModule()
    {

        $mockModuleService = $this->getMockBuilder('Gear\Service\Module\ModuleService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockModuleService->expects($this->any())
        ->method('create')
        ->willReturn('Módulo criado com sucesso');

        $mockModuleService->expects($this->any())
        ->method('getConfig')
        ->willReturn($this->getMockConfig());

        $this->indexController->setModuleService($mockModuleService);

        $this->dispatch(sprintf(self::MODULE_CREATE, 'piber'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('IndexController');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('module');
        $this->assertMatchedRouteName('gear-module');

    }

    public function getMockConfig()
    {
        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TesteModule'));

        $mockConfig->expects($this->any())
        ->method('getModuleFolder')
        ->will($this->returnValue(\Gear\Service\ProjectService::getProjectFolder().'/data/temp/'));

        return $mockConfig;
    }

    /**
     * @group rev3

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
    } */


    /**
     * @group buceta
     * /


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
