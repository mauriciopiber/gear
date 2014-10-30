<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\ValueObject\Controller;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

class ControllerService extends AbstractJsonService
{
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

            $schema = $this->getSchema();

            $jsonStatus = $this->getJsonService()->insertController($this->getSchema(), $controller->export());

            if ($jsonStatus) {

                //$this->createSingleControllerTest($controller);
                //$this->createSingleController($controller);
                //$this->updateControllerManager();
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
        $config = $this->getServiceLocator()->get('configService');

        $config->mergeControllerConfig($this->getJson());
    }

    public function createSingleControllerTest(Controller $data)
    {

    }

    public function createSingleController(Controller $data)
    {



    }

}
