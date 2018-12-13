<?php
namespace Gear\Creator\FileCreator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\Template\TemplateService;

class FileCreatorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceManager = $controllerManager->get('ServiceManager');

        $file = $serviceManager->get('Gear\Util\File\FileService');
        $template = $serviceManager->get(TemplateService::class);

        return new FileCreator($file, $template);
    }
}
