<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Db\Db;
use GearJson\Src\Src;

class ServiceTestService extends AbstractMvcTest
{
    use ServiceManagerTrait;
    use SchemaServiceTrait;

    static protected $defaultNamespace = 'ServiceTest';

    static protected $defaultLocation = null;

    static protected $factories = 'factories';

    public function getFirstString()
    {
        $validColumn = null;

        foreach ($this->tableColumns as $a => $b) {
            if ($b->getDataType() == 'varchar') {
                $validColumn = $this->str('var', $b->getName());
                break;
            }
        }

        if ($validColumn === null) {
            $validColumn = 'id'.$this->str('class', $this->tableName);
        }

        return $validColumn;
    }

    public function introspectFromTable(Db $table)
    {
        $this->loadTable($table);

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
                'template' => 'template/test/unit/service/setmockauthadapter',
                'placeholder' => 'mockauthadapter',
                'config' => array('var' => substr($this->str('var', $this->src->getName()), 0, 18))
            ));

            $fileCreator->addChildView(array(
                'template' => 'template/test/unit/service/selectbyidnull',
                'placeholder' => 'selectbyidnull',
                'config' => array(
                    'var' => substr($this->str('var', $this->src->getName()), 0, 18),
                    'class' => $this->str('class', $this->src->getName())
                )
            ));
        }

        if ($this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\\Column\\Varchar\\UploadImage')) {

            $fileCreator->addChildView(array(
                'template' => 'template/table/upload-image/controller/mock-upload-image.phtml',
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
        //verificar se tem coluna de imagem.
        $this->dependency = $this->getSrcDependency()->setSrc($this->src);


        $options = array(
            'static' => $this->getColumnService()->renderColumnPart('staticTest'),
            'firstString' => $this->getFirstString(),
            'serviceNameUline' => substr($this->str('var', $this->src->getName()), 0, 18),
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

        $fileCreator->setView('template/module/mvc/service/db-test.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setLocation($this->getModule()->getTestServiceFolder());
        $fileCreator->setFileName($this->src->getName().'Test.php');

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


        $template = 'template/module/mvc/service/src-test.phtml';

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
