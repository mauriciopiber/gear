<?php
namespace Gear\Service\Mvc\RepositoryService;

use Gear\Service\AbstractJsonService;
use Gear\Common\SpecialityServiceTrait;


class MappingService extends AbstractJsonService
{
    use SpecialityServiceTrait;

    protected $aliaseStack;

    protected $columnsStack;

    /** Cada Mapa */
    protected $ref;
    protected $type;
    protected $dataType;
    protected $name;
    protected $aliase;
    protected $table;

    protected $countTableHead;

    public function getAliaseStack()
    {
        return $this->aliaseStack;
    }

    public function setAliaseStack(array $aliaseStack)
    {
        $this->aliaseStack = $aliaseStack;
        return $this;
    }

    public function getMainAliase()
    {
        return $this->aliaseStack[0***REMOVED***;
    }

    public function convertDataTypeToInternalType()
    {
        switch ($this->dataType) {
        	case 'decimal':
        	    $type = 'money';
        	    break;

        	case 'date':
        	case 'datetime':
        	case 'time':
        	    $type = 'date';
        	    break;
        	case 'text':
        	case 'varchar':
        	case 'longtext':
        	    $type = 'text';
        	    break;
        	case 'int':
        	case 'tinyint':
        	    $type = 'int';
        	    break;
        	default:
        	    throw new \Exception(sprintf('Type %s can\'t be found', $this->dataType));
        	    break;
        }

        return $type;
    }


    /**
     * Increase with X the aliase until found one available.
     * @param unknown $tableAliase
     * @return string
     */
    public function concatenateAliase($tableAliase)
    {
        if (in_array($tableAliase,  $this->getAliaseStack())) {
            do {
                $tableAliase .= 'x';
            } while (in_array($tableAliase, $this->getAliaseStack()));
        }
        return $tableAliase;
    }

    public function getFirstValidColumnFromReferencedTable($tableReference)
    {
        $schema = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));

        $columns = $schema->getColumns($tableReference);

        foreach ($columns as $i => $columnItem) {
            if ($columnItem->getDataType() == 'varchar') {
                $use = $columnItem->getName();
                break;
            }
        }
        if (!isset($use)) {
            $use = 'id_'.$tableReference;
        }

        return $use;
    }

    public function addAliaseStack($newAliase)
    {
        $stacks = $this->getAliaseStack();

        if ($stacks == null) {
            $this->setAliaseStack(array($newAliase));
        } elseif(is_array($stacks)) {
            $this->setAliaseStack(array_merge($this->getAliaseStack(),array($newAliase)));
        }
    }

    public function extractAliaseFromTableName($tableName)
    {
        $callable = function($a, $b) {
            return $a. substr($b, 0, 1);
        };
        $tableAliase = array_reduce(explode('_', $tableName), $callable);
        $tableAliase = $this->concatenateAliase($tableAliase);
        $this->addAliaseStack($tableAliase);

        return $tableAliase;
    }


    public function extractTypeFromColumn($column)
    {
        if ($this->db->isForeignKey($column)) {
            $this->type = 'join';
            return $this;
        }

        if ($this->db->isPrimaryKey($column)) {
            $this->type = 'primary';
            return $this;
        }

        $this->type = $this->convertDataTypeToInternalType();
        return $this;
    }

    public function extractAliaseFromColumn($column)
    {
        if ($this->db->isForeignKey($column)) {
            $tableReference = $this->db->getForeignKeyReferencedTable($column);

            $this->aliase = $this->extractAliaseFromTableName($tableReference);

            return $this;
        }

        $this->aliase = $this->getMainAliase();
        return $this;
    }

    /**
     * Define se a coluna irá aparecer no head da tabela.
     * @param unknown $column
     * @return \Gear\Service\Mvc\RepositoryService\MappingService
     */
    public function extractTableFromColumn($column)
    {
        if ($this->db->isForeignKey($column)) {
            $tableReference = $this->db->getForeignKeyReferencedTable($column);
            if ($column->getName() == 'created_by' && $tableReference == 'user') {
                $table = false;
            } else {
                $table = true;
            }
        } else {

            $specialityService = $this->getSpecialityService();
            $specialityName = $this->getGearSchema()->getSpecialityByColumnName($column->getName(), $this->db->getTable());

            $specialityOnTableHead = array('email');

            if (in_array($specialityName, $specialityOnTableHead)) {
                $table = true;
            } elseif ($this->dataType == 'text' || $specialityName !== null) {
                $table = false;
            } else {
                $table = true;
            }
        }


        $this->table = $this->convertBooleanToString($table);

        return $this;
    }

    public function extractRefFromColumn($column)
    {
        if ($this->db->isForeignKey($column)) {
            $tableReference = $this->db->getForeignKeyReferencedTable($column);

            $refColumn = $this->getFirstValidColumnFromReferencedTable($tableReference);
            $this->ref = sprintf('%s.%s', $this->aliase, $this->str('var', $refColumn));

            return $this;
        }

        $this->ref = sprintf('%s.%s', $this->aliase, $this->str('var', $column->getName()));

        return $this;
    }

    public function getRepositoryMapping()
    {
        unset($this->countTableHead);
        $this->getEventManager()->trigger('getInstance', $this);
        $this->db = $this->getInstance();
        $columns = $this->db->getTableColumnsMapping();

        foreach ($columns as $i => $column) {

            $this->dataType = $column->getDataType();

            $this->extractAliaseFromColumn($column);
            $this->extractRefFromColumn($column);
            $this->extractTableFromColumn($column);
            $this->extractTypeFromColumn($column);

            $this->label = $this->str('label', $column->getName());
            $this->name  = $this->str('var', $column->getName());

            $this->columnsStack[***REMOVED*** = array(
            	'name' => $this->name,
                'label' => $this->label,
                'ref' => $this->ref,
                'type' => $this->type,
                'aliase' => $this->aliase,
                'table' => $this->table
            );

            unset($this->label, $this->ref, $this->type, $this->aliase, $this->table, $this->name);
        }

        return $this;
    }

    public function getCountTableHead()
    {
        return $this->countTableHead;
    }

    public function convertBooleanToString($boolean)
    {
        if ($boolean) {
            if (isset($this->countTableHead)) {
                $this->countTableHead = $this->countTableHead+1;
            } else {
                $this->countTableHead = 1;
            }
            return 'true';
        } else {
            return 'false';
        }
    }

    public function toString()
    {
        $line = '        return array('.PHP_EOL;
        foreach ($this->columnsStack as $column) {
            $line .= $this->printArray($column['name'***REMOVED***, $column['label'***REMOVED***, $column['ref'***REMOVED***, $column['type'***REMOVED***, $column['aliase'***REMOVED***, $column['table'***REMOVED***);
        }
        $line .= '        );';

        return $line;
    }

    public function printArray($name, $label, $ref, $type, $aliase, $table)
    {
        return sprintf(
            '            \'%s\' => array('.PHP_EOL.
            '                \'label\' => \'%s\','.PHP_EOL.
            '                \'ref\' => \'%s\','.PHP_EOL.
            '                \'type\' => \'%s\','.PHP_EOL.
            '                \'aliase\' => \'%s\','.PHP_EOL.
            '                \'table\' => %s'.PHP_EOL.
            '            ),',
            $name,
            $label,
            $ref,
            $type,
            $aliase,
            $table
        ).PHP_EOL;
    }
}
