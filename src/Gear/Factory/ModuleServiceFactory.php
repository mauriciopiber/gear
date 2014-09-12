<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $fileWriterService \Gear\Service\Filesystem\FileWriterService */
        $fileWriterService = $serviceLocator->get('fileWriterService');

        /* @var $driWriterServicer \Gear\Service\Filesystem\DirWriterService */
        $dirWriterService  = $serviceLocator->get('dirWriterService');

        /* @var $stringService \Gear\Service\Type\StringService */
        $stringService     = $serviceLocator->get('stringService');

        $module = new \Gear\Service\Module\ModuleService($fileWriterService, $dirWriterService, $stringService);

        //$module->setFileWriter($fileWriterService);

        return $module;
    }
}
