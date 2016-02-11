<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Service;

use Gear\Service\AbstractJsonService;

use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\Action\ActionServiceTrait as JsonAction;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\RouterManagerTrait;
use Gear\Mvc\Config\NavigationManagerTrait;
use Gear\Mvc\View\ViewServiceTrait as MvcView;
use Gear\Mvc\Controller\ControllerTestServiceTrait;
use Gear\Mvc\Controller\ControllerServiceTrait as MvcControllerService;
use Gear\Mvc\ConsoleController\ConsoleControllerTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;

class ActionService extends AbstractJsonService
{
    /* schema */
    use JsonAction;

    /* mvc config */
    use ConfigServiceTrait;

    /* mvc config route */
    use RouterManagerTrait;

    /* mvc config navigation */
    use NavigationManagerTrait;

    /* mvc console controller */
    use ConsoleControllerTestTrait;
    use ConsoleControllerTrait;

    /* mvc controller */
    use ControllerTestServiceTrait;
    use MvcControllerService;

    /* mvc view */
    use MvcView;

    public function createControllerAction($data)
    {
        $module = $this->getModule()->getModuleName();

        $this->action = $this->getActionService()->create($module, $data['controller'***REMOVED***, $data['name'***REMOVED***);
        $this->controller = $this->getActionService()->getSchemaService()->getController($module, $data['controller'***REMOVED***);
        $this->controller = new Controller($this->controller);
        $this->action->setController($this->controller);

        if ($this->controller->getType() == 'Action') {
            $this->getMvcController()->build($this->controller);
            $this->getControllerTestService()->build($this->controller);
            $this->getNavigationManager()->create($this->action);
            $this->getRouterManager()->create($this->action);
            $this->getViewService()->build($this->action);
            return;
        }


        if ($this->controller->getType() == 'Console') {
            $this->getConsoleController()->build($this->controller);
            $this->getConsoleControllerTest()->build($this->controller);
            $this->getConsoleRouter()->insertRoutes($this->action);
            return;
        }


        return true;

    }

    public function delete($data = array())
    {
        return true;
    }
}
