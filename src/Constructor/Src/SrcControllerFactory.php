<?php
namespace Gear\Constructor\Src;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Constructor\Src\SrcConstructor;
use Gear\Constructor\Src\SrcController;

class SrcControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $srcService = $container->get(SrcConstructor::class);
        $srcController = new SrcController($srcService);
        return $srcController;
    }
}
