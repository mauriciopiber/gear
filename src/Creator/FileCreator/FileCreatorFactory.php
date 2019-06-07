<?php
namespace Gear\Creator\FileCreator;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\Template\TemplateService;

class FileCreatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $file = $container->get('Gear\Util\File\FileService');
        $template = $container->get(TemplateService::class);

        return new FileCreator($file, $template);
    }
}
