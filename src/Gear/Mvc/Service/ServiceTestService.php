<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Db\Db;
use GearJson\Src\Src;
use Gear\Mvc\Service\ColumnInterface\ServiceSetUpInterface;

class ServiceTestService extends AbstractMvcTest
{
    //use ServiceManagerTrait;

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

        $onlyOneSetUp = [***REMOVED***;
        $this->setUp = '';
        $this->createMock = '';
        $this->createValues = '';
        $this->updateValues = '';
        $this->updateMock = '';

        foreach ($this->getColumnService()->getColumns($this->db) as $column) {
            if ($column instanceof \Gear\Mvc\Service\ColumnInterface\ServiceSetUpInterface
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

            if ($column instanceof \Gear\Mvc\Service\ColumnInterface\ServiceFixtureDataInterface) {
                $this->createValues .= $column->getServiceFixtureData();
                $this->updateValues .= $column->getServiceFixtureData();
            }
        }

        //verificar se tem coluna de imagem.
        $this->dependency = $this->getSrcDependency()->setSrc($this->src);

        $this->repository = $this->getSchemaService()->getSrcByDb($table, 'Repository');
        $this->entity = $this->getSchemaService()->getSrcByDb($table, 'Entity');

        $options = [
            'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace'     => $this->getCodeTest()->getTestNamespace($this->src),
            'repository' => $this->getServiceManager()->getServiceName($this->repository),
            'entity' => $this->getServiceManager()->getServiceName($this->entity),
            'createValues' => $this->createValues,
            'updateValues' => $this->updateValues,
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
        ***REMOVED***;

        $construct = [
            'className' => $this->src->getName(),
            'table' => $this->db->getTable(),
            'service' => $this->getServiceManager()->getServiceName($this->src),
            'repository' => $this->getServiceManager()->getServiceName($this->repository),
            'setUp' => $this->setUp,
        ***REMOVED***;


        if (
            $this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
            || $this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')
        ) {
            $dep = $this->src->getDependency();
            $dep[***REMOVED*** = '\GearImage\Service\ImageService';
            $this->src->setDependency($dep);
        }

        if ($this->src->getService() === 'factories') {

            $construct['dependency'***REMOVED*** = $this->getCodeTest()->getConstructorDependency($this->src);
            $construct['constructor'***REMOVED*** = $this->getCodeTest()->getConstructor($this->src);
        }

        $options['constructor'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/service-test/db/constructor/'.$this->src->getService().'.phtml',
            $construct
        );

        $location = $this->getCodeTest()->getLocation($this->src);



        $fileCreator->setView('template/module/mvc/service-test/db/db-test.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setLocation($location);
        $fileCreator->setFileName($this->src->getName().'Test.php');

        $this->getTraitTestService()->createTraitTest($this->src, $location);

        if ($this->src->getService() == 'factories') {
            $this->getFactoryTestService()->createFactoryTest($this->src, $location);
        }

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

        if ($src->getService() == static::$factories && $src->getAbstract() === false) {
            $this->getFactoryTestService()->createFactoryTest($src, $location);
        }

        if ($src->getAbstract() === false) {
            $this->getTraitTestService()->createTraitTest($src, $location);
        }



        $options = [
            'callable' => $this->getServiceManager()->getServiceName($this->src),
            'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
            'var' => $this->str('var-lenght', $this->src->getName()),
            'className'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName()
        ***REMOVED***;

        if ($this->src->getService() === 'factories') {

            $templateView = ($this->src->getAbstract() === true) ? 'abstract-factory' : 'factory';

            $options['dependency'***REMOVED*** = $this->getCodeTest()->getConstructorDependency($this->src);

            if ($this->src->getAbstract() === true) {
                $options['dependencyReveal'***REMOVED*** = $this->getCodeTest()->getDependencyReveal($this->src);
            } else {
                $options['constructor'***REMOVED*** = $this->getCodeTest()->getConstructor($this->src);
            }

        } else {
            //add abstract-factory
            $templateView = ($this->src->getAbstract() === true) ? 'abstract-invokable' : 'invokable';
        }


        $template = 'template/module/mvc/service-test/src/'.$templateView.'.phtml';

        $fileName = $this->src->getName().'Test.php';





        $this->srcFile = $this->getFileCreator();
        return $this->srcFile->createFile($template, $options, $fileName, $location);

        return true;
    }
}
