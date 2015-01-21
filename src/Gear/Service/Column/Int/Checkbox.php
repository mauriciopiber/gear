<?php
namespace Gear\Service\Column\Int;

use Gear\Service\Column\Int;
use Gear\Service\Column\AbstractCheckbox;

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
