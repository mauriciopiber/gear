<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;
use Gear\ValueObject\Src;
use Gear\ValueObject\Db;

class RepositoryTestService extends AbstractFixtureService
{
    protected $tableName;
    protected $tableColumns;
    protected $table;


    public function createAbstract($className = null)
    {
        if (empty($className)) {
            $className = 'AbstractRepository';
        }

        return $this->createFileFromTemplate(
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

        $this->dependency = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());

        $this->functions  = $this->dependency->getTests();


        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        $this->createFileFromTemplate(
            'template/test/unit/repository/src.repository.phtml',
            array(
                'mock'       => $mock,
                'functions'  => $this->functions,
                'var'        => $this->str('var-lenght', $this->src->getName()),
                'className'  => $src->getName(),
                'module'     => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

    public function introspectFromTable(Db $table)
    {
        $this->loadTable($table);


        $this->repository = true;

        $this->setBaseArray(array(
        	'method' => $this->tableName, 'module' => $this->getModule()->getModuleName()
        ));

        $this->usePrimaryKey = true;

        $entityValues = $this->getValuesForUnitTest();

        $this->setUpOrder();
        $this->setUpOneBy();

        $this->createFileFromTemplate(
            'template/test/unit/repository/full.repository.phtml',
            array(
                'static' => $this->static,
                'fixtureSize' => $this->getFixtureSizeByTableName(),
                'varLenght' => $this->str('var-lenght', $this->tableName),
                'serviceNameClass'   => $this->tableName,
                'module'  => $this->getModule()->getModuleName(),
                'order' => $this->order,
                'oneBy' => $this->oneBy,
                'insertArray' => $entityValues->getInsertArray(),
                'updateArray' => $entityValues->getUpdateArray(),
                'insertAssert' => $entityValues->getInsertAssert(),
                'updateAssert' => $entityValues->getUpdateAssert()
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
