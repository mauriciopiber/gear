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

            return true;
        } else {
            return false;
        }
        //json
        //tests
        //php
        //servicemanager
    }

    public function delete($data = array())
    {
        $this->getEventManager()->trigger('doTest', $controller, $data);
        return true;
    }

    public function createSingleController(array $data)
    {


       // $this->getJsonService()->tempJson()->addController($controller);

        if ($this->getJsonService()->isValid()) {

            $this->createController($controller);

        } else {
            return $this->getJsonService()->getAllMessage();
        }
    }

    public function createController(Controller $controller)
    {

    }
}
