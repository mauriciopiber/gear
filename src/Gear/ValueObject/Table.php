<?php
namespace Gear\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;

class Table
{
    protected $name;

    protected $columns;

    protected $constraints;

    public function __construct(\Zend\Db\Metadata\Object\TableObject $table)
    {
        $columns = new ArrayCollection();

        $this->setName($table->getName());
        $this->setColumns($table->getColumns());
        $this->setConstraints($table->getConstraints());
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

    public function getColumns()
    {
        return $this->columns;
    }

    public function setColumns($columns)
    {
        foreach ($columns as $indice => $column) {
            $columnValueObject = new \Gear\ValueObject\Column($column,$this);
            $this->columns[***REMOVED*** = $columnValueObject;
        }

        return $this;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasUnique()
    {
        if (count($this->getConstraints())<1) {
            return false;
        } else {
            $unique = false;
            foreach ($this->getConstraints() as $v) {
                if ($v->getType()=='UNIQUE') {
                    $unique = true;
                    break;
                }
            }

            return $unique;
        }
    }

    /**
     *
     * @return multitype array:
     */
    public function getUnique()
    {
        $unique = [***REMOVED***;
        if (count($this->getConstraints())<1) {
            return $unique;
        } else {
            foreach ($this->getConstraints() as $v) {
                if ($v->getType()=='UNIQUE') {
                    $unique[***REMOVED*** = $v;
                }
            }
        }

        return $unique;
    }

    public function getPrimaryKeyColumnName()
    {
        if (count($this->getConstraints())<1) {
            return false;
        } else {
            $primaryKeyName = '';
            foreach ($this->getConstraints() as $v) {
                if ($v->getType()=='PRIMARY KEY') {
                    $columns = $v->getColumns();
                    $primaryKeyName = array_pop($columns);
                    break;
                }
            }

            return $primaryKeyName;
        }
    }
}
