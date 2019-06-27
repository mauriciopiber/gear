<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\TraitServiceTrait;
use Gear\Mvc\InterfaceServiceTrait;
use Gear\Mvc\Factory\FactoryServiceTrait;
use Gear\Schema\Controller\Controller;
use Gear\Util\GearVersionTrait;
use Gear\Schema\Db\Db as DbObject;
use Gear\Schema\App\App as AppObject;
use Gear\Schema\Src\Src as SrcObject;
use Gear\Exception\InvalidArgumentException;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Code\Code;
use Gear\Code\CodeTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\Dir\DirService;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Table\TableService\TableService;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Mvc\Config\ServiceManager;
use Gear\Util\Vector\ArrayService;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Creator\Injector\Injector;
use Gear\Creator\Injector\InjectorTrait;

abstract class AbstractMvc
{

    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $string,
        Code $code,
        DirService $dirService,
        TableService $tableService,
        ArrayService $array,
        Injector $injector
    ) {
        $this->setArrayService($array);
        $this->setCode($code);
        $this->setModule($module);
        $this->setFileCreator($fileCreator);
        $this->setStringService($string);
        $this->setDirService($dirService);
        $this->setTableService($tableService);
        $this->setInjector($injector);
    }

    use InjectorTrait;

    use ArrayServiceTrait;

    use TableServiceTrait;

    use DirServiceTrait;

    use StringServiceTrait;

    use FileCreatorTrait;

    use ModuleStructureTrait;

    use CodeTrait;


    /**
     * Resolve all Modules Namespaces to PSR-4 folders
     */
    public function getResolveModule()
    {
        if (!strpos($this->getModule()->getModuleName(), '\\') !== false) {

            return $this->str('class', $this->getModule()->getModuleName());
        }

        $module = $this->getModule()->getModuleName();

        $pieces = explode('\\', $module);
        $fixStack = [***REMOVED***;

        foreach ($pieces as $index => $piece) {
            if (empty($piece)) {
                continue;
            }
            $fixStack[***REMOVED*** = $this->str('class', $piece);
        }
        return implode('/', $fixStack);
    }

    /**
     * Fix all Modules Namespaces to PSR-4
     */
    public function getModuleNamespace()
    {
        if (!strpos($this->getModule()->getModuleName(), '\\') !== false) {
            return $this->str('class', $this->getModule()->getModuleName());
        }

        $module = $this->getModule()->getModuleName();

        $pieces = explode('\\', $module);
        $fixStack = [***REMOVED***;

        foreach ($pieces as $index => $piece) {
            if (empty($piece)) {
                continue;
            }
            $fixStack[***REMOVED*** = $this->str('class', $piece);
        }

        return implode('\\\\', $fixStack);
    }


    public function forceDb($data, $type)
    {
        if (($data instanceof DbObject) === false && ($data instanceof SrcObject && $data->getDb() != null) === false) {
            throw new InvalidArgumentException(sprintf('%s need a valid db', $type));
        }

        return $this->create($data, $type);
    }

    public function forceSrc($data, $type)
    {
        if (($data instanceof DbObject) || ($data instanceof SrcObject && $data->getDb() != null)) {
            throw new InvalidArgumentException(sprintf('%s need to be free from db', $type));
        }

        return $this->create($data, $type);
    }

    public function create($data, $type)
    {
        if ($data instanceof DbObject) {
            $this->db = $data;
            $this->src = $this->getSchemaService()->getSrcByDb($this->db, $type);
            return $this->createDb();
        }

        if ($data instanceof SrcObject && $data->getDb() instanceof DbObject) {
            $this->src = $data;
            $this->db = $this->src->getDb();
            return $this->createDb();
        }

        if ($data instanceof AppObject) {
            $this->app = $data;
            return $this->createApp();
        }

        $this->src = $data;
        return $this->createSrc();
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
