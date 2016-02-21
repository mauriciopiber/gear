<?php
namespace Gear\Creator;

use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;
use Gear\Creator\FileExtendsInterface;
use Gear\Creator\FileUseAttributeInterface;
use Gear\Creator\FileUseInterface;

class Code extends AbstractCode implements
    FileExtendsInterface,
    FileUseAttributeInterface,
    FileUseInterface
{
    static protected $defaultLocation;

    static protected $defaultNamespace;


    public function getExtends($data)
    {
        if ($data->getExtends() === null) {

            if ($data instanceof Controller) {
                return 'AbstractActionController';
            }

            return null;
        }

        $extendsItem = explode('\\', $data->getExtends());
        return end($extendsItem);
    }

    public function getNamespace($data)
    {
        if (!empty($data->getNamespace())) {

            $namespace = ($data->getNamespace()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';


            $namespace .= $data->getNamespace();
            return $namespace;
            //cria um diretório específico.
        }

        if ($data->getType() == 'SearchForm') {
            $type = 'Form\\Search';
        } elseif ($data->getType() == 'ViewHelper') {
            $type = 'View\\Helper';
        } else {
            $type = $data->getType();
        }

        return $this->getModule()->getModuleName().'\\'.$type;
    }

    public function getLocation($data)
    {
        if (!empty($data->getNamespace())) {

            $namespace = ($data->getNamespace()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $psr = explode('\\', $data->getNamespace());
            $location = $this->getModule()->getSrcModuleFolder().'/'.implode('/', $psr);
            $this->getDirService()->mkDeepDir(implode('/', $psr), $this->getModule()->getSrcModuleFolder());
            $this->getDirService()->mkDir($location);
            return $location;
            //cria um diretório específico.
        }

        return $this->getModule()->map($data->getType());

    }


    /**
     * Retorna o nome completo que consiste no Namespace + Nome.
     */
    public function getClassName($data)
    {
        $namespace = '';

        if ($data instanceof Src) {

            if (empty($data->getNamespace())) {

                if ($data->getType() == 'SearchForm') {
                    $type = 'Form\\Search';
                } else {
                    $type = $data->getType();
                }

                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName();
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName();
        }

        if ($data instanceof Controller) {

            if (empty($data->getNamespace())) {

                $type = 'Controller';
                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName();
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName();

        }

        return $namespace;
    }


    public function classNameToNamespace($data)
    {
        $namespace = '';

        if ($data instanceof Src) {

            if (empty($data->getNamespace())) {

                if ($data->getType() == 'SearchForm') {
                    $type = 'Form\\Search';
                } else {
                    $type = $data->getType();
                }

                return 'use '.$this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName().';'.PHP_EOL;
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName().';'.PHP_EOL;
        }

        if ($data instanceof Controller) {

            if (empty($data->getNamespace())) {

                $type = 'Controller';
                return 'use '.$this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName().';'.PHP_EOL;
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName().';'.PHP_EOL;

        }


        return 'use '.$namespace;
    }

    public function getUse($data)
    {
        if ($data instanceof Src) {
            $this->dependency = new \Gear\Creator\Src\Dependency($data, $this->getModule());
        }

        if ($data instanceof Controller) {
            $this->dependency = new \Gear\Creator\Controller\Dependency($data, $this->getModule());
        }

        $this->uses = $this->dependency->getUseNamespace(false);

        if ($data->getExtends() !== null) {

            $namespace = ($data->getExtends()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $extendsItem = explode('\\', $data->getExtends());
            $this->uses .= 'use '.$namespace.implode('\\', $extendsItem).';'.PHP_EOL;
        }

        if ($data->getExtends() == null && $data instanceof Controller) {
            $this->uses .= 'use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL;
        }

        return $this->uses;
    }


    public function getUseAttribute($data)
    {

        if ($data instanceof Src) {
            $this->dependency = new \Gear\Creator\Src\Dependency($data, $this->getModule());
        }

        $attributes = $this->dependency->getUseAttribute(false);
        return $attributes;
    }
}
