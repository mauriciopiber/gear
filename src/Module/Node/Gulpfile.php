<?php
namespace Gear\Module\Node;

use Gear\Service\AbstractJsonService;

class Gulpfile extends AbstractJsonService
{
    public function createFile()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/gulpfile.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('gulpfile.js');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();

        //$this->addConfig();
    }

    public function createFileConfig()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/data/config.phtml');
        //$file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('config.json');
        $file->setLocation($this->getModule()->getDataFolder());
        return $file->render();
    }
}
