<?php
namespace Gear\Column\Int;

use Gear\Column\Int\AbstractCheckbox;

class Checkbox extends AbstractCheckbox
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }


}
