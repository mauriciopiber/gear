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

class FixtureService extends AbstractFixtureService
{

    use SchemaToolServiceTrait;


    protected $speciality;

    protected $tableName;

    protected $srcName;
    /**
     *
     * @param unknown $tableName
     */
    public function instrospect()
    {
        $useColumns = $this->getValidColumnsFromTable();

        $arrayData = $this->getArrayData($useColumns);

        $fieldsData = $this->getFieldData($this->tableName, $useColumns);


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

    public function calculateOrderFromDatabase()
    {

    }

    public function introspectFromTable($db)
    {
        $this->tableName   = $db->getTable();

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
        $this->tableName = $src->getDb();

        $useColumns = $this->getValidColumnsFromTable();

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
     * @param array $columns Colunas da Tabela que serão utilizadas na fixture.
     * @return array:string Valores que serão inseridos na fixture.
     */
    public function getArrayData(array $columns)
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $arrayData = [***REMOVED***;

        for ($iterator = 1; $iterator <= 30; $iterator++) {

            $arrayData[***REMOVED*** = '            array('.PHP_EOL;

            foreach ($columns as $column) {

                $columnConstraint = $table->getForeignKeyFromColumnObject($column);

                if (!$columnConstraint) {
                    $arrayData[***REMOVED*** = sprintf('                \'%s\' => \'%d%s\',', $this->str('var', $column->getName()), $iterator, $this->str('label', $column->getName())).PHP_EOL;
                } else {
                    $arrayData[***REMOVED*** = sprintf('                \'%s\' => $this->getReference(\'%s-%d\'),', $this->str('var', $column->getName()), $this->str('url', $columnConstraint->getReferencedTableName()), $iterator).PHP_EOL;
                }



            }

            $arrayData[***REMOVED*** = '            ),'.PHP_EOL;
        }

        return $arrayData;
    }
}
