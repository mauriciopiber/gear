<?php
namespace Gear\Project\Docs;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Project\Docs\Docs;
use Gear\Creator\FileCreator\FileCreator;

class DocsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Docs(
            $container->get('config'),
            $container->get('Gear\Util\String\StringService'),
            $container->get(FileCreator::class)
        );
        
        return $factory;
    }
}
