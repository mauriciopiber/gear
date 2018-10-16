<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Mvc\Controller\AbstractControllerService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use GearBase\Util\String\StringService;
use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\Code;
use Gear\Creator\CodeTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Mvc\Factory\FactoryService;
use Gear\Mvc\Factory\FactoryServiceTrait;
use GearJson\Controller\Controller as ControllerValueObject;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Mvc/Controller/Api
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ApiControllerService extends AbstractControllerService
{
    use ModuleStructureTrait;
    use StringServiceTrait;
    use CodeTrait;
    use FileCreatorTrait;
    use FactoryServiceTrait;

    /**
     * Constructor
     *
     * @return ApiControllerService
     */
    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $stringService,
        Code $code,
        FactoryService $factoryService
    ) {
        $this->factoryService = $factoryService;
        $this->module = $module;
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->code = $code;
        return $this;
    }

    public function module()
    {
        $file = $this->getFileCreator();
        $file->setOptions($this->getConfig());
        $file->setTemplate('template/module/mvc/rest/module/controller.phtml');
        $file->setFileName('IndexController.php');
        $file->setLocation($this->module->getControllerFolder());

        return $file->render();
    }

    public function moduleFactory()
    {
        $file = $this->getFileCreator();
        $file->setOptions($this->getConfig());
        $file->setTemplate('template/module/mvc/rest/module/controller-factory.phtml');
        $file->setFileName('IndexControllerFactory.php');
        $file->setLocation($this->module->getControllerFolder());

        return $file->render();
    }

    private function getConfig() {
        return [
            'module' => $this->str('class', $this->getModule()->getModuleName()),
        ***REMOVED***;
    }


    public function buildController($controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCode()->getLocation($controller);
        //var_dump($this->location, 'hehe');
        $this->fileName = sprintf('%s.php', $controller->getName());
        $this->controllerFile = $this->location.'/'.$this->fileName;

        $options = [
            'classDocs' => $this->getCode()->getClassDocs($controller, 'Controller'),
            'implements' => $this->getCode()->getImplements($controller),
            'extends' => $this->getCode()->getExtends($controller),
            'attribute' => $this->getCode()->getUseAttribute($controller),
            'use' => $this->getCode()->getUse($controller),
            'namespace' => $this->getCode()->getNamespace($controller),
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'actions' => $controller->getAction(),
            'controllerName' => $controller->getName(),
            'controllerUrl' => $this->str('url', $controller->getName()),
        ***REMOVED***;

        $options['constructor'***REMOVED*** = ($controller->isFactory())
          ? $this->getCode()->getConstructor($controller)
          : '';

        $this->template = 'template/module/mvc/rest/controller/controller.phtml';

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);
        $this->controller = $controller;
        $this->controllerFile = $this->getModule()->getControllerFolder().'/'.sprintf('%s.php', $controller->getName());


        $this->file->setFileName(sprintf('%s.php', $controller->getName()));
        $this->file->setOptions($options);

        if ($controller->isFactory()) {
            $this->getFactoryService()->createFactory($controller, $this->location);
        }

        return $this->file->render();
    }


    public function buildAction(ControllerValueObject $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCode()->getLocation($controller);
        $this->fileName = sprintf('%s.php', $controller->getName());
        $this->controllerFile = $this->location.'/'.$this->fileName;

        $this->mergeActions();
    }


    public function actionToController($insertMethods)
    { 

        $this->functions = '';

        foreach ($insertMethods as $method) {
            $label = $this->str('label', $method->getName());

            $this->functions .= <<<EOS

    /**
     * {$label}
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function {$this->str('var', $method->getName())}Action()
    {
        return new JsonModel([***REMOVED***);
    }

EOS;
        }

        $this->functions = explode(PHP_EOL, $this->functions);
        return $this->functions;
    }
}
