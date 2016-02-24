<?php
namespace Gear\Mvc\View\App;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\AbstractMvc;

class AppControllerService extends AbstractMvc implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    use AppControllerSpecServiceTrait;
}
