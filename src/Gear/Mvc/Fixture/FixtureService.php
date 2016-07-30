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
use GearJson\Db\Db;
use Zend\EventManager\EventManagerInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Gear\Mvc\Fixture\ColumnInterface\GetFixtureTopInterface;

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


    /**
     * Create Fixture from database introspection.
     *
     * @return string
     */
    public function instrospect()
    {
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
                'var'         => $this->str('var-lenght', str_replace('Fixture', '', $this->srcName)),
                'load'        => $this->load,
                'preLoad'     => $this->preLoad,
                'getFixture'  => $this->getFixture,
                'fields'      => $fieldsData,
                'data'        => $arrayData,
                'name'        => $this->srcName,
                'module'      => $this->getModule()->getModuleName(),
                'userlaw'     => $userLaw,
                'use'         => $this->getCode()->getUse($this->src, $this->include, $this->implements),
                'attribute'   => $this->getCode()->getUseAttribute($this->src, $this->include),
                'implements'  => $this->getCode()->getImplements($this->implements),
                'dependency'  => $dependency
            )
        );
        return $this->file->render();
    }

    /**
     * Cria as Dependências da Fixture, utilizada para ordem de carregar.
     *
     * @param Db $db
     */
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

    /**
     * Cria a Fixture para um GearJson\Db
     *
     * Utilizado por Gear\Constructor\Db creator
     *
     * @param unknown $db
     */
    public function introspectFromTable($db)
    {
        $this->db           = $db;
        $this->tableName    = $this->str('class', $this->db->getTable());

        $this->db = $db;
        $src = $this->getSchemaService()->getSrcByDb($db, 'Fixture');
        $this->src = $src;
        $this->srcName = $src->getName();
        return $this->instrospect();
    }

    /**
     * Create the setters field for all columns of table.
     */
    public function getFieldData()
    {
        $this->primaryKey   = $this->getTableService()->getPrimaryKeyColumns($this->db->getTable());

        $fields = [***REMOVED***;
        foreach ($this->getColumnService()->getColumns($this->db) as $column) {

            $field = $column->getColumn();

            if ($column instanceof ForeignKey) {
                $columnConstraint = $this->getTableService()->getConstraintForeignKeyFromColumn($this->tableName, $field);
                if ($columnConstraint && $field->getTableName() === $columnConstraint->getReferencedTableName()) {
                    continue;
                }
            }


            if (in_array($field->getName(), $this->primaryKey)) {
                continue;
            }
            $fields[***REMOVED*** = $column->getFixtureEntitySetters();
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

    /**
     * Generate the code for data who are put in entities on fixtures routine.
     *
     * @param unknown $iterator
     * @return string
     */
    public function getEntityFixture($iterator)
    {
        $entityArrayAsText = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData instanceof ForeignKey) {
                $columnConstraint = $this->getTableService()->getConstraintForeignKeyFromColumn(
                    $this->tableName,
                    $columnData->getColumn()
                );

                $columns = $columnConstraint->getReferencedColumns();

                if ($columnData->getColumn()->getTableName() != $columnConstraint->getReferencedTableName()
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
        $columnOnlyOnceTop = [***REMOVED***;

        $this->getFixture = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {

            $columnClass = get_class($columnData);

            if ($columnData instanceof GetFixtureTopInterface && !in_array($columnClass, $columnOnlyOnceTop)) {
                $columnOnlyOnceTop[***REMOVED*** = $columnClass;
                $this->getFixture .= $columnData->getFixtureTop();
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

    /**
     * DEVE ser associado na tabela de Upload Image
     *
     * @return boolean
     */
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
        if (!$this->getTableService()->verifyTableAssociation($this->tableName, 'upload_image')) {
            return false;
        }
        $this->getUploadImageTable();
    }

    /**
     *
     * @param \GearJson\Src\Src $src
     */
    public function create($src)
    {
        $this->db           = $src->getDb();
        $this->tableName    = $this->str('class', $this->db->getTable());
        $this->src = $src;
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

        foreach ($this->getLoadedFixtures() as $fixture) {
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
