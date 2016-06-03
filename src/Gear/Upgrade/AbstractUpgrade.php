<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Upgrade\ComposerUpgradeTrait;
use Gear\Upgrade\NpmUpgradeTrait;

abstract class AbstractUpgrade extends AbstractJsonService
{
    use ComposerUpgradeTrait;

    use NpmUpgradeTrait;

    //abstract public function upgradeModule();

    //abstract public function upgradeProject();
}
