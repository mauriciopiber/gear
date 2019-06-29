<?php
namespace GearTest\MvcTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Vector\ArrayService;
use Gear\Util\String\StringService;
use Gear\Schema\Controller\Controller;
use Gear\Mvc\Config\ControllerManager;
use Gear\Module;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\UtilTestTrait;
use Gear\Mvc\LanguageService;
use Gear\Util\Dir\DirService;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-config
 * @group module-mvc-config-controller
 */
class ControllerManagerTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/config/ext');

        $this->string = new StringService();

        $this->fileCreator  = $this->createFileCreator();

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->code = $this->createCode();
        //$code->setModule($this->module->reveal());

        $this->arrayService = new ArrayService();


        $this->controllerManager  = new ControllerManager(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->code,
            $this->arrayService,
            $this->prophesize(LanguageService::class)->reveal()
        );

        $this->template = (new Module())->getLocation().'/../test/template/module/config';
    }


    public function testCreateControllerNamespace()
    {
      $controller = new Controller([
        'name' => 'MyController',
        'type' => 'Action',
        'service' => 'factories',
        'namespace' => 'MyNamespace'
        ***REMOVED***);

        file_put_contents(vfsStream::url('module/config/ext/controller.config.php'), <<<EOS
        <?php return array (
          'invokables' =>
          array (
            'MyModule\Controller\Index' => 'MyModule\Controller\IndexController',
          ),
        );
EOS
      );


      //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
      $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

      $expected = [
        'invokables' => [
          'MyModule\Controller\Index' => 'MyModule\Controller\IndexController',
        ***REMOVED***,
        'factories' => [
          'MyModule\MyNamespace\My' => 'MyModule\MyNamespace\MyControllerFactory',
        ***REMOVED***,
      ***REMOVED***;

      $this->assertTrue($this->controllerManager->create($controller));

      $result = include vfsStream::url('module/config/ext/controller.config.php');
      $this->assertEquals($result, $expected);


    }


    public function testCreateController()
    {
      $controller = new Controller([
        'name' => 'MyController',
        'type' => 'Action',
        'service' => 'factories'
      ***REMOVED***);

      file_put_contents(vfsStream::url('module/config/ext/controller.config.php'), <<<EOS
      <?php return array (
        'invokables' =>
        array (
          'MyModule\Controller\Index' => 'MyModule\Controller\IndexController',
        ),
      );
EOS
      );

      //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
      $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();


      $expected = [
        'invokables' => [
          'MyModule\Controller\Index' => 'MyModule\Controller\IndexController',
        ***REMOVED***,
        'factories' => [
          'MyModule\Controller\My' => 'MyModule\Controller\MyControllerFactory',
        ***REMOVED***,
      ***REMOVED***;

      $this->assertTrue($this->controllerManager->create($controller));

      $result = include vfsStream::url('module/config/ext/controller.config.php');
      $this->assertEquals($result, $expected);
    }

    public function testCreateModuleControllerConfig()
    {
        $controllers = [
          "MyModule\Controller\IndexController" => "MyModule\Controller\IndexControllerFactory"
        ***REMOVED***;

        $file = $this->controllerManager->module($controllers);
        //$this->assertTrue($this->controllerManager->create($controller));
        $expected = $this->template.'/controller.config.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
