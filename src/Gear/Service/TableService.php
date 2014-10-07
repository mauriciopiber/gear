<?php
namespace Gear\Service;

class TableService extends \Gear\Service\AbstractService
{
    public function getTable($tableName)
    {
        $table = $this->getRepository('table')->get($tableName);
        $tableObject = new \Gear\ValueObject\Table($table);

        return $tableObject;
    }
}
