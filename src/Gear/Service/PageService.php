<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\Constructor\AbstractJsonService;

class PageService extends AbstractJsonService
{
    public function create()
    {
        return 'sem mock';
    }

    public function delete()
    {
        return null;
    }
}
