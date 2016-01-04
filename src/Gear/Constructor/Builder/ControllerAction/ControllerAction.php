<?php
namespace Gear\Constructor\Builder\ControllerAction;

use Zend\ServiceManager\ServiceManager;
use Gear\ValueObject\Controller as ControllerValueObject;
use Gear\Constructor\Helper;

class ControllerAction {
    
    protected $fileCode;
    
    protected $functions;
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
        $this->location = $this->module->getControllerFolder();
        $this->template = 'template/constructor/controller/controller.phtml';
        
        $this->file = $this->serviceManager->get('fileCreator');
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);
        
        $this->str = $this->serviceManager->get('stringService');
        
        $this->console = $this->serviceManager->get('console');
    }
    
    public function build(ControllerValueObject $controller) {
        
        $this->controller = $controller;
        $this->controllerFile = $this->module->getControllerFolder().'/'.sprintf('%s.php', $controller->getName());
        
        if (!is_file($this->controllerFile)) {
          
            $this->console->writeLine('Controller não existe, verifique antes de continuar');
            return;
        } 
        
        
        $this->insertAction();
        
        return true;
    }
    
    public function getClassName()
    {
        return __CLASS__;
    }
    
    public function loadFileIntoText()
    {
        return file_get_contents($this->controllerFile);
    }
    
    public function addDiffToFile()
    {
        if ($this->fileCode == null) {
            $this->fileCode   = $this->loadFileIntoText();
        }
        
        if ($this->functions == null) {
            $this->functions = $this->diffFunctions();
        }
        
        //quantas linhas tem antes da última } ?
        
        //verifica quantas linhas há no arquivo e cria um array
        $lines = explode(PHP_EOL, $this->fileCode);
        
        $cut = count($lines);
        
        do {
            $cut = $cut-1;
            $match = $lines[$cut***REMOVED***;
            
        } while ($match !== '}');
                
        //Adiciona as novas linhas no meio do array, pega o numero de linhas -2.
        $lines[$cut***REMOVED*** = $this->functions;
        
        //Cria um novo arquivo de texto.
        $file = implode(PHP_EOL, $lines);
       
        $lines = explode(PHP_EOL, $file);

        $file = [***REMOVED***;
        
        $cut = count($lines)-1;
        
        for ($i = $cut; $i > 0; $i--) {
            if (rtrim($lines[$i***REMOVED***) == '' && rtrim($lines[$i-1***REMOVED***) == '}') {
                break;
            }
            unset($lines[$i***REMOVED***);
        }
        
        foreach($lines as $i => $line) {
            $lines[$i***REMOVED*** = rtrim($line);
        }
        
        $file = implode(PHP_EOL, $lines);
        
        return $file;
    }
    
    public function insertAction()
    {
      
        $this->fileText = $this->addDiffToFile();
        file_put_contents($this->controllerFile, $this->fileText);
        

        return $this->fileText;
        
        
            //calcula as dependências
        $this->dependency = new \Gear\Constructor\Controller\Dependency($this->controller, $this->module);
        $this->use = trim($this->dependency->getUseNamespace(false));
        $this->attribute = $this->dependency->getUseAttribute(false);
       
    
        $key = array_search ('use Zend\View\Model\JsonModel;', $lines);
        $uses = explode(PHP_EOL, $this->use);
        $this->realUse = [***REMOVED***;
        foreach ($uses as $use) {
            if (!in_array($use, $lines)) {
                $this->realUse[***REMOVED*** = $use;
            }
        }
        $this->use = trim(implode(PHP_EOL, $this->realUse));
        $lines = Helper\ArrayUtil::moveArray($lines, $key+1, $this->use);
    
        $name = sprintf('class %s extends AbstractActionController', $this->controller->getName());
        $key = array_search ($name, $lines);
        $uses = explode(PHP_EOL, $this->attribute);
        $this->realAttr = [***REMOVED***;
        foreach ($uses as $use) {
            if (!in_array($use, $lines)) {
                $this->realAttr[***REMOVED*** = $use;
            }
        }
        $this->attribute = implode(PHP_EOL, $this->realAttr);
        $lines = Helper\ArrayUtil::moveArray($lines, $key+2, $this->attribute);

        
        var_dump($lines);

        $newFile = implode(PHP_EOL, $lines);

        echo $newFile;
    
        file_put_contents($this->controllerFile, $newFile);
    
        return $this->fileCode;
    }
    
    
    /**
     * Retorna as funções que precisam ser adicionadas ao arquivo.
     */
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
    
   

    public function jsonAction(\Gear\ValueObject\Action $method)
    {
        return <<<EOS

    public function {$this->str->str('var', $method->getName())}Action()
    {
        return new JsonModel(
            array(
            )
        );
    }

EOS;
    
    }
     
    public function viewAction(\Gear\ValueObject\Action $method)
    {
        return <<<EOS

    public function {$this->str->str('var', $method->getName())}Action()
    {
        return new ViewModel(
            array(
            )
        );
    }

EOS;
    
    }

    public function actionToController($insertMethods)
    {
    
        $model = $this->serviceManager->get('application')->getMvcEvent()->getRequest()->getParam('model', 'view');
    
        foreach ($insertMethods as $method) {
    
            if ($model == 'json') {
                $this->functions .= $this->jsonAction($method);
            } else {
                $this->functions .= $this->viewAction($method);
            }
        }
        
        $this->functions .= <<<EOS
}
        
EOS;
        return;
    }
    
    public function getActionsToInject()
    {
        $insertMethods = [***REMOVED***;
        if (!empty($this->controller->getActions())) {
            foreach ($this->controller->getActions() as $action) {
                $checkAction = $this->str->str('class', $action->getName());
                if (!in_array($checkAction, $this->fileActions)) {
                    $insertMethods[***REMOVED*** = $action;
                }
            }
        }
        return $insertMethods;
    }
    
}
