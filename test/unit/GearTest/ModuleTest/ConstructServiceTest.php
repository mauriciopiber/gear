<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

/**
 * @group Module
 * @group ModuleConstruct
 */
class ConstructServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->module = 'Gearing';
        $this->basepath = '/var/www/test';
        $this->config = null;

        $this->construct = new \Gear\Module\ConstructService();
    }

    public function testGetSchemaServices()
    {
        $dbschema = $this->prophesize('GearJson\Db\DbService');
        $srcschema = $this->prophesize('GearJson\Src\SrcService');
        $controllerschema = $this->prophesize('GearJson\Controller\ControllerService');
        $actionschema = $this->prophesize('GearJson\Action\ActionService');
        $appschema = $this->prophesize('GearJson\App\AppService');


        $dbservice = $this->prophesize('Gear\Constructor\Db\DbService');
        $srcservice = $this->prophesize('Gear\Constructor\Src\SrcService');
        $controllerservice = $this->prophesize('Gear\Constructor\Controller\ControllerService');
        $actionservice = $this->prophesize('Gear\Constructor\Action\ActionService');
        $appservice = $this->prophesize('Gear\Constructor\App\AppService');

        //schema
        $this->construct->setDbService($dbschema->reveal());
        $this->construct->setSrcService($srcschema->reveal());
        $this->construct->setControllerService($controllerschema->reveal());
        $this->construct->setActionService($actionschema->reveal());
        $this->construct->setAppService($appschema->reveal());

        //constructor
        $this->construct->setDbConstructor($dbservice->reveal());
        $this->construct->setSrcConstructor($srcservice->reveal());
        $this->construct->setAppConstructor($appservice->reveal());
        $this->construct->setControllerConstructor($controllerservice->reveal());
        $this->construct->setActionConstructor($actionservice->reveal());

        $this->assertEquals($this->construct->getDbService(), $dbschema->reveal());
        $this->assertEquals($this->construct->getSrcService(), $srcschema->reveal());
        $this->assertEquals($this->construct->getAppService(), $appschema->reveal());
        $this->assertEquals($this->construct->getActionService(), $actionschema->reveal());
        $this->assertEquals($this->construct->getControllerService(), $controllerschema->reveal());

        $this->assertEquals($this->construct->getDbConstructor(), $dbservice->reveal());
        $this->assertEquals($this->construct->getSrcConstructor(), $srcservice->reveal());
        $this->assertEquals($this->construct->getAppConstructor(), $appservice->reveal());
        $this->assertEquals($this->construct->getControllerConstructor(), $controllerservice->reveal());
        $this->assertEquals($this->construct->getActionConstructor(), $actionservice->reveal());
    }


    public function testSrcCreate()
    {
        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;

        $src = new \GearJson\Src\Src($data);

        $srcschema = $this->prophesize('GearJson\Src\SrcService');
        $srcschema->srcExist('Gearing', $src)->willReturn(false);

        $srcservice = $this->prophesize('Gear\Constructor\Src\SrcService');
        $srcservice->create($data)->willReturn(true);

        $this->construct->setSrcConstructor($srcservice->reveal());
        $this->construct->setSrcService($srcschema->reveal());

        $this->construct->setConfigLocation($this->gearfileHelper(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
            ));


        $constructed = $this->construct->construct($this->module, $this->basepath, $this->config);


        $this->assertEquals($constructed['created-msg'***REMOVED***[0***REMOVED***, 'Src nome "Gearing" do tipo "Service" criado.');
    }

    public function testSrcDuplicade()
    {
        $srcschema = $this->prophesize('GearJson\Src\SrcService');

        $src = new \GearJson\Src\Src(['name' => 'Gearing', 'type' => 'Service'***REMOVED***);

        $srcschema->srcExist('Gearing', $src)->willReturn(true);

        $this->construct->setSrcService($srcschema->reveal());

        $this->construct->setConfigLocation($this->gearfileHelper(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
        ));

        $constructed = $this->construct->construct($this->module, $this->basepath, $this->config);


        $this->assertEquals($constructed['skipped-msg'***REMOVED***[0***REMOVED***, 'Src nome "Gearing" do tipo "Service" já existe.');

    }


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

        $this->construct->setConfigLocation($this->gearfileHelper(<<<EOS

module: Gearing
db:
  0:
    table: Gearit
    columns: [***REMOVED***

EOS
        ));


        $constructed = $this->construct->construct($this->module, $this->basepath, $this->config);


        $this->assertEquals($constructed['created-msg'***REMOVED***[0***REMOVED***, 'Db tabela "Gearit" criado.');
    }

    public function testDbDuplicade()
    {
        $dbschema = $this->prophesize('GearJson\Db\DbService');

        $db = new \GearJson\Db\Db(['table' => 'Gearit', 'columns' => [***REMOVED******REMOVED***);

        $dbschema->dbExist('Gearing', $db)->willReturn(true);

        $this->construct->setDbService($dbschema->reveal());

        $this->construct->setConfigLocation($this->gearfileHelper(<<<EOS

module: Gearing
db:
  0:
    table: Gearit
    columns: [***REMOVED***

EOS
        ));

        $constructed = $this->construct->construct($this->module, $this->basepath, $this->config);


        $this->assertCount(1, $constructed['skipped-msg'***REMOVED***);
        $this->assertEquals($constructed['skipped-msg'***REMOVED***[0***REMOVED***, 'Db tabela "Gearit" já existe.');

    }

    public function testConstructAll()
    {

        $this->construct->setConfigLocation($this->gearfileHelper(<<<EOS

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

        $constructed = $this->construct->construct($this->module, $this->basepath, $this->config);

        $this->assertArrayHasKey('module', $constructed);

    }



    public function testEmptyConstruct()
    {

        $this->construct->setConfigLocation($this->gearfileHelper());

        $constructed = $this->construct->construct($this->module, $this->basepath, $this->config);

        $this->assertArrayHasKey('module', $constructed);
    }

    public function testLoadJsonConfig()
    {

    }

    public function testSetConfigLocation()
    {
        $expected = 'config-location';


        $this->construct->setConfigLocation($expected);

        $this->assertEquals($expected, $this->construct->getConfigLocation());
    }

    public function testGetGearfileConfigNotFoundException()
    {

        $this->construct->setConfigLocation('/my-wrong/folder');

        $this->setExpectedException('Gear\Module\Exception\GearfileNotFoundException');

        $this->construct->getGearfileConfig();
    }

    public function testDefaultLocation()
    {
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $module->getMainFolder()->willReturn('whatthafuck');


        $this->construct->setModule($module->reveal());
        $default = $this->construct->getDefaultLocation();

        $this->assertStringEndsWith('gearfile.yml', $default);

    }


    public function gearfileHelper($gearfileConfig = null)
    {
        $root = vfsStream::setup('module');

        $gearfile = vfsStream::url('module/gearfile.yml');

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

        return $gearfile;
    }

    public function testLoadGearfileConfig()
    {
        //gearfile
        $this->construct->setConfigLocation($this->gearfileHelper());

        $gearfile = $this->construct->getGearfileConfig();

        $this->assertArrayHasKey('module', $gearfile);
        $this->assertArrayHasKey('db', $gearfile);
        $this->assertArrayHasKey('src', $gearfile);
        $this->assertArrayHasKey('app', $gearfile);
        $this->assertArrayHasKey('controller', $gearfile);

    }

}