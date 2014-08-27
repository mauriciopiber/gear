<?php
namespace Gear\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;

class Column
{

    protected $name;

    protected $dataType;

    protected $isNullable;

    protected $table;

    protected $primaryKey;

    protected $uniqueKey;

    protected $foreignKeys;

    protected $specialites;

    protected $characterMaximumLength;

    public function __construct($column, $table)
    {
        $this->foreignKeys = new ArrayCollection();
        $this->specialites = new ArrayCollection();

        $this->setName($column->getName());
        $this->setDataType($column->getDataType());
        $this->setIsNullable($column->getIsNullable());
        $this->setTable($table);
        $this->setCharacterMaximumLength($column->getCharacterMaximumLength());

        $specialityService = new \Gear\Service\SpecialityService();

        $this->setSpecialites($specialityService->getSpecialityByField($this));

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDataType()
    {
        return $this->dataType;
    }

    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
        return $this;
    }

    public function getIsNullable()
    {
        return $this->nullable;
    }

    public function setIsNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
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

    public function getPrimaryKey()
    {
        return $this->getTable()->getPrimaryKey($this->getName());
    }

    public function getUniqueKey()
    {
        return $this->getTable()->getUniqueKey($this->getName());
    }

    public function getForeignKeys()
    {
        return $this->getTable()->getForeignKeys($this->getName());
    }

    public function getSpecialites()
    {
        return $this->specialites;
    }

    public function setSpecialites($specialites)
    {
        $this->specialites[***REMOVED*** = $specialites;
        return $this;
    }

    public function getCharacterMaximumLength()
    {
        return $this->characterMaximumLength;
    }

    public function setCharacterMaximumLength($characterMaximumLength)
    {
        $this->characterMaximumLength = $characterMaximumLength;
        return $this;
    }
}
