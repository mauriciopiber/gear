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
use Gear\Database\AutoincrementServiceTrait;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Table\UploadImageTrait;
use Gear\Column\Varchar\UploadImage as UploadImageColumn;

class FixtureService extends AbstractMvc
{
    const DEPENDENCY_SEPARATOR = ',';

    const INDENT_12 = '            ';

    protected $loadedFixtures;

    protected $event;

    use UploadImageTrait;

    use AutoincrementServiceTrait;

    use SchemaServiceTrait;

    use SchemaToolServiceTrait;

    use ConfigServiceTrait;

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
        $this->columnManager = $this->db->getColumnManager();
        $this->getConfigService()->introspectUploadImage($this->db);

        $this->load = '';
        $this->preLoad = '';

        /* Extends - Use and Extends */
        //$this->extends = '\Doctrine\Common\DataFixtures\AbstractFixture';

        /* Include - Use */
        $this->include = [***REMOVED***;
        //$this->include[***REMOVED*** = '\Doctrine\Common\Persistence\ObjectManager';

        /* Implements - Use, Implements */
        $this->implements = [***REMOVED***;
        $this->implements[***REMOVED*** = '\Doctrine\Common\DataFixtures\FixtureInterface';
        $this->implements[***REMOVED*** = '\Doctrine\Common\DataFixtures\DependentFixtureInterface';

        if (
            $this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
            || $this->columnManager->isAssociatedWith(UploadImageColumn::class)
        ) {
            $this->src->addDependency('\GearImage\Fixture');
        }

        $this->getColumnsSpecifications();

        $this->getTableSpecifications();

        $arrayData = $this->getArrayData();

        $fieldsData = $this->getFieldData();

        $dependency = $this->fixtureDependency($this->db);

        $this->file = $this->getFileCreator();
        $this->file->setTemplate('template/module/mvc/fixture/default.phtml');
        $this->file->setFileName($this->srcName.'.php');
        $this->file->setLocation($this->getModule()->getFixtureFolder());

        $this->src->addImplements($this->implements);

        $this->file->setOptions(
            array(
                'tableLabel'  => $this->str('label', $this->db->getTable()),
                'package'     => $this->getCode()->getClassDocsPackage($this->src),
                'var'         => $this->str('var-length', str_replace('Fixture', '', $this->srcName)),
                'load'        => $this->load,
                'preLoad'     => $this->preLoad,
                'getFixture'  => $this->getFixture,
                'fields'      => $fieldsData,
                'data'        => $arrayData,
                'name'        => $this->srcName,
                'module'      => $this->getModule()->getModuleName(),
                'use'         => $this->getCode()->getUse($this->src),
                'attribute'   => $this->getCode()->getUseAttribute($this->src),
                'implements'  => $this->getCode()->getImplements($this->src),
                'dependency'  => $dependency
            )
        );
        return $this->file->render();
    }

    public function quote($userName)
    {
        return '\''.$userName.'\'';
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
            $fixture = $this->quote($userName);
        } else {
            $fixture = PHP_EOL.self::INDENT_12.$this->quote($userName).self::DEPENDENCY_SEPARATOR.PHP_EOL;
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

            $fixture .= self::INDENT_12.$this->quote($name);

            if (isset($foreign[$i+1***REMOVED***)) {
                $fixture .= self::DEPENDENCY_SEPARATOR;
            }

            $fixture .= PHP_EOL;
        }

        if ($count > 0) {
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
        foreach ($this->columnManager->getColumns() as $column) {
            $field = $column->getColumn();

            if ($column instanceof ForeignKey) {
                $columnConstraint = $this->getTableService()->getConstraintForeignKeyFromColumn(
                    $this->tableName,
                    $field
                );
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
            $arrayData[***REMOVED*** = '            ['.PHP_EOL;
            $arrayData[***REMOVED*** = $this->getEntityFixture($iterator);
            $arrayData[***REMOVED*** = '            ***REMOVED***,'.PHP_EOL;
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

        $columns = $this->columnManager->getColumns();

        foreach ($columns as $columnData) {
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
        $this->getFixture = $this->columnManager->generateCode('getFixtureTop', true);
    }

    /**
     * DEVE ser associado na tabela de Upload Image
     *
     * @return boolean
     */
    public function getUploadImageTable()
    {
        $this->load .= $this->getUploadImage()->getFixtureLoad($this->tableName);
        $this->preLoad .= $this->getUploadImage()->getFixturePreLoad();

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
