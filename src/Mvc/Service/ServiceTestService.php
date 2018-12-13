<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\AbstractMvcTest;
use Gear\Schema\Db\Db;
use Gear\Schema\Src\Src;
use Gear\Mvc\Service\ServiceTestColumnInterface;
use Gear\Column\Varchar\UploadImage as UploadImageColumn;
use Gear\Table\UploadImage as UploadImageTable;
use Gear\Schema\Src\SrcTypesInterface;

class ServiceTestService extends AbstractMvcTest
{
    //use ServiceManagerTrait;

    const KEY_INSERT = 68;

    const KEY_UPDATE = 78;

    const COLUMN_SCHEMA = [
        'setUp' => [
            0 => [ServiceTestColumnInterface::SET_UP => true***REMOVED***
        ***REMOVED***,
        'create' => [
            0 => [ServiceTestColumnInterface::CREATE_MOCK => true***REMOVED***,
            1 => [ServiceTestColumnInterface::CREATE_DATA=> [***REMOVED******REMOVED***
        ***REMOVED***,
        'update' => [
            0 => [ServiceTestColumnInterface::UPDATE_MOCK => true***REMOVED***,
            1 => [ServiceTestColumnInterface::CREATE_DATA => [***REMOVED******REMOVED***
        ***REMOVED***
    ***REMOVED***;

    public function getFirstString()
    {
        return $this->str('var', $this->getTableService()->getReferencedTableValidColumnName($this->db->getTable()));
    }

    public function getUserType(Db $db)
    {
        $userType = $this->str('class', $db->getUser());
        $userClass = sprintf('\Gear\UserType\ServiceTest\%s', $userType);
        $user = new $userClass();
        return $user;
    }

    public function getUserTypeOptions()
    {
        $options = [***REMOVED***;

        $user = $this->getUserType($this->db);

        $partialOptions = [
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'class'  => $this->str('class', $this->db->getTable())
        ***REMOVED***;

        if (in_array($this->db->getUser(), ['strict', 'low-strict'***REMOVED***)) {
            $options['selectbyidnull'***REMOVED*** = $user->renderSelectByIdNull($partialOptions);
            $options['selectbyidinvalid'***REMOVED*** = $user->renderSelectByIdReturnInvalid($partialOptions);
            $options['selectviewbyid'***REMOVED*** = $user->renderSelectViewById($partialOptions);
            $options['selectall'***REMOVED*** = $user->renderSelectAll($partialOptions);
        }

        $options['selectbyid'***REMOVED*** = $user->renderSelectById($partialOptions);
        $options['delete'***REMOVED*** = $user->renderDelete($partialOptions);

        return $options;
    }

    public function createServiceTest($data)
    {
        return parent::createTest($data, SrcTypesInterface::SERVICE);
    }

    public function createDbTest()
    {
        $this->columnManager = $this->db->getColumnManager();
        $this->tableName    = $this->str('class', $this->db->getTable());

        $fileCreator = $this->getFileCreator();

        $options = [***REMOVED***;

        $userOptions = $this->getUserTypeOptions($this->db);

        $options = array_merge($options, $userOptions);

        //get dependencies.
        //get repository.
        $this->repository = $this->getSchemaService()->getSrcByDb($this->db, 'Repository');
        $repositoryName = $this->getServiceManager()->getServiceName($this->repository);

        /**
         * @TODO certeza que isso tá errado kkkkkkkk
         */
        if ($this->columnManager->isAssociatedWith(UploadImageColumn::class)) {
            $fileCreator->addChildView([
                'template' => 'template/module/table/upload-image/controller/mock-upload-image.phtml',
                'placeholder' => 'extraColumns',
                'config' => ['module' => $this->getModule()->getModuleName()***REMOVED***
            ***REMOVED***);
        }

        $optionsColumn = $this->columnManager->generateSchema(self::COLUMN_SCHEMA);

        $this->entity = $this->getSchemaService()->getSrcByDb($this->db, 'Entity');

        $options = array_merge($options, [
            'namespaceFile'    => $this->getCodeTest()->getNamespace($this->src),
            'namespace'        => $this->getCodeTest()->getTestNamespace($this->src),
            'repository'       => $this->getServiceManager()->getServiceName($this->repository),
            'entity'           => $this->getServiceManager()->getServiceName($this->entity),
            'firstString'      => $this->getFirstString(),
            'serviceNameClass' => $this->src->getName(),
            'class'            => $this->str('class', $this->src->getNameOff()),
            'classUrl'         => $this->str('url', $this->src->getNameOff()),
            'module'           => $this->getModule()->getModuleName(),
            'moduleUrl'        => $this->str('url', $this->getModule()->getModuleName()),
        ***REMOVED***);

        $options = array_merge($options, $optionsColumn);

        $construct = [
            'className'  => $this->src->getName(),
            'table'      => $this->db->getTable(),
            'service'    => $this->getServiceManager()->getServiceName($this->src),
            'repository' => $repositoryName,
            'setUp'      => $optionsColumn['setUp'***REMOVED***[0***REMOVED***,
        ***REMOVED***;

        $isTableImage = $this->getTableService()->verifyTableAssociation($this->db->getTable(), UploadImageTable::NAME);
        $isTableColumn = $this->columnManager->isAssociatedWith(UploadImageColumn::class);

        if ($isTableImage || $isTableColumn) {
            $this->src->addDependency('\GearImage\Service\ImageService');
        }

        $construct['dependency'***REMOVED*** = $this->getCodeTest()->getConstructorDependency($this->src);
        $construct['constructor'***REMOVED*** = $this->getCodeTest()->getConstructor($this->src);

        $options['constructor'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/service-test/db/constructor/'.$this->src->getService().'.phtml',
            $construct
        );

        $location = $this->getCodeTest()->getLocation($this->src);

        $fileCreator->setView('template/module/mvc/service-test/db/db-test.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setLocation($location);
        $fileCreator->setFileName($this->src->getName().'Test.php');

        $this->getTraitTestService()->createTraitTest($this->src);

        $this->getFactoryTestService()->createFactoryTest($this->src);

        return $fileCreator->render();
    }

    public function createSrcTest()
    {
        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->isFactory() && $this->src->isAbstract() === false) {
            $this->getFactoryTestService()->createFactoryTest($this->src);
        }

        if ($this->src->isAbstract() === false) {
            $this->getTraitTestService()->createTraitTest($this->src);
        }

        $options = [
            'callable'      => $this->getServiceManager()->getServiceName($this->src),
            //'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
            'namespace'     => $this->getCodeTest()->getTestNamespace($this->src),
            'fileNamespace' => $this->getCodeTest()->getFileNamespace($this->src),
            'var'           => $this->str('var-length', $this->src->getName()),
            'className'     => $this->src->getName(),
            'module'        => $this->getModule()->getModuleName()
        ***REMOVED***;

        if ($this->src->isFactory()) {
            $templateView = ($this->src->isAbstract()) ? 'abstract-factory' : 'factory';

            $options['dependency'***REMOVED*** = $this->getCodeTest()->getConstructorDependency($this->src);

            if ($this->src->isAbstract()) {
                $options['dependencyReveal'***REMOVED*** = $this->getCodeTest()->getDependencyReveal($this->src);
            } else {
                $options['constructor'***REMOVED*** = $this->getCodeTest()->getConstructor($this->src);
            }
        } else {
            //add abstract-factory
            $templateView = ($this->src->isAbstract()) ? 'abstract-invokable' : 'invokable';
        }

        $template = 'template/module/mvc/service-test/src/'.$templateView.'.phtml';

        $fileName = $this->src->getName().'Test.php';

        $this->srcFile = $this->getFileCreator();

        return $this->srcFile->createFile(
            $template,
            $options,
            $fileName,
            $location
        );
    }
}
