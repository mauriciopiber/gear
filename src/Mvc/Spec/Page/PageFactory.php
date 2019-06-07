<?php
namespace Gear\Mvc\Spec\Page;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Spec\Page\Page;

class PageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Page(
        );
        
        return $factory;
    }
}
