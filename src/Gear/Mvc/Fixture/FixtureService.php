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

use Gear\Mvc\AbstractMvc;
use Gear\Database\SchemaToolServiceTrait;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Int\ForeignKey;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Column\Exception\WrongFormat;
use GearJson\Db\Db;
use Zend\EventManager\EventManagerInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class FixtureService extends AbstractMvc
{

    protected $loadedFixtures;

    protected $event;

    use \Gear\Database\AutoincrementServiceTrait;

    use SchemaServiceTrait;

    use SchemaToolServiceTrait;

    protected $speciality;

    protected $tableName;

    protected $srcName;

    protected $tableData;


    public function instrospect()
    {
        $this->columns = $this->getValidColumnsFromTable();

        $this->load = '';
        $this->preLoad = '';

        /* Extends - Use and Extends */
        //$this->extends = '\Doctrine\Common\DataFixtures\AbstractFixture';

        /* Include - Use */
        $this->include = [***REMOVED***;
        //$this->include[***REMOVED*** = '\Doctrine\Common\Persistence\ObjectManager';

        /* Implements - Use, Implements */
        $this->implements = [***REMOVED***;
        $this->implements[***REMOVED*** = 'Doctrine\Common\DataFixtures\FixtureInterface';
        $this->implements[***REMOVED*** = 'Doctrine\Common\DataFixtures\DependentFixtureInterface';

        $this->getColumnsSpecifications();

        $this->getTableSpecifications();

        $this->getUserSpecifications();

        $arrayData = $this->getArrayData();

        $fieldsData = $this->getFieldData();

        $userLaw = $this->getUserSpecifications();


        $dependency = $this->fixtureDependency($this->db);

        $this->file = $this->getFileCreator();
        $this->file->setTemplate('template/module/mvc/fixture/default.phtml');
        $this->file->setFileName($this->srcName.'.php');
        $this->file->setLocation($this->getModule()->getFixtureFolder());

        $this->file->setOptions(
            array(
                'var' => $this->str('var-lenght', str_replace('Fixture', '', $this->srcName)),
                'load'        => $this->load,
                'preLoad'       => $this->preLoad,
                'getFixture'   => $this->getFixture,
                'fields'  => $fieldsData,
                'data'   => $arrayData,
                'name'   => $this->srcName,
                'module'  => $this->getModule()->getModuleName(),

                'userlaw' => $userLaw,
                'use' => $this->getCode()->getUse($this->src, $this->include, $this->implements),
                'attribute' => $this->getCode()->getUseAttribute($this->src, $this->include),
                'implements' => $this->getCode()->getImplements($this->implements),
                'dependency' => $dependency
                //'order' => $this->getSchemaToolService()->getOrderNumber($this->str('uline', $this->tableName))
            )
        );
        return $this->file->render();
    }

    public function fixtureDependency(Db $db)
    {
        $foreign = $this->getTableService()->getForeignKeys($db);



        $template = 'template/module/mvc/fixture/dependency.phtml';

        $userName = 'GearAdmin\\Fixture\\LoadUser';



        $count = count($foreign);

        if ($count == 0) {
            $fixture = '\''.$userName.'\'';
        } elseif ($count > 1) {
            $fixture = PHP_EOL.'        \''.$userName.'\','.PHP_EOL;
        } else {
            $fixture = '\''.$userName.'\','.PHP_EOL;
        }

        if ($count === 0) {
            return $this->getFileCreator()->renderPartial(
                $template,
                ['fixture' => $fixture***REMOVED***
            );
        }


        $namespace = $this->getModule()->getModuleName().'\\Fixture';


        foreach ($foreign as $i => $item) {

            $fixtureName = $this->str('class', $item->getReferencedTableName()).'Fixture';

            $name = $namespace.'\\'.$fixtureName;

            $fixture .= '            \''.$name.'\'';

            if (isset($foreign[$i+1***REMOVED***)) {
                $fixture .= ',';
            }

            $fixture .= PHP_EOL;
        }

        if ($count > 1) {
            $fixture .= '        ';

        }

        return $this->getFileCreator()->renderPartial(
            $template,
            ['fixture' => $fixture***REMOVED***
        );

    }



    public function introspectFromTable($db)
    {
        $this->loadTable($db);
        $this->db = $db;
        $src = $this->getSchemaService()->getSrcByDb($db, 'Fixture');
        $this->src = $src;
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
            $fields[***REMOVED*** = sprintf(
                '            $%s->set%s($fixture[\'%s\'***REMOVED***);',
                $this->str('var-lenght', $this->tableName),
                $this->str('class', $field->getName()),
                $this->str('var', $field->getName())
            );
        }
        return $fields;
    }

    /**
     * Adiciona 30 Fixtures na tabela.
     *
     * @param array $columns Colunas da Tabela que serão utilizadas na fixture.
     * @return array:string Valores que serão inseridos na fixture.
     */
    public function getArrayData($count = 30)
    {
        $arrayData = [***REMOVED***;
        for ($iterator = 1; $iterator <= $count; $iterator++) {
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

        foreach ($this->getTableData() as $columnData) {


            if (
                method_exists($columnData, 'getFixtureGetFixture')
                && !$this->getColumnService()->isDuplicated($columnData, 'getFixtureGetFixture')
            ) {
                $this->getFixture .= $columnData->getFixtureGetFixture();
            }

            if ($columnData instanceof \Gear\Column\ImplementsInterface) {

                $implements = $columnData->getImplements('Fixture');

                foreach ($implements as $name => $item) {

                    if (array_key_exists($name, $this->include)) {
                        continue;
                    }
                    $this->include[$name***REMOVED*** = $item;
                }

            }
        }
    }

    public function getUserSpecifications()
    {
        $templateUser = !empty($this->db) ? $this->db->getUserClass() : null;

        $userClass = 'Gear\UserType\\'.$this->str('class', $templateUser);

        $userType = new $userClass();


        if ($userType instanceof \Gear\Column\ImplementsInterface) {

            $this->implements[***REMOVED*** = $userType->getImplements('Fixture');
        }

        if (!$templateUser || $templateUser == 'all') {
            $userType = 'all';
        } else {
            $userType = 'strict';
        }

        return $this->getFileCreator()->renderPartial(
            sprintf('template/module/mvc/fixture/user-%s.phtml', $userType),
            array(
                'user-law' => !empty($this->db) ? $this->db->getUser() : 'all',
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

        if ($uploadImage instanceof \Gear\Column\ImplementsInterface) {

            $implements = $uploadImage->getImplements('Fixture');

            foreach ($implements as $name => $item) {

                if (array_key_exists($name, $this->include)) {
                    continue;
                }
                $this->include[$name***REMOVED*** = $item;
            }
        }

        return true;
    }

    public function getTableSpecifications()
    {
        if (!$this->getTableService()->verifyTableAssociation($this->tableName)) {
            return false;
        }
        $this->getUploadImageTable();
    }


    /**
     * @deprecated
     */
    public function getValidColumnsFromTable()
    {
        $metadata = $this->getMetadata();

        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        $primaryKeyColumn = $table->getPrimaryKeyColumns();

        unset($this->validColumns);

        foreach ($this->tableColumns as $column) {


            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {

                if (!$this->usePrimaryKey) {
                    continue;
                }
            }

            if (in_array($column->getName(), \GearJson\Db\Db::excludeList())) {
                continue;
            }

            $columnConstraint = $table->getForeignKeyFromColumn($column);


            $this->validColumns[***REMOVED***  = $column;
        }
        return $this->validColumns;
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

    public function getLoadedFixtures()
    {
        return $this->loadedFixtures;
    }

    public function setLoadedFixtures($loadedFixtures)
    {
        $this->loadedFixtures = $loadedFixtures;
        return $this;
    }

    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class()
        ));
        $this->event = $events;
        return $this;
    }

    public function getEventManager()
    {
        if (null === $this->event) {
            $this->setEventManager(new \Zend\EventManager\EventManager());
        }
        return $this->event;
    }


    public function importProject()
    {
        $reset = $this->getRequest()->getParam('reset-autoincrement');
        $append = $this->getRequest()->getParam('append');
        $this->getEventManager()->trigger('loadFixtures', $this);

        $loader = new Loader();

        foreach ($this->getLoadedFixtures() as $moduleName => $fixture) {
            $loader->loadFromDirectory(realpath($fixture));
        }


        if ($reset) {
            $this->getAutoincrementService()->autoincrementDatabase();
        }

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'), $purger);
        $executor->execute($loader->getFixtures(), $append);
    }


    public function importModule()
    {

        $module = $this->getRequest()->getParam('module');
        $append = $this->getRequest()->getParam('append');
        $reset = $this->getRequest()->getParam('reset-autoincrement');

        $this->getEventManager()->trigger('loadFixtures', $this);

        $loader = new Loader();

        foreach ($this->getLoadedFixtures() as $moduleName => $fixture) {

            if ($module == $moduleName) {
                $loader->loadFromDirectory(realpath($fixture));
            }
        }

        if ($reset) {
            $this->getAutoincrementService()->autoincrementDatabase();
        }

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'), $purger);
        $executor->execute($loader->getFixtures(), $append);
    }
}
