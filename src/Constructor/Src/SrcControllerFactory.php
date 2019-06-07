<?php
namespace Gear\Constructor\Src;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class SrcControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $srcService = $controllerManager->get('Gear\Module\Constructor\Src');
        $srcController = new \Gear\Constructor\Src\SrcController($srcService);
        return $srcController;
    }
}
