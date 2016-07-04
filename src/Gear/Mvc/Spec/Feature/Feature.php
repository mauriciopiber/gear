<?php
namespace Gear\Mvc\Spec\Feature;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Action\Action;

class Feature extends AbstractMvcTest
{

    public function build(Action $action)
    {
        $version = $this->getGearVersion();



        if ($action->getController() instanceof \GearJson\Controller\Controller) {
            $controllerName = $action->getController()->getName();
        } else {
            $controllerName = $action->getController();
        }

        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));
        $nameClass = sprintf('%s%sAction', $controllerName, $action->getName());

        $options = [
            'version' => $version,
            'action' => $this->str('class', $action->getName()),
            'controller' => $this->str('class', $controllerName),
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'actionLabel' => $this->str('label', $action->getName()),
            'controllerLabel' => $this->str('label', $controllerName),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'actionUrl' => $this->str('url', $action->getName()),
            'controllerUrl' => $this->str('url',  $controllerName),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***;

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);


        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $name = sprintf('%s.js', $nameClass);


        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/action.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();

    }

    public function createIndexFeature($projectName = 'PiberNetwork')
    {

        return $this->getFileCreator()->createFile(
            'template/module/mvc/spec/feature/index.feature.phtml',
            array(
                //'module' => $this->getModule()->getModuleName(),
                'project' => $this->str('label', $projectName),
                'module' => $this->str('label', $this->getModule()->getModuleName())
            ),
            'index.feature',
            $this->getModule()->getPublicJsSpecEndFolder().'/index'
        );


    }
}
