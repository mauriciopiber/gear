<?php
namespace TestUntil\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\Session\Container;

abstract class AbstractService implements
    ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    protected $routeMatch;

    protected $cache;

    abstract public function selectAll();

    abstract public function getSessionName();

    public function getTableHeadFromMap($map)
    {
        $mapping = [***REMOVED***;
        foreach ($map as $i => $info) {
            if ($info['table'***REMOVED*** == true) {
                $mapping[***REMOVED*** = array('label' => $info['label'***REMOVED***, 'name' => $i);
            }
        }
        return $mapping;
    }


    public function cacheCompare($key, $value)
    {
        if (!$this->getCache()->hasItem($key)) {
            $this->getCache()->setItem($key, $value);
            return false;
        }
        $cache = $this->getCache()->getItem($key);

        if ($value != $cache) {
            $this->getCache()->replaceItem($key, $value);
            return false;
        } else {
            return true;
        }
    }

    public function getData($prg)
    {
        $orderBy = $this->getRouteMatch()->getParam('orderBy');

        $sessionData = new Container($this->getSessionName());

        if ($orderBy == null) {

            unset($sessionData->prg);
        }
        if ($prg == false || is_array($prg) && count($prg) == 0) {
            $data = $this->selectAll(isset($sessionData->prg) ? $sessionData->prg : array());

        } else {
            $sessionData->prg = $prg;
            $data = $this->selectAll($prg);
        }
        return $this->getPaginator($data);
    }

    public function getOrderBy()
    {
        $routeMatch = $this->getRouteMatch();
        return $routeMatch->getParam('orderBy') ? $routeMatch->getParam('orderBy') : $this->getTableHead()[0***REMOVED***['name'***REMOVED***;
    }

    public function getPaginator($resultSet)
    {
        $adapter = new ArrayAdapter($resultSet);
        $paginator = new Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($this->getPage());
        return $paginator;
    }

    public function getCache()
    {
        if (!isset($this->cache)) {
            $this->cache = $this->getServiceLocator()->get('memcached');
        }
        return $this->cache;
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
        if (!isset($this->routeMatch)) {
            $this->routeMatch =$this->getServiceLocator()
              ->get('application')
              ->getMvcEvent()
              ->getRouteMatch();
        }

        return $this->routeMatch;
    }

    public function setRouteMatch($routeMatch)
    {
        $this->routeMatch = $routeMatch;
        return $this;
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
