<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\AbstractMvc;
use GearJson\App\App;
use GearJson\Action\Action;

class AppControllerService extends AbstractMvc
{
    use AppControllerSpecServiceTrait;

    /**
     * Cria arquivo Controller Angular para Ação pelo método Constructor -> Action
     *
     * @param $action Ação
     *
     * @return $file Localização do arquivo
     */
    public function build(Action $action)
    {
        $version = $this->getGearVersion();


        if ($action->getController() instanceof \GearJson\Controller\Controller) {
            $controllerName = $action->getController()->getName();
        } else {
            $controllerName = $action->getController();
        }

        $nameClass = sprintf('%s%sAction', $controllerName, $action->getName());

        $options = [
            'version' => $version,
            'className' => $nameClass
        ***REMOVED***;

        $location = $this->getModule()->getPublicJsAppFolder().'/'.$this->str('url', $controllerName);


        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $name = sprintf('%s.js', $nameClass);


        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/view/app/controller/action.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($name);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }

    public function createIndexController()
    {

        /*  $this->getAssetManager()->addAsset(
         sprintf('js/%s.js', $this->str('url', $this->getModule()->getModuleName())),
         sprintf('/js/app/%sIndexController.js', $this->str('class', $this->getModule()->getModuleName()))
         );
        */
        $moduleGear = new \Gear\Module();

        $config = $moduleGear->getConfig();
        $version = $config['gear'***REMOVED***['modules'***REMOVED***['gear'***REMOVED***['version'***REMOVED***;


        $module = $this->getModule()->getModuleName();

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/app/controller-index.phtml');
        $fileCreator->setOptions(
            [
                'version' => $version,
                'module' => $module

            ***REMOVED***
        );
        $fileCreator->setFileName(sprintf('%sIndexController.js', $module));
        $fileCreator->setLocation($this->getModule()->getPublicJsAppFolder());

        return $fileCreator->render();
    }

    public function createAppController($data)
    {
        return parent::create($data);
    }

    public function createApp()
    {
        $template = 'template/module/app/controller/controller.phtml';

        $location = $this->getCode()->getLocation($this->app);

        $class = $this->str('class', $this->app->getName());
        $var = $this->str('var-length', $class);

        $filename = $class.'.js';

        $options = [
            'class' => $class,
            'var' => $var
        ***REMOVED***;


        $options['constructorArgs'***REMOVED*** = $this->getConstructorArgs()->render($this->app, $options);
        $options['inject'***REMOVED*** = $this->getInject()->render($this->app, $options);


        $this->getAppControllerSpecService()->create($this->app);
        $file = $this->getFileCreator();
        return $file->createFile($template, $options, $filename, $location);
    }
}
