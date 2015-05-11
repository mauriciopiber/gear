<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ConstructorControllerTest extends AbstractConsoleControllerTestCase
{
    const CONTROLLER = 'gear module controller create %s --name=%s --object=%s';
    const ACTION     = 'gear module activity create %s %s --name=%s';
    const SRC        = 'gear module src create %s --type=%s --name=%s';
    const DB         = 'gear module db create %s --table=%s';
    const VIEW       = 'gear module view create %s --target=%s';
    const TEST       = 'gear module test create %s --suite=%s --target=%s';

    public function mockUp($class)
    {
        $mock = $this->getMockBuilder($class)
        ->disableOriginalConstructor()
        ->getMock();

        $mock->expects($this->any())
        ->method('create')
        ->willReturn(true);

        $mock->expects($this->any())
        ->method('delete')
        ->willReturn(true);

        return $mock;

    }

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php');

        parent::setUp();

        $this->getApplication()->getServiceManager()->setAllowOverride(true);

        $controllerManager = $this->getApplication()->getServiceManager()->get('controllermanager');

        $this->constructorController = $controllerManager->get('Gear\Controller\Constructor');
        $this->constructorController->setControllerService($this->mockUp('Gear\Service\Constructor\ControllerService'));
        $this->constructorController->setActionService($this->mockUp('Gear\Service\Constructor\ActionService'));
        $this->constructorController->setPageService($this->mockUp('Gear\Service\Constructor\PageService'));
        $this->constructorController->setViewService($this->mockUp('Gear\Service\Constructor\ViewService'));
        $this->constructorController->setTestService($this->mockUp('Gear\Service\Constructor\TestService'));
        $this->constructorController->setDbService($this->mockUp('Gear\Service\Constructor\DbService'));
        $this->constructorController->setSrcService($this->mockUp('Gear\Service\Constructor\SrcService'));
    }

    public function tearDown()
    {
        parent::tearDown();
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        unset($this->constructorController);
    }

    public function controllerProviderSuccessful()
    {

        return array(
        	array('Gear', 'MyController', '%s\Controller\My'),
            array('Gear', 'SecondController', '%s\Controller\Second')
        );
    }
    /**
     * @dataProvider controllerProviderSuccessful
     */
    public function testCreateControllerAction($module, $controllerName, $controllerServiceManager)
    {
        $this->dispatch(sprintf(self::CONTROLLER, $module, $controllerName, $controllerServiceManager));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('controller');
        $this->assertMatchedRouteName('gear-controller');
        $this->assertResponseStatusCode(0);
    }

    public function srcProviderSuccessful()
    {

        return array(
            array('Gear', 'Service', 'MyService'),
            array('Gear', 'Factory', 'MyFactory'),
            array('Gear', 'Repository', 'MyRepository'),
            array('Gear', 'Entity', 'MyEntity')
        );
    }

    /**
     * @dataProvider srcProviderSuccessful
     */

    public function testCreateSrcAction($module, $serviceType, $serviceName)
    {
        $this->dispatch(sprintf(self::SRC, $module, $serviceType, $serviceName));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('src');
        $this->assertMatchedRouteName('gear-src');
        $this->assertResponseStatusCode(0);
    }


    public function actionProviderSuccessful()
    {
        return array(
        	array('Gear', 'MyController', 'MyAction'),
            array('Gear', 'SecondController', 'TwoAction')
        );
    }
    /**
     * @dataProvider actionProviderSuccessful
     */

    public function testCreateActionAction($module, $controller, $actionName)
    {
        $this->dispatch(sprintf(self::ACTION, $module, $controller, $actionName));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('action');
        $this->assertMatchedRouteName('gear-activity');
        $this->assertResponseStatusCode(0);
    }

    public function pageProviderSuccesful()
    {
        return array(
        	array('Gear', 'MyController', '%s\Controller\MyController', 'MyAction'),
            array('Gear', 'YourController', '%s\Controller\YourController', 'YourAction'),
            array('Gear', 'ByController', '%s\Controller\ByController', 'ByAction'),
        );
    }

    /**
     * @dataProvider pageProviderSuccesful
     * @param unknown $module
     * @param unknown $controllerName
     * @param unknown $controllerInvokable
     * @param unknown $actionName

    public function testCreatePageAction($module, $controllerName, $controllerInvokable, $actionName)
    {
        $this->dispatch(sprintf(self::PAGE, $module, $controllerName, $controllerInvokable, $actionName));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('page');
        $this->assertMatchedRouteName('gear-page');
        $this->assertResponseStatusCode(0);
    }

 */

    public function dbProviderSuccessful()
    {

        return array(
        	array('Gear', 'Module'),
            array('Gear', 'Controller'),
            array('Gear', 'Action'),
            array('Gear', 'Role'),
            array('Gear', 'Rule'),
        );
    }

    /**
     * @dataProvider dbProviderSuccessful
     * @param unknown $module
     * @param unknown $table
     */

    public function testCreateDbAction($module, $table)
    {
        $this->dispatch(sprintf(self::DB, $module, $table));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('db');
        $this->assertMatchedRouteName('gear-db');
        $this->assertResponseStatusCode(0);
    }

    public function viewProviderSuccesful()
    {
        return array(
        	array('Gear', 'template/download/teste.phtml'),
            array('Gear', 'template/download/teste2.phtml'),
            array('Gear', 'template/download/teste3.phtml'),
            array('Gear', 'template/download/teste4.phtml'),
        );
    }

    /**
     * @dataProvider viewProviderSuccesful
     */
    public function testCreateViewAction($module, $createDir)
    {
        $this->dispatch(sprintf(self::VIEW, $module, $createDir));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('view');
        $this->assertMatchedRouteName('gear-view');
        $this->assertResponseStatusCode(0);
    }

    public function testProviderSuccesful()
    {
        return array(
        	array('Gear', 'unit', 'test/unit/%s/UnitTest.php'),
            array('Gear', 'unit', 'test/unit/%s/MySecondTest.php'),
            array('Gear', 'unit', 'test/unit/%s/ThirdTest.php'),
            array('Gear', 'unit', 'test/unit/%s/FourTest.php'),
            array('Gear', 'unit', 'test/unit/%s/FiveTest.php'),
            array('Gear', 'unit', 'test/unit/%s/SixTest.php'),
            array('Gear', 'acceptance', 'test/acceptance/MyAcceptance.php'),
            array('Gear', 'acceptance', 'test/acceptance/SecondAcceptance.php'),
            array('Gear', 'functional', 'test/functional/MyFunctional.php'),
            array('Gear', 'functional', 'test/functional/SecondFunctional.php'),
        );
    }

    /**
     * @dataProvider testProviderSuccesful
     * @param unknown $module
     * @param unknown $suite
     * @param unknown $name
     */
    public function testCreateTestAction($module, $suite, $name)
    {
        $this->dispatch(sprintf(self::TEST, $module, $suite, $name));
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ConstructorController');
        $this->assertControllerName('Gear\Controller\Constructor');
        $this->assertActionName('test');
        $this->assertMatchedRouteName('gear-test');
        $this->assertResponseStatusCode(0);
    }
}