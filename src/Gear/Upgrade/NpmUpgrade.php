<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Service\AbstractJsonService;

class NpmUpgrade extends AbstractJsonService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function upgradeProject($type = 'web')
    {
        return true;
    }
}
