<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ProjectControllerTest extends AbstractConsoleControllerTestCase
{
    const CREATE       = 'gear project create %s %s %s';
    const DELETE       = 'gear project delete %s %s %s';
    const ENVIRONMENT  = 'gear project setUpEnvironment --environment=%s';
    const GLOBALY      = 'gear project setUpGlobal --host=%s --dbname=%s --environment=%s --dbms=%s';
    const LOCAL        = 'gear project setUpLocal --username=%s --password=%s';

    const DUMP_ARRAY   = 'gear project dump %s --json';
    const DUMP_JSON    = 'gear project dump %s --array';
    const CONFIG       = 'gear project setUpConfig --host=%s --dbname=%s --username=%s --password=%s --environment=%s --dbms=%s';
    const ACL          = 'gear project setUpAcl';

    const MYSQL        = 'gear project setUpMysql --dbname=%s --username=%s --password=%s';
    const SQLITE       = 'gear project setUpSqlite --dbname=%s --dump=%s --username=%s --password=%s';
    const ENTITIES     = 'gear project setUpEntities %s';
    const ENTITY       = 'gear project setUpEntity %s --entity=%s';



    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php'
        );

        parent::setUp();

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $controllerManager = $this->getApplication()
        ->getServiceManager()
        ->get('controllermanager');

        $this->projectController = $controllerManager->get('Gear\Controller\Project');

        $mockProjectService = $this->getMockBuilder('Gear\Service\ProjectService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockProjectService->expects($this->any())
        ->method('setUpEnvironment')
        ->will($this->returnValue('Ok'));

        $mockProjectService->expects($this->any())
        ->method('setUpGlobal')
        ->willReturn('Ok');

        $mockProjectService->expects($this->any())
        ->method('setUpMysql')
        ->will($this->returnValue('Ok'));

        $mockProjectService->expects($this->any())
        ->method('setUpSqlite')
        ->will($this->returnValue('Ok'));

        $mockProjectService->expects($this->any())
        ->method('setUpEntities')
        ->willReturn('Ok');

        $mockProjectService->expects($this->any())
        ->method('setUpEntity')
        ->willReturn('Ok');

        $mockProjectService->expects($this->any())
        ->method('delete')
        ->willReturn('Projeto deletado com sucesso');

        $mockProjectService->expects($this->any())
        ->method('setUpLocal')
        ->willReturn('Ok');


        $mockProjectService->expects($this->any())
        ->method('create')
        ->willReturn('Projeto criado com sucesso');

        $mockProjectService->expects($this->any())
        ->method('getConfig')
        ->willReturn($this->getMockConfig());

        $mockProjectService->expects($this->any())
        ->method('dump')
        ->willReturn('alapuxatche');

        $this->projectController->setProjectService($mockProjectService);

        $mockVersionService = $this->getMockBuilder('Gear\Service\AclService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockVersionService->expects($this->any())
        ->method('loadAcl')
        ->willReturn(array());

        $this->projectController->setAclService($mockVersionService);


        $mockEntityService = $this->getMockBuilder('Gear\Service\Mvc\EntityService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockEntityService->expects($this->any())
        ->method('setUpEntity')
        ->willReturn(array());

        $mockEntityService->expects($this->any())
        ->method('setUpEntities')
        ->willReturn(array());

        $this->projectController->setEntityService($mockEntityService);
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
        unset($this->projectController);
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
     */
    public function testDumpSchemaAsArray()
    {
        $this->dispatch(sprintf(self::DUMP_ARRAY, 'Project'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('dump');
        $this->assertMatchedRouteName('gear-dump');
    }

    /**
     * @group rev3
     */
    public function testDumpSchemaAsJson()
    {
        $this->dispatch(sprintf(self::DUMP_JSON, 'TesteModule'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('dump');
        $this->assertMatchedRouteName('gear-dump');
    }



    public function testsetUpEnvironment()
    {
        $this->dispatch(sprintf(SELF::ENVIRONMENT, 'development'));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('environment');
        $this->assertMatchedRouteName('gear-environment');
        $this->assertResponseStatusCode(0);
    }

    public function testSetUpGlobal()
    {
        $url =  sprintf(
            self::GLOBALY,
            'host.gear.dev',
            'mydbname',
            'development',
            'mysql'
        );
        $this->dispatch($url);


        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('global');
        $this->assertMatchedRouteName('gear-global');
    }

    public function testSetUpLocal()
    {
        $url =  sprintf(
            self::LOCAL,
            'mydbname',
            'myusername',
            'mymypassword'
        );
        $this->dispatch($url);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('local');
        $this->assertMatchedRouteName('gear-local');
    }


    public function testsetUpConfig()
    {

        $url =  sprintf(
            self::CONFIG,
            'host.gear.dev',
            'mydbname',
            'myusername',
            'mypassword',
            'development',
            'mysql'
        );
        $this->dispatch($url);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('config');
        $this->assertMatchedRouteName('gear-config');

    }


    public function testAcl()
    {
        $this->dispatch(SELF::ACL);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('acl');
        $this->assertMatchedRouteName('gear-acl');
        $this->assertResponseStatusCode(0);
    }



    /**
     */
    public function testCreateProject()
    {
        $this->dispatch(sprintf(self::CREATE, 'piber', 'piber.gear.dev', 'git@piber.com'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('project');
        $this->assertMatchedRouteName('gear-project');
    }



    /**
    */
    public function testDeleteProject()
    {
        $this->dispatch(sprintf(self::DELETE, 'piber', 'piber.gear.dev', 'git@piber.com'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('project');
        $this->assertMatchedRouteName('gear-project');
    }

    public function testSetUpMYsql()
    {

        $this->dispatch(sprintf(self::MYSQL, 'piber', 'myusername', 'mypassword'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('mysql');
        $this->assertMatchedRouteName('gear-mysql');
    }

    public function testSetUpEntities()
    {
        $this->dispatch(sprintf(self::ENTITIES, 'Piber'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('entities');
        $this->assertMatchedRouteName('gear-entities');
    }

    public function testSetUpEntity()
    {
        $this->dispatch(sprintf(self::ENTITY, 'Piber', 'Module,Controller,Action'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ProjectController');
        $this->assertControllerName('Gear\Controller\Project');
        $this->assertActionName('entity');
        $this->assertMatchedRouteName('gear-entity');
    }
}
