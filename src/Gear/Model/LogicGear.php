<?php
namespace Gear\Model;
class LogicGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Logic';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();

        if(is_array($entities) && count($entities)>0) {
            foreach($entities as $i => $table) {
                $this->createLogic($table);
            }
        } else {
            return false;
        }
    }

    public function setTable($table)
    {
    	$this->table = $table;
    }
    public function getTable()
    {
    	return $this->table;
    }

    public function getUse()
    {
    	return 'use \Zend\ServiceManager\ServiceLocatorAwareInterface;'.PHP_EOL.PHP_EOL;
    }

    public function getClass($className)
    {
        return 'class '.$className.'Logic implements \Zend\ServiceManager\ServiceLocatorAwareInterface'.PHP_EOL.'{'.PHP_EOL;
    }

    public function createLogic($table)
    {
        $module = $this->getModule();
        $path   = $this->getFinalPath();

        $this->setTable($this->getFileName($this->str('class',$table)));

        $class = $this->underlineToClass($this->getTable());
        $columns = $this->getColumns($this->getTable());
        $b = '';
        $b .= $this->getNamespace($module.'\\Logic');
        $b .= $this->getUse();
        $b .= $this->getClass($this->getFileName($this->str('class',$this->getTable())));
        $b .= $this->defineServiceLocator();
        $b .= $this->defineEntityManager();
        $b .= $this->serviceLocator();
        $b .= $this->insertFunction();
        $b .= $this->updateFunction();
        $b .= $this->deleteFunction($table);
        $b .= $this->selectOneFunction();
        $b .= $this->selectAllFunction();
        $b .= $this->selectCountFunction();
        $b .= $this->selectByIdFunction($table);
        $b .= $this->exportEntity($table);

        //$b .= $this->getConstruct($class,$columns,$table,$module);
        $b .= $this->getEndFile();
        //die();
        $this->mkPHP($path, $this->getFileName($table).'Logic',$b);
    }

    public function insertFunction()
    {
        $b  = $this->getIndent(1).trim('public function insert($data)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->insert($data);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function updateFunction()
    {
        $b  = $this->getIndent(1).trim('public function update($data)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->update($data);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function deleteFunction($table)
    {
        $class = $this->str('class',$table);
        $b  = $this->getIndent(1).trim('public function delete($id'.$class.')').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->delete($id'.$class.');').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function selectOneFunction()
    {
        $b  = $this->getIndent(1).trim('public function selectOne($criteria = array())').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->selectOne($criteria);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function selectAllFunction()
    {
        $b  = $this->getIndent(1).trim('public function selectAll($criteria = array())').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->selectAll($criteria);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }


    public function selectCountFunction()
    {
        $b  = $this->getIndent(1).trim('public function selectCount($criteria = array())').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->selectCount($criteria);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function selectByIdFunction($table)
    {
        $class = $this->str('class',$table);
        $b  = $this->getIndent(1).trim('public function selectById($id'.$class.')').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->selectById($id'.$class.');').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function exportEntity($table)
    {
        $class = $this->str('class',$table);
        $b  = $this->getIndent(1).trim('public function exportEntity($id'.$class.')').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$this->str('var',$this->getTable()).'Model = $this->getServiceLocator()->get(\'model_'.$this->str('uline',$this->getTable()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$this->str('var',$this->getTable()).'Model->exportEntity($id'.$class.');').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL;
        return $b;
    }
}