<?php
namespace Gear\Mvc\Filter;

use Gear\Mvc\AbstractMvcTest;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Varchar\UniqueId;
use Gear\Mvc\Config\ServiceManagerTrait;

class FilterTestService extends AbstractMvcTest
{
    use ServiceManagerTrait;

    public function create($src)
    {
        $this->src = $src;
        if ($this->src->getDb() !== null) {
            $this->db = $this->src->getDb();
            return $this->createDb();
        }

        $location = $this->getCodeTest()->getLocation($src);

        if ($this->src->getAbstract() !== true) {

            $this->getTraitTestService()->createTraitTest($src, $location);

            if ($this->src->getService() == 'factories') {
                $this->getFactoryTestService()->createFactoryTest($src, $location);
            }
        }


        return $this->getFileCreator()->createFile(
            'template/module/mvc/filter-test/src/test-src.phtml',
            array(
                'callable' => $this->getServiceManager()->getServiceName($this->src),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
            ),
            $this->src->getName().'Test.php',
            $location
        );
    }

    public function introspectFromTable($db)
    {
        $this->db = $db;
        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Filter');
        return $this->createDb();
    }

    public function getTestRequiredColumns()
    {
        //test fail without fixture

        //show validation message

        $filterMessage = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof UniqueId) {
                continue;
            }

            if ($columnData->getColumn()->isNullable() == false) {
                if ($columnData instanceof PrimaryKey) {
                    continue;
                }

                if ($columnData instanceof \Gear\Column\Varchar\UploadImage) {
                    continue;
                }

                $var = $this->str('var', $columnData->getColumn()->getName());

                $filterMessage .= $this->getFileCreator()->renderPartial(
                    'template/module/mvc/filter/db/test-required-column.phtml',
                    ['var' => $var***REMOVED***
                );
            }
        }

        $this->functions .= $this->getFileCreator()->renderPartial(
            'template/module/mvc/filter/db/test-required.phtml',
            [
                'messages' => $filterMessage,
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->class,
                'var' => $this->var,
            ***REMOVED***
        );

        //test pass with fixture
    }

    public function getTestRequired()
    {
        $this->required = false;

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData->getColumn()->isNullable() == false) {
                $this->required = true;
                $this->getTestRequiredColumns();
                break;
            }
            continue;
        }


       /*  if ($required === false) {
            $this->getTestNoRequired();
        } */
    }

    /*
    public function getTestColumns()
    {
        $this->customFilterTest = false;

        if (empty($this->getColumnService()->getColumns($this->db))) {
            return null;
        }

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if (method_exists($columnData, 'getFilterTest')) {
                $this->customFilterTest = true;
                $this->functions .= $columnData->getFilterTest();
            }
        }
    }
    */

    public function getTestNoRequired($db)
    {

        if (!$this->getTableService()->isNullable($db->getTable())) {
            return;
        }


        $this->functions .= $this->getFileCreator()->renderPartial(
            'template/module/mvc/filter/db/test-no-required.phtml',
            [
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->class,
                'var' => $this->var,
            ***REMOVED***
        );
    }

    /**
     * Cria colunas para testar o filtro Ok. O filtro funcionando.
     */
    public function getTestValidReturnTrue()
    {
        $fixture = '';
        $columns = '';

        $onlyOneFunction = [***REMOVED***;

        $columnsDb = $this->getColumnService()->getColumns($this->db);

        if (count($columnsDb)>0) {
            foreach ($columnsDb as $column) {
                if ($column instanceof Gear\Column\Int\PrimaryKey
                    || $column instanceof Gear\Column\Varchar\UniqueId
                ) {
                    continue;
                }

                if ($column instanceof \Gear\Mvc\Filter\ColumnInterface\FilterValidPostInterface) {
                    $columns .= $column->getFilterValidPost();
                }

                if ($column instanceof \Gear\Mvc\Filter\ColumnInterface\FilterFunctionInterface
                    && !in_array(get_class($column), $onlyOneFunction)
                ) {
                    $this->functions .= $column->getFilterFunction();
                    $onlyOneFunction[***REMOVED*** = get_class($column);
                }


                $fixture .= $column->getFilterData(99);
            }
        }

        $this->functions .= $this->getFileCreator()->renderPartial(
            'template/module/mvc/filter/db/test-valid-post.phtml',
            [
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->class,
                'var' => $this->var,
                'fixture' => $fixture,
                'columns' => $columns
            ***REMOVED***
        );
    }

    public function createDb()
    {

        $this->tableName = $this->db->getTable();
        $this->class     = $this->str('class', $this->src->getName());
        $this->var       = $this->str('var-lenght', $this->src->getName());

        $this->functions = '';

        //validate-max
        //validate-min
        //validate-unique
        //validate-format

        //validate-null
        $this->getTestRequired();
        //sucesso
        $this->getTestValidReturnTrue();

        $module = $this->getModule()->getModuleName();

        //criar teste com fixture correta, passando válido.

        return $this->getFileCreator()->createFile(
            'template/module/mvc/filter/db/test.phtml',
            array(
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'functions' => $this->functions
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestFilterFolder()
        );
    }
}
