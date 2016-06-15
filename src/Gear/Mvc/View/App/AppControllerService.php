<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\AbstractMvc;
use GearJson\App\App;

class AppControllerService extends AbstractMvc
{
    use AppControllerSpecServiceTrait;


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

    public function create(App $app)
    {
        $template = 'template/module/app/controller/controller.phtml';

        $location = $this->getCode()->getLocation($app);

        $class = $this->str('class', $app->getName());
        $var = $this->str('var-lenght', $class);

        $filename = $class.'.js';

        $options = [
            'class' => $class,
            'var' => $var
        ***REMOVED***;


        $options['constructorArgs'***REMOVED*** = $this->getConstructorArgs()->render($app, $options);
        $options['inject'***REMOVED*** = $this->getInject()->render($app, $options);


        $this->getAppControllerSpecService()->create($app);
        $file = $this->getFileCreator();
        $file->createFile($template, $options, $filename, $location);
    }
}
