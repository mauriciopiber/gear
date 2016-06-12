<?php
namespace Gear\Module\Node;

use Gear\Service\AbstractJsonService;

class Protractor extends AbstractJsonService
{
    public function create()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/protractor.phtml');
        $file->setOptions(
            [
                'module' => $this->str('class', $this->getModule()->getModuleName()),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ***REMOVED***
        );
        $file->setFileName('end2end.conf.js');
        $file->setLocation($this->getModule()->getPublicJsSpecFolder());
        $file->render();
    }

    public function createTestIndexAction()
    {
        $file = $this->getFileCreator();
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
