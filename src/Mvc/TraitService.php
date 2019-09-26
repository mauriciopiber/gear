<?php
namespace Gear\Mvc;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\AbstractMvcInterface;

class TraitService extends AbstractMvc implements AbstractMvcInterface
{
    public function createTrait(
        $src,
        $location = null,
        $name = null,
        $testLocation = null,
        $isSearchForm = false,
        $specialName = null
    ) {

        if ($this->getCode()->skipApi($src)) {
            return;
        }
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
                'callable' => $this->getCode()->getServiceManagerName($src),
                'classDocs' => $this->getCode()->getClassDocs($src),
                'module' => $this->getModule()->getNamespace(),
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
