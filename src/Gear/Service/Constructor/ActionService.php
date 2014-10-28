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

class ActionService extends AbstractJsonService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data = array())
    {
        $this->getEventManager()->trigger('doTest', $this, array('name' => 'actionInsideService'));
        return true;
    }

    public function delete($data = array())
    {
        return true;
    }
}
