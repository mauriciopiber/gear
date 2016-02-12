<?php
namespace Gear\Creator;

/**
 * Retorna o Namespace do Objecto que Será testado, aqui deve ser usado o ServiceManagerHelper.
 */
interface FileTestNamespaceInterface
{
    public function getTestNamespace($data);
}
