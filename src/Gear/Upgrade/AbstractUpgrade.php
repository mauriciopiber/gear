<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Upgrade\ComposerUpgradeTrait;
use Gear\Upgrade\NpmUpgradeTrait;
use Gear\Upgrade\DirUpgradeTrait;
use Gear\Upgrade\FileUpgradeTrait;
use Gear\Upgrade\AntUpgradeTrait;

abstract class AbstractUpgrade extends AbstractJsonService
{
    use ComposerUpgradeTrait;

    use NpmUpgradeTrait;

    use DirUpgradeTrait;

    use FileUpgradeTrait;

    use AntUpgradeTrait;

    //abstract public function upgradeModule();

    //abstract public function upgradeProject();
}
