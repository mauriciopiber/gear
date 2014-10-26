<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;

class ActionService extends AbstractJsonService
{
    public function create($data = array())
    {

        return true;
    }

    public function delete($data = array())
    {
        return true;
    }
}
