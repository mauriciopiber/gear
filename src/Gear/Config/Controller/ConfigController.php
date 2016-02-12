<?php
namespace Gear\Config\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Config\Service\ConfigServiceTrait;

class ConfigController extends AbstractConsoleController
{
    use ConfigServiceTrait;

    public function addAction()
    {
        return $this->getConfigService()->add();
    }

    public function updateAction()
    {
        return $this->getConfigService()->update();
    }

    public function configAction()
    {
        return $this->getConfigService()->listConfig();
    }

    public function deleteAction()
    {
        return $this->getConfigService()->delete();
    }
}
