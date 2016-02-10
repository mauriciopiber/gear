<?php
namespace Gear\Constructor\Builder\ControllerAction;

use Zend\ServiceManager\ServiceManager;
use GearJson\Controller\Controller as ControllerValueObject;
use Gear\Constructor\Helper;

class ControllerActionTest {
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
        $this->location = $this->module->getTestControllerFolder();
        $this->template = 'template/constructor/controller/controller-test.phtml';
        
        $this->file = $this->serviceManager->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);
        
        $this->str = $this->serviceManager->get('stringService');
        
        $this->console = $this->serviceManager->get('console');
    }
    
    public function build(ControllerValueObject $controller) {
        
        $this->controller = $controller;
        
        $this->fileName = sprintf('%sTest.php', $controller->getName());
        
        $this->controllerFile = $this->module->getTestControllerFolder().'/'.$this->fileName;
        
        if (!is_file($this->controllerFile)) {
            $this->console->writeLine('Controller não existe, verifique antes de continuar');
            return;
        } 
        
     
        $this->insertAction();
        return;
    }
    

    /**
     * Retorna as funções que precisam ser adicionadas ao arquivo.
     */

    public function insertAction()
    {
        $this->functions = '';
        $this->fileCode  = file_get_contents($this->controllerFile);
    
        $this->functions = $this->diffFunctions();

        $this->fileCode = Helper\ArrayToFile::addFunctionsToClass($this->fileCode, $this->functions);
        
        file_put_contents($this->controllerFile, $this->fileCode);
    
        return $this->fileCode;
    }
    
    public function diffFunctions()
    {
    
        //pega o nome das funções existentes no código.
        $this->fileActions     = Helper\ExtractFromClass::getFunctionsName($this->fileCode, $this->str);
    
        //verifica quais ações estão presentes no controller/action e não estão presentes no arquivo [ainda não foram geradas***REMOVED***
        $this->actionsToInject = $this->getActionsToInject();
    
      
        //cria o template das nova funções.
        $this->actionToController($this->actionsToInject);
    
       
        return $this->functions;
    }
    
    public function getDbFunctionsMap()
    {
        return [
            'TestWhenCreateDisplaySuccessfulWithRedirect'            => 'create',
            'TestWhenCreateDisplaySuccessful'                        => 'create',
            'TestWhenEditDisplaySuccessful'                          => 'edit',
            'TestWhenEditRedirectWithInvalidIdToListing'             => 'edit',
            'TestWhenListDisplaySuccessful'                          => 'list',
            'TestWhenFilterWithoutData'                              => 'list',
            'TestWhenFilterWithoutDataWithPRG'                       => 'list',
            'TestDeleteSucessfullAndRedirectToListWithFailNotFound'  => 'delete',
            'TestWhenDeleteDisplaySuccessful'                        => 'delete',
            'TestViewSucessfullAndRedirectToListWithFailNotFound'    => 'view',
            'TestWhenViewDisplaySuccessful'                          => 'view',
            'TestCreateSuccess'                                      => 'create',
            'TestWhenListDisplaySuccessfulWithValidId'               => 'edit',
            'TestWhenViewDisplaySuccessfulWithValidId'               => 'view',
            'TestWhenListRedirectSuccessfulPRGWithValidId'           => 'edit',
            'TestWhenListRedirectSuccessfulPRGWithValidIdReturnEdit' => 'edit',
            'TestDeleteSucessfullAndRedirectToListWithSucesss'       => 'delete',
        ***REMOVED***;
        /**
         return [
         'insert'       => [
         'TestWhenCreateDisplaySuccessful',
         'TestWhenCreateDisplaySuccessfulWithRedirect'
         ***REMOVED***,
         'update'       => [
         'TestWhenEditDisplaySuccessful',
         'TestWhenEditRedirectWithInvalidIdToListing',
         ''
         ***REMOVED***,
         'list'         => [
         'TestWhenListDisplaySuccessful',
         'TestWhenFilterWithoutData',
         'TestWhenFilterWithoutDataWithPRG'
         ***REMOVED***,
         'delete'       => [
         'TestDeleteSucessfullAndRedirectToListWithFailNotFound',
         'TestWhenDeleteDisplaySuccessful'
         ***REMOVED***,
         'upload-image' => [
    
         ***REMOVED***,
         ***REMOVED***;
         */
    }
    
    public function getActionsToInject()
    {
        $insertMethods = [***REMOVED***;
        $dbFunctions = $this->getDbFunctionsMap();
        if (!empty($this->controller->getActions())) {
    
            foreach ($this->controller->getActions() as $i => $action) {
    
    
                $insertMethods[$i***REMOVED*** = $action;
    
                $actionUrl   = $this->str->str('url', $action->getName());
                $actionClass = $this->str->str('class', $action->getName());
    
                foreach ($dbFunctions as $actionFromFileMap => $actionFromObject) {
                    if ($actionFromObject == $actionUrl) {
                        unset($insertMethods[$i***REMOVED***);
                    }
                }
    
                if (in_array('Test'.$actionClass, $this->fileActions)) {
                    unset($insertMethods[$i***REMOVED***);
                }
            }
        }
    
    
        return $insertMethods;
    }
    
    public function actionToController($insertMethods)
    {
    
        $controller = $this->str->str('class', $this->controller->getName());
        $controllerVar = $this->str->str('var-lenght', $this->controller->getName());
        $controllerName =  $this->str->str('class', $this->controller->getNameOff());
        $controllerUrl = $this->str->str('url', $this->controller->getNameOff());
        $module = $this->module->getModuleName();
        $moduleUrl = $this->str->str('url', $this->module->getModuleName());
    
        foreach ($insertMethods as $i => $method) {
    
            $actionName = $this->str->str('class', $method->getName());
            $actionUrl  = $this->str->str('url', $method->getName());
    
            $this->functions .= <<<EOS
    
    public function test{$this->str->str('class', $method->getName())}Action()
    {
        \$resp = \$this->{$controllerVar}->{$this->str->str('var', $method->getName())}Action();
        \$this->assertInstanceOf('Zend\View\Model\ViewModel', \$resp);
    }

EOS;
    
            if (isset($insertMethods[$i+1***REMOVED***)) {
                $this->functions .= PHP_EOL;
            }
        }
        $this->functions .= <<<EOS
}
EOS;
    
    }
}
