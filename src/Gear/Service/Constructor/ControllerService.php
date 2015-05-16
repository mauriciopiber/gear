<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\ValueObject\Controller;
use Gear\Common\ControllerServiceTrait as RenameControllerServiceTrait;
use Gear\Common\ConfigServiceTrait;
use Gear\Common\ControllerTestServiceTrait as RenameControllerTestServiceTrait;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

class ControllerService extends AbstractJsonService
{
    use RenameControllerTestServiceTrait;
    use RenameControllerServiceTrait;
    use ConfigServiceTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function isValid($data)
    {
        return true;
    }

    public function create($data = array())
    {
        if ($this->isValid($data)) {
            $controller = new Controller($data);

            $jsonStatus = $this->getGearSchema()->insertController(
                $this->getGearSchema()->decode(
                    $this->getGearSchema()->getJsonFromFile()
                ),
                $controller->export()
            );

            if ($jsonStatus) {
                $this->setUpControllerTest($controller);
                $this->setUpController($controller);
                $this->updateControllerManager();
                return true;
            }
        }
        return false;
    }

    public function delete($data = array())
    {
        $this->getEventManager()->trigger('doTest', $controller, $data);
        return true;
    }

    public function updateControllerManager()
    {
        $config = $this->getConfigService();
        $config->mergeControllerConfig();
    }

    public function setUpControllerTest(Controller $controller)
    {

        $controllerService = $this->getControllerTestService();
        $controllerService->implement($controller);

    }

    public function setUpController(Controller $data)
    {
        $controllerService = $this->getControllerService();
        $controllerService->implement($data);
    }

}
