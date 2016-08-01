<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Db\Db;
use GearJson\Src\Src;
use Gear\Mvc\Service\ColumnInterface\ServiceSetUpInterface;

class ServiceTestService extends AbstractMvcTest
{
    use ServiceManagerTrait;

    const KEY_INSERT = 68;

    const KEY_UPDATE = 78;

    static protected $defaultNamespace = 'ServiceTest';

    static protected $defaultLocation = null;

    public function getFirstString()
    {
        return $this->str('var', $this->getTableService()->getReferencedTableValidColumnName($this->db->getTable()));
    }

    public function introspectFromTable(Db $table)
    {
        $this->db           = $table;
        $this->tableName    = $this->str('class', $this->db->getTable());

        $this->src = $this->getSchemaService()->getSrcByDb($table, 'Service');

        $this->setBaseArray(array(
            'method' => $this->tableName.'Service',
            'module' => $this->getModule()->getModuleName(),
            'entityName' => $this->tableName
        ));

        $this->usePrimaryKey = true;

        $fileCreator = $this->getFileCreator();

        if ($this->db->getUser() == 'strict' || $this->db->getUser() == 'low-strict') {
            $fileCreator->addChildView(array(
                'template' => 'template/module/test/unit/service/setmockauthadapter',
                'placeholder' => 'mockauthadapter',
                'config' => array('var' => substr($this->str('var', $this->src->getName()), 0, 18))
            ));

            $fileCreator->addChildView(array(
                'template' => 'template/module/test/unit/service/selectbyidnull',
                'placeholder' => 'selectbyidnull',
                'config' => array(
                    'var' => substr($this->str('var', $this->src->getName()), 0, 18),
                    'class' => $this->str('class', $this->src->getName())
                )
            ));
        }

        if ($this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\\Column\\Varchar\\UploadImage')) {
            $fileCreator->addChildView(array(
                'template' => 'template/module/table/upload-image/controller/mock-upload-image.phtml',
                'placeholder' => 'extraColumns',
                'config' => array('module' => $this->getModule()->getModuleName())
            ));
        }


        $selectOneBy = $this->getSelectOneByForUnitTest();

        $this->oneBy = '';
        foreach ($selectOneBy as $select) {
            $this->oneBy .= <<<EOS
    public function testSelectOneBy{$select['class'***REMOVED***}()
    {
        \$resultSet = \$this->get{$select['method'***REMOVED***}()->selectOneBy(
            array(
                '{$select['var'***REMOVED***}' =>
                    {$select['value'***REMOVED***}
            )
        );
        \$this->assertInstanceOf('{$select['module'***REMOVED***}\Entity\\{$select['entityName'***REMOVED***}', \$resultSet);
        \$this->assertEquals(
            {$select['value'***REMOVED***},
            \$resultSet->get{$select['class'***REMOVED***}()
        );
    }

EOS;
        }

        $onlyOneSetUp = [***REMOVED***;
        $this->setUp = '';
        $this->createMock = '';
        $this->updateMock = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $column) {

            if (
                $column instanceof \Gear\Mvc\Service\ColumnInterface\ServiceSetUpInterface
                && !in_array(get_class($column), $onlyOneSetUp)
            ) {
                $this->setUp .= $column->getServiceSetUp();
                $onlyOneSetUp[***REMOVED*** = get_class($column);
            }

            if ($column instanceof \Gear\Mvc\Service\ColumnInterface\ServiceCreateMock) {
                $this->createMock .= $column->getServiceCreateMock();
                //$onlyOneCreate[***REMOVED*** = get_class($column);
            }

            if ($column instanceof \Gear\Mvc\Service\ColumnInterface\ServiceUpdateMock) {
                $this->updateMock .= $column->getServiceUpdateMock();
                //$onlyOneUpdate[***REMOVED*** = get_class($column);
            }
        }

        //verificar se tem coluna de imagem.
        $this->dependency = $this->getSrcDependency()->setSrc($this->src);


        $options = array(
            'setUp' => $this->setUp,
            'updateMock' => $this->updateMock,
            'createMock' => $this->createMock,
            'static' => $this->getColumnService()->renderColumnPart('staticTest'),
            'firstString' => $this->getFirstString(),
            'uline' => substr($this->str('var', $this->src->getName()), 0, 18),
            'serviceNameVar' => substr($this->str('var', $this->src->getName()), 0, 18),
            'serviceNameClass'   => $this->src->getName(),
            'class' => $this->str('class', str_replace('Service', '', $this->src->getName())),
            'classUrl' => $this->str('url', str_replace('Service', '', $this->src->getName())),
            'module'  => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'injection' => $this->getCodeTest()->getDependencyTest($this->src),
            'oneBy' => $this->oneBy,
            'insertArray' => $this->getColumnService()->renderColumnPart('insertArray'),
            'insertAssert' => $this->getColumnService()->renderColumnPart('insertAssert', false, true),
            'updateArray'  => $this->getColumnService()->renderColumnPart('updateArray'),
            'updateAssert' => $this->getColumnService()->renderColumnPart('updateAssert', false, true),
        );

        $location = $this->getModule()->getTestServiceFolder();

        $fileCreator->setView('template/module/mvc/service/db/db-test.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setLocation($location);
        $fileCreator->setFileName($this->src->getName().'Test.php');

        $this->getTraitTestService()->createTraitTest($this->src, $location);

        return $fileCreator->render();
    }

    public function create(Src $src)
    {
        static::$defaultLocation = $this->getModule()->getTestServiceFolder();

        $this->src = $src;

        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->getDb() !== null) {
            return $this->introspectFromTable($this->src->getDb());
        }

        if ($src->getService() == static::$factories) {
            $this->getFactoryTestService()->createFactoryTest($src, $location);
        }

        $this->getTraitTestService()->createTraitTest($src, $location);


        $template = 'template/module/mvc/service/src/src-test.phtml';

        $fileName = $this->src->getName().'Test.php';

        $this->dependency = $this->getSrcDependency()->setSrc($this->src);


        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        $options = [
            'callable' => $this->getServiceManager()->getServiceName($this->src),
            'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
            'functions' => $this->dependency->getTests(),
            'var' => $this->str('var-lenght', $this->src->getName()),
            'mock' => $mock,
            'className'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName()
        ***REMOVED***;


        $this->srcFile = $this->getFileCreator();
        return $this->srcFile->createFile($template, $options, $fileName, $location);

        return true;
    }
}
