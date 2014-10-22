<?php
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;

class DbService extends AbstractJsonService
{
    public function create($tableName)
    {
        return 'create table';
    }
}
