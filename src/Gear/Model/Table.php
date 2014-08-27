<?php
namespace Gear\Model;

/**
 * @author piber
 *
 */
class Table extends MakeGear
{
    protected $name;
    protected $columns_fix = array();
    protected $columns_clean;
    protected $primary_key;
    protected $contraints;

    public function __construct(\Gear\Model\Configuration $configuration,$name)
    {
        parent::setConfig($configuration);
        //$this->setAdapter($configuration->getDriver());

        $schema = new \Gear\Model\Schema($configuration->getDriver());
        $this->setName($name);
        $this->setColumnsFix($this->getColumns($name));
        $this->setColumnsClean($schema->getColumns($name));

    }

    public function getClass()
    {
        return $this->str('class',$this->getFileName($this->getName()));
    }

    public function getEntity()
    {
        return $this->str('class',$this->getName());
    }

    public function getVar()
    {
    	return $this->str('var',$this->getFileName($this->getName()));
    }

    public function getUrl()
    {
    	return $this->str('url',$this->getFileName($this->getName()));
    }

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	public function getColumnsFix() {
		return $this->columns_fix;
	}

	public function setColumnsFix($columns_fix) {
		$this->columns_fix = $columns_fix;
		return $this;
	}

	public function getColumnsClean() {
		return $this->columns_clean;
	}

	public function setColumnsClean($columns) {
		$this->columns_clean = $columns;
		return $this;
	}

	public function getPrimaryKey() {
		return $this->primary_key;
	}

	public function setPrimaryKey($primary_key) {
		$this->primary_key = $primary_key;
		return $this;
	}

	public function getContraints() {
		return $this->contraints;
	}

	public function setContraints($contraints) {
		$this->contraints = $contraints;
		return $this;
	}




}