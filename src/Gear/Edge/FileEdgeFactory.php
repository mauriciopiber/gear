<?php
namespace Gear\Edge;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Edge\FileEdge;

class FileEdgeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new FileEdge(
        );
        unset($serviceLocator);
        return $factory;
    }
}
