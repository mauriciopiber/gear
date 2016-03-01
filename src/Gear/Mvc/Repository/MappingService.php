<?php
namespace Gear\Mvc\Repository;

use Gear\Service\AbstractJsonService;

class MappingService extends AbstractJsonService
{
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

    public function convertDataTypeToInternalType($column)
    {
        $class = get_class($column);


        switch ($class) {
            case 'Gear\\Column\\Decimal':
            case 'Gear\\Column\\Decimal\\MoneyPtBr':
                $type = 'money';
                break;

            case 'Gear\\Column\\Date':
            case 'Gear\\Column\\Datetime':
            case 'Gear\\Column\\Date\DatePtBr':
            case 'Gear\\Column\\Datetime\\DatetimePtBr':
            case 'Gear\\Column\\Time':
                $type = 'date';
                break;

            case 'Gear\\Column\\Varchar':
            case 'Gear\\Column\\Varchar\\Email':
            case 'Gear\\Column\\Varchar\\PasswordVerify':
            case 'Gear\\Column\\Varchar\\UniqueId':
            case 'Gear\\Column\\Varchar\\UploadImage':
            case 'Gear\\Column\\Varchar\\Url':
            case 'Gear\\Column\\Varchar\\Telephone':
            case 'Gear\\Column\\Text':
            case 'Gear\\Column\\Text\\Html':

                $type = 'text';
                break;

            case 'Gear\\Column\\Int':
            case 'Gear\\Column\\Int\\Checkbox':
            case 'Gear\\Column\\Tinyint':
            case 'Gear\\Column\\Tinyint\\Checkbox':

                $type = 'int';
                break;
            default:
                throw new \Exception(sprintf('Type %s can\'t be found', $class));
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
        if (in_array($tableAliase, $this->getAliaseStack())) {
            do {
                $tableAliase .= 'x';
            } while (in_array($tableAliase, $this->getAliaseStack()));
        }
        return $tableAliase;
    }

    public function getFirstValidColumnFromReferencedTable($tableReference)
    {
        $schema = $this->getMetadata();

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
        } elseif (is_array($stacks)) {
            $this->setAliaseStack(array_merge($this->getAliaseStack(), array($newAliase)));
        }
    }

    public function extractAliaseFromTableName($tableName)
    {
        $callable = function ($a, $b) {
            return $a. substr($b, 0, 1);
        };
        $tableAliase = array_reduce(explode('_', $tableName), $callable);
        $tableAliase = $this->concatenateAliase($tableAliase);
        $this->addAliaseStack($tableAliase);

        return $tableAliase;
    }


    public function extractTypeFromColumn($column)
    {
        if ($column instanceof \Gear\Column\Int\ForeignKey) {
            $this->type = 'join';
            return $this;
        }

        if ($column instanceof \Gear\Column\Int\PrimaryKey) {
            $this->type = 'primary';
            return $this;
        }

        $this->type = $this->convertDataTypeToInternalType($column);
        return $this;
    }

    public function extractAliaseFromColumn(\Gear\Column\AbstractColumn $columnData)
    {

        $column = $columnData->getColumn();

        if ($columnData instanceof \Gear\Column\Int\ForeignKey) {
            $tableReference = $this->getTable()->getForeignKeyReferencedTable($column);

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
    public function extractTableFromColumn($columnData)
    {
        $column = $columnData->getColumn();

        if ($columnData instanceof \Gear\Column\Int\ForeignKey) {

            $tableReference = $this->getTable()->getForeignKeyReferencedTable($column);

            if ($column->getName() == 'created_by' && $tableReference == 'user') {
                $this->tableName = $this->convertBooleanToString(false);
                return $this;
            }

            $this->tableName = $this->convertBooleanToString(true);
            return $this;

        }

        if ($this->getColumnService()->filter($columnData, [
            'Gear\Column\Varchar\PasswordVerify',
            'Gear\Column\Varchar\UniqueId',
            'Gear\Column\Varchar\UploadImage',
            'Gear\Column\Text',
            'Gear\Column\Text\Html',
            'Gear\Column\Int\Checkbox',
            'Gear\Column\Tinyint\Checkbox',
        ***REMOVED***)) {
            $this->tableName = $this->convertBooleanToString(false);
            return $this;
        }


        $this->tableName = $this->convertBooleanToString(true);
        return $this;

    }

    public function extractRefFromColumn($columnData)
    {
        $column = $columnData->getColumn();

        if ($columnData instanceof \Gear\Column\Int\ForeignKey) {

            $tableReference = $this->getTable()->getForeignKeyReferencedTable($column);

            $refColumn = $this->getFirstValidColumnFromReferencedTable($tableReference);
            $this->ref = sprintf('%s.%s', $this->aliase, $this->str('var', $refColumn));

            return $this;
        }

        $this->ref = sprintf('%s.%s', $this->aliase, $this->str('var', $column->getName()));

        return $this;
    }

    public function getRepositoryMapping($db = null)
    {
        unset($this->countTableHead);

        $this->db = $db;

        $columns = $this->getColumnService()->getColumns();

        if (!empty($columns)) {
            foreach ($columns as $i => $column) {

                $this->dataType = $column->getColumn()->getDataType();

                $this->extractAliaseFromColumn($column);
                $this->extractRefFromColumn($column);
                $this->extractTableFromColumn($column);
                $this->extractTypeFromColumn($column);

                $this->label = $this->str('label', $column->getColumn()->getName());
                $this->name  = $this->str('var', $column->getColumn()->getName());

                $this->columnsStack[***REMOVED*** = array(
                    'name' => $this->name,
                    'label' => $this->label,
                    'ref' => $this->ref,
                    'type' => $this->type,
                    'aliase' => $this->aliase,
                    'table' => $this->tableName
                );

                unset($this->label, $this->ref, $this->type, $this->aliase, $this->tableName, $this->name);
            }
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
        if (!empty($this->columnsStack)) {
            foreach ($this->columnsStack as $column) {
                $line .= $this->printArray(
                    $column['name'***REMOVED***,
                    $column['label'***REMOVED***,
                    $column['ref'***REMOVED***,
                    $column['type'***REMOVED***,
                    $column['aliase'***REMOVED***,
                    $column['table'***REMOVED***
                );
            }
        }
        $line .= '        );';

        return $line;
    }

    public function printArray($name, $label, $ref, $type, $aliase, $table)
    {
        return sprintf(
            '            \'%s\' => array('.PHP_EOL.
            '                \'label\'  => \'%s\','.PHP_EOL.
            '                \'ref\'    => \'%s\','.PHP_EOL.
            '                \'type\'   => \'%s\','.PHP_EOL.
            '                \'aliase\' => \'%s\','.PHP_EOL.
            '                \'table\'  => %s'.PHP_EOL.
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
