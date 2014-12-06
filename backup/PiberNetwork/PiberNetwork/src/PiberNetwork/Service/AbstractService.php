<?php
namespace PiberNetwork\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

/**
 * @author piber
 */
abstract class AbstractService implements
    ServiceLocatorAwareInterface
{
    protected $serviceLocator;


    public function getOrderBy()
    {
        $routeMatch = $this->getRouteMatch();
        return $routeMatch->getParam('orderBy') ? $routeMatch->getParam('orderBy') : $this->getTableHead()[0***REMOVED***['name'***REMOVED***;
    }

    public function getPaginator($resultSet)
    {
        $page = $this->getRouteMatch()->getParam('page', 1);

        $adapter = new ArrayAdapter($resultSet);

        $paginator = new Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return $paginator;
    }

    public function getRouteMatchList()
    {
        $routeMatchedName = $this->getRouteMatch()->getMatchedRouteName();

        if (strpos($routeMatchedName, '/list')) {
            $route = $routeMatchedName;
        } else {
            $route = $routeMatchedName.'/list';
        }
        return $route;
    }

    public function getPage()
    {
        return $this->getRouteMatch()->getParam('page', 1);
    }

    public function getRouteMatch()
    {
        return $this->getServiceLocator()
        ->get('application')
        ->getMvcEvent()
        ->getRouteMatch();
    }


    public function getOrder()
    {
        $routeMatch = $this->getRouteMatch();
        return $routeMatch->getParam('order') ? $routeMatch->getParam('order') : 'DESC';
    }


    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
