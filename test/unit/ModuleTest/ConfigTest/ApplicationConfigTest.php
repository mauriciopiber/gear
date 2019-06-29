<?php
namespace GearTest\ModuleTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Config\ApplicationConfig;
use Zend\Console\Request;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
//use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group Module
 * @group ApplicationConfig
 */
class ApplicationConfigTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->module = $this->prophesize(ModuleStructure::class);
        $this->request = $this->prophesize(Request::class);
    }

    public function testMissingApplicationConfigOnGetApplicationConfig()
    {
        $root = vfsStream::setup('project');

        $this->applicationConfig = new ApplicationConfig(
            $this->module->reveal(),
            $this->request->reveal()
        );

        $this->applicationConfig->setProject(vfsStream::url('project'));

        $this->expectException('Gear\Module\Config\Exception\MissingApplicationConfig');

        $file = $this->applicationConfig->getApplicationConfig();
    }

    public function testGetApplicationConfig()
    {
        $expected = '<?php return array[***REMOVED***;?>';

        $root = vfsStream::setup('project');
        vfsStream::newDirectory('config')->at($root);
        file_put_contents(vfsStream::url('project/config/application.config.php'), $expected);

        $this->applicationConfig = new ApplicationConfig(
            $this->module->reveal(),
            $this->request->reveal()
        );

        $this->applicationConfig->setProject(vfsStream::url('project'));

        $file = $this->applicationConfig->getApplicationConfig();

        $this->assertEquals(
            $expected,
            file_get_contents($file)
        );
    }

    public function testGetApplicationConfigArray()
    {
        $expected = "<?php return ['data' => 'one', 'date' => ['one' => 'yes', 'two' => 'no'***REMOVED******REMOVED***;?>";

        $root = vfsStream::setup('project');
        vfsStream::newDirectory('config')->at($root);
        file_put_contents(vfsStream::url('project/config/application.config.php'), $expected);

        $this->applicationConfig = new ApplicationConfig(
            $this->module->reveal(),
            $this->request->reveal()
        );
        $this->applicationConfig->setProject(vfsStream::url('project'));

        $array = $this->applicationConfig->getApplicationConfigArray();

        $this->assertEquals(
            ['data' => 'one', 'date' => ['one' => 'yes', 'two' => 'no'***REMOVED******REMOVED***,
            $array
        );
    }

    public function testUnregisterModule()
    {
        $expected = "<?php return array (
  'modules' =>
  array (
      'DoctrineModule',
      'DoctrineORMModule',
      'DoctrineDataFixtureModule',
      'GearBase',
      'Gear\Schema',
      'Gear',
      'GearDeploy',
      'GearJenkins',
      'GearVersion'
  ),
  'module_listener_options' =>
  array (
    'module_paths' =>
    array (
        '../.',
        './vendor',
    ),
    'config_glob_paths' =>
    array (
        'config/autoload/{,*.}{global,local}.php',
    ),
  ),
); ?>
    ";

        $root = vfsStream::setup('project');
        vfsStream::newDirectory('config')->at($root);
        file_put_contents(vfsStream::url('project/config/application.config.php'), $expected);

        $this->applicationConfig = new ApplicationConfig(
            $this->module->reveal(),
            $this->request->reveal()
        );

        $this->applicationConfig->setProject(vfsStream::url('project'));

        $module = $this->prophesize(ModuleStructure::class);
        $module->getModuleName()->willReturn('GearDeploy')->shouldBeCalled();
        $this->applicationConfig->setModule($module->reveal());
        $array = $this->applicationConfig->removeModuleFromProject();

        $this->assertTrue($array);

        $newFile = require vfsStream::url('project/config/application.config.php');

        $this->assertNotContains('GearDeploy', $newFile['modules'***REMOVED***);
    }

    public function testRegisterModule()
    {
        $expected = "<?php return array (
  'modules' =>
  array (
      'DoctrineModule',
      'DoctrineORMModule',
      'DoctrineDataFixtureModule',
      'GearBase',
      'Gear\Schema',
      'Gear',
      'GearDeploy',
      'GearJenkins',
      'GearVersion'
  ),
  'module_listener_options' =>
  array (
    'module_paths' =>
    array (
        '../.',
        './vendor',
    ),
    'config_glob_paths' =>
    array (
        'config/autoload/{,*.}{global,local}.php',
    ),
  ),
); ?>
    ";

        $root = vfsStream::setup('project');
        vfsStream::newDirectory('config')->at($root);
        file_put_contents(vfsStream::url('project/config/application.config.php'), $expected);

        $this->applicationConfig = new ApplicationConfig(
            $this->module->reveal(),
            $this->request->reveal()
        );

        $this->applicationConfig->setProject(vfsStream::url('project'));

        $module = $this->prophesize(ModuleStructure::class);
        $module->getModuleName()->willReturn('MyNewModule')->shouldBeCalled();

        $this->applicationConfig->setModule($module->reveal());
        $array = $this->applicationConfig->addModuleToProject();

        $this->assertTrue($array);

        $newFile = require vfsStream::url('project/config/application.config.php');

        $this->assertContains('MyNewModule', $newFile['modules'***REMOVED***);
    }
}
