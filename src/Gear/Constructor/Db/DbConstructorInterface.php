<?php
namespace Gear\Constructor\Db;

use GearJson\Db\Db;

interface DbConstructorInterface
{
    public function introspectFromTable(Db $db);
}
