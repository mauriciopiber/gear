<?php
/**
 *
 * @author piber
 * Um serviço é o ítem mais importante do DDD.
 * Um serviço precisa ser testado com TDD.
 * Um serviço não possui interface então não precisa ser testado com codeception.
 * Um serviço pode extender outro serviço.
 * Um serviço precisa ser adicionado ao invokables do Module.php ao final do processo.
 *
 */
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class FixtureService extends AbstractJsonService
{
    /**
     *
     * @param \Gear\ValueObject\Src $src
     */
    public function create($src)
    {
        $useColumns = $this->getValidColumnsFromTable($src->getDb());

        $arrayData = $this->getArrayData($useColumns);

        $fieldsData = $this->getFieldData($src->getDb(), $useColumns);

        $this->createFileFromTemplate(
            'template/src/fixture/default.phtml',
            array(
                'fields'  => $fieldsData,
                'data'   => $arrayData,
                'name'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFixtureFolder()
        );
        return;
    }

    /**
     * @param string $tableName
     * @param array $columns
     */
    public function getFieldData($tableName, array $columns)
    {
        $fields = [***REMOVED***;
        foreach ($columns as $field) {
            $fields[***REMOVED*** = sprintf('            $%s->set%s($fixture[\'%s\'***REMOVED***);', $this->str('var', $tableName), $this->str('class', $field->getName()), $this->str('var', $field->getName()));
        }
        return $fields;
    }


    /**
     *
     * @param string $tableName Nome da Tabela
     */
    public function getValidColumnsFromTable($tableName)
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');

        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $tableName)));

        $primaryKeyColumn = $table->getPrimaryKeyColumns();

        $columns = $metadata->getColumns($this->str('uline', $tableName));

        $arrayData = [***REMOVED***;

        foreach ($columns as $column) {

            if (in_array($this->str('uline', $column->getName()), \Gear\ValueObject\Db::excludeList())) {
                continue;
            }

            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {
                continue;
            }

            $columnConstraint = $table->getForeignKeyFromColumn($column);


            if ($columnConstraint && $column->isNullable()) {
                continue;
            } else {
                //create a getReference using getOrder.
            }




            $arrayData[***REMOVED*** = $column;
        }

        return $arrayData;
    }

    /**
     * @param array $columns Colunas da Tabela que serão utilizadas na fixture.
     * @return array:string Valores que serão inseridos na fixture.
     */
    public function getArrayData(array $columns)
    {
        $arrayData = [***REMOVED***;

        for ($iterator = 1; $iterator <= 30; $iterator++) {

            $arrayData[***REMOVED*** = '            array('.PHP_EOL;

            foreach ($columns as $column) {
                $arrayData[***REMOVED*** = sprintf('                \'%s\' => \'%d%s\',', $this->str('var', $column->getName()), $iterator, $this->str('label', $column->getName())).PHP_EOL;
            }

            $arrayData[***REMOVED*** = '            ),'.PHP_EOL;
        }

        return $arrayData;
    }
}
