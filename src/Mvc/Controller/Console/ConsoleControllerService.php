<?php
namespace Gear\Mvc\Controller\Console;

use Gear\Schema\Controller\Controller as ControllerValueObject;
use Gear\Mvc\Controller\AbstractControllerService;
use Gear\Mvc\AbstractMvcInterface;

class ConsoleControllerService extends AbstractControllerService implements AbstractMvcInterface
{

    public function module()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/console-controller/module.phtml',
            array(
                'module' => $this->getModule()->getNamespace(),
                'namespace' => $this->getModuleNamespace()
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
                'module' => $this->getModule()->getNamespace(),
            ),
            'IndexControllerFactory.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function buildController(ControllerValueObject $controller)
    {
        $this->controller = $controller;
        $this->location = $this->getCode()->getLocation($controller);
        $this->fileName = sprintf('%s.php', $controller->getName());
        $this->controllerFile = $this->location.'/'.$this->fileName;

        $options = [
            'classDocs' => $this->getCode()->getClassDocs($controller, 'Controller'),
            'implements' => $this->getCode()->getImplements($controller),
            'extends' => $this->getCode()->getExtends($controller),
            'attribute' => $this->getCode()->getUseAttribute($controller),
            'use' => $this->getCode()->getUse($controller),
            'namespace' => $this->getCode()->getNamespace($controller),
            'module' => $this->getModule()->getNamespace(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'actions' => $controller->getAction(),
            'controllerName' => $controller->getName(),
            'controllerUrl' => $this->str('url', $controller->getName()),
        ***REMOVED***;

        $options['constructor'***REMOVED*** = ($controller->isFactory())
          ? $this->getCode()->getConstructor($controller)
          : '';

        $this->template = 'template/module/mvc/console-controller/controller.phtml';

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
     * @return \Zend\View\Model\ConsoleModel
     */
    public function {$this->str('var', $method->getName())}Action()
    {
        return new ConsoleModel([***REMOVED***);
    }

EOS;
        }

        $this->functions = explode(PHP_EOL, $this->functions);
        return $this->functions;
    }
}
