<?php
namespace Gear\Constructor\App;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Mvc\View\App\AppServiceServiceTrait;
use Gear\Mvc\View\App\AppControllerServiceTrait;
use GearJson\Schema\SchemaServiceTrait;

class AppService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    use AppServiceServiceTrait;
    use AppControllerServiceTrait;
    use SchemaServiceTrait;
}
