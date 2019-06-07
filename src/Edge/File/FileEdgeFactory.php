<?php
namespace Gear\Edge\File;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Edge\File\FileEdge;

class FileEdgeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new FileEdge(
        );
        
        return $factory;
    }
}
