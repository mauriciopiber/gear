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
use GearJson\Controller\Controller as ControllerObject;
use GearJson\Action\Action as ActionObject;

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

        $this->construct = new ConstructService(
            $this->dbSchema->reveal(),
            $this->srcSchema->reveal(),
            $this->appSchema->reveal(),
            $this->controllerSchema->reveal(),
            $this->actionSchema->reveal(),
            $this->dbService->reveal(),
            $this->srcService->reveal(),
            $this->appService->reveal(),
            $this->controllerService->reveal(),
            $this->actionService->reveal()
        );
        $this->construct->setBaseDir($this->basepath);
        //schema

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
     * @group integration
     *
     * Checklist
     *
     * 1. Src [ok,validate,duplicated***REMOVED***
     * 1. Src Entity [ok,validate,duplicated***REMOVED***
     * 1. Src Additional [ok,validate,duplicated***REMOVED***
     * 1. Controller  [ok,validate,duplicated***REMOVED***
     * 1. Action  [ok,validate,duplicated***REMOVED***
     * 1. Db [ok,validate,duplicated***REMOVED***
     * 1. App [ok,validate,duplicated***REMOVED***
     */
    public function testIntegration()
    {
        //src create
        $data = ['name' => 'MyService', 'type' => 'Service'***REMOVED***;

        $src = new Src($data);
        $this->srcSchema->srcExist('Gearing', $src)->willReturn(false)->shouldBeCalled();
        $this->srcSchema->factory('Gearing', $data, false)->willReturn($src)->shouldBeCalled();
        $this->srcService->create($src->export())->willReturn(true)->shouldBeCalled();


        //src exist
        $data = ['name' => 'AlreadyExist', 'type' => 'Service'***REMOVED***;

        $src = new Src($data);

        $this->srcSchema->factory('Gearing', $data, false)->willReturn($src)->shouldBeCalled();
        $this->srcSchema->srcExist('Gearing', $src)->willReturn(true)->shouldBeCalled();


        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: MyService
    type: Service
  1:
    name: AlreadyExist
    type: Service
EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertNotEmpty($constructed->getCreated());

        $this->assertEquals(
            [
                sprintf(ConstructService::SRC_CREATED, 'MyService', 'Service')
            ***REMOVED***,
            $constructed->getCreated()
        );

        $this->assertEquals(
            [
                sprintf(ConstructService::SRC_SKIP, 'AlreadyExist', 'Service')
            ***REMOVED***,
            $constructed->getSkipped()
        );

        $this->assertEquals(
            [
            ***REMOVED***,
            $constructed->getValidated()
        );
    }

    /**
     * @group mm1
     */
    public function testSrcCreate()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        $src = new Src($data);

        $this->srcSchema->srcExist('Gearing', $src)->willReturn(false)->shouldBeCalled();
        $this->srcSchema->factory('Gearing', $data, false)->willReturn($src)->shouldBeCalled();

        $this->srcService->create($src->export())->willReturn(true)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
        ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertNotEmpty($constructed->getCreated());

        $this->assertEquals(
            $constructed->getCreated()[0***REMOVED***,
            sprintf(ConstructService::SRC_CREATED, 'Gearing', 'Service')
        );
    }

    /**
     * @group mm1
     */
    public function testSrcDuplicade()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        $src = new Src($data);

        $this->srcSchema->factory('Gearing', $data, false)->willReturn($src)->shouldBeCalled();

        $this->srcSchema->srcExist('Gearing', $src)->willReturn(true)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertNotEmpty($constructed->getSkipped());

        $this->assertEquals(
            $constructed->getSkipped()[0***REMOVED***,
            sprintf(ConstructService::SRC_SKIP, 'Gearing', 'Service')
        );

    }



    /**
     * @group mm1
     * @group mm3
     */
    public function testSrcWithTrait()
    {
        $data = ['name' => 'Gearing', 'type' => 'Trait'***REMOVED***;

        $src = new Src($data);

        //$this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcService->createAdditional([$data***REMOVED***)->willReturn([
            'created' => [$src***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Trait

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertNotEmpty($constructed->getCreated());

        $this->assertEquals(
            $constructed->getCreated()[0***REMOVED***,
            sprintf(ConstructService::SRC_CREATED, 'Gearing', 'Trait')
        );
    }

    /**
     * @group mm1
     * @group mm3
     */
    public function testSrcWithFactory()
    {
        $data = ['name' => 'Gearing', 'type' => 'Factory'***REMOVED***;

        $src = new Src($data);

        //$this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcService->createAdditional([$data***REMOVED***)->willReturn([
            'created' => [$src***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Factory

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertNotEmpty($constructed->getCreated());

        $this->assertEquals(
            $constructed->getCreated()[0***REMOVED***,
            sprintf(ConstructService::SRC_CREATED, 'Gearing', 'Factory')
        );
    }

    /**
     * @group mm1
     * @group mm3
     */
    public function testSrcWithEntity()
    {
        $data = ['name' => 'Gearing', 'type' => 'Entity'***REMOVED***;

        $src = new Src($data);

        //$this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcService->createEntities([$data***REMOVED***)->willReturn([
            'created' => [$src***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Entity

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertNotEmpty($constructed->getCreated());

        $this->assertEquals(
            $constructed->getCreated()[0***REMOVED***,
            sprintf(ConstructService::SRC_CREATED, 'Gearing', 'Entity')
        );
    }

    /**
     * @group z1
     * @group mm1
     * @group mm2
     */
    public function testSrcValidate()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        //$srcschema = $this->prophesize('GearJson\Src\SrcService');

        //$src = new \GearJson\Src\Src($data);

        //$srcschema->srcExist('Gearing', $src)->willReturn(false)->shouldBeCalled();

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Src Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();

        $this->srcSchema->factory('Gearing', $data, false)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();

        //$this->construct->setSrcService($srcschema->reveal());

        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
            ));

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertNotEmpty($constructed->getValidated());

        $this->assertEquals(
            $constructed->getValidated()[0***REMOVED***,
            sprintf(ConstructService::SRC_VALIDATE, 'Gearing', 'Service')
        );

        $this->assertEquals(
            $constructed->getValidated()[1***REMOVED***,
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


        $this->assertEquals($constructed->getSkipped()[0***REMOVED***, 'App nome "Gearing" do tipo "Service" já existe.');
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


        $this->assertEquals($constructed->getCreated()[0***REMOVED***, 'App nome "Gearing" do tipo "Service" criado.');
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


        $this->assertEquals($constructed->getCreated()[0***REMOVED***, 'Controller "Gearing" criado.');
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

        $this->assertCount(1, $constructed->getSkipped());
        $this->assertEquals($constructed->getSkipped()[0***REMOVED***, 'Controller "Gearing" já existe.');
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
            $constructed->getValidated()[0***REMOVED***,
            sprintf(ConstructService::CONTROLLER_VALIDATE, 'Gearing')
        );
    }

    /**
     * @group aaaa1
     * @group ac1
     * @group ac2
     */
    public function testActionCreateInAnExistingController()
    {
        //set expected config to be build
        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    service: invokables
    actions:
      0:
        name: GearIt

EOS
            ));

        //instanciate controller
        $data = [
            'name' => 'Gearing',
            'service' => 'invokables',
        ***REMOVED***;

        $controller = new ControllerObject($data);

        //check into schema if controller already exist, will return false.
        $this->controllerSchema->controllerExist('Gearing', $controller)->willReturn(true)->shouldBeCalled();


        //instanciate action
        $action = new ActionObject(
            [
                'name' => 'GearIt',
                'controller' => $controller
            ***REMOVED***
        );

        //check into schema if action already exist, will return false.
        $this->actionSchema->actionExist('Gearing', $action)->willReturn(false);

        //create the action
        $this->actionService->createControllerAction(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***)->willReturn(true);

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertCount(1, $constructed->getCreated());
        $this->assertEquals($constructed->getCreated()[0***REMOVED***, 'Action "GearIt" do Controller "Gearing" criado.');
    }

    /**
     * @group aaaa1
     * @group aaaa2
     * @group ac1
     * @group ac2
     */
    public function testActionCreateInAnNotExistingController()
    {
        //set expected config to be build
        $this->construct->setConfigLocation($this->mockGearfileIO(<<<EOS

module: Gearing
controller:
  0:
    name: Gearing
    service: invokables
    actions:
      0:
        name: GearIt

EOS
        ));



        //instanciate controller
        $data = [
            'name' => 'Gearing',
            'service' => 'invokables',
        ***REMOVED***;

        $controller = new ControllerObject($data);

        //check into schema if controller already exist, will return false.
        $this->controllerSchema->controllerExist('Gearing', $controller)->willReturn(false)->shouldBeCalled();

        //creates the controller, return true now but will be fixed
        /**
         * @TODO FIX
         */
        $this->controllerService->createController($data)->willReturn(true)->shouldBeCalled();


        $dataMirror = $data;
        unset($dataMirror['actions'***REMOVED***);
        $controllerMirror = new ControllerObject($data);

        //instanciate action
        $action = new ActionObject(
            [
                'name' => 'GearIt',
                'controller' => $controllerMirror
            ***REMOVED***
        );

        //check into schema if action already exist, will return false.
        $this->actionSchema->actionExist('Gearing', $action)->willReturn(false)->shouldBeCalled();

        //create the action
        $this->actionService->createControllerAction(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***)->willReturn(true)->shouldBeCalled();;

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertCount(2, $constructed->getCreated());
        $this->assertEquals($constructed->getCreated()[1***REMOVED***, 'Action "GearIt" do Controller "Gearing" criado.');
    }

    /**
     * @group z4
     * @group ac1
     * @group ac2
     */
    public function testActionDuplicade()
    {
        //controller
        $data = [
            'name' => 'Gearing',
            'object' => '%s\Controller\Gearing',
            'service' => 'invokables',
        ***REMOVED***;

        $controller = new \GearJson\Controller\Controller($data);



        $controllerschema = $this->prophesize('GearJson\Controller\ControllerService');
        $controllerschema->controllerExist('Gearing', $controller)->willReturn(false);

        $controllerservice = $this->prophesize('Gear\Constructor\Controller\ControllerService');
        $controllerservice->createController($data)->willReturn(true);

        $this->construct->setControllerConstructor($controllerservice->reveal());
        $this->construct->setControllerService($controllerschema->reveal());


        $data = array_merge($data, [
            'actions' => [
                ['name' => 'GearIt'***REMOVED***
            ***REMOVED***
        ***REMOVED***);

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

        $this->assertCount(1, $constructed->getSkipped());
        $this->assertEquals($constructed->getSkipped()[0***REMOVED***, 'Action "GearIt" do Controller "Gearing" já existe.');
    }

    /**
     * @group z4
     * @group z41
     * @group ac1
     * @group ac2
     */
    public function testActionValidate()
    {
        $data = [
            'name' => 'Gearing',
            'object' => '%s\Controller\Gearing',
            'service' => 'invokables',
        ***REMOVED***;

        $controller = new \GearJson\Controller\Controller($data);

        $this->controllerSchema->controllerExist('Gearing', $controller)->willReturn(false)->shouldBeCalled();

        $this->controllerService->createController($data)->willReturn(true)->shouldBeCalled();



        $data = array_merge($data, [
            'actions' => [
                ['name' => 'GearIt'***REMOVED***
            ***REMOVED***
        ***REMOVED***);
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

        $this->assertCount(2, $constructed->getValidated());
        $this->assertEquals(
            sprintf(ConstructService::ACTION_VALIDATE, 'GearIt', 'Gearing'),
            $constructed->getValidated()[0***REMOVED***
        );

        $this->assertEquals(
            'Controller Gearing está com dados errados',
            $constructed->getValidated()[1***REMOVED***
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


        $this->assertEquals($constructed->getCreated()[0***REMOVED***, 'Db tabela "Gearit" criado.');
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


        $this->assertCount(1, $constructed->getSkipped());
        $this->assertEquals($constructed->getSkipped()[0***REMOVED***, 'Db tabela "Gearit" já existe.');

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
            $constructed->getValidated()[0***REMOVED***
        );

        $this->assertEquals(
            'Controller Gearing está com dados errados',
            $constructed->getValidated()[1***REMOVED***
        );
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


        return vfsStream::url(self::GEARFILE_URL);
    }
}