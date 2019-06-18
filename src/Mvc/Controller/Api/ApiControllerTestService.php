<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Mvc\Controller\AbstractControllerTestService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Creator\CodeTest;
use Gear\Creator\CodeTestTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Schema\Controller\Controller as ControllerValueObject;
use Gear\Mvc\Config\ControllerManagerTrait;
use Gear\Mvc\Config\ControllerManager;
use Gear\Creator\Injector\Injector;
use Gear\Creator\Injector\InjectorTrait;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Mvc\Factory\FactoryTestServiceTrait;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Mvc/Controller/Api
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ApiControllerTestService extends AbstractControllerTestService
{
    use ControllerManagerTrait;
    use ModuleStructureTrait;
    use StringServiceTrait;
    use CodeTestTrait;
    use FileCreatorTrait;
    use InjectorTrait;
    use FactoryTestServiceTrait;

    /**
     * Constructor
     *
     * @return ApiControllerTestService
     */
    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $stringService,
        CodeTest $codeTest,
        FactoryTestService $factoryTest,
        ControllerManager $controllerManager,
        Injector $injector
    ) {
        $this->factoryTestService = $factoryTest;
        $this->injector = $injector;
        $this->module = $module;
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->codeTest = $codeTest;
        $this->controllerConfig = $controllerManager;
        return $this;
    }

    public function module()
    {
        $file = $this->getFileCreator();
        $file->setOptions($this->getConfig());
        $file->setTemplate('template/module/mvc/rest-test/module/controller.phtml');
        $file->setFileName('IndexControllerTest.php');
        $file->setLocation($this->module->getTestControllerFolder());

        return $file->render();
    }

    public function moduleFactory()
    {
        $file = $this->getFileCreator();
        $file->setOptions($this->getConfig());
        $file->setTemplate('template/module/mvc/rest-test/module/controller-factory.phtml');
        $file->setFileName('IndexControllerFactoryTest.php');
        $file->setLocation($this->module->getTestControllerFolder());

        return $file->render();
    }

    private function getConfig() {
        $namespace = $this->getModule()->getNamespace();
        $namespace = preg_replace('/\\\\/i', '\\\\\\\\', $namespace);

        return [
            'module' => $namespace
        ***REMOVED***;
    }

    public function buildController(ControllerValueObject $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCodeTest()->getLocation($controller);
        $this->fileName = sprintf('%sTest.php', $controller->getName());

        $this->controllerFile = $this->location.'/'.$this->fileName;

        $options = [
            'callable' => $this->getControllerManager()->getServiceName($controller),
            'namespaceFile' => $this->getCodeTest()->getNamespace($controller),
            'namespace' => $this->getCodeTest()->getTestNamespace($controller),
        ***REMOVED***;

        $options = $this->mergeConfig($options);

        $templateView = ($this->controller->isFactory()) ? 'factory' : 'invokable';

        $this->template = 'template/module/mvc/rest-test/controller/'.$templateView.'.phtml';

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->fileName = sprintf('%sTest.php', $this->controller->getName());

        $this->controllerFile = $this->getModule()->getTestControllerFolder().'/'.$this->fileName;


        $this->file->setFileName($this->fileName);
        $this->file->setOptions($options);

        if ($this->controller->isFactory()) {
            $this->getFactoryTestService()->createControllerFactoryTest($this->controller, $this->location);
        }

        return $this->file->render();
    }


    public function buildAction(ControllerValueObject $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCodeTest()->getLocation($controller);

        $this->fileName = sprintf('%sTest.php', $this->controller->getName());

        $this->controllerFile = $this->location.'/'.$this->fileName;

        $this->functions       = '';

        $this->fileCode        = file_get_contents($this->controllerFile);

        //ações que já constam no arquivo
        $this->fileActions     = $this->getCodeTest()->getFunctionsNameFromFile($this->controllerFile);

        $this->actionsToInject = $this->getActionsToInject($this->controller, $this->fileActions);

        $this->functions = $this->actionToController($this->actionsToInject);

        $this->fileCode = explode(PHP_EOL, file_get_contents($this->controllerFile));

        $lines = $this->getInjector()->inject($this->fileCode, $this->functions);

       //$lines = $this->injectDependency($lines);

        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);

        return $newFile;
        //die('console test lele');
    }

    public function getActionsToInject($controller, $fileActions)
    {
        $insertMethods = [***REMOVED***;
        //$dbFunctions = $this->getDbFunctionsMap();
        if (!empty($controller->getActions())) {
            foreach ($controller->getActions() as $i => $action) {
                $insertMethods[$i***REMOVED*** = $action;

                $actionClass = $this->str('class', $action->getName());

                if (in_array('Test'.$actionClass, $fileActions)) {
                    unset($insertMethods[$i***REMOVED***);
                }
            }
        }


        return $insertMethods;
    }

    public function injectDependency($lines)
    {
        $dependency = $this->getCodeTest()->getDependencyToInject($this->controller, $lines);

        if ($dependency === false) {
            return $lines;
        }

        $injectFunctions = '';

        foreach ($dependency as $functionName => $namespace) {
            preg_match('/Test[S|G***REMOVED***et/', $functionName, $match);

            $type = str_replace('Test', '', $match[0***REMOVED***);
            $type = $this->str('url', $type);

            $namespaceArray = explode('\\', $namespace);
            $name = end($namespaceArray);

            $injectFunctions .= $this->getFileCreator()->renderPartial(
                'template/module/mvc/console-controller/test-'.$type.'-dependency.phtml',
                [
                    'controllerVar' => $this->str('var-length', $this->controller->getName()),
                    'functionName' => $this->str('var', $functionName),
                    'namespace' => $namespace,
                    'name' => $name
                ***REMOVED***
            );
        }

        if (!empty($injectFunctions)) {
            $functions = explode(PHP_EOL, $injectFunctions);
            $lines = $this->getCodeTest()->inject($lines, $functions);
        }

        return $lines;
    }


    public function actionToController($insertMethods)
    {
        $controllerVar = $this->str('var-length', $this->controller->getName());

        foreach ($insertMethods as $method) {

            $name = $this->str('class', $method->getName());

            switch($name) {
              case 'GetList': $template = 'get-list'; break;
              case 'Get': $template = 'get'; break;
              case 'Create': $template = 'create'; break;
              case 'Update': $template = 'update'; break;
              case 'Delete': $template = 'delete'; break;
              default: $template = 'test-dispatch';
            }

            $actionName = $this->str('class', $method->getName());
            $actionVar  = $this->str('var', $method->getName());

            $controller = $this->controller->getName();

            $routeUrl = sprintf(
                '%s %s %s',
                $this->str('url', $this->getModule()->getModuleName()),
                $this->str('url', $controller),
                $this->str('url', $method->getRoute())
            );

            $routeMatch = sprintf(
                '%s-%s-%s',
                $this->str('url', $this->getModule()->getModuleName()),
                $this->str('url', $controller),
                $this->str('url', $method->getName())
            );

            $this->functions .= $this->getFileCreator()->renderPartial(
                sprintf('template/module/mvc/rest-test/controller/%s.phtml', $template),
                [
                    'actionName' => $actionName,
                    'routeUrl' => $routeUrl,
                    'module' => $this->getModule()->getNamespace(),
                    'actionNameUrl' => $this->str('url', $actionName),
                    'controllerName' => $controller,
                    'namespace' => $this->controller->getNamespace(),
                    'routeMatch' => $routeMatch
                ***REMOVED***
            );
        }

        $this->functions = explode(PHP_EOL, $this->functions);
        return $this->functions;
    }


}
