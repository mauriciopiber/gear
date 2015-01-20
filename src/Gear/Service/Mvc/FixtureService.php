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

use Gear\Service\AbstractFixtureService;
use Gear\Common\SchemaToolServiceTrait;
use Gear\Common\SpecialityServiceTrait;
use Gear\Service\Column\Int\PrimaryKey;
use Gear\Service\Column\Int\ForeignKey;

class FixtureService extends AbstractFixtureService
{
    use SchemaToolServiceTrait;
    use SpecialityServiceTrait;

    protected $speciality;

    protected $tableName;

    protected $srcName;

    protected $tableData;

    /**
     * @param array $columns Colunas da Tabela que serão utilizadas na fixture.
     * @return array:string Valores que serão inseridos na fixture.
     */
    public function getArrayData()
    {
        $arrayData = [***REMOVED***;
        for ($iterator = 1; $iterator <= 30; $iterator++) {
            $arrayData[***REMOVED*** = '            array('.PHP_EOL;
            $arrayData[***REMOVED*** = $this->getEntityFixture($iterator);
            $arrayData[***REMOVED*** = '            ),'.PHP_EOL;
        }
        return $arrayData;
    }

    public function getEntityFixture($iterator)
    {
        $entityArrayAsText = '';

        foreach ($this->tableData as $columnData) {

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData instanceof ForeignKey) {
                $columnConstraint = $this->table->getForeignKeyFromColumnObject($columnData->getColumn());
                if ($columnData->getColumn()->getTableName() === $columnConstraint->getReferencedTableName()) {
                    continue;
                }
           }

           $entityArrayAsText .= $columnData->getFixtureData($iterator);
        }

        return $entityArrayAsText;

    }

    public function instrospect()
    {
        $data = $this->getTableData();

        $this->columns = $this->getValidColumnsFromTable();

        $arrayData = $this->getArrayData();

        $fieldsData = $this->getFieldData();


        $schemaTool = $this->getSchemaToolService();

        return $this->createFileFromTemplate(
            'template/src/fixture/default.phtml',
            array(
                'fields'  => $fieldsData,
                'data'   => $arrayData,
                'name'   => $this->srcName,
                'module'  => $this->getConfig()->getModule(),
                'order' => $schemaTool->getOrderNumber($this->str('uline', $this->tableName))
            ),
            $this->srcName.'.php',
            $this->getModule()->getFixtureFolder()
        );
    }

    public function introspectFromTable($db)
    {
        $this->loadTable($db);
        $src = $this->getGearSchema()->getSrcByDb($db, 'Fixture');
        $this->srcName = $src->getName();
        return $this->instrospect();
    }
    /**
     *
     * @param \Gear\ValueObject\Src $src
     */
    public function create($src)
    {
        $this->loadTable($src);
        $this->srcName = $src->getName();
        return $this->instrospect();
    }

    /**
     * @param string $tableName
     * @param array $columns
     */
    public function getFieldData()
    {
        $fields = [***REMOVED***;
        foreach ($this->columns as $field) {

            $columnConstraint = $this->table->getForeignKeyFromColumnObject($field);
            if ($columnConstraint && $field->getTableName() === $columnConstraint->getReferencedTableName()) {
                continue;
            }
            if (in_array($field->getName(), $this->primaryKey)) {
                continue;
            }
            $fields[***REMOVED*** = sprintf('            $%s->set%s($fixture[\'%s\'***REMOVED***);', $this->str('var', $this->tableName), $this->str('class', $field->getName()), $this->str('var', $field->getName()));
        }
        return $fields;
    }

}
