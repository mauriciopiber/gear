<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Module\ConstructService;
use GearJson\Db\DbService as SchemaDbService;
use GearJson\Src\SrcService as SchemaSrcService;
use GearJson\Controller\ControllerService as SchemaControllerService;
use GearJson\Action\ActionService as SchemaActionService;
use GearJson\App\AppService as SchemaAppService;
use Gear\Constructor\Db\DbService;
use Gear\Constructor\Src\SrcService;
use Gear\Constructor\Controller\ControllerService;
use Gear\Constructor\Action\ActionService;
use Gear\Constructor\App\AppService;
use GearJson\Src\Src;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Construct
 */
class ConstructServiceTest extends AbstractTestCase
{
    const ROOT_URL = 'basepath';

    const GEARFILE_URL = 'basepath/gearfile.yml';

    const MODULE_NAME = 'Gearing';


    public function setUp()
    {
        parent::setUp();

        vfsStream::setup(self::ROOT_URL);

        $this->basepath = vfsStream::url(self::ROOT_URL);
        $this->config = null;

        $this->dbSchema = $this->prophesize(SchemaDbService::class);
        $this->srcSchema = $this->prophesize(SchemaSrcService::class);
        $this->controllerSchema = $this->prophesize(SchemaControllerService::class);
        $this->actionSchema = $this->prophesize(SchemaActionService::class);
        $this->appSchema = $this->prophesize(SchemaAppService::class);


        $this->dbService = $this->prophesize(DbService::class);
        $this->srcService = $this->prophesize(SrcService::class);
        $this->controllerService = $this->prophesize(ControllerService::class);
        $this->actionService = $this->prophesize(ActionService::class);
        $this->appService = $this->prophesize(AppService::class);

        $this->construct = new ConstructService();
        $this->construct->setBaseDir($this->basepath);
        //schema
        $this->construct->setDbService($this->dbSchema->reveal());
        $this->construct->setSrcService($this->srcSchema->reveal());
        $this->construct->setControllerService($this->controllerSchema->reveal());
        $this->construct->setActionService($this->actionSchema->reveal());
        $this->construct->setAppService($this->appSchema->reveal());

        //constructor
        $this->construct->setDbConstructor($this->dbService->reveal());
        $this->construct->setSrcConstructor($this->srcService->reveal());
        $this->construct->setAppConstructor($this->appService->reveal());
        $this->construct->setControllerConstructor($this->controllerService->reveal());
        $this->construct->setActionConstructor($this->actionService->reveal());
    }

    public function testGetSchemaServices()
    {
        $this->assertEquals($this->construct->getDbService(), $this->dbSchema->reveal());
        $this->assertEquals($this->construct->getSrcService(), $this->srcSchema->reveal());
        $this->assertEquals($this->construct->getAppService(), $this->appSchema->reveal());
        $this->assertEquals($this->construct->getActionService(), $this->actionSchema->reveal());
        $this->assertEquals($this->construct->getControllerService(), $this->controllerSchema->reveal());

        $this->assertEquals($this->construct->getDbConstructor(), $this->dbService->reveal());
        $this->assertEquals($this->construct->getSrcConstructor(), $this->srcService->reveal());
        $this->assertEquals($this->construct->getAppConstructor(), $this->appService->reveal());
        $this->assertEquals($this->construct->getControllerConstructor(), $this->controllerService->reveal());
        $this->assertEquals($this->construct->getActionConstructor(), $this->actionService->reveal());
    }

    /**
     * @group q1
     */
    public function testIntegrateAll()
    {
        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: MyModule
src:
  0:
    name: MyService
    type: Service
  1:
    name: MyRepository
    type: Repository
  2:
    name: MyEntity
    type: Entity
  3:
    name: MyOldService
    type: Factory
  4:
    name: MyOldService
    type: Trait
db:
  0:
    table: MyTable
controller:
  0:
    name: MyController
    actions:
      0:
        name: FirstAction
      1:
        name: SecondAction
  1:
    name: MyControllerSrcMvc
    db: MySrcMvc
    actions:
      0:
        name: FirstSrcMvcAction
      1:
        name: SecondSrcMvcAction



EOS
        ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals(

            [
                sprintf(ConstructService::SRC_CREATED, 'MyService', 'Service'),
                sprintf(ConstructService::SRC_CREATED, 'MyRepository', 'Repository'),
                /* @TODO sprintf(ConstructService::SRC_CREATED, 'MyEntity', 'Entity'), */
                sprintf(ConstructService::SRC_CREATED, 'MyOldService', 'Factory'),
                sprintf(ConstructService::SRC_CREATED, 'MyOldService', 'Trait'),
                sprintf(ConstructService::DB_CREATED, 'MyTable'),
                sprintf(ConstructService::CONTROLLER_CREATED, 'MyController'),
                sprintf(ConstructService::ACTION_CREATED, 'FirstAction', 'MyController'),
                sprintf(ConstructService::ACTION_CREATED, 'SecondAction', 'MyController'),
                sprintf(ConstructService::CONTROLLER_CREATED, 'MyControllerSrcMvc'),
                sprintf(ConstructService::ACTION_CREATED, 'FirstSrcMvcAction', 'MyControllerSrcMvc'),
                sprintf(ConstructService::ACTION_CREATED, 'SecondSrcMvcAction', 'MyControllerSrcMvc'),

            ***REMOVED***,
            $constructed['created-msg'***REMOVED***
        );

    }

    /**
     * @group z1
     */
    public function testSrcCreate()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        $src = new Src($data);

        $this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcService->create($data)->willReturn(true)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
        ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals(
            $constructed['created-msg'***REMOVED***[0***REMOVED***,
            sprintf(ConstructService::SRC_CREATED, 'Gearing', 'Service')
        );
    }

    /**
     * @group z1
     */
    public function testSrcDuplicade()
    {
        $srcschema = $this->prophesize('GearJson\Src\SrcService');

        $src = new \GearJson\Src\Src(['name' => 'Gearing', 'type' => 'Service'***REMOVED***);

        $srcschema->srcExist('Gearing', $src)->willReturn(true);

        $this->construct->setSrcService($srcschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals(
            $constructed['skipped-msg'***REMOVED***[0***REMOVED***,
            sprintf(ConstructService::SRC_SKIP, 'Gearing', 'Service')
        );

    }

    /**
     * @group z1
     */
    public function testSrcWithEntity()
    {
        $data = ['name' => 'Gearing', 'type' => 'Entity'***REMOVED***;

        $src = new Src($data);

        $this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcService->createEntities([$data***REMOVED***)->willReturn(true)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Entity

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals([
            'module' => 'Gearing',
            'skipped-msg' => [***REMOVED***,
            'created-msg' => [***REMOVED***,
            'invalid-msg' => [***REMOVED***

        ***REMOVED***, $constructed);
    }

    /**
     * @group z1
     * @group z13
     */
    public function testSrcAll()
    {
        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: EntityOne
    type: Entity
  1:
    name: ServiceOne
    type: Service
  2:
    name: ServiceOne
    type: Service
    extends: MyClass
  4:
    name: Servic\\eOne
    type: Service


EOS
        ));

        $srcOne = new Src([
            'name' => 'EntityOne',
            'type' => 'Entity'
        ***REMOVED***);

        $srcTwo = new Src([
            'name' => 'ServiceOne',
            'type' => 'Service'
        ***REMOVED***);

        $srcThree = new Src([
            'name' => 'ServiceOne',
            'type' => 'Service',
            'extends' => 'MyClass'
        ***REMOVED***);

        $srcFour = new Src([
            'name' => 'Servic\\eOne',
            'type' => 'Service'
        ***REMOVED***);

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Src Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();

        //$this->srcSchema->srcExist(self::MODULE_NAME, $srcOne)->willReturn(false)->shouldBeCalled();
        $this->srcSchema->srcExist(self::MODULE_NAME, $srcTwo)->willReturn(false)->shouldBeCalled();
        $this->srcSchema->srcExist(self::MODULE_NAME, $srcThree)->willReturn(true)->shouldBeCalled();
        $this->srcSchema->srcExist(self::MODULE_NAME, $srcFour)->willReturn(false)->shouldBeCalled();

        $this->srcService->create([
            'name' => 'EntityOne',
            'type' => 'Entity'
        ***REMOVED***)->willReturn(true);
        $this->srcService->create([
            'name' => 'ServiceOne',
            'type' => 'Service'
        ***REMOVED***)->willReturn(true);
        $this->srcService->create([
            'name' => 'ServiceOne',
            'type' => 'Service',
            'extends' => 'MyClass'
        ***REMOVED***)->shouldNotBeCalled();
        $this->srcService->create([
            'name' => 'Servic\\eOne',
            'type' => 'Service'
        ***REMOVED***)->willReturn($this->consoleValidation->reveal());


        $this->srcService->createEntities([
            [
                'name' => 'EntityOne',
                'type' => 'Entity'
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals(
            [
                'module' => 'Gearing',
                'skipped-msg' => [
                    sprintf(ConstructService::SRC_SKIP, 'ServiceOne', 'Service')
                ***REMOVED***,
                'created-msg' => [
                    sprintf(ConstructService::SRC_CREATED, 'ServiceOne', 'Service')
                ***REMOVED***,
                'invalid-msg' => [
                    sprintf(ConstructService::SRC_VALIDATE, 'Servic\\eOne', 'Service'),
                    'Src Gearing está com dados errados'
                ***REMOVED***
            ***REMOVED***,
            $constructed
        );

    }

    /**
     * @group z1
     * @group z11
     */
    public function testSrcValidate()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        $srcschema = $this->prophesize('GearJson\Src\SrcService');

        $src = new \GearJson\Src\Src($data);

        $srcschema->srcExist('Gearing', $src)->willReturn(false)->shouldBeCalled();

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Src Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();

        $this->srcService->create($data)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();

        $this->construct->setSrcService($srcschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals(
            $constructed['invalid-msg'***REMOVED***[0***REMOVED***,
            sprintf(ConstructService::SRC_VALIDATE, 'Gearing', 'Service')
        );

        $this->assertEquals(
            $constructed['invalid-msg'***REMOVED***[1***REMOVED***,
            'Src Gearing está com dados errados'
        );
    }

    /**
     * @group z2
     */
    public function testAppDuplicade()
    {
        $appschema = $this->prophesize('GearJson\App\AppService');

        $app = new \GearJson\App\App(['name' => 'Gearing', 'type' => 'Service'***REMOVED***);

        $appschema->appExist('Gearing', $app)->willReturn(true);

        $this->construct->setAppService($appschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
app:
  0:
    name: Gearing
    type: Service

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals($constructed['skipped-msg'***REMOVED***[0***REMOVED***, 'App nome "Gearing" do tipo "Service" já existe.');
    }


    /**
     * @group z2
     */
    public function testAppCreate()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        $app = new \GearJson\App\App($data);

        $appschema = $this->prophesize('GearJson\App\AppService');
        $appschema->appExist('Gearing', $app)->willReturn(false);

        $appservice = $this->prophesize('Gear\Constructor\App\AppService');
        $appservice->create($data)->willReturn(true);

        $this->construct->setAppConstructor($appservice->reveal());
        $this->construct->setAppService($appschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
app:
  0:
    name: Gearing
    type: Service

EOS
            ));


        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals($constructed['created-msg'***REMOVED***[0***REMOVED***, 'App nome "Gearing" do tipo "Service" criado.');
    }


    /**
     * @group z3
     */
    public function testControllerCreate()
    {
        $data = ['name' => 'Gearing', 'object' => '%s\Controller\Gearing'***REMOVED***;

        $controller = new \GearJson\Controller\Controller($data);

        $controllerschema = $this->prophesize('GearJson\Controller\ControllerService');
        $controllerschema->controllerExist('Gearing', $controller)->willReturn(false);

        $controllerservice = $this->prophesize('Gear\Constructor\Controller\ControllerService');
        $controllerservice->createController($data)->willReturn(true);

        $this->construct->setControllerConstructor($controllerservice->reveal());
        $this->construct->setControllerService($controllerschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    object: '%s\Controller\Gearing'

EOS
            ));


        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals($constructed['created-msg'***REMOVED***[0***REMOVED***, 'Controller "Gearing" criado.');
    }

    /**
     * @group z3
     */
    public function testControllerDuplicade()
    {
        $controllerschema = $this->prophesize('GearJson\Controller\ControllerService');

        $controller = new \GearJson\Controller\Controller(['name' => 'Gearing', 'object' => '%s\Controller\Gearing'***REMOVED***);

        $controllerschema->controllerExist('Gearing', $controller)->willReturn(true);

        $this->construct->setControllerService($controllerschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    object: '%s\Controller\Gearing'
    service: invokables


EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertCount(1, $constructed['skipped-msg'***REMOVED***);
        $this->assertEquals($constructed['skipped-msg'***REMOVED***[0***REMOVED***, 'Controller "Gearing" já existe.');
    }

    /**
     * @group z3
     */
    public function testControllerValidate()
    {
        $data = ['name' => 'Gearing', 'object' => '%s\Controller\Gearing'***REMOVED***;

        $controller = new \GearJson\Controller\Controller($data);

        $this->controllerSchema->controllerExist('Gearing', $controller)->willReturn(false);

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Src Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();

        $this->controllerService->createController($data)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();


        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    object: '%s\Controller\Gearing'

EOS
            ));


        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals(
            $constructed['invalid-msg'***REMOVED***[0***REMOVED***,
            sprintf(ConstructService::CONTROLLER_VALIDATE, 'Gearing')
        );
    }

    /**
     * @group z4
     */
    public function testActionCreate()
    {
        $data = [
            'name' => 'Gearing',
            'object' => '%s\Controller\Gearing',
            'service' => 'invokables',
            'actions' => [
                ['name' => 'GearIt'***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $controller = new \GearJson\Controller\Controller($data);

        $controllerschema = $this->prophesize('GearJson\Controller\ControllerService');
        $controllerschema->controllerExist('Gearing', $controller)->willReturn(false);

        $controllerservice = $this->prophesize('Gear\Constructor\Controller\ControllerService');
        $controllerservice->createController($data)->willReturn(true);

        $this->construct->setControllerConstructor($controllerservice->reveal());
        $this->construct->setControllerService($controllerschema->reveal());


        //action
        $actionschema = $this->prophesize('GearJson\Action\ActionService');

        $action = new \GearJson\Action\Action(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***);
        $actionschema->actionExist('Gearing', $action)->willReturn(false);
        $this->construct->setActionService($actionschema->reveal());

        $actionservice = $this->prophesize('Gear\Constructor\Action\ActionService');
        $actionservice->createControllerAction(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***)->willReturn(true);

        $this->construct->setActionConstructor($actionservice->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    object: '%s\Controller\Gearing'
    service: invokables
    actions:
      0:
        name: GearIt

EOS
        ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertCount(2, $constructed['created-msg'***REMOVED***);
        $this->assertEquals($constructed['created-msg'***REMOVED***[1***REMOVED***, 'Action "GearIt" do Controller "Gearing" criado.');
    }

    /**
     * @group z4
     */
    public function testActionDuplicade()
    {
        //controller
        $data = [
            'name' => 'Gearing',
            'object' => '%s\Controller\Gearing',
            'service' => 'invokables',
            'actions' => [
                ['name' => 'GearIt'***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $controller = new \GearJson\Controller\Controller($data);

        $controllerschema = $this->prophesize('GearJson\Controller\ControllerService');
        $controllerschema->controllerExist('Gearing', $controller)->willReturn(false);

        $controllerservice = $this->prophesize('Gear\Constructor\Controller\ControllerService');
        $controllerservice->createController($data)->willReturn(true);

        $this->construct->setControllerConstructor($controllerservice->reveal());
        $this->construct->setControllerService($controllerschema->reveal());


        //action
        $actionschema = $this->prophesize('GearJson\Action\ActionService');

        $action = new \GearJson\Action\Action(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***);
        $actionschema->actionExist('Gearing', $action)->willReturn(true);
        $this->construct->setActionService($actionschema->reveal());


        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    object: '%s\Controller\Gearing'
    service: invokables
    actions:
      0:
        name: GearIt

EOS
        ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertCount(1, $constructed['skipped-msg'***REMOVED***);
        $this->assertEquals($constructed['skipped-msg'***REMOVED***[0***REMOVED***, 'Action "GearIt" do Controller "Gearing" já existe.');
    }

    /**
     * @group z4
     * @group z41
     */
    public function testActionValidate()
    {
        $data = [
            'name' => 'Gearing',
            'object' => '%s\Controller\Gearing',
            'service' => 'invokables',
            'actions' => [
                ['name' => 'GearIt'***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $controller = new \GearJson\Controller\Controller($data);

        $this->controllerSchema->controllerExist('Gearing', $controller)->willReturn(false)->shouldBeCalled();

        $this->controllerService->createController($data)->willReturn(true)->shouldBeCalled();


        //action

        $action = new \GearJson\Action\Action(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***);
        $this->actionSchema->actionExist('Gearing', $action)->willReturn(false)->shouldBeCalled();



        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Controller Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();


        $this->actionService->createControllerAction(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();


        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    object: '%s\Controller\Gearing'
    service: invokables
    actions:
      0:
        name: GearIt

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertCount(2, $constructed['invalid-msg'***REMOVED***);
        $this->assertEquals(
            sprintf(ConstructService::ACTION_VALIDATE, 'GearIt', 'Gearing'),
            $constructed['invalid-msg'***REMOVED***[0***REMOVED***
        );

        $this->assertEquals(
            'Controller Gearing está com dados errados',
            $constructed['invalid-msg'***REMOVED***[1***REMOVED***
        );
    }

    /**
     * @group z5
     */
    public function testDbCreate()
    {
        $data = ['table' => 'Gearit', 'columns' => [***REMOVED******REMOVED***;

        $db = new \GearJson\Db\Db($data);

        $dbschema = $this->prophesize('GearJson\Db\DbService');
        $dbschema->dbExist('Gearing', $db)->willReturn(false);

        $dbservice = $this->prophesize('Gear\Constructor\Db\DbService');
        $dbservice->create($data)->willReturn(true);

        $this->construct->setDbConstructor($dbservice->reveal());
        $this->construct->setDbService($dbschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
db:
  0:
    table: Gearit
    columns: [***REMOVED***

EOS
        ));


        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals($constructed['created-msg'***REMOVED***[0***REMOVED***, 'Db tabela "Gearit" criado.');
    }

    /**
     * @group z5
     */
    public function testDbDuplicade()
    {
        $dbschema = $this->prophesize('GearJson\Db\DbService');

        $db = new \GearJson\Db\Db(['table' => 'Gearit', 'columns' => [***REMOVED******REMOVED***);

        $dbschema->dbExist('Gearing', $db)->willReturn(true);

        $this->construct->setDbService($dbschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
db:
  0:
    table: Gearit
    columns: [***REMOVED***

EOS
        ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertCount(1, $constructed['skipped-msg'***REMOVED***);
        $this->assertEquals($constructed['skipped-msg'***REMOVED***[0***REMOVED***, 'Db tabela "Gearit" já existe.');

    }

    /**
     * @group z5
     */
    public function testDbValidate()
    {
        $data = ['table' => 'Gearit', 'columns' => [***REMOVED******REMOVED***;

        $db = new \GearJson\Db\Db($data);

        $this->dbSchema->dbExist('Gearing', $db)->willReturn(false)->shouldBeCalled();

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Controller Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();

        $this->dbService->create($data)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
db:
  0:
    table: Gearit
    columns: [***REMOVED***

EOS
            ));


        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertEquals(
            sprintf(ConstructService::DB_VALIDATE, 'Gearit'),
            $constructed['invalid-msg'***REMOVED***[0***REMOVED***
        );

        $this->assertEquals(
            'Controller Gearing está com dados errados',
            $constructed['invalid-msg'***REMOVED***[1***REMOVED***
        );
    }

    public function testConstructAll()
    {

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gear
src: [***REMOVED***
db: [***REMOVED***
controller: [***REMOVED***
app: [***REMOVED***

EOS
        ));

        $module = 'ConstructIt';
        $basepath = '/var/www/test';
        $config = null;

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertArrayHasKey('module', $constructed);

    }



    public function testEmptyConstruct()
    {

        $this->construct->setConfigLocation($this->mockGearfileIO());

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertArrayHasKey('module', $constructed);
    }

    public function testSetConfigLocation()
    {
        $file = vfsStream::url('basepath/file.yml');

        file_put_contents($file, '');

        $expected = 'file.yml';

        $this->construct->setConfigLocation($expected);

        $this->assertEquals('vfs://basepath/file.yml', $this->construct->getConfigLocation());
    }



    public function testGetGearfileConfigNotFoundException()
    {
        $this->setExpectedException('Gear\Module\Exception\GearfileNotFoundException');
        $this->construct->setConfigLocation('/my-wrong/folder');
    }

    /**
     * @group c1
     */
    public function testSetConfigLocationSetDefaultLocation()
    {
        $this->construct->setConfigLocation('');

        $this->assertEquals('gearfile.yml', $this->construct->getConfigLocation());
    }

    /**
     * @group c1
     */
    public function testGetGearFileFromLocation()
    {
        $this->construct->setConfigLocation($this->mockGearfileIO());

        $config = $this->construct->getGearfileConfig();

        $this->assertTrue(is_array($config));
    }

    public function testDefaultLocation()
    {
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $module->getMainFolder()->willReturn('whatthafuck');


        $this->construct->setModule($module->reveal());
        $default = $this->construct->getDefaultLocation();

        $this->assertStringEndsWith('gearfile.yml', $default);

    }

    /**
     * @group fix
     */
    public function testLoadGearfileConfig()
    {
        $file = $this->mockGearfileIO();

        $this->assertFileExists($file);

        $this->construct->setConfigLocation($file);

        $gearfile = $this->construct->getGearfileConfig();

        $this->assertEquals(
            [
                'module' => 'Gear',
                'db' => [***REMOVED***,
                'src' => [***REMOVED***,
                'controller' => [***REMOVED***,
                'app' => [***REMOVED***
            ***REMOVED***,
            $gearfile
        );

    }


    public function mockGearfileIO($gearfileConfig = null)
    {

        $gearfile = vfsStream::url(self::GEARFILE_URL);

        if ($gearfileConfig == null) {

            $gearfileConfig = <<<EOS

module: Gear
src: [***REMOVED***
db: [***REMOVED***
controller: [***REMOVED***
app: [***REMOVED***

EOS;

        }

        file_put_contents($gearfile, $gearfileConfig);

        //var_dump($gearfile);

        return vfsStream::url(self::GEARFILE_URL);
    }
}