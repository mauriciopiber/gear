<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\Constructor\ValueObject\Controller;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
class ControllerService extends AbstractJsonService implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    public function __construct()
    {
        $this->getEventManager()->trigger('init', $this, array());
    }


    public function create($data = array())
    {
        $controller = new Controller($data);


        $this->getEventManager()->trigger('doTest', $this, array('name' => 'controller'));
        //json
        //tests
        //php
        //servicemanager

        return true;
    }

    public function delete($data = array())
    {
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
