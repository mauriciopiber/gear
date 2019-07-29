<?php
namespace Gear\Module\Node;

use Gear\Upgrade\Npm\NpmUpgradeTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Upgrade\Npm\NpmUpgrade;

class Package
{
    use FileCreatorTrait;

    use StringServiceTrait;

    use ModuleStructureTrait;

    public function __construct(
        ModuleStructure $module,
        StringService $string,
        FileCreator $file,
        NpmUpgrade $npmUpgrade
    ) {
        $this->setNpmUpgrade($npmUpgrade);
        $this->module = $module;
        $this->stringService = $string;
        $this->fileCreator = $file;
    }

    use NpmUpgradeTrait;

    public function create()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/package.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('package.json');
        $file->setLocation($this->getModule()->getMainFolder());
        $file = $file->render();

        $this->getNpmUpgrade()->getConsolePrompt()->setForce(true);
        $this->getNpmUpgrade()->upgradeModule('web');

        return $file;
    }
}
