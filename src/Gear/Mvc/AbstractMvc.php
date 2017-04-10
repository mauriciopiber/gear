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
use Gear\Util\GearVersionTrait;

abstract class AbstractMvc extends AbstractJsonService
{
    use GearVersionTrait;
    use InjectorTrait;
    use InjectTrait;
    use ConstructorArgsTrait;
    use CodeTrait;
    use InterfaceServiceTrait;
    use TraitServiceTrait;
    use FactoryServiceTrait;

    static protected $factories = 'factories';

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

    /**
     * @deprecated Should use Code directly
     *
     * @param Controller $controller
     * @param unknown $lines
     */
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

    /**
     * @deprecated Should use Code directly
     */
    public function createUseAttributes(Controller $controller, $lines)
    {
        //pegar os attributes

        $useAttributesFile = preg_grep('/^    use [0-9a-zA-Z***REMOVED***/', $lines, PREG_OFFSET_CAPTURE);


        //pega as dependency do controller + action

        $useAttrText = $this->getCode()->getUseAttribute($controller);
        $useAttribute = explode(PHP_EOL, $useAttrText);

        if (empty($useAttrText)) {
            return $lines;
        }


        //junta com os ítens atuais
        $useAttributes = array_merge($useAttributesFile, $useAttribute);

        //separa os únicos
        $useAttributes = array_unique($useAttributes, SORT_REGULAR);



        $filtered = [***REMOVED***;

        foreach ($useAttributes as $i => $link) {
            $filtered[***REMOVED*** = $link;

            if (isset($useAttributes[$i+1***REMOVED***)) {
                $filtered[***REMOVED*** = '';
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

        $limit = max(array_keys($useAttributesFile))-$offset+2;

        if (!empty($useAttributes)) {
            $lines = $this->getArrayService()->replaceRange($lines, $offset, $limit, $filtered);
        }

        return $lines;
    }
}
