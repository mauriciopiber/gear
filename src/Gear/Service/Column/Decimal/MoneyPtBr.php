<?php
namespace Gear\Service\Column\Decimal;

use Gear\Service\Column\Decimal;

class MoneyPtBr extends Decimal
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'decimal') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }
}
