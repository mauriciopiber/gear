<?php
namespace Teste\TesteTest\RepositoryTest;

/**
 * @group Service
 */
class AbstractServiceTest extends \TesteTest\AbstractTest
{
    protected $user;

    /**
     * @group cache
     */
    public function testGetOrder()
    {
        $abstractService = $this->getMockBuilder('Teste\Service\AbstractService')
        ->disableOriginalConstructor()
        ->setMethods(array('getRouteMatch'))
        ->getMockForAbstractClass();

        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'Teste\Controller\User',
            'action'     => 'list',
            'page'       => 1,
            'orderBy'    => 'idUser',
            'order'      => 'asc'
        ));

        $routeMatch->setMatchedRouteName('test-until/user');

        $abstractService->expects($this->any())
        ->method('getRouteMatch')
        ->will($this->returnValue($routeMatch));

        $this->assertEquals('idUser', $abstractService->getOrderBy());
        $this->assertEquals('asc', $abstractService->getOrder());
        $this->assertEquals(1, $abstractService->getPage());

    }

    public function testUnsetSessionName()
    {
        $abstractService = $this->getMockBuilder('Teste\Service\AbstractService')
        ->disableOriginalConstructor()
        ->setMethods(array('getSessionName'))
        ->getMockForAbstractClass();

        $abstractService->expects($this->any())
        ->method('getSessionName')
        ->willReturn(null);

        $abstractService->unsetSessionName();
        $this->assertNull($abstractService->getSessionName());
    }

    /**
     * @group cache
     */
    public function testCacheCompare()
    {

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem('compareTestKey')) {
            $cache->removeItem('compareTestKey');
        }

        $abstractService = $this->getMockBuilder('Teste\Service\AbstractService')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstractService->setServiceLocator($this->bootstrap->getServiceLocator());


        $compare = $abstractService->cacheCompare('compareTestKey', 5);
        $compare = $abstractService->cacheCompare('compareTestKey', 5);
        $compare = $abstractService->cacheCompare('compareTestKey', 15);
    }

    /**
     * @group cache
     */
    public function testGetDataWIthSessionEnabled()
    {
        $abstractService = $this->getMockBuilder('Teste\Service\AbstractService')
        ->disableOriginalConstructor()
        ->setMethods(array('selectAll', 'getSessionName'))
        ->getMockForAbstractClass();

        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'Teste\Controller\User',
            'action'     => 'list',
            'page'       => 1,
            'orderBy'    => 'idUser',
            'order'      => 'asc'
        ));

        $routeMatch->setMatchedRouteName('test-until/user');

        $abstractService->setRouteMatch($routeMatch);
        /* $abstractService->expects($this->any())
        ->method('getRouteMatch')
        ->will($this->returnValue($routeMatch));
 */
        $abstractService->expects($this->any())
        ->method('selectAll')
        ->will($this->returnValue(array()));

        $abstractService->expects($this->any())
        ->method('getSessionName')
        ->will($this->returnValue('unitTest'));

        $abstractService->setServiceLocator($this->bootstrap->getServiceLocator());

        $data = $abstractService->getData(array('data' => '1'));

        $this->assertInstanceOf('Zend\Paginator\Paginator', $data);
    }

    public function testGetPage()
    {
        $abstractService = $this->getMockBuilder('Teste\Service\AbstractService')
        ->disableOriginalConstructor()
        ->setMethods(array('getRouteMatch'))
        ->getMockForAbstractClass();

        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'Teste\Controller\User',
            'action'     => 'list',
            'page' => 1
        ));

        $routeMatch->setMatchedRouteName('test-until/user');
        $routeMatch->setParam('page', 1);
        $abstractService->expects($this->any())
        ->method('getRouteMatch')
        ->will($this->returnValue($routeMatch));



        $page = $abstractService->getPage();

        $this->assertEquals(1, $page);
    }

    public function testGetRouteMatchList()
    {
        $abstractService = $this->getMockBuilder('Teste\Service\AbstractService')
        ->disableOriginalConstructor()
        ->setMethods(array('getRouteMatch'))
        ->getMockForAbstractClass();

        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'Teste\Controller\User',
            'action'     => 'list',
            'page' => 1
        ));

        $routeMatch->setMatchedRouteName('test-until/user');
        $routeMatch->setParam('page', 1);
        $abstractService->expects($this->any())
        ->method('getRouteMatch')
        ->will($this->returnValue($routeMatch));


        $page = $abstractService->getRouteMatchList();

        $this->assertEquals('test-until/user/list', $page);

    }
}
