<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\AbstractMvcTest;
use GearJson\App\App;

class AppControllerSpecService extends AbstractMvcTest
{

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
        $testVar = $this->str('var-lenght', 'Test'.$class);

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
