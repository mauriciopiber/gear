<?php
namespace Gear\Constructor\Db;

use Gear\Schema\Db\Db;

interface DbConstructorInterface
{
    public function introspectFromTable(Db $db);
}
