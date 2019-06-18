<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\AbstractMvcTest;

abstract class AbstractControllerTestService extends AbstractMvcTest
{
    public function mergeConfig(array $config)
    {
          $options = [
            'module' => $this->getModule()->getNamespace(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'actions' => $this->controller->getActions(),
            'controllerName' => $this->controller->getName(),
            'controllerUrl' => $this->str('url', $this->controller->getNameOff()),
            'controllerCallname' => $this->str('class', $this->controller->getNameOff()),
            'controllerVar' => $this->str('var-length', $this->controller->getName())
        ***REMOVED***;

        $templateView = ($this->controller->isFactory()) ? 'factory' : 'invokable';


        if ($this->controller->isFactory()) {

            $options['dependency'***REMOVED*** = str_replace(
                '$this->action',
                '$this->controller',
                $this->getCodeTest()->getConstructorDependency($this->controller)
            );

            $options['constructor'***REMOVED*** = str_replace(
                '$this->action',
                '$this->controller',
                $this->getCodeTest()->getConstructor($this->controller)
            );
        }


        return array_merge($options, $config);
    }
}
