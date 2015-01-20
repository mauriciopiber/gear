<?php
namespace Gear\Service\Column\Date;

use Gear\Service\Column\Date;

class DatePtBr extends Date
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'date') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }
}
