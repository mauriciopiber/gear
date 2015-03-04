<?php
namespace Gear\Service\Column;

use Gear\Service\Column\Varchar;

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
