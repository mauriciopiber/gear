<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\Constructor\ValueObject\Controller;

class ControllerMaker extends AbstractJsonService
{
    public function create($data = array())
    {
        $controller = new Controller($data);

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
