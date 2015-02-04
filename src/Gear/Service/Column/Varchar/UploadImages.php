<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;

class UploadImages extends Varchar
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'varchar') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }
}
