<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Module\ConstructService;
use GearJson\Db\DbSchema;
use GearJson\Src\SrcSchema;
use GearJson\Controller\ControllerSchema;
use GearJson\Action\ActionSchema;
use GearJson\App\AppService as SchemaAppService;
use Gear\Constructor\Db\DbConstructor;
use Gear\Constructor\Src\SrcConstructor;
use Gear\Constructor\Controller\ControllerConstructor;
use Gear\Constructor\Action\ActionConstructor;
use Gear\Constructor\App\AppService;
use GearJson\Src\Src;
use GearJson\Db\Db;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use GearJson\Controller\Controller as ControllerObject;
use GearJson\Action\Action as ActionObject;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Construct
 */
class ConstructServiceTest extends TestCase
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

        $this->dbSchema = $this->prophesize(DbSchema::class);
        $this->srcSchema = $this->prophesize(SrcSchema::class);
        $this->controllerSchema = $this->prophesize(ControllerSchema::class);
        $this->actionSchema = $this->prophesize(ActionSchema::class);
        $this->appSchema = $this->prophesize(SchemaAppService::class);


        $this->dbConstructor = $this->prophesize(DbConstructor::class);
        $this->srcConstructor = $this->prophesize(SrcConstructor::class);
        $this->controllerConstructor = $this->prophesize(ControllerConstructor::class);
        $this->actionConstructor = $this->prophesize(ActionConstructor::class);
        $this->appService = $this->prophesize(AppService::class);

        $this->construct = new ConstructService(
            $this->dbSchema->reveal(),
            $this->srcSchema->reveal(),
            $this->appSchema->reveal(),
            $this->controllerSchema->reveal(),
            $this->actionSchema->reveal(),
            $this->dbConstructor->reveal(),
            $this->srcConstructor->reveal(),
            $this->appService->reveal(),
            $this->controllerConstructor->reveal(),
            $this->actionConstructor->reveal()
        );
        $this->construct->setBaseDir($this->basepath);
        //schema

    }

    public function testGetSchemaServices()
    {
        $this->assertEquals($this->construct->getAppService(), $this->appSchema->reveal());
        $this->assertEquals($this->construct->getDbSchema(), $this->dbSchema->reveal());
        $this->assertEquals($this->construct->getSrcSchema(), $this->srcSchema->reveal());
        $this->assertEquals($this->construct->getActionSchema(), $this->actionSchema->reveal());
        $this->assertEquals($this->construct->getControllerSchema(), $this->controllerSchema->reveal());

        $this->assertEquals($this->construct->getDbConstructor(), $this->dbConstructor->reveal());
        $this->assertEquals($this->construct->getSrcConstructor(), $this->srcConstructor->reveal());
        $this->assertEquals($this->construct->getAppConstructor(), $this->appService->reveal());
        $this->assertEquals($this->construct->getControllerConstructor(), $this->controllerConstructor->reveal());
        $this->assertEquals($this->construct->getActionConstructor(), $this->actionConstructor->reveal());
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
        $this->srcConstructor->create($src->export())->willReturn(true)->shouldBeCalled();


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

        $this->srcConstructor->create($src->export())->willReturn(true)->shouldBeCalled();

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
     * @group src
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
     * @group src
     */
    public function testSrcWithTrait()
    {
        $data = ['name' => 'Gearing', 'type' => 'Trait'***REMOVED***;

        $src = new Src($data);

        //$this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcConstructor->createAdditional([$data***REMOVED***)->willReturn([
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
     * @group src
     */
    public function testSrcWithFactory()
    {
        $data = ['name' => 'Gearing', 'type' => 'Factory'***REMOVED***;

        $src = new Src($data);

        //$this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcConstructor->createAdditional([$data***REMOVED***)->willReturn([
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
     * @group src
     */
    public function testSrcWithEntity()
    {
        $data = ['name' => 'Gearing', 'type' => 'Entity'***REMOVED***;

        $src = new Src($data);

        //$this->srcSchema->srcExist('Gearing', $src)->willReturn(false);

        $this->srcConstructor->createEntities([$data***REMOVED***)->willReturn([
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
     * @group src
     */
    public function testSrcValidate()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        //$srcschema = $this->prophesize('GearJson\Src\SrcSchema');

        //$src = new \GearJson\Src\Src($data);

        //$srcschema->srcExist('Gearing', $src)->willReturn(false)->shouldBeCalled();

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Src Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();

        $this->srcSchema->factory('Gearing', $data, false)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();

        //$this->construct->setSrcConstructor($srcschema->reveal());

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

        $controllerschema = $this->prophesize('GearJson\Controller\ControllerSchema');
        $controllerschema->controllerExist('Gearing', $controller)->willReturn(false);

        $controllerservice = $this->prophesize('Gear\Constructor\Controller\ControllerConstructor');
        $controllerservice->createController($data)->willReturn(true);

        $this->construct->setControllerConstructor($controllerservice->reveal());
        $this->construct->setControllerSchema($controllerschema->reveal());

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
        $controllerschema = $this->prophesize('GearJson\Controller\ControllerSchema');

        $controller = new \GearJson\Controller\Controller(['name' => 'Gearing', 'object' => '%s\Controller\Gearing'***REMOVED***);

        $controllerschema->controllerExist('Gearing', $controller)->willReturn(true);

        $this->construct->setControllerSchema($controllerschema->reveal());

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

        $this->controllerConstructor->createController($data)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();


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
        $this->actionConstructor->createControllerAction(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***)->willReturn(true);

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
        $this->controllerConstructor->createController($data)->willReturn(true)->shouldBeCalled();


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
        $this->actionConstructor->createControllerAction(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***)->willReturn(true)->shouldBeCalled();;

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



        $controllerschema = $this->prophesize('GearJson\Controller\ControllerSchema');
        $controllerschema->controllerExist('Gearing', $controller)->willReturn(false);

        $controllerservice = $this->prophesize('Gear\Constructor\Controller\ControllerConstructor');
        $controllerservice->createController($data)->willReturn(true);

        $this->construct->setControllerConstructor($controllerservice->reveal());
        $this->construct->setControllerSchema($controllerschema->reveal());


        $data = array_merge($data, [
            'actions' => [
                ['name' => 'GearIt'***REMOVED***
            ***REMOVED***
        ***REMOVED***);

        //action
        $actionschema = $this->prophesize('GearJson\Action\ActionSchema');

        $action = new \GearJson\Action\Action(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***);
        $actionschema->actionExist('Gearing', $action)->willReturn(true);
        $this->construct->setActionSchema($actionschema->reveal());


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

        $this->controllerConstructor->createController($data)->willReturn(true)->shouldBeCalled();

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


        $this->actionConstructor->createControllerAction(['name' => 'GearIt', 'controller' => 'Gearing'***REMOVED***)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();


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

        const MODULE_GEARING = <<<EOS

module: Gearing
db:
  0:
    table: Gearit
    columns: [***REMOVED***

EOS;

    /**
     * @group db
     */
    public function testDbCreate()
    {
        $data = ['table' => 'Gearit', 'columns' => [***REMOVED******REMOVED***;

        $this->dbSchema->canCreate('Gearing', $data)->willReturn($data)->shouldBeCalled();

        $this->construct->setConfigLocation($this->mockGearfileIO(self::MODULE_GEARING));

        $this->dbConstructor->create($data)->willReturn(new Db($data))->shouldBeCalled();

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);


        $this->assertEquals($constructed->getCreated()[0***REMOVED***, 'Db tabela "Gearit" criado.');
    }


    /**
     * @group db
     * @group db1
     */
    public function testDbDuplicade()
    {
        $this->construct->setConfigLocation($this->mockGearfileIO(self::MODULE_GEARING));

        $data = ['table' => 'Gearit', 'columns' => [***REMOVED******REMOVED***;

        $this->dbSchema->canCreate('Gearing', $data)->willReturn(false)->shouldBeCalled();

        $constructed = $this->construct->construct(self::MODULE_NAME, $this->basepath, $this->config);

        $this->assertCount(1, $constructed->getSkipped());
        $this->assertEquals($constructed->getSkipped()[0***REMOVED***, 'Db tabela "Gearit" já existe.');

    }

    /**
     * @group db
     * @group db1
     */
    public function testDbValidate()
    {
        $this->construct->setConfigLocation($this->mockGearfileIO(self::MODULE_GEARING));

        $data = ['table' => 'Gearit', 'columns' => [***REMOVED******REMOVED***;

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);
        $this->consoleValidation->getErrors()->willReturn([
            'Controller Gearing está com dados errados'
        ***REMOVED***)->shouldBeCalled();


        $this->dbSchema->canCreate('Gearing', $data)->willReturn($this->consoleValidation->reveal())->shouldBeCalled();

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
        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

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