<?php
namespace Gear\Creator;

interface FileLocationInterface
{
    public $defaultLocation;

    public function getLocation();
}
