<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Service\VersionService;
use Zend\View\Model\ConsoleModel;

class GearController extends AbstractConsoleController
{
    protected $versionService;

    public function versionAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getVersionService()->getVersion();

        return new ConsoleModel();
    }

    public function getVersionService()
    {
        if (!isset($this->versionService)) {
            $this->versionService = $this->getServiceLocator()->get('versionService');
        }
        return $this->versionService;
    }

    public function setVersionService(VersionService $versionService)
    {
        $this->versionService = $versionService;
        return $this;
    }
}
