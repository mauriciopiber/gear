<?php
namespace Gear\Edge\File;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Edge\File\FileEdge;

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
