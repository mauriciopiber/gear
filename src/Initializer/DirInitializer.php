<?php
namespace Gear\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use GearBase\Util\String\DirServiceAwareInterface;

class DirInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof DirServiceAwareInterface) {
            $dirWriter = $serviceLocator->get('GearBase\Util\DirService');
            $instance->setDirService($dirWriter);
            return;
        }
    }
}
