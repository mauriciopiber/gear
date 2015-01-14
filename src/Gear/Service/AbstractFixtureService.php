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


       /*      if ($columnConstraint && $column->isNullable()) {
                continue;
            } else {
                $this->validColumns[***REMOVED***  = $column;
                continue;
                //create a getReference using getOrder.
            } */

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
        $insert .= sprintf('\'%s\' => \'%s\','.PHP_EOL, $this->str('var', $column->getName()), $this->getBaseMessage('insert', $column));

        return $insert;
    }

    public function getBaseMessage($base, $column)
    {
        $baseMessage = sprintf('%s %s', $base, $this->str('label', $column->getName()));

        if (strlen($baseMessage) > $column->getCharacterMaximumLength()) {
            $baseMessage = substr($baseMessage, 0, $column->getCharacterMaximumLength());
        }
        return $baseMessage;
    }
    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn($column)
    {
        $insertAssert = '        ';
        $insertAssert .= sprintf('$this->assertEquals(\'%s\', $resultSet->get%s());'.PHP_EOL, $this->getBaseMessage('insert', $column), $this->str('class', $column->getName()));

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
        $update .= sprintf('\'%s\' => \'%s\','.PHP_EOL, $this->str('var', $column->getName()), $this->getBaseMessage('update', $column));
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
        $updateAssert .= sprintf('$this->assertEquals(\'%s\', $resultSet->get%s());'.PHP_EOL, $this->getBaseMessage('update', $column), $this->str('class', $column->getName()));
        return $updateAssert;
    }

}
