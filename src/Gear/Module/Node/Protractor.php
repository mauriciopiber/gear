<?php
namespace Gear\Module\Node;

use Gear\Service\AbstractJsonService;

class Protractor extends AbstractJsonService {

    public function create()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/protractor.phtml');
        $file->setOptions(
            [
                'module' => $this->str('class', $this->getModule()->getModuleName()),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ***REMOVED***
        );
        $file->setFileName('protractor.conf.js');
        $file->setLocation($this->getModule()->getMainFolder());
        $file->render();
    }

    public function createTestIndexAction()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/index/integration.phtml');
        $file->setOptions(
            [
                'module' => $this->str('class', $this->getModule()->getModuleName()),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName())
            ***REMOVED***
        );
        $file->setLocation($this->getModule()->getPublicJsSpecIntegrationFolder());
        $file->setFileName($this->str('class', $this->getModule()->getModuleName()).'IndexActionSpec.js');

        $file->render();

    }
}
