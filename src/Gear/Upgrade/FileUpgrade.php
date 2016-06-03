<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Service\AbstractJsonService;

class FileUpgrade extends AbstractJsonService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function upgradeModule($type = 'web')
    {
        return [***REMOVED***;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
