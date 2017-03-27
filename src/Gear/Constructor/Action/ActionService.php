<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Action;

use Gear\Service\AbstractJsonService;

use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\Action\ActionServiceTrait as JsonAction;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\RouterManagerTrait;
use Gear\Mvc\Config\ConsoleRouterManagerTrait;
use Gear\Mvc\Config\NavigationManagerTrait;
use Gear\Mvc\View\ViewServiceTrait as MvcView;
use Gear\Mvc\Controller\ControllerTestServiceTrait;
use Gear\Mvc\Controller\ControllerServiceTrait as MvcControllerService;
use Gear\Mvc\ConsoleController\ConsoleControllerTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;
use Gear\Mvc\View\App\AppControllerServiceTrait;
use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\Spec\Feature\FeatureTrait;
use Gear\Mvc\Spec\Page\PageTrait;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;

class ActionService extends AbstractJsonService
{
    use PageTrait;

    use FeatureTrait;

    use AppControllerServiceTrait;

    use AppControllerSpecServiceTrait;

    /* schema */
    use JsonAction;

    /* mvc config */
    use ConfigServiceTrait;

    /* mvc config route */
    use ConsoleRouterManagerTrait;
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

        $this->action = $this->getActionService()->create(
            $module,
            $data['controller'***REMOVED***,
            $data['name'***REMOVED***,
            isset($data['route'***REMOVED***) ? $data['route'***REMOVED*** : null,
            isset($data['role'***REMOVED***) ? $data['role'***REMOVED*** : null,
            isset($data['dependency'***REMOVED***) ? $data['dependency'***REMOVED*** : null,
            isset($data['db'***REMOVED***) ? $data['db'***REMOVED*** : null,
            isset($data['columns'***REMOVED***) ? $data['columns'***REMOVED*** : null
        );

        if ($this->action instanceof ConsoleValidationStatus) {
            return $this->action;
        }

        $this->controller = $this->getActionService()->getSchemaService()->getController($module, $data['controller'***REMOVED***);
        $this->controller = new Controller($this->controller);
        $this->action->setController($this->controller);

        if ($this->str('class', $this->controller->getType()) == 'Action') {
            $this->getMvcController()->buildAction($this->controller);
            $this->getControllerTestService()->buildAction($this->controller);
            $this->getNavigationManager()->create($this->action);
            $this->getRouterManager()->create($this->action);
            $this->getViewService()->build($this->action);
            $this->getAppControllerService()->build($this->action);
            $this->getAppControllerSpecService()->build($this->action);
            $this->getFeature()->build($this->action);
            //$this->getPage()->build($this->action);
            return true;
        }

        if ($this->str('class', $this->controller->getType()) == 'Console') {
            $this->getConsoleController()->buildAction($this->controller);
            $this->getConsoleControllerTest()->buildAction($this->controller);
            $this->getConsoleRouterManager()->create($this->action);
            return true;
        }


        return false;
    }
}
