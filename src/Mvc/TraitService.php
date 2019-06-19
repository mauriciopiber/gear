<?php
namespace Gear\Mvc;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\AbstractMvcInterface;
use Gear\Mvc\Config\ServiceManagerTrait;

class TraitService extends AbstractMvc implements AbstractMvcInterface
{
    use ServiceManagerTrait;

    public function createTrait(
        $src,
        $location = null,
        $name = null,
        $testLocation = null,
        $isSearchForm = false,
        $specialName = null
    ) {
        if ($name === null) {
            $name = $src->getName();
        }

        $location = $this->getCode()->getLocation($src);

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/trait/src.phtml');
        $trait->setFileName($name.'Trait.php');
        $trait->setLocation($location);

        $trait->setOptions(
            [
                'classDocs' => $this->getCode()->getClassDocs($src),
                'module' => $this->getModule()->getModuleName(),
                'namespace' => $this->getCode()->getNamespace($src),
                'class' => $this->str('class', $name),
                'label' => $this->str('label', $name),
                'var'   => $this->str('var', $name),
                'lenght' => $this->str('var-length', $name, ['offset' => 'mock'***REMOVED***),
                'srcType' => $src->getType(),
                'srcName' => $src->getName(),
            ***REMOVED***
        );

        return $trait->render();
    }
}
