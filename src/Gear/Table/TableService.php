<?php
namespace Gear\Table;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Metadata\MetadataTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\ModuleAwareTrait;
use GearJson\Db\Db;

class TableService implements ServiceLocatorAwareInterface
{
    use ModuleAwareTrait;
    use MetadataTrait;
    use StringServiceTrait;
    use ServiceLocatorAwareTrait;

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

    public function getPrimaryKeyColumns($tableName)
    {
        $table = $this->getMetadata()->getTable($this->str('uline', $tableName));

        if ($table) {
            $contraints = $table->getConstraints();

            foreach ($contraints as $contraint) {

                if ($contraint->getType() == 'PRIMARY KEY') {

                    $columns = $contraint->getColumns();

                    //var_dump($columns);

                    //$column = implode(',', $columns);

                    return $columns;

                } else {
                    continue;
                }
            }
        }



        throw new \Exception(sprintf('Tabela %s não possui Primary Key', $this->table));

    }

    public function isNullable(Db $db)
    {

        $tableName = $db->getTable();

        $isNullable = true;

        $table = $this->getMetadata()->getTable($this->str('uline', $db->getTable()));

        $primaryKeyColumns = $this->getPrimaryKeyColumns($tableName);
        $excludeColumns = $this->getExcludeColumns();


        foreach ($table->getColumns() as $column) {

            if (
                in_array($column->getName(), array_merge($primaryKeyColumns, $excludeColumns))
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
