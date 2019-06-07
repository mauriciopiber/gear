<?php
namespace GearTest\MvcTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Config\RouterManager;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Gear\Schema\Controller\Controller;
use Gear\Schema\Action\Action;
use GearTest\UtilTestTrait;

/**
 * @group Mvc
 * @group Mvc-Config
 * @group Config
 * @group Router
 */
class RouterManagerTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
      parent::setUp();
      vfsStream::setup('module');

      vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
      vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

      file_put_contents(vfsStream::url('module/config/ext/route.config.php'), <<<EOS
<?php return [
    'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack',
    'routes' => [
        'my-module' => [
            'type' => 'literal',
            'options' => [
                'route' => '/my-module',
                'defaults' => [
                    'controller' => 'MyModule\Controller\Index'
                ***REMOVED***
            ***REMOVED***,
            'may_terminate' => true,
        ***REMOVED***
    ***REMOVED***
***REMOVED***;
EOS
);


      $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
      $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
      $this->module->getModuleName()->willReturn('MyModule');

      $this->string = new \Gear\Util\String\StringService();

      $this->language = $this->prophesize(\Gear\Mvc\LanguageService::class);

      $this->array = new \Gear\Util\Vector\ArrayService();

      $this->code = new \Gear\Creator\Code();
      $this->code->setModule($this->module->reveal());

      $this->router = new \Gear\Mvc\Config\RouterManager();
      $this->router->setModule($this->module->reveal());
      $this->router->setStringService($this->string);
      $this->router->setCode($this->code);
      $this->router->setArrayService($this->array);
      $this->router->setLanguageService($this->language->reveal());
    }

    public function testCreateActionAction()
    {
      $action = new Action([
        'name' =>  'MyAction',
        'controller' => 'MyController'
      ***REMOVED***);

      $this->assertEquals('Action', $action->getController()->getType());


      $router = $this->router->create($action);
      $this->assertTrue($router);


      $routerFile = include vfsStream::url('module/config/ext/route.config.php');


      $this->assertArrayHasKey('routes', $routerFile);
      $this->assertArrayHasKey('my-module', $routerFile['routes'***REMOVED***);
      $this->assertArrayHasKey('child_routes', $routerFile['routes'***REMOVED***['my-module'***REMOVED***);
      $this->assertArrayHasKey('my', $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***);
      $this->assertArrayHasKey('child_routes', $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***);

      $actionRoutes = $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***['child_routes'***REMOVED***;
      $this->assertCount(1, $actionRoutes);
      $this->assertEquals($actionRoutes['my-action'***REMOVED***['options'***REMOVED***['route'***REMOVED***, '/my-action');
      $this->assertEquals($actionRoutes['my-action'***REMOVED***['options'***REMOVED***['defaults'***REMOVED***['controller'***REMOVED***, 'MyModule\Controller\My');
      $this->assertEquals($actionRoutes['my-action'***REMOVED***['options'***REMOVED***['defaults'***REMOVED***['action'***REMOVED***, 'my-action');

      //var_dump($routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***['child_routes'***REMOVED***[0***REMOVED***['options'***REMOVED***);
      //$this->assertArrayHasKey('routes', $routerFile['routes'***REMOVED***);
      //var_dump($routerFile);
    }


    public function testCreateActionRest()
    {
      $action = new Action([
        'name' =>  'MyAction',
        'controller' => 'MyController'
      ***REMOVED***);
      $action->getController()->setType('Rest');

      $this->assertEquals('Rest', $action->getController()->getType());


      $router = $this->router->create($action);
      $this->assertTrue($router);


      $routerFile = include vfsStream::url('module/config/ext/route.config.php');


      $this->assertArrayHasKey('routes', $routerFile);
      $this->assertArrayHasKey('my-module', $routerFile['routes'***REMOVED***);
      $this->assertArrayHasKey('child_routes', $routerFile['routes'***REMOVED***['my-module'***REMOVED***);
      $this->assertArrayHasKey('my', $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***);
      $this->assertArrayHasKey('child_routes', $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***);

      $actionRoutes = $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***['child_routes'***REMOVED***;
      $this->assertCount(1, $actionRoutes);
      $this->assertEquals($actionRoutes['my-action'***REMOVED***['options'***REMOVED***['route'***REMOVED***, '/my-action');
      $this->assertEquals($actionRoutes['my-action'***REMOVED***['options'***REMOVED***['defaults'***REMOVED***['controller'***REMOVED***, 'MyModule\Controller\My');
      $this->assertEquals($actionRoutes['my-action'***REMOVED***['options'***REMOVED***['defaults'***REMOVED***['action'***REMOVED***, 'my-action');

      $expected = [
        'my' => [
            'type'    => 'segment',
            'options' => [
                'route'    => '/my-controller[/:id***REMOVED***',
                'constraints' => [
                    'id'     => '[a-zA-Z0-9***REMOVED***+',
                ***REMOVED***,
                'defaults' => [
                    'controller' => 'MyModule\Controller\My',
                ***REMOVED***,
            ***REMOVED***,
            'may_terminate' => true,
            'child_routes' => [
              'my-action' => [
                'type' => 'segment',
                'options' => [
                  'route' => '/my-action',
                  'defaults' => [
                    'controller' => 'MyModule\Controller\My',
                    'action' => 'my-action'
                  ***REMOVED***
                ***REMOVED***
              ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
       ***REMOVED***;
      $this->assertEquals($expected, $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***);

      //var_dump($routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***['child_routes'***REMOVED***[0***REMOVED***['options'***REMOVED***);
      //$this->assertArrayHasKey('routes', $routerFile['routes'***REMOVED***);
      //var_dump($routerFile);
    }

    public function testCreateActionRestDefaultAction()
    {
      $action = new Action([
        'name' =>  'GetList',
        'controller' => 'MyController'
      ***REMOVED***);
      $action->getController()->setType('Rest');

      $this->assertEquals('Rest', $action->getController()->getType());


      $router = $this->router->create($action);
      $this->assertTrue($router);


      $routerFile = include vfsStream::url('module/config/ext/route.config.php');


      $this->assertArrayHasKey('routes', $routerFile);
      $this->assertArrayHasKey('my-module', $routerFile['routes'***REMOVED***);
      $this->assertArrayHasKey('child_routes', $routerFile['routes'***REMOVED***['my-module'***REMOVED***);
      $this->assertArrayHasKey('my', $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***);
      $this->assertArrayHasKey('child_routes', $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***);

      $actionRoutes = $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***['child_routes'***REMOVED***;
      $this->assertCount(0, $actionRoutes);


      $expected = [
        'my' => [
            'type'    => 'segment',
            'options' => [
                'route'    => '/my-controller[/:id***REMOVED***',
                'constraints' => [
                    'id'     => '[a-zA-Z0-9***REMOVED***+',
                ***REMOVED***,
                'defaults' => [
                    'controller' => 'MyModule\Controller\My',
                ***REMOVED***,
            ***REMOVED***,
            'may_terminate' => true,
            'child_routes' => [***REMOVED***
        ***REMOVED***,
       ***REMOVED***;
      $this->assertEquals($expected, $routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***);

      //var_dump($routerFile['routes'***REMOVED***['my-module'***REMOVED***['child_routes'***REMOVED***['my'***REMOVED***['child_routes'***REMOVED***[0***REMOVED***['options'***REMOVED***);
      //$this->assertArrayHasKey('routes', $routerFile['routes'***REMOVED***);
      //var_dump($routerFile);
    }
}
