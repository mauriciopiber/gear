<?php
namespace Gear\Creator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\File;

class FileCreatorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceManager = $controllerManager->get('ServiceManager');

        $file = $serviceManager->get('fileService');
        $template = $serviceManager->get('Gear\Creator\Template');

        return new File($file, $template);
    }
}
