<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;

abstract class AbstractMvcTest extends AbstractJsonService implements FileNamespaceInterface, FileLocationInterface
{

    public function getNamespace($data)
    {

    }

    public function getLocation($data)
    {

    }
}
