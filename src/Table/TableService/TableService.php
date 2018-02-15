<?php
namespace Gear\Table\TableService;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Table\Metadata\MetadataTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\Structure\ModuleStructureTrait;
use GearJson\Db\Db;

class TableService implements ServiceLocatorAwareInterface
{
    use ModuleStructureTrait;
    use MetadataTrait;
    use StringServiceTrait;
    use ServiceLocatorAwareTrait;

    /**
     * Retorna as colunas válidas da tabela, com a exclusão das colunas básicas.
     *
     * @param string  $tableName     Table Name
     * @param boolean $usePrimaryKey Choose if return Primary Key
     *
     * @return array Valid Columns From Table
     */
    public function getValidColumnsFromTable($tableName, $usePrimaryKey = false)
    {
        $this->usePrimaryKey = $usePrimaryKey;
        $this->tableName = $this->str('uline', $tableName);
        $this->tableColumns = $this->getColumns($this->tableName);

        $primaryKeyColumn = $this->getPrimaryKeyColumns($this->tableName);

        foreach ($this->tableColumns as $column) {
            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {
                if (!$this->usePrimaryKey) {
                    continue;
                }
            }

            if (in_array($column->getName(), $this->getExcludeColumns())) {
                continue;
            }

            $this->validColumns[***REMOVED***  = $column;
        }
        return $this->validColumns;
    }


    /**
     * Retorna exclusivamente o nome da Coluna em uma String. Chaves compostas vem divididas com ",".
     *
     * @param string $tableName Table Name
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getPrimaryKeyColumnName($tableName)
    {
        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        if ($table) {
            $contraints = $table->getConstraints();

            foreach ($contraints as $contraint) {
                if ($contraint->getType() == 'PRIMARY KEY') {
                    $columns = $contraint->getColumns();

                    $column = implode(',', $columns);

                    return $column;
                } else {
                    continue;
                }
            }
        }

        throw new \Exception(sprintf('Tabela %s não possui Primary Key', $this->table));
    }

    /**
     * Retorna a coluna que deve ser usada para referenciar as ForeignKey.
     *
     * @return ColumnObject
     */
    public function getReferencedTableValidColumnName($tableName)
    {
        $this->tableName = $this->str('uline', $tableName);
        $this->columns = $this->getColumns($this->tableName);

        $column = null;

        foreach ($this->columns as $b) {
            if ($b->getDataType() == 'varchar') {
                $column = $this->str('class', $b->getName());
                break;
            }
        }

        if ($column === null) {
            $column = 'id.'.$this->str('class', $tableName);
        }


        return $column;
    }

    /**
     * Verifica se a tabela possui colunas Unique
     *
     * @param string $tableName
     */
    public function hasUniqueConstraint($tableName)
    {
        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        $constraints = $table->getConstraints();

        foreach ($constraints as $constraint) {
            if ($constraint->getType() == 'UNIQUE') {
                return true;
            }
        }

        return false;
    }

    public function getTableObject($tableName)
    {
        return $this->getMetadata()->getTable($this->getStringService()->str('uline', $tableName));
    }

    public function getUniqueConstraintFromColumn($tableName, $columnCheck)
    {
        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));
        $contraints = $table->getConstraints();

        foreach ($contraints as $contraint) {
            if ($contraint->getType() == 'UNIQUE') {
                $columns = $contraint->getColumns();

                if (in_array($columnCheck->getName(), $columns)) {
                    return $contraint;
                }
            }
        }

        return false;
    }

    /**
     * Retorna as colunas da tabela.
     *
     * @param string $tableName Nome da Tabela.
     *
     * @return array
     */
    public function getColumns($tableName)
    {
        return $this->getMetadata()->getColumns($this->str('uline', $tableName));
    }

    /**
     * Pega a ConstraintObject relativa a determinada Coluna.
     *
     * Exemplo: Quero saber a constraint da coluna id_marca da tabela produto, logo retorna
     * o ConstraintObject do tipo FOREIGN_KEY
     *
     * Returna Falso caso não haja FOREIGN KEY
     *
     * @param string $tableName Nome da Tabela.
     * @param ColumnObject $columnCheck
     *
     * @return ConstraintObject|boolean
     */
    public function getConstraintForeignKeyFromColumn($tableName, $columnCheck)
    {
        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        $contraints = $table->getConstraints();

        foreach ($contraints as $contraint) {
            if ($contraint->getType() == 'FOREIGN KEY') {
                $columns = $contraint->getColumns();

                if (in_array($columnCheck->getName(), $columns)) {
                    return $contraint;
                }
            }
        }

        return false;
    }

    public function getPrimaryKey($tableName)
    {
        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        $contraints = $table->getConstraints();

        if (!empty($contraints)) {
            foreach ($contraints as $contraint) {
                if ($contraint->getType() == 'PRIMARY KEY') {
                    return $contraint;
                } else {
                    continue;
                }
            }
        }
    }


    public function verifyTableAssociation($tableName, $tableImage = 'upload_image')
    {

        $tableName = $this->str('class', $tableName);

        $metadata = $this->getMetadata();


        try {
            $imagem = $metadata->getTable($tableImage);
        } catch (\Exception $e) {
            return false;
        }


        if (isset($imagem)) {
            $constrains = $imagem->getConstraints();
            foreach ($constrains as $constraint) {
                if ($constraint->getType() == 'FOREIGN KEY') {
                    $tableNameReferenced = $constraint->getReferencedTableName();
                    if ($tableName == $this->str('class', $tableNameReferenced)) {
                        if (in_array('created_by', $constraint->getColumns())) {
                            continue;
                        }
                        if (in_array('updated_by', $constraint->getColumns())) {
                            continue;
                        }

                        return true;
                    }
                }
            }
        }
        return false;
    }


    /**
     * Validação para as colunas que geralmente não são usadas pelas telas
     *
     * Especifica as colunas que são usadas para estrutura interna, não para gerar as telas.
     *
     * @return string[***REMOVED***
     */
    public function getExcludeColumns()
    {
        return array(
            'created',
            'updated',
            'created_by',
            'updated_by',
            'id_lixeira'
        );
    }

    /**
     * Returns the Primary Key Column for the Table
     *
     * @param string $tableName Table Name
     *
     * @throws \Exception
     *
     * @return ColumnObject|boolean
     */
    public function getPrimaryKeyColumns($tableName)
    {
        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        if ($table) {
            $contraints = $table->getConstraints();

            foreach ($contraints as $contraint) {
                if ($contraint->getType() == 'PRIMARY KEY') {
                    $columns = $contraint->getColumns();
                    return $columns;
                } else {
                    continue;
                }
            }
        }
        throw new \Exception(sprintf('Tabela %s não possui Primary Key', $this->table));
    }

    public function isNullable($tableName)
    {
        $isNullable = true;

        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        $primaryKeyColumns = $this->getPrimaryKeyColumns($tableName);
        $excludeColumns = $this->getExcludeColumns();

        foreach ($table->getColumns() as $column) {
            if (in_array($column->getName(), array_merge($primaryKeyColumns, $excludeColumns))
            ) {
                continue;
            }

            if ($column->isNullable() === false) {
                $isNullable = false;
                break;
            }
        }

        return $isNullable;
    }


    public function isPrimaryKey($column)
    {
        return in_array($column->getName(), $this->getPrimaryKeyColumns());
    }

    public function isExcludedKey($column)
    {
        return in_array($column->getName(), \GearJson\Db\Db::excludeList());
    }


    public function getForeignKeys($db)
    {
        $tableName = $db->getTable();

        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        $constraints = $table->getConstraints();



        if (empty($constraints)) {
            return [***REMOVED***;
        }

        $foreignKeys = [***REMOVED***;


        foreach ($constraints as $constraint) {
            if ($constraint->getType() == 'FOREIGN KEY') {
                if (in_array('created_by', $constraint->getColumns())) {
                    continue;
                }
                if (in_array('updated_by', $constraint->getColumns())) {
                    continue;
                }

                $foreignKeys[***REMOVED*** = $constraint;
            }
        }

        return $foreignKeys;
    }
}
