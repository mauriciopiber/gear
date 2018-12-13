<?php
namespace Gear\Module\Node;

use Gear\Service\AbstractJsonService;

class Karma extends AbstractJsonService
{
    public function create()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/karma.phtml');
        $file->setOptions(['module' => $this->str('class', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('karma.conf.js');
        $file->setLocation($this->getModule()->getPublicJsSpecFolder());
        return $file->render();
    }
}
