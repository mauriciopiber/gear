<?php
namespace Gear\Service\Module;

use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\Model\MakeGear;
use Gear\Model\TestGear;
use Doctrine\ORM\Mapping\Entity;
use Gear\ValueObject\Config\Config;
use Gear\Service\Filesystem\DirWriterService;
use Gear\Service\Filesystem\FileService;
use Gear\Service\Filesystem\ClassService;
use Gear\Service\Type\StringService;
use Gear\Common\DirServiceAwareInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\FileServiceAwareInterface;
use Gear\Common\ConfigAwareInterface;
use Gear\Common\StringServiceAwareInterface;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ModuleFileService implements
    ServiceLocatorAwareInterface,
    FileServiceAwareInterface,
    ClassServiceAwareInterface,
    StringServiceAwareInterface,
    ConfigAwareInterface
{
    protected $serviceLocator;

    protected $fileService;

    protected $classService;

    public function getModule()
    {
        return $this->getConfig()->getModule();
    }

    public function generate()
    {
        $b  = '';
        $b .= $this->getNamespace($this->getConfig()->getModule());
        $b .= $this->getUse();
        $b .= $this->getClassModule();
        //$b .= $this->getInit();
        $b .= $this->getFunctionAutoloaderConfig();
        //$b .= $this->getFunctionGetConfig();
        //$b .= $this->getServiceConfig($this->getModule());
        $b .= $this->getEndFile();
        return $b;
    }

    /**
     *
     * @param string $moduleName
     * @return string
     */
    public function getNamespace($moduleName)
    {
        return   sprintf('namespace %s;',$moduleName)
            . PHP_EOL
            . PHP_EOL;
    }

    public function getIndent($indent, $patters = 4)
    {
        return $this->getClassService()->getIndent($indent, $patters);
    }

    public function powerline($indent, $text, $params = array(), $newline = false)
    {
        return $this->getClassService()->powerLine($indent, $text, $params, $newline);
    }


    public function getUse()
    {
        return 'use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;'.PHP_EOL.PHP_EOL;
    }

    public function getClassModule()
    {
        $buffer = '';
        $buffer  = $this->getIndent(0).trim('/**').PHP_EOL;
        $buffer .= $this->getIndent(0).trim('  * @SuppressWarnings(PHPMD.CouplingBetweenObjects)').PHP_EOL;
        $buffer .= $this->getIndent(0).trim('  */').PHP_EOL;
        $buffer .= 'class Module'.PHP_EOL;
        $buffer .= '{'.PHP_EOL;
        return $buffer;
    }


    public function getInit()
    {
        $b  = '';
        $b  = $this->getIndent(1).trim('public function init(\Zend\ModuleManager\ModuleManager $moduleManager)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $moduleManager->getEventManager()->getSharedManager()->attach(__NAMESPACE__, \'dispatch\', function ($event) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $event->getTarget()->layout(\'layout/'.$this->str('url',$this->getModule()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    });').PHP_EOL;
        $b .= $this->getIndent(1).trim(' }').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getFunctionAutoloaderConfig()
    {
        $b = '';
        $b .= $this->getIndent(1).trim("public function getAutoloaderConfig()").PHP_EOL;
        $b .= $this->getIndent(1).trim("{").PHP_EOL;
        $b .= $this->getIndent(2).trim("    return array(").PHP_EOL;
        /*
        $b .= $this->getIndent(3).trim("        'Zend\Loader\ClassMapAutoloader' => array(").PHP_EOL;
        $b .= $this->getIndent(4).trim("            __DIR__ . '/autoload_classmap.php',").PHP_EOL;
        $b .= $this->getIndent(3).trim("        ),").PHP_EOL;
        */
        $b .= $this->getIndent(3).trim("        'Zend\Loader\StandardAutoloader' => array(").PHP_EOL;
        $b .= $this->getIndent(4).trim("            'namespaces' => array(").PHP_EOL;
        $b .= $this->getIndent(5).trim("                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,").PHP_EOL;
        $b .= $this->getIndent(4).trim("            ),").PHP_EOL;
        $b .= $this->getIndent(3).trim("        ),").PHP_EOL;
        $b .= $this->getIndent(2).trim("    );").PHP_EOL;
        $b .= $this->getIndent(1).trim("}").PHP_EOL;
        return $b;
    }



    public function getFunctionGetConfig()
    {
        $b = '';
        $b .= $this->getIndent(1).trim("public function getConfig()").PHP_EOL;
        $b .= $this->getIndent(1).trim("{").PHP_EOL;
        $b .= $this->getIndent(2).trim("    return include __DIR__ . '/config/module.config.php';").PHP_EOL;
        $b .= $this->getIndent(1).trim("}").PHP_EOL;
        $b .= PHP_EOL;
        return $b;
    }


    public function getServiceConfig($module)
    {
        $b = $this->powerline(1,'/**');
        $b .= $this->powerline(1,' * @SuppressWarnings(PHPMD.ExcessiveMethodLength)');
        $b .= $this->powerline(1,' * @SuppressWarnings(PHPMD.CyclomaticComplexity)');
        $b .= $this->powerline(1,'*/');
        $b .= $this->getIndent(1).trim('public function getServiceConfig()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        $b .= $this->getIndent(2).trim('return array(').PHP_EOL;


        //invokables
        $b .= $this->getIndent(3).trim('    \'invokables\' => array(').PHP_EOL;
        $entities = $this->getConfig()->getTables();
        //var_dump($entities);die();
        //make all model
        if(count($entities)>0) {
            foreach($entities as $i => $v) {
                $b .= $this->getIndent(4).trim('\'model_'.$this->str('uline',$this->getFileName($this->str('class',$v))).'\' => \''.$this->str('class',$module).'\Model\\'.$this->getFileName($this->str('class',$v)).'Model\',').PHP_EOL;
            }
        }
        //make all logic
        if(count($entities)>0) {
            foreach($entities as $i => $v) {
                $b .= $this->getIndent(4).trim('\'logic_'.$this->str('uline',$this->getFileName($this->str('class',$v))).'\' => \''.$this->str('class',$module).'\Logic\\'.$this->getFileName($this->str('class',$v)).'Logic\',').PHP_EOL;
            }
        }

        $b .= $this->getIndent(3).trim('     ),').PHP_EOL;
        //factories

        $b .= $this->getIndent(3).trim('    \'factories\' => array(').PHP_EOL;

        if(count($entities)>0) {
            $tableService = $this->getConfig()->getServiceLocator()->get('tableService');
            foreach($entities as $i => $v) {
                $tableUline = $this->str('uline',$this->getFileName($this->str('class',$v)));
                $tableClass = $this->getFileName($this->str('class',$v));
                $b .= $this->getIndent(4).trim(' \'form_'.$tableUline.'\' => function ($serviceLocator) {').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $entityManager = $serviceLocator->get(\'doctrine.entitymanager.orm_default\');').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $form = new \\'.$this->getModule().'\Form\\'.$tableClass.'Form($entityManager);').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $hydrator = new DoctrineEntity($entityManager, \''.$this->getModule().'\Entity\\'.$this->str('class',$v).'\');').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $form->setHydrator($hydrator);').PHP_EOL;


                $table = $tableService->getTable($tableUline);
                var_dump($table->getHasUnique());

                $b .= $this->getIndent(5).trim('    $filter = new \\'.$this->getModule().'\Filter\\'.$tableClass.'Filter(').PHP_EOL;
                $b .= $this->getIndent(6).trim('        $serviceLocator->get(\'Zend\Db\Adapter\Adapter\')').PHP_EOL;
                $b .= $this->getIndent(5).trim('    );').PHP_EOL;

                if ($table->getHasUnique() == true) {

                    $b .= $this->powerLine(5 ,'$request = $serviceLocator->get(\'Request\');');
                    $b .= $this->powerLine(5 ,'if (preg_match(\'/editar/\', $request->getUri())) {');
                    $b .= $this->powerLine(6 ,'    if (preg_match(\'/[0-9***REMOVED****$/\', $request->getUri()->getPath(), $match)) {');
                    $b .= $this->powerLine(7 ,'        $id%s = $match[0***REMOVED***;', $tableClass);
                    $b .= $this->powerLine(6 ,'    }');
                    $b .= $this->powerLine(5 ,'} else {');
                    $b .= $this->powerLine(6 ,'    $id%s = null;', $tableClass);
                    $b .= $this->powerLine(5 ,'}');
                    $b .= $this->powerLine(5 ,'$form->setInputFilter($filter->getInputFilter($id%s));',$tableClass).PHP_EOL;
                } else {
                    $b .= $this->getIndent(5).trim('    $form->setInputFilter($filter->getInputFilter());').PHP_EOL;
                }
                $b .= $this->getIndent(5).trim('    return $form;').PHP_EOL;
                $b .= $this->getIndent(4).trim('},').PHP_EOL;
                $b .= $this->getIndent(4).trim(' \'form_search_'.$tableUline.'\' => function ($serviceLocator) {').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $entityManager = $serviceLocator->get(\'doctrine.entitymanager.orm_default\');').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $form = new \\'.$this->getModule().'\Form\\'.$tableClass.'SearchForm($entityManager);').PHP_EOL;
                $b .= $this->getIndent(5).trim('    return $form;').PHP_EOL;
                $b .= $this->getIndent(4).trim('},').PHP_EOL;
            }
        }

        $b .= $this->getIndent(3).trim('     ),').PHP_EOL;

        $b .= $this->getIndent(2).trim(');').PHP_EOL;


        $b .= $this->getIndent(1).trim('}').PHP_EOL;

        return $b;
    }

    public function getEndFile()
    {
        return '}'.PHP_EOL;
    }


    public function setStringService(StringService $fileWriter)
    {
        $this->stringService = $fileWriter;
        return $this;
    }

    public function getStringService()
    {
        if (!isset($this->stringService)) {
            $this->stringService = $this->getServiceLocator()->get('stringService');
        }
        return $this->stringService;
    }

    public function str($type, $message)
    {
        return $this->getStringService()->str($type, $message);
    }

    public function setFileService(FileService $fileWriter)
    {
        $this->fileService = $fileWriter;
        return $this;
    }

    public function getFileService()
    {
        if (!isset($this->fileService)) {
            $this->fileService = $this->getServiceLocator()->get('fileService');
        }
        return $this->fileService;
    }

    public function setClassService(ClassService $fileWriter)
    {
        $this->classService = $fileWriter;
        return $this;
    }

    public function getClassService()
    {
        if (!isset($this->classService)) {
            $this->classService = $this->getServiceLocator()->get('classService');
        }
        return $this->classService;
    }

    public function setConfig(Config $config)
    {

        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }


    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
