<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Service\Filesystem\DirServiceAwareInterface;

class DirInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof DirServiceAwareInterface) {
            $dirWriter = $serviceLocator->get('dirService');
            $instance->setDirService($dirWriter);
            return;
        }
    }
}
