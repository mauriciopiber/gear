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
namespace Gear\Mvc\Fixture;

use Gear\Service\AbstractFileCreator;
use Gear\Database\SchemaToolServiceTrait;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Int\ForeignKey;

class FixtureService extends AbstractFileCreator
{
    use SchemaToolServiceTrait;

    protected $speciality;

    protected $tableName;

    protected $srcName;

    protected $tableData;


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
            $fields[***REMOVED*** = sprintf('            $%s->set%s($fixture[\'%s\'***REMOVED***);', $this->str('var-lenght', $this->tableName), $this->str('class', $field->getName()), $this->str('var', $field->getName()));
        }
        return $fields;
    }

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

        foreach ($this->getTableData() as $columnData) {

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData instanceof ForeignKey) {

                /* if (
                $columnData->getColumn()->getName() == 'user'


                ) */


                $columnConstraint = $this->table->getForeignKeyFromColumnObject($columnData->getColumn());

                $columns = $columnConstraint->getReferencedColumns();

                if (
                    $columnData->getColumn()->getTableName() != $columnConstraint->getReferencedTableName()
                    && $columnConstraint->getReferencedTableName() == 'user'
                    && in_array('id_user', $columns)
                ) {
                    $entityArrayAsText .= $columnData->getFixtureUser($iterator);
                    continue;
                }

                if ($columnData->getColumn()->getTableName() === $columnConstraint->getReferencedTableName()) {
                    continue;
                }
           }

           $entityArrayAsText .= $columnData->getFixtureData($iterator);
        }

        return $entityArrayAsText;

    }



    public function getColumnsSpecifications()
    {


        $this->getFixture = '';
        $this->use = '';
        $this->attribute = '';
        foreach ($this->getTableData() as $columnData) {


            if (method_exists($columnData, 'getFixtureGetFixture') && !$this->isDuplicated($columnData, 'getFixtureGetFixture')) {
                $this->getFixture .= $columnData->getFixtureGetFixture();
            }

            if (method_exists($columnData, 'getFixtureUse') && !$this->isDuplicated($columnData, 'getFixtureUse')) {
                $this->use .= $columnData->getFixtureUse();
            }

            if (method_exists($columnData, 'getFixtureAttribute') && !$this->isDuplicated($columnData, 'getFixtureAttribute')) {
                $this->attribute .= $columnData->getFixtureAttribute();
            }
        }
    }

    public function getUserSpecifications()
    {
        $templateUser = !empty($this->db) ? $this->db->getUserClass() : null;

        $userClass = 'Gear\UserType\\'.$this->str('class', $templateUser);

        $userType = new $userClass();

        if (method_exists($userType, 'getFixtureUse')) {
            $this->use .= $userType->getFixtureUse();
        }

        if (method_exists($userType, 'getFixtureAttribute')) {
            $this->attribute .= $userType->getFixtureAttribute();
        }

        if (!$templateUser || $templateUser == 'all') {
            $userType = 'all';
        } else {
            $userType = 'strict';
        }

        $this->file->addChildView(
            array(
                'config' =>array(
                    'user-law' => !empty($this->db) ? $this->db->getUser() : 'all',
                ),
                'template' => sprintf('template/src/fixture/user-%s.phtml', $userType),
                'placeholder' => 'userlaw'
            )
        );
    }

    public function getUploadImageTable()
    {
        $uploadImage = new \Gear\Table\UploadImage();
        $uploadImage->setServiceLocator($this->getServiceLocator());
        $uploadImage->setModule($this->getModule());

        $this->load .= $uploadImage->getFixtureLoad($this->tableName);
        $this->preLoad .= $uploadImage->getFixturePreLoad();


        $this->use = $uploadImage->getFixtureUse();
        $lines = array_unique(explode('\n', $this->use));
        $this->use = implode('\n', $lines);

        $this->attribute = $uploadImage->getFixtureAttribute();
        $lines = array_unique(explode('\n', $this->attribute));
        $this->attribute = implode('\n', $lines);

        return true;
    }

    public function getTableSpecifications()
    {
        if (!$this->verifyUploadImageAssociation($this->tableName)) {
            return false;
        }
        $this->getUploadImageTable();
    }

    public function instrospect()
    {
        $this->columns = $this->getValidColumnsFromTable();

        $this->load = '';
        $this->preLoad = '';

        $arrayData = $this->getArrayData();

        $fieldsData = $this->getFieldData();

        $schemaTool = $this->getSchemaToolService();

        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->file->setView('template/src/fixture/default.phtml');
        $this->file->setFileName($this->srcName.'.php');
        $this->file->setLocation($this->getModule()->getFixtureFolder());

        $this->getColumnsSpecifications();
        $this->getUserSpecifications();
        $this->getTableSpecifications();

        //get dependency

        $this->file->setOptions(array(
            'var' => $this->str('var-lenght', str_replace('Fixture', '', $this->srcName)),
            'load'        => $this->load,
            'preLoad'       => $this->preLoad,
            'getFixture'   => $this->getFixture,
            'use'    => $this->use,
            'attribute' => $this->attribute,
            'fields'  => $fieldsData,
            'data'   => $arrayData,
            'name'   => $this->srcName,
            'module'  => $this->getModule()->getModuleName(),
            'order' => $schemaTool->getOrderNumber($this->str('uline', $this->tableName))
        ));
        return $this->file->render();
    }

    public function introspectFromTable($db)
    {
        $this->loadTable($db);
        $this->db = $db;
        $src = $this->getGearSchema()->getSrcByDb($db, 'Fixture');
        $this->srcName = $src->getName();
        return $this->instrospect();
    }
    /**
     *
     * @param \GearJson\Src\Src $src
     */
    public function create($src)
    {
        $this->loadTable($src);
        $this->srcName = $src->getName();
        return $this->instrospect();
    }

    public function getColumnDuplicated()
    {
        return $this->columnDuplicated;
    }

    public function setColumnDuplicated($columnDuplicated)
    {
        $this->columnDuplicated = $columnDuplicated;
        return $this;
    }

}
