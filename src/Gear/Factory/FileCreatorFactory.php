<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FileCreatorFactory implements FactoryInterface
{


    public function createService(ServiceLocatorInterface $controllerManager)
    {

        $serviceManager = $controllerManager->get('ServiceManager');

        $file = $serviceManager->get('fileService');
        $template = $serviceManager->get('Gear\Creator\Template');


        return new \Gear\Creator\File($file, $template);
    }
}
