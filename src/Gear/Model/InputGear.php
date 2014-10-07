<?php

namespace Gear\Model;

/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class InputGear extends \Gear\Model\MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getHiddenElement($column_name)
    {
        $inputName = $this->underlineToCode($column_name);
        $inputNameDoctrine = lcfirst($this->underlineToClass($column_name));

        $b = '';
        $b .= $this->getIndent(2).trim('$'.$inputName.' = new Element(\''.$inputNameDoctrine.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$inputName.'->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'name\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'id\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'type\' => \'hidden\',').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$inputName.');').PHP_EOL.PHP_EOL;

        return $b;
    }

    //get table target property
    public function getProperty($table_reference)
    {
        $schema  = new \Gear\Model\Schema($this->getConfig()->getDriver());
        $columns = $schema->getColumns($table_reference);

        $whitelist = array(
            'nome',
            'titulo',
            'name',
            'title'
        );
        $property = '';
        foreach ($columns as $i => $v) {
            if (in_array($v->getName(),$whitelist)) {
                $property = $v->getName();
                break;
            }
        }

        if (strlen($property)<1) {
            $property = $this->str('var',$schema->getPrimaryKey($table_reference));
        }

        return $property;
    }

    public function getSelectElement($column_name,$module,$constraint)
    {
        $inputName = $this->underlineToCode($column_name);
        $inputNameDoctrine = lcfirst($this->underlineToClass($column_name));

        $property = $this->getProperty($constraint->getReferencedTableName());

        $b = '';
        $b .= $this->getIndent(2).trim('$'.$inputName.' = array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'name\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'type\' => \'DoctrineModule\Form\Element\ObjectSelect\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    \'options\' => array(').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'label\' =>\''.$this->underlineToLabel($column_name).'\',').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'object_manager\' => $entityManager,').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'target_class\' => \''.$this->controllerToClass($module).'\Entity\\'.$this->controllerToClass($constraint->getReferencedTableName()).'\',').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'property\' => \''.$property.'\',').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'empty_option\' => \'Choose\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('    ),').PHP_EOL;

        $b .= $this->getIndent(2).trim(');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$inputName.');').PHP_EOL.PHP_EOL;

        return $b;

    }

    public function getTextAreaElement($column_name)
    {
        $inputName = $this->underlineToCode($column_name);
        $inputNameDoctrine = lcfirst($this->underlineToClass($column_name));

        $b = '';

        $b .= $this->getIndent(2).trim('$'.$inputName.' = new Element\Textarea(\''.$inputNameDoctrine.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$inputName.'->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'name\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'id\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'size\' => \'30\',').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$inputName.'->setLabel(\''.$this->underlineToLabel($column_name).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$inputName.');').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getDatetimeElement($column_name)
    {
        $inputName = $this->underlineToCode($column_name);
        $inputNameDoctrine = lcfirst($this->underlineToClass($column_name));

        $b = '';
        $b .= $this->getIndent(2).trim('$'.$inputName.' = new Element\DateTime(\''.$inputNameDoctrine.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$inputName.'->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'name\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'id\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'size\' => \'30\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'class\' => \'datepicker\',').PHP_EOL;

        $b .= $this->getIndent(3).trim('\'min\'  => \'01/01/2010 00:00:00\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'max\'  => \'31/12/2030 23:59:59\'').PHP_EOL;

        $b .= $this->getIndent(2).trim('));').PHP_EOL;

        $b .= $this->getIndent(2).trim('$'.$inputName.'->setLabel(\''.$this->underlineToLabel($column_name).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$inputName.');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->get(\''.$inputNameDoctrine.'\')->setFormat(\'d/m/Y H:i\');').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getDateElement($column_name)
    {
        $inputName = $this->underlineToCode($column_name);
        $inputNameDoctrine = lcfirst($this->underlineToClass($column_name));

        $b = '';
        $b .= $this->getIndent(2).trim('$'.$inputName.' = new Element\Date(\''.$inputNameDoctrine.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$inputName.'->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'name\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'id\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'type\' => \'date\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'size\' => \'30\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'class\' => \'datepicker\',').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;

        $b .= $this->getIndent(2).trim('$'.$inputName.'->setLabel(\''.$this->underlineToLabel($column_name).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$inputName.');').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getTextElement($column_name)
    {
        $inputName = $this->underlineToCode($column_name);
        $inputNameDoctrine = lcfirst($this->underlineToClass($column_name));

        $b = '';
        $b .= $this->getIndent(2).trim('$'.$inputName.' = new Element(\''.$inputNameDoctrine.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$inputName.'->setAttributes(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'name\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'id\' => \''.$inputNameDoctrine.'\',').PHP_EOL;
        $b .= $this->getIndent(3).trim('\'type\' => \'text\',').PHP_EOL;
        $b .= $this->getIndent(2).trim('));').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$inputName.'->setLabel(\''.$this->underlineToLabel($column_name).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->add($'.$inputName.');').PHP_EOL.PHP_EOL;

        return $b;

    }

}
