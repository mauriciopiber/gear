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
                'module' => $this->getConfig()->getModule(),
                'className' => $className
            ),
            $className.'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

    public function createFromSrc(Src $src)
    {
        $this->className = $src->getName();
        $classNameWithType = ($this->endsWith($this->className, 'Repository')) ? $this->className : $this->className.'Repository';

        $this->createFileFromTemplate(
            'template/test/unit/repository/src.repository.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $classNameWithType,
                'className' => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );
    }

    public function introspectFromTable(Db $table)
    {
        $this->loadTable($table);


        $this->repository = true;

        $this->setBaseArray(array(
        	'method' => $this->tableName, 'module' => $this->getConfig()->getModule()
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
                'module'  => $this->getConfig()->getModule(),
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
