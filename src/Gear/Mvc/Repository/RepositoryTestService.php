<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;
use GearJson\Db\Db;
use Gear\Mvc\Config\ServiceManagerTrait;

class RepositoryTestService extends AbstractMvcTest
{
    use ServiceManagerTrait;

    protected $tableName;
    protected $tableColumns;
    protected $table;


    public function createAbstract($className = null)
    {
        if (empty($className)) {
            $className = 'AbstractRepository';
        }

        return $this->getFileCreator()->createFile(
            'template/test/unit/repository/abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'className' => $className
            ),
            $className.'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

    public function createFromSrc(Src $src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null) {
            return $this->introspectFromTable($this->src->getDb());
        }

        $this->className = $this->src->getName();

        $this->dependency = $this->getSrcDependency()->setSrc($this->src);

        $this->functions  = $this->dependency->getTests();

        $location = $this->getCodeTest()->getLocation($this->src);


        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        $this->getFileCreator()->createFile(
            'template/module/mvc/repository/test-src.phtml',
            array(
                'callable' => $this->getServiceManager()->getServiceName($this->src),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'mock'       => $mock,
                'functions'  => $this->functions,
                'var'        => $this->str('var-lenght', $this->src->getName()),
                'className'  => $src->getName(),
                'module'     => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'Test.php',
            $location
        );
    }

    public function introspectFromTable(Db $table)
    {
        $this->loadTable($table);

        $this->getColumnService()->getColumns($table);

        $this->repository = true;

        $this->setBaseArray(array(
            'method' => $this->tableName, 'module' => $this->getModule()->getModuleName()
        ));

        $this->usePrimaryKey = true;

        $this->setUpOrder();
        $this->setUpOneBy();

        $this->getFileCreator()->createFile(
            'template/module/mvc/repository/db-test.phtml',
            array(
                'static'       => $this->getColumnService()->renderColumnPart('staticTest'),
                'insertArray'  => $this->getColumnService()->renderColumnPart('insertArray', true),
                'insertAssert' => $this->getColumnService()->renderColumnPart('insertAssert', true, true),
                'updateArray'  => $this->getColumnService()->renderColumnPart('updateArray', true),
                'updateAssert' => $this->getColumnService()->renderColumnPart('updateAssert', true, true),
                'fixtureSize'  => $this->getFixtureSizeByTableName(),
                'varLenght'    => $this->str('var-lenght', $this->tableName),
                'class'        => $this->tableName,
                'module'       => $this->getModule()->getModuleName(),
                'order'        => $this->order,
                'oneBy'        => $this->oneBy,
            ),
            $this->tableName.'RepositoryTest.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }


    public function setUpOrder()
    {
        $this->order = '';
        $orders = $this->getOrderByForUnitTest();

        $fixtureSize = $this->getFixtureSizeByTableName();

        foreach ($orders as $order) {
            $this->order .= <<<EOS

    public function testSelectAllOrderBy{$order['class'***REMOVED***}{$order['order'***REMOVED***}()
    {
        \$resultSet = \$this->get{$order['method'***REMOVED***}()->selectAll(
            array(),
            '{$order['var'***REMOVED***}',
            '{$order['order'***REMOVED***}'
        );
        \$this->assertTrue(is_array(\$resultSet));
        \$this->assertEquals({$fixtureSize}, count(\$resultSet));
        \$data = array_shift(\$resultSet);
        \$this->assertEquals(
            {$order['value'***REMOVED***},
            \$data['{$order['var'***REMOVED***}'***REMOVED***
        );
    }


EOS;
        }
    }

    public function setUpOneBy()
    {
        $this->oneBy = '';
        $oneBys = $this->getSelectOneByForUnitTest();

        foreach ($oneBys as $oneBy) {
            $this->oneBy .= <<<EOS

    public function testSelectOneBy{$oneBy['class'***REMOVED***}()
    {
        \$resultSet = \$this->get{$oneBy['method'***REMOVED***}()->selectOneBy(
            array(
                '{$oneBy['var'***REMOVED***}' =>
                    {$oneBy['value'***REMOVED***}
            )
        );
        \$this->assertInstanceOf('{$oneBy['module'***REMOVED***}\Entity\\{$oneBy['method'***REMOVED***}', \$resultSet);
        \$this->assertEquals(
            {$oneBy['value'***REMOVED***},
            \$resultSet->get{$oneBy['class'***REMOVED***}()
        );
    }


EOS;
        }
    }
}
