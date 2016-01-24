<?php
namespace Gear\Javascript\Module;

use Gear\Service\AbstractJsonService;

class Package extends AbstractJsonService {

    public function create()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/package.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('package.json');
        $file->setLocation($this->getModule()->getMainFolder());
        $file->render();

    }



}
