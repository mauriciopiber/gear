<?php
namespace Gear\Model;

use Zend\Db\Adapter\Adapter;
use Doctrine\ORM\Mapping\Entity;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ModuleGear extends MakeGear implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    /**
     * Versão 0.1 - Banco de dados já criados,
     * deverá receber o Nome do Módulo a ser criado e as Entidades que quer que apareça.
     */
    public function createModule()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $this->getConfig()->setDriver($adapter->driver);

        //$this->getConfig()->setTables(array('die_food'));

        echo 'Iniciando criação dos testes unitários de Entidades'."\n";

        $entityUnit = new \Gear\Model\EntityUnitGear($this->getConfig());
        $entityUnit->generate();

        echo 'Iniciando criação das Models'."\n";

        $model = new \Gear\Model\ModelGear($this->getConfig());
        $model->generate();

        echo 'Iniciando criação dos testes unitários das Models'."\n";

        $modelUnit  = new \Gear\Model\ModelUnitGear($this->getConfig());
        $modelUnit->generate();

        echo 'Iniciando criação das Logics'."\n";

        $logic = new \Gear\Model\LogicGear($this->getConfig());
        $logic->generate();

        echo 'Iniciando criação dos testes unitários das Logis'."\n";

        $logicUnit = new \Gear\Model\LogicUnitGear($this->getConfig());
        $logicUnit->generate();

        echo 'Iniciando criação dos Forms'."\n";

        $form = new \Gear\Model\FormGear($this->getConfig());
        $form->generate();

        echo 'Iniciando criação dos Search Form'."\n";

        $search = new \Gear\Model\SearchGear($this->getConfig());
        $search->generate();

        echo 'Iniciando criação dos Filters'."\n";

        $filter = new \Gear\Model\FilterGear($this->getConfig());
        $filter->generate();

        echo 'Iniciando criação dos Controllers'."\n";

        $controller = new \Gear\Model\ControllerGear($this->getConfig());
        $controller->generate();

        echo 'Iniciando criação dos Testes unitários dos Controllers'."\n";

        $controllerTest = new \Gear\Model\ControllerUnitGear($this->getConfig());
        $controllerTest->generate();

        echo 'Iniciando criação das Views'."\n";

        $view = new \Gear\Model\ViewGear($this->getConfig());
        $view->generate();

        echo 'Iniciando criação do IndexController do Módulo'."\n";

        //$controller->createIndexController();
        //$view->createIndexView();

        echo 'Iniciando criação do arquivo Module'."\n";
        $this->makeModuleFile();

        echo 'Iniciando criação do arquivo config'."\n";

        $config = new \Gear\Model\ConfigGear($this->getConfig());
        $config->generate();

        //echo 'Iniciando criação das Fixtures'."\n";

        $fixture  = new \Gear\Model\FixtureGear($this->getConfig());
        //$fixture->generate();

        echo 'Crud criado com sucesso'."\n";
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
        if (count($entities)>0) {
            foreach ($entities as $i => $v) {
                $b .= $this->getIndent(4).trim('\'model_'.$this->str('uline',$this->getFileName($this->str('class',$v))).'\' => \''.$this->str('class',$module).'\Model\\'.$this->getFileName($this->str('class',$v)).'Model\',').PHP_EOL;
            }
        }
        //make all logic
        if (count($entities)>0) {
            foreach ($entities as $i => $v) {
                $b .= $this->getIndent(4).trim('\'logic_'.$this->str('uline',$this->getFileName($this->str('class',$v))).'\' => \''.$this->str('class',$module).'\Logic\\'.$this->getFileName($this->str('class',$v)).'Logic\',').PHP_EOL;
            }
        }

        $b .= $this->getIndent(3).trim('     ),').PHP_EOL;
        //factories

        $b .= $this->getIndent(3).trim('    \'factories\' => array(').PHP_EOL;

        if (count($entities)>0) {
            $tableService = $this->getConfig()->getServiceLocator()->get('tableService');
            foreach ($entities as $i => $v) {
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


}
