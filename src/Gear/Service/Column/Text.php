<?php
namespace Gear\Service\Column;

class Text extends AbstractColumn
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'text') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }
}
