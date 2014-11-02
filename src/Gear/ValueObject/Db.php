<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class Db extends AbstractHydrator
{

    protected $table;

    protected $tableObject;

    public function makeSrc()
    {
        $srcToAdd = [***REMOVED***;

        $name = $this->getTable();

        $services = array(
            array('type' => 'Entity'),
            array('type' => 'Repository'),
        	array('type' => 'Service', 'dependency' => $name.'Repository,'.$name.'Form'),
            array('type' => 'Form'),
            array('type' => 'Filter'),
            array('type' => 'Factory', 'dependency' => $name.'Filter,'.$name.'Form'),
        );

        foreach ($services as $i => $v) {
            $toInsert = array_merge($v, array('name' => sprintf('%s%s', $name, $v['type'***REMOVED***), 'db' => $this));
            $srcTemp = new \Gear\ValueObject\Src($toInsert);
            $srcToAdd[***REMOVED*** = $srcTemp;
        }

        return $srcToAdd;
    }

    public function makeController()
    {
        $name = $this->getTable();

        $controllerName = sprintf('%sController', $name);
        $controllerService = '%s'.sprintf('\\Controller\\%s', $name);

        $controller = new \Gear\ValueObject\Controller(array(
        	'name' => $controllerName,
            'object' => $controllerService
        ));

        $role = 'admin';

        $actions = array(
        	array('role' => $role, 'controller' => $controller->getName(), 'name' => 'create', 'db' => $this, 'dependency' => "Service\\".$name),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'edit', 'db' => $this, 'dependency' => "Service\\".$name),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'list', 'db' => $this, 'dependency' => "Service\\".$name),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'delete', 'db' => $this, 'dependency' => "Service\\".$name),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'view', 'db' => $this, 'dependency' => "Service\\".$name),
        );


        foreach ($actions as $action) {
            $action = new \Gear\ValueObject\Action($action);
            $controller->addAction($action);
        }

        return $controller;

    }


    public function getInputFilter()
    {
        $name = new Input('table');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);


        return $inputFilter;
    }

    public function getTableUnderscore()
    {

        $filterChain = new \Zend\Filter\FilterChain();

        $filterChain->attach(new \Zend\Filter\Word\CamelCaseToUnderscore())
        ->attach(new \Zend\Filter\StringToLower());


        return $filterChain->filter($this->getTable());

    }

    public function export()
    {
        return array('table' => $this->getTable());
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

	public function getTableObject()
	{
		return $this->tableObject;
	}

	public function setTableObject(\Zend\Db\Metadata\Object\TableObject $tableObject)
	{
		$this->tableObject = $tableObject;
		return $this;
	}

}
