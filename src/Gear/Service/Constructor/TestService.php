<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\Constructor\ValueObject\Controller;

class TestService extends AbstractJsonService
{
    public function create($data = array())
    {
        $controller = new Controller($data);

        $this->getEventManager()->trigger('doTest', $this, array('name' => 'testService'));

        return true;
    }

    public function delete($data = array())
    {
        return true;
    }
}
