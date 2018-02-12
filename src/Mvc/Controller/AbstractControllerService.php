<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\AbstractMvc;

abstract class AbstractControllerService extends AbstractMvc
{
    abstract function actionToController($insertMethods);

    public function mergeActions()
    {
        //busca as funciones que já existem.
        $this->fileActions     = $this->getCode()->getFunctionsNameFromFile($this->controllerFile);

        //pega as funções que serão adicionadas
        $this->actionsToInject = $this->getActionsToInject($this->controller, $this->fileActions);
        //transforma as novas actions em funções
        $this->functions = $this->actionToController($this->actionsToInject);
        $this->fileCode = explode(PHP_EOL, file_get_contents($this->controllerFile));


        $lines = $this->getInjector()->inject($this->fileCode, $this->functions);
        $lines = $this->createUse($this->controller, $lines);
        $lines = $this->createUseAttributes($this->controller, $lines);

        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);
    }
}
