<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;
use Gear\Creator\FileExtendsInterface;
use Gear\Creator\FileUseAttributeInterface;
use Gear\Creator\FileUseInterface;

abstract class AbstractMvc extends AbstractJsonService implements
    FileNamespaceInterface,
    FileLocationInterface,
    FileExtendsInterface,
    FileUseAttributeInterface,
    FileUseInterface
{
    static protected $defaultLocation;

    static protected $defaultNamespace;


    public function getExtends($data)
    {
        if ($data->getExtends() === null) {
            return null;
        }

        $extendsItem = explode('\\', $data->getExtends());
        return end($extendsItem);
    }

    public function getNamespace($data)
    {
        if (!empty($data->getNamespace())) {
            $namespace = $data->getNamespace();
            return $namespace;
            //cria um diretório específico.
        }

        return static::$defaultNamespace;
    }

    public function getLocation($data)
    {
        if (!empty($data->getNamespace())) {

            $psr = explode('\\', $data->getNamespace());
            $location = $this->getModule()->getSrcModuleFolder().'/'.implode('/', $psr);
            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getSrcModuleFolder());
            $this->getDirService()->mkDir($location);

            return $location;
            //cria um diretório específico.
        }

        return static::$defaultLocation;
    }

    public function getUse($data)
    {
        $this->uses = $this->dependency->getUseNamespace(false);

        if ($data->getExtends() !== null) {

            $namespace = ($data->getExtends()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $extendsItem = explode('\\', $data->getExtends());
            $this->uses .= 'use '.$namespace.implode('\\', $extendsItem).';'.PHP_EOL;
        }

        return $this->uses;
    }

    public function getUseAttribute($data)
    {
        $attributes = $this->dependency->getUseAttribute(false);
        return $attributes;
    }
}
