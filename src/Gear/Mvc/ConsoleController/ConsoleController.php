<?php
namespace Gear\Mvc\ConsoleController;

use GearJson\Controller\Controller as ControllerValueObject;
use Gear\Mvc\AbstractMvc;

class ConsoleController extends AbstractMvc
{

    public function module()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/console-controller/module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexController.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function moduleFactory()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/console-controller/module-factory.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexControllerFactory.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function build(ControllerValueObject $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCode()->getLocation($controller);
        $this->fileName = sprintf('%s.php', $controller->getName());
        $this->controllerFile = $this->location.'/'.$this->fileName;

        if (is_file($this->controllerFile)) {
            $this->insertAction();
            return;
        }


        $this->template = 'template/module/mvc/console-controller/controller.phtml';

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);
        $this->controller = $controller;
        $this->controllerFile = $this->getModule()->getControllerFolder().'/'.sprintf('%s.php', $controller->getName());


        $this->file->setFileName(sprintf('%s.php', $controller->getName()));
        $this->file->setOptions(
            [
                'extends' => $this->getCode()->getExtends($controller),
                'use' => $this->getCode()->getUse($controller),
                'namespace' => $this->getCode()->getNamespace($controller),
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'actions' => $controller->getAction(),
                'controllerName' => $controller->getName(),
                'controllerUrl' => $this->str('url', $controller->getName()),

            ***REMOVED***
        );

        return $this->file->render();
    }



    public function insertAction()
    {
        //busca as funciones que já existem.
        $this->fileActions     = $this->getCode()->getFunctionsNameFromFile($this->controllerFile);

        //pega as funções que serão adicionadas
        $this->actionsToInject = $this->getActionsToInject($this->controller, $this->fileActions);
        //transforma as novas actions em funções
        $this->functions = $this->actionToController($this->actionsToInject);
        $this->fileCode = explode(PHP_EOL, file_get_contents($this->controllerFile));


        $lines = $this->getCode()->inject($this->fileCode, $this->functions);
        $lines = $this->createUse($this->controller, $lines);
        $lines = $this->createUseAttributes($this->controller, $lines);

        /*      if ($this->controller->getService()->getService() == 'factories') {

        $this->getFactoryService()->createFactory($this->controller, $this->location);
        $arguments = $this->getCode()->getConstructorArguments($this->controller);
        var_dump($arguments);
        $params = $this->getCode()->getConstructorParams($this->controller);
        var_dump($params);
        } */


        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);

        //die('console lala');
    }


    public function actionToController($insertMethods)
    {

        $this->functions = '';

        foreach ($insertMethods as $method) {
            $this->functions .= <<<EOS
    public function {$this->str('var', $method->getName())}Action()
    {
        return new ConsoleModel(
            array(
            )
        );
    }
EOS;
        }

        $this->functions = explode(PHP_EOL, $this->functions);
        return $this->functions;
    }
}
