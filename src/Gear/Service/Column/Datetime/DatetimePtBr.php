<?php
namespace Gear\Service\Column\Datetime;

use Gear\Service\Column\Datetime;

class DatetimePtBr extends Datetime
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'datetime') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }
}
