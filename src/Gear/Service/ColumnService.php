<?php
namespace Gear\Service;

class ColumnService extends \Gear\Service\AbstractService
{
    public function getColumn($columnName,$tableName)
    {
        $column = $this->getRepository('column')->get($columnName,$tableName);
        $columnObject = new \Gear\ValueObject\Column($column);

        return $columnObject;
    }
}
