<?php
namespace Gear\Mvc\View\App;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Mvc\AbstractMvcTest;

class AppControllerSpecService extends AbstractMvcTest implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
}
