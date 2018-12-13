<?php
namespace Gear\Creator;

/**
 * Retorna o Namespace do arquivo que será criado, tanto para testes *Test quanto para Src.
 */
interface FileNamespaceInterface
{
    public function getNamespace($data);
}
