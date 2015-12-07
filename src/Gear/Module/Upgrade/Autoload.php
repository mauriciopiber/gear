<?php
namespace Gear\Module\Upgrade;

use Gear\Project\Upgrade\UpgradeInterface;
use Gear\Project\Upgrade\AbstractUpgrade;
use Zend\ServiceManager\ServiceManager;

class Autoload extends AbstractUpgrade implements UpgradeInterface
{
    public function __construct(ServiceManager $serviceLocator)
    {
        $this->module          = $serviceLocator->get('moduleStructure');
        $this->module->prepare();


        $this->str = $serviceLocator->get('stringService');

        $this->console = $serviceLocator->get('console');

        parent::__construct($serviceLocator);
    }
}
