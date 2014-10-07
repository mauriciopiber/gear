<?php

namespace Gear\Model;

/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class FormGear extends MakeGear
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
        if (is_array($entities) && count($entities)>0) {
            foreach ($entities as $i => $table) {
                $this->createForm($table);
            }
        } else {
            return false;
        }
    }

    public function createForm($table)
    {
        $module = $this->getModule();
        $path   = $this->getFinalPath();

        $class = $this->str('class',$table);

        $schema = new Schema($this->getAdapter());
        $columns = $schema->getColumns($table);

        $b = '';
        $b .= $this->getNamespace($module.'\\Form');
        $b .= $this->getUse();
        $b .= $this->getClass($this->getFileName($class));
        $b .= $this->getConstruct($class,$columns,$table,$module);
        $b .= $this->getEndFile();
        $this->mkPHP($path, $this->getFileName($table).'Form',$b);

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
        return 'class '.$table.'Form extends Form'.PHP_EOL.'{'.PHP_EOL;
    }

    public function getSubmitButton($label = 'Enviar')
    {
        $b = '';
        $b .= $this->getIndent(2).trim('$send = new Element(\'submit\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$send->setValue(\'Submit\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$send->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim(' \'type\'  => \'submit\'').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($send);').PHP_EOL;

        return $b;
    }

    /**
	 * @param string $module_name
	 * @param unknown $name
	 * @param unknown $inputs
	 * @return string
	 */
    public function getAllInputs($module,$name,$inputs)
    {
        $schema = new Schema($this->getAdapter());
        $input  = new \Gear\Model\InputGear($this->getConfig());

        //chave primária
        $key = $schema->getPrimaryKey($this->toTable($name));
        //constraints
        $constraints = $schema->getConstraints($name);
        $b = '';
        $b .= PHP_EOL;
        foreach ($inputs as $i => $v) {
            //var_dump($inputs);die();
            if (in_array($v->getName(),$this->getConfig()->getDbException())) {
                continue;
            }

            $inputName  = $this->underlineToCode($v->getName());

            $constraint = $schema->hasConstraint($v->getName(),$constraints);

            if (count($constraints)>0) {

                if ($v->getName()==$key) {

                    $b .= $input->getHiddenElement($v->getName());

                } elseif ($constraint && preg_match('/^id_/',$v->getName())) {

                    $b .= $input->getSelectElement($v->getName(),$module,$constraint);

                } elseif ($v->getDataType()=='text') {

                    $b .= $input->getTextareaElement($v->getName());

                } elseif (($v->getDataType()=='datetime' || $v->getDataType()=='timestamp')) {

                    if ($v->getDataType()=='datetime') {

                        $b .= $input->getDatetimeElement($v->getName());

                    } elseif ($v->getDataType()=='date') {

                        $b .= $input->getDateElement($v->getName());
                    }

                } else {

                    $b .= $input->getTextElement($v->getName());
                }
            } else {
                $b .= $input->getTextElement($v->getName());
            }

        }

        return $b;
    }

    public function getConstruct($class,$inputs,$table_name,$module_name)
    {

        $schema = new \Gear\Model\Schema($this->getConfig()->getDriver());

        $b = '';

        $contraints = $schema->getConstraints($this->str('uline',$table_name));
        $entityManager = false;
        foreach ($contraints as $i => $v) {
            if ($v->getType()=='FOREIGN KEY') {
                $entityManager = true;
            }
        }

        if ($entityManager) {
            $b .= $this->getIndent(1).'public function __construct(EntityManager $entityManager)'.PHP_EOL;
        } else {
            $b .= $this->getIndent(1).'public function __construct()'.PHP_EOL;
        }
        $b .= $this->getIndent(1).'{'.PHP_EOL;
        $b .= $this->getIndent(2).trim(' parent::__construct(\''.$class.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim(' $this->setAttribute(\'method\', \'post\');').PHP_EOL.PHP_EOL;

        $b .= $this->getAllInputs($module_name,$table_name,$inputs);

        $b .= $this->getSubmitButton();

        $b .= $this->getIndent(1).'}'.PHP_EOL;
        $b .= '';

        return $b;
    }

}
