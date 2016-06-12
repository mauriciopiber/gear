<?php
namespace Gear\Module\Node;

use Gear\Service\AbstractJsonService;
use Gear\Upgrade\NpmUpgradeTrait;

class Package extends AbstractJsonService
{
    use NpmUpgradeTrait;

    public function create()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/package.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('package.json');
        $file->setLocation($this->getModule()->getMainFolder());
        $file = $file->render();

        $this->getNpmUpgrade()->upgradeModule('web');

        return $file;
    }
}
