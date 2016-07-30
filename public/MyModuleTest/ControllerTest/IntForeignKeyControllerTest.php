<?php
namespace MyModuleTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase as TestCase;
use MyModule\Controller\IntForeignKeyController;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;

/**
 * @group MyModule
 * @group IntForeignKey
 * @group Controller
 */
class IntForeignKeyControllerTest extends TestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include \GearBase\Module::getProjectFolder().'/config/application.config.php'
        );
        parent::setUp();


        $this->controller = new IntForeignKeyController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'IntForeignKeyController'));
        $this->event      = new MvcEvent();

        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);

        $this->intForeignKeyForm = $this->prophesize('MyModule\Form\IntForeignKeyForm');
        $this->intForeignKeySearchForm = $this->prophesize('MyModule\Form\Search\IntForeignKeySearchForm');
        $this->intForeignKeyService = $this->prophesize('MyModule\Service\IntForeignKeyService');

        $requestPlugin = new \GearBase\Controller\Plugin\RequestPlugin();

        $this->controller->getPluginManager()->setService('getRequestPlugin', $requestPlugin);

        $this->url = $this->prophesize('Zend\Mvc\Controller\Plugin\Url');

        $this->controller->getPluginManager()->setService('url', $this->url->reveal());


        $this->controller->setIntForeignKeyForm($this->intForeignKeyForm->reveal());
        $this->controller->setIntForeignKeyService($this->intForeignKeyService->reveal());
        $this->controller->setIntForeignKeySearchForm($this->intForeignKeySearchForm->reveal());
    }

    protected function tearDown()
    {
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
    }

    /**
    public function testSetService()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('MyModule\Controller\IntForeignKey');

        $abstract = $this->getMockBuilder('MyModule\Service\IntForeignKeyService')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setIntForeignKeyService($abstract);

    }

    public function testSetForm()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('MyModule\Controller\IntForeignKey');

        $abstract = $this->getMockBuilder('MyModule\Form\IntForeignKeyForm')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setIntForeignKeyForm($abstract);
    }
    */

    // OK
    /**
     * @group Controller.Create
     * @group force-80
     */
    public function testEnterCreatePage()
    {
        $this->routeMatch->setParam('action', 'create');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    //OK
    /**
     * @group Controller.Create
     * @group force-80
     */
    public function testSendPostToCreatePageRedirectToGet()
    {
        $this->url->fromRoute(IntForeignKeyController::CREATE)->willReturn(IntForeignKeyController::CREATE);
        $this->url->setController($this->controller)->shouldBeCalled();

        $this->routeMatch->setParam('action', 'create');
        $this->request->setMethod('POST');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(303, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }

    //OK
    /**
     * @group Controller.Create
     * @group force-80
     * @group force-84
     */
    public function testSendPostToCreateShowValidation()
    {

        $this->url->fromRoute(IntForeignKeyController::CREATE)->willReturn(IntForeignKeyController::CREATE);
        $this->url->setController($this->controller)->shouldBeCalled();

        $prg = $this->prophesize('Zend\Mvc\Controller\Plugin\PostRedirectGet');
        $prg->setController($this->controller)->shouldBeCalled();
        $prg->__invoke('my-module/int-foreign-key/create', true)->willReturn([***REMOVED***);

        $this->controller->getPluginManager()->setService('postredirectget', $prg->reveal());

        $this->routeMatch->setParam('action', 'create');
        $this->request->setMethod('POST');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    //OK
   /**
     * @group force-80
     * @group force-85
     */
    public function testCreateSuccessful()
    {
        $this->url->fromRoute(IntForeignKeyController::CREATE)->willReturn(IntForeignKeyController::CREATE);
        $this->url->fromRoute("my-module/int-foreign-key/edit", ["id" => 31, "success" => 1***REMOVED***, [***REMOVED***, false)
          ->willReturn(IntForeignKeyController::EDIT.'/31/1');

        $this->url->setController($this->controller)->shouldBeCalled();

        $data = array(
            'depName' => 'insert93 Dep Name',
        );

        $this->prg = $this->prophesize('Zend\Mvc\Controller\Plugin\PostRedirectGet');
        $this->prg->setController($this->controller)->shouldBeCalled();

        $this->prg->__invoke('my-module/int-foreign-key/create', true)->willReturn($data);

        $this->controller->getPluginManager()->setService('postredirectget', $this->prg->reveal());

        $this->entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        $this->entity->getIdIntForeignKey()->willReturn(31)->shouldBeCalled();

        $this->intForeignKeyForm->setData($data)->shouldBeCalled();
        $this->intForeignKeyForm->isValid()->willReturn(true)->shouldBeCalled();
        $this->intForeignKeyForm->getData()->willReturn($data)->shouldBeCalled();
        $this->intForeignKeyService->create($data)->willReturn($this->entity)->shouldBeCalled();

        $this->routeMatch->setParam('action', 'create');
        $this->request->setMethod('POST');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }

    //OK
    /**
     * @group force-80
     * @group force-91
     */

    public function testWhenEditDisplaySuccessful()
    {
        $this->url->fromRoute(IntForeignKeyController::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::LISTS);
        $this->url->setController($this->controller)->shouldBeCalled();

        $this->routeMatch->setParam('action', 'edit');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }

    //OK
    /**
     * @group force-80
     * @group force-92
     */
    public function testWhenEditRedirectWithInvalidIdToListing()
    {
        $this->url->fromRoute(IntForeignKeyController::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::LISTS);
        $this->url->setController($this->controller)->shouldBeCalled();

        $this->intForeignKeyService->selectById(6000)->willReturn(null);

        $this->routeMatch->setParam('action', 'edit');
        $this->routeMatch->setParam('id', 6000);
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }

    // OK
    /**
     * @group force-80
     * @group force-93
     */
    public function testDisplayEditSuccessful()
    {
        $this->entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        //$this->entity->getIdIntForeignKey()->willReturn(31)->shouldBeCalled();

        $this->intForeignKeyService->selectById(31)->willReturn($this->entity);


        $this->routeMatch->setParam('action', 'edit');
        $this->routeMatch->setParam('id', 31);

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    /**
     * @group force-80
     * @group force-94
     */
    public function testWhenListRedirectSuccessfulPRGWithValidId()
    {
        $this->url->fromRoute(IntForeignKeyController::EDIT, ['id' => 31***REMOVED***)->willReturn(IntForeignKeyController::EDIT);
        $this->url->setController($this->controller)->shouldBeCalled();

        $this->entity = $this->prophesize('MyModule\Entity\IntForeignKey');

        $this->intForeignKeyService->selectById(31)->willReturn($this->entity);

        $this->routeMatch->setParam('action', 'edit');
        $this->routeMatch->setParam('id', 31);

        $this->request->setMethod('POST');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(303, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }

    /**
     * @group force-80
     * @group force-95
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation()
    {
        $this->url->fromRoute(IntForeignKeyController::EDIT, ['id' => 31***REMOVED***)->willReturn(IntForeignKeyController::EDIT.'/31');
        $this->url->setController($this->controller)->shouldBeCalled();

        $prg = $this->prophesize('Zend\Mvc\Controller\Plugin\PostRedirectGet');
        $prg->setController($this->controller)->shouldBeCalled();
        $prg->__invoke('my-module/int-foreign-key/edit/31', true)->willReturn([***REMOVED***);

        $this->entity = $this->prophesize('MyModule\Entity\IntForeignKey');

        $this->controller->getPluginManager()->setService('postredirectget', $prg->reveal());

        $this->intForeignKeyService->selectById(31)->willReturn($this->entity);

        $this->routeMatch->setParam('action', 'edit');
        $this->routeMatch->setParam('id', 31);

        $this->request->setMethod('POST');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    /**
     * @group force-80
     * @group force-96
     */
    public function testEditSuccessfull()
    {
        $this->url->fromRoute(IntForeignKeyController::EDIT, ['id' => 31***REMOVED***)->willReturn(IntForeignKeyController::EDIT);
        $this->url->fromRoute("my-module/int-foreign-key/edit", ["id" => 31, "success" => 1***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::EDIT.'/31/1');
        $this->url->setController($this->controller)->shouldBeCalled();

        $data = array(
            'depName' => '58Dep Name',
        );

        $this->prg = $this->prophesize('Zend\Mvc\Controller\Plugin\PostRedirectGet');
        $this->prg->setController($this->controller)->shouldBeCalled();

        $this->prg->__invoke('my-module/int-foreign-key/edit', true)->willReturn($data);

        $this->controller->getPluginManager()->setService('postredirectget', $this->prg->reveal());

        $this->entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        $this->entity->getIdIntForeignKey()->willReturn(31)->shouldBeCalled();

        $this->intForeignKeyForm->setData($data)->shouldBeCalled();
        $this->intForeignKeyForm->isValid()->willReturn(true)->shouldBeCalled();
        $this->intForeignKeyForm->getData()->willReturn($data)->shouldBeCalled();
        $this->intForeignKeyService->update(31, $data)->willReturn($this->entity)->shouldBeCalled();
        $this->intForeignKeyService->selectById(31)->willReturn($this->entity);

        $this->routeMatch->setParam('action', 'edit');
        $this->routeMatch->setParam('id', 31);

        $this->request->setMethod('POST');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }


    /**
     * @group force-80
     * @group force-101
     */
    public function testWhenListDisplaySuccessful()
    {
        $this->intForeignKeyService->selectAll()->willReturn([***REMOVED***)->shouldBeCalled();

        $this->routeMatch->setParam('action', 'list');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    /**
     * @group force-80
     * @group force-111
     */
    public function testWhenViewDisplaySuccessfulWithValidId()
    {
        $this->entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        //$this->entity->getIdIntForeignKey()->willReturn(31)->shouldBeCalled();

        $this->intForeignKeyService->selectById(31)->willReturn($this->entity->reveal());
        $this->intForeignKeyService->extract($this->entity->reveal())->willReturn([***REMOVED***);

        $this->routeMatch->setParam('action', 'view');
        $this->routeMatch->setParam('id', 31);

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    /**
     * @group force-80
     * @group force-112
     */
    public function testViewSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->url->fromRoute(IntForeignKeyController::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::LISTS);
        $this->url->setController($this->controller)->shouldBeCalled();

        $this->intForeignKeyService->selectById(6000)->willReturn(null);

        $this->routeMatch->setParam('action', 'view');
        $this->routeMatch->setParam('id', 6000);

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }

    /**
     * @group force-80
     * @group force-113
     */
    public function testWhenViewDisplaySuccessful()
    {
        $this->url->fromRoute(IntForeignKeyController::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::LISTS);
        $this->url->setController($this->controller)->shouldBeCalled();

        $this->routeMatch->setParam('action', 'view');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);
    }

    /**
     * @group force-80
     * @group force-122
     */
    public function testDeleteSucessfullAndRedirectToListWithFailNotFound()
    {
        //$this->url->fromRoute(IntForeignKeyController::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::LISTS);
        //$this->url->setController($this->controller)->shouldBeCalled();

        $this->intForeignKeyService->delete(6000)->willReturn(['success' => false, 'error' => 'EntityNotFound'***REMOVED***);

        $this->routeMatch->setParam('action', 'delete');
        $this->routeMatch->setParam('id', 6000);

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\JsonModel', $result);
    }

    /**
     * @group force-80
     * @group force-123
     */
    public function testDeleteSucessfullAndRedirectToListWithSuccessful()
    {
        //$this->url->fromRoute(IntForeignKeyController::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::LISTS);
        //$this->url->setController($this->controller)->shouldBeCalled();

        $this->intForeignKeyService->delete(6000)->willReturn(['success' => true***REMOVED***);

        $this->routeMatch->setParam('action', 'delete');
        $this->routeMatch->setParam('id', 6000);

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\JsonModel', $result);
    }

    /**
     * @group force-80
     * @group force-123
     */
    public function testWhenDeleteDisplaySuccessful()
    {
        $this->url->fromRoute(IntForeignKeyController::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn(IntForeignKeyController::LISTS);
        $this->url->setController($this->controller)->shouldBeCalled();

        $this->routeMatch->setParam('action', 'delete');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $result);


    }
}
