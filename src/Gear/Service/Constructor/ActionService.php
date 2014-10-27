<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

class ActionService extends AbstractJsonService implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    public function __construct()
    {
        $this->getEventManager()->trigger('init', $this, array());
    }



    public function create($data = array())
    {
        $this->getEventManager()->trigger('doTest', $this, array('name' => 'action'));
        return true;
    }

    public function delete($data = array())
    {
        return true;
    }
}
