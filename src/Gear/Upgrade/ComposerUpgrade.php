<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Service\AbstractJsonService;

class ComposerUpgrade extends AbstractJsonService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
}
