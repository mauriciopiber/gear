<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

abstract class AbstractFixtureService extends AbstractJsonService
{
    protected $tableName;
    protected $tableColumns;
    protected $validColumns;
    protected $usePrimaryKey;



    public function getValidColumnsFromTable()
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');

        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        $primaryKeyColumn = $table->getPrimaryKeyColumns();

        foreach ($this->tableColumns as $column) {


            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {

                if (!$this->usePrimaryKey) {
                    continue;
                }
            }

            if (in_array($column->getName(), \Gear\ValueObject\Db::excludeList())) {
                continue;
            }

            $columnConstraint = $table->getForeignKeyFromColumn($column);


            if ($columnConstraint && $column->isNullable()) {
                continue;
            } else {
                //create a getReference using getOrder.
            }

            $this->validColumns[***REMOVED***  = $column;
        }
        return $this->validColumns;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn($column)
    {
        $insert = '            ';
        $insert .= sprintf('\'%s\' => \'insert %s\','.PHP_EOL, $this->str('var', $column->getName()), $this->str('label', $column->getName()));

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn($column)
    {
        $insertAssert = '        ';
        $insertAssert .= sprintf('$this->assertEquals(\'insert %s\', $resultSet->get%s());'.PHP_EOL, $this->str('label', $column->getName()), $this->str('class', $column->getName()));

        return $insertAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn($column)
    {
        $update = '            ';
        $update .= sprintf('\'%s\' => \'update %s\','.PHP_EOL, $this->str('var', $column->getName()), $this->str('label', $column->getName()));
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn($column)
    {
        $updateAssert = '        ';
        $updateAssert .= sprintf('$this->assertEquals(\'update %s\', $resultSet->get%s());'.PHP_EOL, $this->str('label', $column->getName()), $this->str('class', $column->getName()));
        return $updateAssert;
    }

}
