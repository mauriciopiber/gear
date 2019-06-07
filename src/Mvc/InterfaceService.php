<?php
namespace Gear\Mvc;

use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Schema\Src\Src;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\String\StringServiceAwareInterface;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Creator\CodeTrait;
use Gear\Util\Dir\DirServiceTrait;

class InterfaceService, ModuleStructureInterface, StringServiceAwareInterface
{
    use FileCreatorTrait;
    use StringServiceTrait;
    use ModuleStructureTrait;
    use CodeTrait;
    use DirServiceTrait;

    //namespace
    //extends
    //dependency
    public function create(Src $src)
    {
        $this->src = $src;
        $this->name = $this->src->getName();
        $this->srcType = $this->src->getType();


        // prevent use reserved language word
        if ($this->src->getNamespace() == null) {
            $this->src->setNamespace('Interfaces');
        }

        $location = $this->getCode()->getLocation($this->src);

        //create folder because it's not a default on Interfaces.
        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }


        $options = [
            'module' => $this->getModule()->getModuleName(),
            'class' => $this->str('class', $this->name),
            'var'   => $this->str('var', $this->name),
            'lenght' => $this->str('var-length', $this->name),
            'srcType' => $this->srcType,
            'srcName' => $this->name
        ***REMOVED***;

        $options['dependency'***REMOVED*** = $this->getCode()->getInterfaceDependency($this->src);
        $options['namespace'***REMOVED*** = $this->getCode()->getNamespace($this->src);
        $options['extends'***REMOVED*** = $this->getCode()->getExtends($this->src);
        $options['use'***REMOVED*** = $this->getCode()->getInterfaceUse($this->src);
        $options['classDocs'***REMOVED*** = $this->getCode()->getClassDocs($this->src, 'Interface');



        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/interface/src/interface.phtml');
        $trait->setFileName($this->name.'.php');
        $trait->setLocation($location);

        $trait->setOptions($options);

        return $trait->render();
    }

    public function createInterface(Src $src)
    {
        $this->src = $src;

        $location = $this->getCode()->getLocation($this->src);

        $this->name = $this->src->getName();
        $this->srcType = $this->src->getType();

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/interface/db/interface.phtml');
        $trait->setFileName($this->name.'Interface.php');
        $trait->setLocation($location);

        $trait->setOptions(
            [
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->str('class', $this->name),
                'var'   => $this->str('var', $this->name),
                'lenght' => $this->str('var-length', $this->name),
                'srcType' => $this->srcType,
                'srcName' => $this->name,
                'srcLabel' => $this->str('label', $this->name)
            ***REMOVED***
        );

        return $trait->render();
    }
}
