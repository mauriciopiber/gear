<?php
namespace Gear\Module\Node;

use Gear\Service\AbstractJsonService;

class Karma extends AbstractJsonService
{
    public function create()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/karma.phtml');
        $file->setOptions(['module' => $this->str('class', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('karma.conf.js');
        $file->setLocation($this->getModule()->getMainFolder());
        $file->render();
    }

    public function createTestIndexAction()
    {
        $moduleGear = new \Gear\Module();
        $config = $moduleGear->getConfig();
        $version = $config['gear'***REMOVED***['version'***REMOVED***;

        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/index/unit.phtml');
        $file->setOptions(
            [
                'module' => $this->str('class', $this->getModule()->getModuleName()),
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
                'version' => $version
            ***REMOVED***
        );
        $file->setLocation($this->getModule()->getPublicJsSpecUnitFolder());
        $file->setFileName($this->str('class', $this->getModule()->getModuleName()).'IndexControllerSpec.js');
        $file->render();
    }
}
