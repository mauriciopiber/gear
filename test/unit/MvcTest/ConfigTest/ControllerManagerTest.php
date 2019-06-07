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

    public function setUp() : void
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



        $expected = $this->template.'/controller.config.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
