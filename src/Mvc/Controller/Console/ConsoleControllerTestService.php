<?php
namespace Gear\Mvc\Controller\Console;

use GearJson\Controller\Controller as ControllerValueObject;
use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\Factory\FactoryServiceTrait;
use Gear\Mvc\Config\ControllerManagerTrait;
use Gear\Mvc\Controller\AbstractControllerTestService;

class ConsoleControllerTestService extends AbstractControllerTestService
{
    use ControllerManagerTrait;

    use FactoryServiceTrait;

    public function module()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/console-test/module/module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexControllerTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }

    public function moduleFactory()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/console-test/module/module-factory.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexControllerFactoryTest.php',
            $this->getModule()->getTestControllerFolder()
        );
    }


    public function generateAbstractClass()
    {
        $this->getFileCreator()->createFile(
            'template/module/mvc/console-controller/test-abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'AbstractConsoleControllerTestCase.php',
            $this->getModule()->getTestControllerFolder()
        );
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
            $actionName = $this->str('class', $method->getName());
            $actionVar  = $this->str('var', $method->getName());

            /**
            $this->functions .= $this->getFileCreator()->renderPartial(
                'template/module/mvc/console-controller/test-action.phtml',
                [
                    'actionName' => $actionName,
                    'actionVar' => $actionVar,
                    'controllerVar' => $controllerVar
                ***REMOVED***
            );
            */

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
                'template/module/mvc/console-controller/test-dispatch.phtml',
                [
                    'actionName' => $actionName,
                    'routeUrl' => $routeUrl,
                    'module' => $this->getModule()->getModuleName(),
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

        $this->template = 'template/module/mvc/console-test/src/'.$templateView.'.phtml';

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
}
