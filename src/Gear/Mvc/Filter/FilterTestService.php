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
        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        $location = $this->getCodeTest()->getLocation($src);

        return $this->getFileCreator()->createFile(
            'template/module/mvc/filter/test-src.phtml',
            array(
                'callable' => $this->getServiceManager()->getServiceName($this->src),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'mock'  => $mock
            ),
            $this->src->getName().'Test.php',
            $location
        );
    }

    public function introspectFromTable($db)
    {

        $this->db = $db;
        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Filter');
        $this->createDb();
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

        foreach ($this->getTableData() as $columnData) {
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

    public function getTestColumns()
    {
        $this->customFilterTest = false;

        if (empty($this->getTableData())) {
            return null;
        }

        foreach ($this->getTableData() as $columnData) {
            if (method_exists($columnData, 'getFilterTest')) {
                $this->customFilterTest = true;
                $this->functions .= $columnData->getFilterTest();
            }
        }
    }

    public function getTestNoRequired($db)
    {

        if (!$this->isNullable($db)) {
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

    public function getTestValidReturnTrue()
    {
        $fixture = $this->getColumnService()->renderColumnPart('insertArray');

        //$fixture = implode('        ', $insertArray);

        $columns = '';

        $columnsDb = $this->getColumnService()->getColumns($this->db);

        if (count($columnsDb)>0) {
            foreach ($columnsDb as $column) {
                if ($column instanceof \Gear\Column\Varchar\UploadImage) {
                    $columns .= $this->getFileCreator()->renderPartial(
                        'template/module/column/varchar/upload-image/set-auto-prepend-upload-validator.phtml',
                        ['name' => $this->str('var', $column->getColumn()->getName())***REMOVED***
                    );
                }
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

        $this->getTestRequired();
        $this->getTestColumns();
        //$this->getTestNoRequired($this->db);
        $this->getTestValidReturnTrue();

        $module = $this->getModule()->getModuleName();
        //caso tenha algum campo obrigatório, criar teste com validação negativa.
        //validar mensagens.

        if ($this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\\Column\\Varchar\\UploadImage')) {
            $this->functions .= $this->getFileCreator()->renderPartial(
                'template/table/upload-image/filter/mock-upload-image.phtml',
                [
                    'module' => $module
                ***REMOVED***
            );
        }

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
