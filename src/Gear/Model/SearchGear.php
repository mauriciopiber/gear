<?php

namespace Gear\Model;
use Zend\Db\Adapter\Adapter;
use Gear\Model\MakeGear;
use Gear\Model\Schema;
use Gear\Model\FilterGear;


/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class SearchGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Form';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if(is_array($entities) && count($entities)>0) {
            foreach($entities as $i => $table) {
                $this->createSearchForm($table);
            }
        } else {
            return false;
        }
    }

    public function createSearchForm($table)
    {
        $module = $this->getModule();
        $path   = $this->getFinalPath();

        $class = $this->str('class',$table);
        $schema = new Schema($this->getAdapter());
        $columns = $schema->getColumns($this->str('uline',$table));

        $b = '';
        $b .= $this->getNamespace($module.'\\Form');
        $b .= $this->getUse();
        $b .= $this->getClass($this->getFileName($table));
        $b .= $this->getConstruct($class,$columns,$table,$module);
        $b .= $this->getEndFile();
        $this->mkPHP($path, $this->getFileName($table).'SearchForm',$b);
    }

    public function getUse()
    {
        $b = 'use Zend\Form\Form;'.PHP_EOL;
        $b .= 'use Zend\Form\Element;'.PHP_EOL;
        $b .= 'use Doctrine\ORM\EntityManager;'.PHP_EOL.PHP_EOL;
        return $b;
    }

    public function getClass($table)
    {
        return 'class '.$table.'SearchForm extends Form'.PHP_EOL.'{'.PHP_EOL;
    }

    public function getConstruct($class,$inputs,$table_name,$module_name)
    {

        $schema = new \Gear\Model\Schema($this->getConfig()->getDriver());

        $b = '';

        $contraints = $schema->getConstraints($this->str('uline',$table_name));
        $entityManager = false;
        foreach($contraints as $i => $v) {
            if($v->getType()=='FOREIGN KEY') {
                $entityManager = true;
            }
        }

        if($entityManager) {
            $b .= $this->getIndent(1).'public function __construct(EntityManager $entityManager)'.PHP_EOL;
        } else {
            $b .= $this->getIndent(1).'public function __construct()'.PHP_EOL;
        }

        $b .= $this->getIndent(1).'{'.PHP_EOL;
        $b .= $this->getIndent(2).trim(' parent::__construct(\''.$class.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim(' $this->setAttribute(\'method\', \'post\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->setAttribute(\'role\', \'form\');').PHP_EOL;

        $b .= $this->getAllInputs($module_name,$table_name,$inputs);

        $b .= $this->getSubmitButton();

        $b .= $this->getIndent(1).'}'.PHP_EOL;
        $b .= '';

        return $b;
    }

    public function getSubmitButton()
    {
        $label = $this->getConfig()->getTranslate('Submit');
        $reset = $this->getConfig()->getTranslate('Reset');

        $b = '';
        $b .= $this->getIndent(2).trim('$send = new Element(\'submit\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$send->setValue(\''.$label.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$send->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim(' \'type\'  => \'submit\'').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($send);').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(2).trim('$send = new Element(\'clear\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$send->setValue(\''.$reset.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$send->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'type\'  => \'submit\'').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($send);').PHP_EOL.PHP_EOL;

        return $b;
    }

    /**
     * @param string $module_name
     * @param unknown $name
     * @param unknown $inputs
     * @return string
     */
    public function getAllInputs($module,$table,$inputs)
    {
        $schema = new Schema($this->getAdapter());
        $input  = new \Gear\Model\InputGear($this->getConfig());

        //chave primária
        //
        //constraints
        $constraints = $schema->getConstraints($table);
        $b = '';
        $b .= PHP_EOL;
        //var_dump($inputs);die();

        $key = $schema->getPrimaryKey($this->toTable($table));
        //var_dump($key);die();

        $text = false;

        foreach($inputs as $i => $v)
        {
            if($v->getName()==$key) {
                $b .= $this->getPrimaryKeyElement($v,$table);
                continue;
            }
            if(in_array($v->getDataType(),array('varchar','text'))) {
                $text = true;
            }

            $inputName = $this->underlineToCode($v->getName());
            $constraint = $schema->hasConstraint($v->getName(),$constraints);
            if(count($constraints)>0) {
                if($constraint && preg_match('/^id_/',$v->getName())) {
                    $b .= $this->getSelectElement($v->getName(),$table,$module,$constraint);
                } elseif(in_array($v->getDataType(),array('datetime','int','decimal')) && !in_array($this->str('class',$v->getName()),array('Created','Updated'))) {
                    $b .= $this->getSelectBetween($v->getName(),$table);
                }
            }

        }
//die();
        if($text==true) {
            $b .= $this->getTextSearchElement();
        }
        return $b;
    }

    public function getPRimaryKeyElement($column,$table)
    {
        $tableVar = $this->str('var',$column->getName());
        $tableClass = $this->str('class',$column->getName());
        $tableLabel = $this->str('label',$column->getName());

        $b  = $this->getIndent(2).trim(sprintf('$%s = new Element(\'%s\');',$tableVar,$tableClass)).PHP_EOL;
        $b .= $this->getIndent(2).trim(sprintf('$%s->setAttributes(array(',$tableVar)).PHP_EOL;
        $b .= $this->getIndent(3).trim(sprintf('    \'name\' => \'%s\',',$tableClass)).PHP_EOL;
        $b .= $this->getIndent(3).trim(sprintf('    \'id\' => \'%s\',',$tableClass)).PHP_EOL;
        $b .= $this->getIndent(3).trim(sprintf('    \'type\' => \'text\',')).PHP_EOL;
        $b .= $this->getIndent(2).trim(sprintf('));')).PHP_EOL;
        $b .= $this->getIndent(2).trim(sprintf('$%s->setLabel(\'%s\');',$tableVar,$tableLabel)).PHP_EOL;
        $b .= $this->getIndent(2).trim(sprintf('$this->add($%s);',$tableVar)).PHP_EOL.PHP_EOL;
        return $b;
    }


    public function getSelectBetween($column,$table)
    {

        $moduleClass = $this->getModule();
        $tableClass  = $this->str('class',$table);
        $columnLabel  = $this->str('label',$column);
        $tableVar    = $this->str('var',$column);
        $columnClass  = $this->str('class',$column);


        $b  = $this->getIndent(2).trim('$'.$tableVar.'From = new Element(\''.$this->str('url',$tableVar).'From\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$tableVar.'From->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'name\' => \''.$tableVar.'From\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'id\' => \''.$tableVar.'From\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'type\' => \'text\',').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$tableVar.'From->setLabel(\''.$columnLabel.' '.$this->getConfig()->getTranslate('From').'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$tableVar.'From);').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(2).trim('$'.$tableVar.'To = new Element(\''.$this->str('url',$tableVar).'To\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$tableVar.'To->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'name\' => \''.$tableVar.'To\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'id\' => \''.$tableVar.'To\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'type\' => \'text\',').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$tableVar.'To->setLabel(\''.$columnLabel.' '.$this->getConfig()->getTranslate('To').'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$tableVar.'To);').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getSelectElement($columns,$table,$module,$constraint)
    {
        $tableVar = $this->str('var',$columns);
        $moduleClass = $this->getModule();
        $tableLabel = $this->str('label',$columns);
        $tableClass = $this->str('class',$table);

        $targetClass = $this->getColumn($columns,$table);

        $targetClass = $this->str('class',$targetClass->fk);

        $input  = new \Gear\Model\InputGear($this->getConfig());
        $property = $input->getProperty($constraint->getReferencedTableName());

        $b  = $this->getIndent(2).trim('$'.$tableVar.' = array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'name\' => \''.$tableVar.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'type\' => \'DoctrineModule\Form\Element\ObjectSelect\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'options\' => array(').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'label\' =>\''.$tableLabel.'\',').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'object_manager\' => $entityManager,').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'target_class\' => \''.$moduleClass.'\Entity\\'.$targetClass.'\',').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'property\' => \''.$property.'\',').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'empty_option\' => \'Choose\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    ),').PHP_EOL;
        $b .= $this->getIndent(2).trim(');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$tableVar.');').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function getTextSearchElement()
    {
        $b  = $this->getIndent(2).trim('$name = new Element(\'like\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$name->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'name\' => \'like\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'id\' => \'like\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'type\' => \'text\',').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$name->setLabel(\''.$this->getConfig()->getTranslate('Match Text').'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($name);').PHP_EOL.PHP_EOL;

        return $b;
    }
}