<?php
namespace GearTest\MvcTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\UtilTestTrait;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-config
 * @group module-mvc-config-controller
 */
class ControllerManagerTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/config/ext');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \Gear\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $code = new \Gear\Creator\Code();
        $code->setModule($this->module->reveal());

        $array = new \Gear\Util\Vector\ArrayService();

        $this->controllerManager  = new \Gear\Mvc\Config\ControllerManager();
        $this->controllerManager->setFileCreator($this->fileCreator);
        $this->controllerManager->setStringService($this->string);
        $this->controllerManager->setModule($this->module->reveal());
        $this->controllerManager->setCode($code);
        $this->controllerManager->setArrayService($array);

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/config';
    }


    public function testCreateControllerNamespace()
    {
      $controller = new \Gear\Schema\Controller\Controller([
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

      $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

      $this->assertTrue($this->controllerManager->create($controller));

      $expected = [
        'invokables' => [
          'MyModule\Controller\Index' => 'MyModule\Controller\IndexController',
        ***REMOVED***,
        'factories' => [
          'MyModule\MyNamespace\My' => 'MyModule\MyNamespace\MyControllerFactory',
        ***REMOVED***,
      ***REMOVED***;

      $result = include vfsStream::url('module/config/ext/controller.config.php');
      $this->assertEquals($result, $expected);


    }


    public function testCreateController()
    {
      $controller = new \Gear\Schema\Controller\Controller([
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

      $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

      $this->assertTrue($this->controllerManager->create($controller));

      $expected = [
        'invokables' => [
          'MyModule\Controller\Index' => 'MyModule\Controller\IndexController',
        ***REMOVED***,
        'factories' => [
          'MyModule\Controller\My' => 'MyModule\Controller\MyControllerFactory',
        ***REMOVED***,
      ***REMOVED***;

      $result = include vfsStream::url('module/config/ext/controller.config.php');
      $this->assertEquals($result, $expected);


    }

    public function testCreateModuleControllerConfig()
    {
        $controllers = ["MyModule\Controller\IndexController" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;


        $file = $this->controllerManager->module($controllers);

        $expected = $this->template.'/controller.config.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
