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


    public function convertDataTypeToInternalType($dataType)
    {
        switch ($dataType) {
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
        	    throw new \Exception(sprintf('Type %s can\'t be found', $dataType));
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

    public function getRepositoryMapping()
    {
        $this->getEventManager()->trigger('getInstance', $this);
        $this->db = $this->getInstance();


        $columns = $this->db->getTableColumnsMapping();

        $map = array();

        foreach ($columns as $i => $column) {
            $columnName = $column->getName();

            $tableAliase = '';
            $dataType = $column->getDataType();
            if ($this->db->isForeignKey($column)) {
                $tableReference = $this->db->getForeignKeyReferencedTable($column);

                $this->aliase = $this->extractAliaseFromTableName($tableReference);

                $refColumn = $this->getFirstValidColumnFromReferencedTable($tableReference);
                $this->ref = sprintf('%s.%s', $this->aliase, $this->str('var', $refColumn));
                //ref
                $this->type = 'join';

                if ($column->getName() == 'created_by' && $tableReference == 'user') {
                    $table = false;
                } else {
                    $table = true;
                }
                $this->table = $this->convertBooleanToString($table);


            } else {
                $this->aliase = $this->getMainAliase();
                if ($this->db->isPrimaryKey($column)) {
                    $this->type = 'primary';
                } else {
                    $this->type = $this->convertDataTypeToInternalType($dataType);
                }
                $this->ref = sprintf('%s.%s', $tableAliase, $this->str('var', $columnName));

                $specialityService = $this->getSpecialityService();
                $specialityName = $this->getGearSchema()->getSpecialityByColumnName($column->getName(), $this->db->getTable());

                if ($dataType == 'text' || $specialityName !== null) {
                    $this->table = 'false';
                } else {
                    $this->table = 'true';
                }
            }

            $this->label = $this->str('label', $columnName);
            $this->name  = $this->str('var', $columnName);

            $this->columnsStack[***REMOVED*** = array(
            	'name' => $this->name,
                'label' => $this->label,
                'ref' => $this->ref,
                'type' => $this->type,
                'aliase' => $this->aliase,
                'table' => $this->table
            );

            unset($this->label, $this->ref, $this->type, $this->aliase, $this->table, $this->name);


            $this->countTableHead += 1;

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
