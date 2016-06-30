<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Creator\CodeTrait;
use Gear\Mvc\TraitServiceTrait;
use Gear\Mvc\InterfaceServiceTrait;
use Gear\Mvc\Factory\FactoryServiceTrait;
use GearJson\Controller\Controller;
use Gear\Creator\FileCreator\App\ConstructorArgsTrait;
use Gear\Creator\FileCreator\App\InjectTrait;
use Gear\Creator\File\InjectorTrait;

abstract class AbstractMvc extends AbstractJsonService
{
    use InjectorTrait;
    use InjectTrait;
    use ConstructorArgsTrait;
    use CodeTrait;
    use InterfaceServiceTrait;
    use TraitServiceTrait;
    use FactoryServiceTrait;



    public function hasUniqueConstraint()
    {
        $constraints = $this->tableObject->getConstraints();

        foreach ($constraints as $constraint) {
            if ($constraint->getType() == 'UNIQUE') {
                return true;
            }
        }

        return false;
    }

    public function getActionsToInject($controller, $fileActions)
    {
        $insertMethods = [***REMOVED***;
        if (!empty($controller->getActions())) {
            foreach ($controller->getActions() as $action) {
                $checkAction = $this->str('class', $action->getName());
                if (!in_array($checkAction, $fileActions)) {
                    $insertMethods[***REMOVED*** = $action;
                }
            }
        }

        return $insertMethods;
    }

    public function createUse(Controller $controller, $lines)
    {
        $useFile = preg_grep('/^use [0-9a-zA-Z***REMOVED***/', $lines, PREG_OFFSET_CAPTURE);

        $use = explode(PHP_EOL, $this->getCode()->getUse($controller));

        $uses = array_merge($useFile, $use);
        $uses = array_unique($uses, SORT_REGULAR);

        foreach ($uses as $key => $link) {
            if ($link === '') {
                unset($uses[$key***REMOVED***);
            }
        }

        $offset = min(array_keys($useFile));

        $limit = max(array_keys($useFile))-$offset+1;

        if (!empty($uses)) {
            $lines = $this->getArrayService()->replaceRange($lines, $offset, $limit, $uses);
        }

        return $lines;
    }

    public function createUseAttributes(Controller $controller, $lines)
    {
        //pegar os attributes

        $useAttributesFile = preg_grep('/^    use [0-9a-zA-Z***REMOVED***/', $lines, PREG_OFFSET_CAPTURE);


        $useAttribute = explode(PHP_EOL, $this->getCode()->getUseAttribute($controller));
        $useAttributes = array_merge($useAttributesFile, $useAttribute);
        $useAttributes = array_unique($useAttributes, SORT_REGULAR);



        foreach ($useAttributes as $key => $link) {
            if ($link === '') {
                unset($useAttributes[$key***REMOVED***);
            }
        }


        if (count($useAttributesFile) == 0) {
            $line = array_search('{', $lines);

            if ($lines[$line+1***REMOVED*** !== "") {
                $useAttributes[***REMOVED*** = "";
            }

            $lines = $this->getArrayService()->moveArray($lines, $line+1, $useAttributes);
            //adiciona em um arquivo que não tem espaço.
            return $lines;
        }

        $offset = min(array_keys($useAttributesFile));

        $limit = max(array_keys($useAttributesFile))-$offset+1;



        if (!empty($useAttributes)) {
            $lines = $this->getArrayService()->replaceRange($lines, $offset, $limit, $useAttributes);
        }

        return $lines;

    }
}
