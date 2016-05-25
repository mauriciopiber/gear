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

        $construct = new \Gear\Module\ConstructService();

        //schema
        $construct->setDbService($dbschema->reveal());
        $construct->setSrcService($srcschema->reveal());
        $construct->setControllerService($controllerschema->reveal());
        $construct->setActionService($actionschema->reveal());
        $construct->setAppService($appschema->reveal());

        //constructor
        $construct->setDbConstructor($dbservice->reveal());
        $construct->setSrcConstructor($srcservice->reveal());
        $construct->setAppConstructor($appservice->reveal());
        $construct->setControllerConstructor($controllerservice->reveal());
        $construct->setActionConstructor($actionservice->reveal());

        $this->assertEquals($construct->getDbService(), $dbschema->reveal());
        $this->assertEquals($construct->getSrcService(), $srcschema->reveal());
        $this->assertEquals($construct->getAppService(), $appschema->reveal());
        $this->assertEquals($construct->getActionService(), $actionschema->reveal());
        $this->assertEquals($construct->getControllerService(), $controllerschema->reveal());

        $this->assertEquals($construct->getDbConstructor(), $dbservice->reveal());
        $this->assertEquals($construct->getSrcConstructor(), $srcservice->reveal());
        $this->assertEquals($construct->getAppConstructor(), $appservice->reveal());
        $this->assertEquals($construct->getControllerConstructor(), $controllerservice->reveal());
        $this->assertEquals($construct->getActionConstructor(), $actionservice->reveal());
    }


    public function testSrcCreate()
    {
        $construct = new \Gear\Module\ConstructService();

        $data = ['name' => 'Gearing', 'type' => 'Service'***REMOVED***;


        $src = new \GearJson\Src\Src($data);

        $srcschema = $this->prophesize('GearJson\Src\SrcService');
        $srcschema->srcExist('Gearing', $src)->willReturn(false);

        $srcservice = $this->prophesize('Gear\Constructor\Src\SrcService');
        $srcservice->create($data)->willReturn(true);

        $construct->setSrcConstructor($srcservice->reveal());
        $construct->setSrcService($srcschema->reveal());

        $construct->setConfigLocation($this->gearfileHelper(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
            ));

        $module = 'Gearing';
        $basepath = '/var/www/test';
        $config = null;


        $constructed = $construct->construct($module, $basepath, $config);

        $this->assertEquals($constructed['created'***REMOVED***, 1);

        $this->assertEquals($constructed['skipped'***REMOVED***, 0);
        $this->assertEquals($constructed['created-msg'***REMOVED***[0***REMOVED***, 'Src nome "Gearing" do tipo "Service" criado.');
    }

    public function testSrcDuplicade()
    {
        $construct = new \Gear\Module\ConstructService();

        $srcschema = $this->prophesize('GearJson\Src\SrcService');

        $src = new \GearJson\Src\Src(['name' => 'Gearing', 'type' => 'Service'***REMOVED***);

        $srcschema->srcExist('Gearing', $src)->willReturn(true);

        $construct->setSrcService($srcschema->reveal());

        $construct->setConfigLocation($this->gearfileHelper(<<<EOS

module: Gearing
src:
  0:
    name: Gearing
    type: Service

EOS
            ));

        $module = 'Gearing';
        $basepath = '/var/www/test';
        $config = null;


        $constructed = $construct->construct($module, $basepath, $config);

        $this->assertEquals($constructed['created'***REMOVED***, 0);
        $this->assertEquals($constructed['skipped'***REMOVED***, 1);
        $this->assertEquals($constructed['skipped-msg'***REMOVED***[0***REMOVED***, 'Src nome "Gearing" do tipo "Service" já existe.');

    }


    /*
    public function testDbAlreadyExists()
    {
        $construct = new \Gear\Module\ConstructService();
        $construct->setConfigLocation($this->gearfileHelper(<<<EOS

module: Gear
db: [
  table: 'exist'
  columns: [***REMOVED***
***REMOVED***

EOS
        ));

        //set module json


    }
    */


    public function testConstructAll()
    {
        $construct = new \Gear\Module\ConstructService();
        $construct->setConfigLocation($this->gearfileHelper(<<<EOS

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

        $constructed = $construct->construct($module, $basepath, $config);

        $this->assertArrayHasKey('module', $constructed);

    }



    public function testEmptyConstruct()
    {
        $construct = new \Gear\Module\ConstructService();
        $construct->setConfigLocation($this->gearfileHelper());

        $module = 'ConstructIt';
        $basepath = '/var/www/test';
        $config = null;

        $constructed = $construct->construct($module, $basepath, $config);

        $this->assertArrayHasKey('module', $constructed);
    }

    public function testLoadJsonConfig()
    {

    }

    public function testSetConfigLocation()
    {
        $expected = 'config-location';

        $construct = new \Gear\Module\ConstructService();
        $construct->setConfigLocation($expected);

        $this->assertEquals($expected, $construct->getConfigLocation());
    }

    public function testGetGearfileConfigNotFoundException()
    {
        $construct = new \Gear\Module\ConstructService();
        $construct->setConfigLocation('/my-wrong/folder');

        $this->setExpectedException('Gear\Module\Exception\GearfileNotFoundException');

        $construct->getGearfileConfig();
    }

    public function testDefaultLocation()
    {
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $module->getMainFolder()->willReturn('whatthafuck');

        $construct = new \Gear\Module\ConstructService();
        $construct->setModule($module->reveal());
        $default = $construct->getDefaultLocation();

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

        $construct = new \Gear\Module\ConstructService();
        $construct->setConfigLocation($this->gearfileHelper());

        $gearfile = $construct->getGearfileConfig();

        $this->assertArrayHasKey('module', $gearfile);
        $this->assertArrayHasKey('db', $gearfile);
        $this->assertArrayHasKey('src', $gearfile);
        $this->assertArrayHasKey('app', $gearfile);
        $this->assertArrayHasKey('controller', $gearfile);

    }

}