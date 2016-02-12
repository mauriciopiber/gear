<?php
namespace Gear\Creator;

interface FileNamespaceInterface
{
    public $defaultNamespace;

    public function getNamespace();
}
