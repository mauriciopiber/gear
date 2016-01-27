<?php
namespace Gear\Column;

use Gear\Column\Varchar;

class Longtext extends AbstractColumn
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'longtext') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }
}
