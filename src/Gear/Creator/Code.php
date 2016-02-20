<?php
namespace Gear\Creator;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use GearBase\Util\Dir\DirServiceTrait;
use GearBase\Util\Dir\DirServiceAwareInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringServiceAwareInterface;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;
use Gear\Creator\FileExtendsInterface;
use Gear\Creator\FileUseAttributeInterface;
use Gear\Creator\FileUseInterface;
use GearJson\Src\Src;
use GearJson\Db\Db;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;

class Code implements
    FileNamespaceInterface,
    FileLocationInterface,
    FileExtendsInterface,
    FileUseAttributeInterface,
    FileUseInterface,
    ModuleAwareInterface,
    ServiceLocatorAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface
{

    use DirServiceTrait;
    use ServiceManagerTrait;
    use StringServiceTrait;
    use ModuleAwareTrait;
    use ServiceLocatorAwareTrait;

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

            $namespace = ($data->getNamespace()[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';


            $namespace .= $data->getNamespace();
            return $namespace;
            //cria um diretório específico.
        }

        if ($data->getType() == 'SearchForm') {
            $type = 'Form\\Search';
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

    public function classNameToNamespace($data)
    {
        $namespace = '';

        if (empty($data->getNamespace())) {

            if ($data->getType() == 'SearchForm') {
                $type = 'Form\\Search';
            } else {
                $type = $data->getType();
            }

            return 'use '.$this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName().';'.PHP_EOL;
        }

        throw new \Exception('implement');
    }

    public function getUse($data)
    {
        if (!($data instanceof Src) && !($data instanceof Controller)) {
            throw new \Exception('ARRUMA FDP');
        }

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
