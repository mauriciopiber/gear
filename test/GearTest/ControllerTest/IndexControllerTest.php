<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class IndexControllerTest extends AbstractConsoleControllerTestCase
{
    /** project */
    const CREATE       = 'gear project create %s %s %s';
    const DELETE       = 'gear project delete %s %s %s';
    const ENVIRONMENT  = 'gear setUpEnvironment --environment=%s';
    const GLOBALY      = 'gear setUpGlobal --host="%s" --database="%s" --environment="%s" --dbms="%s"';
    const LOCAL        = 'gear setUpLocal  --username="%s" --password="%s" ';
    const MYSQL        = 'gear setUpMysql --database="%s" --username="%s" --password="%s"';

    const CONFIG       = 'gear setUpConfig --host="%s" --database="%s" --username="%s" --password="%s" --environment="%s" --dbms="%s"';
    const ACL          = 'gear acl';
    /** module **/

    const DB_CREATE      = 'gear db create %s --table=%s';


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
     * @group buceta
     */
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

}
