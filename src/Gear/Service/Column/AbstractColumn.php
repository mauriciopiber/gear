<?php
namespace Gear\Service\Column;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Object\ColumnObject;

abstract class AbstractColumn extends AbstractJsonService
{
    protected $column;

    public function __construct(ColumnObject $column)
    {
        $this->setColumn($column);
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function setColumn(ColumnObject $column)
    {
        $this->column = $column;
        return $this;
    }
}
