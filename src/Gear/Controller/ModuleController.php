<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;

class ModuleController extends AbstractConsoleController
{
    use \Gear\Common\ModuleTrait;

    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function moduleAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $module = $this->getModuleService();

        $build = $this->getRequest()->getParam('build');

        $this->gear()->loopActivity($module, array('build' => $build), 'Module');

        return new ConsoleModel();
    }

    public function loadAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $request    = $this->getRequest();
        /* @var $module \Gear\Service\Module\ModuleService */
        $module = $this->getModuleService();

        $this->gear()->loopActivity($module, array(), 'Load', null);
        return new ConsoleModel();
    }

    public function pushAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $request    = $this->getRequest();
        /* @var $module \Gear\Service\Module\ModuleService */
        $module = $this->getModuleService();

        $this->gear()->loopActivity($module, array('description' => $request->getParam('description', null)), 'Push', null);
        return new ConsoleModel();
    }
}
