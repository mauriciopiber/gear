<?php
namespace Gear\Mvc\View\App;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Mvc\View\App\AppServiceSpecServiceTrait;
use Gear\Mvc\AbstractMvc;

class AppServiceService extends AbstractMvc implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    use AppServiceSpecServiceTrait;
}
