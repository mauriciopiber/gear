<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\AbstractMvcTest;
use Gear\Schema\App\App;
use Gear\Schema\Action\Action;

class AppControllerSpecService extends AbstractMvcTest
{

    /**
     * Cria arquivo Spec Controller Angular para Ação pelo método Constructor -> Action
     *
     * @param $action Ação
     *
     * @return $file Localização do arquivo
     */
    public function build(Action $action)
    {
        $version = $this->getGearVersion();


        if ($action->getController() instanceof \Gear\Schema\Controller\Controller) {
            $controllerName = $action->getController()->getName();
        } else {
            $controllerName = $action->getController();
        }


        $nameClass = sprintf('%s%sAction', $controllerName, $action->getName());


        $describe = sprintf(
            '%s %s %s Spec',
            $this->str('label', $this->getModule()->getModuleName()),
            $this->str('label', $controllerName),
            $this->str('label', $action->getName())
        );

        $options = [
            'version' => $version,
            'className' => $nameClass,
            'describe' => $describe
        ***REMOVED***;



        $location = $this->getModule()->getPublicJsSpecUnitFolder().'/'.$this->str('url', $controllerName).'-spec';

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $name = sprintf('%sSpec.js', $nameClass);


        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/view/app/controller-spec/action.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($name);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }


    public function createTestIndexAction()
    {
        $moduleGear = new \Gear\Module();
        $config = $moduleGear->getConfig();
        $version = $config['gear'***REMOVED***['modules'***REMOVED***['gear'***REMOVED***['version'***REMOVED***;

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/index/unit.phtml');
        $file->setOptions(
            [
                'module' => $this->str('class', $this->getModule()->getModuleName()),
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
                'version' => $version
            ***REMOVED***
        );
        $file->setLocation($this->getModule()->getPublicJsSpecUnitFolder());
        $file->setFileName($this->str('class', $this->getModule()->getModuleName()).'IndexControllerSpec.js');
        $file->render();
    }

    public function create(App $app)
    {
        $template = 'template/module/app/controller/spec-controller.phtml';

        $location = $this->getCodeTest()->getLocation($app);

        $class = $this->str('class', $app->getName());
        $testVar = $this->str('var-length', 'Test'.$class);

        $filename = $class.'Spec.js';

        $options = [
            'class' => $class,
            'testVar' => $testVar
        ***REMOVED***;

        $vars = $this->getVars()->render($app, $options);
        $beforeEach = $this->getBeforeEach()->render($app, $options);

        $options['vars'***REMOVED*** = $vars;
        $options['beforeEach'***REMOVED*** = $beforeEach;

        $file = $this->getFileCreator();
        $file->createFile($template, $options, $filename, $location);
    }
}
