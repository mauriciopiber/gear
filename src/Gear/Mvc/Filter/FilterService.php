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
namespace Gear\Mvc\Filter;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\Filter\FilterTestServiceTrait;
use GearJson\Schema\SchemaServiceTrait;

class FilterService extends AbstractMvc
{
    public static $extends = '\Zend\InputFilter\InputFilter';

    use SchemaServiceTrait;

    use FilterTestServiceTrait;

    /*
    public function getFilterValues()
    {
        $data = $this->getColumnService()->getColumns($this->db);

        $filters = [***REMOVED***;
        foreach ($data as $columnData) {
            if ($columnData instanceof \Gear\Column\Integer\PrimaryKey
                || $columnData instanceof \Gear\Column\Varchar\UniqueId
            ) {
                continue;
            }

            if ($columnData instanceof \Gear\Column\AbstractColumn) {
                $filters[***REMOVED*** = ['element' => $columnData->getFilterFormElement()***REMOVED***;
            }
        }
        return $filters;
    }
    */

    public function introspectFromTable($table)
    {
        //$this->getAbstract();

        $this->db = $table;

        $this->src = $this->getSchemaService()->getSrcByDb($table, 'Filter');

        return $this->createDb();
    }

    public function createDb()
    {
        $this->tableName   = $this->db->getTable();
        $this->columnManager = $this->db->getColumnManager();
        $this->tableObject = $this->db->getTableObject();

        $location = $this->getCode()->getLocation($this->src);

        $this->file = $this->getFileCreator();

        $options = [
            'package' => $this->getCode()->getClassDocsPackage($this->src),
            'tableLabel' => $this->str('label', $this->db->getTable()),
            'var'     => $this->str('var-length', 'id'.$this->src->getName()),
            'class'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName(),
            'namespace' => $this->getCode()->getNamespace($this->src)
        ***REMOVED***;


        $this->src->setDependency([
            '\Zend\Db\Adapter\Adapter',
            'translator' => '\Zend\Mvc\I18n\Translator'
        ***REMOVED***);

        $options['constructor'***REMOVED*** =  $this->getCode()->getConstructor($this->src);

        $options['use'***REMOVED*** = $this->getCode()->getUseConstructor($this->src, [
              '\Zend\Db\Adapter\Adapter',
              '\Zend\Mvc\I18n\Translator'
          ***REMOVED***);

        $options['filterElements'***REMOVED*** = $this->columnManager->generateCode('getFilterFormElement', [***REMOVED***, [
            \Gear\Column\Integer\PrimaryKey::class,
            \Gear\Column\Varchar\UniqueId::class
        ***REMOVED***);

        /*
        $inputValues = $this->getFilterValues();

        $this->file->addChildView([
            'template' => 'template/module/mvc/filter/collection/element.phtml',
            'config' => ['elements' => $inputValues***REMOVED***,
            'placeholder' => 'filterElements'
        ***REMOVED***);
        */


        $this->file->setTemplate('template/module/mvc/filter/full.filter.phtml');

        $this->file->setOptions($options);

        $this->file->setFileName($this->src->getName().'.php');
        $this->file->setLocation($location);

        if ($this->getTableService()->hasUniqueConstraint($this->tableName)) {
            $this->file->addChildView([
                'template' => 'template/module/mvc/filter/db/full.filter.header.unique.phtml',
                'config' => [
                    'class' => $this->str('class', $this->src->getName()),
                    'var'     => $this->str('var-length', 'id'.$this->tableName),
                ***REMOVED***,
                'placeholder' => 'header'
            ***REMOVED***);
        } else {
            $this->file->addChildView([
                'template' => 'template/module/mvc/filter/db/full.filter.header.phtml',
                'config' => [
                    'class' => $this->str('class', $this->src->getName()),
                    'var'     => $this->str('var-length', 'id'.$this->tableName),
                ***REMOVED***,
                'placeholder' => 'header'
            ***REMOVED***);
        }

        $this->getFilterTestService()->introspectFromTable($this->db);

        $this->getFactoryService()->createFactory($this->src);

        return $this->file->render();
    }

    public function create($src)
    {
        $this->src = $src;
        $this->className = $this->src->getName();

        if ($this->src->getDb() !== null) {
            $this->db = $this->src->getDb();

            return $this->createDb();
        }

        if (empty($this->src->getExtends())) {
            $this->src->setExtends(static::$extends);
        }

        $location = $this->getCode()->getLocation($this->src);

        $this->getTraitService()->createTrait($this->src);
        $this->getInterfaceService()->createInterface($this->src, $location);

        $this->getFilterTestService()->create($this->src);

        if ($this->src->isFactory()) {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $options = [
            'classDocs' => $this->getCode()->getClassDocs($this->src),
            'namespace' => $this->getCode()->getNamespace($this->src),
            'extends'    => $this->getCode()->getExtends($this->src),
            'use'       => $this->getCode()->getUse($this->src),
            //'attributes' => $this->getCode()->getUseAttribute($this->src),
            'class'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName()
        ***REMOVED***;

        $options['constructor'***REMOVED*** = ($this->src->isFactory())
          ? $this->getCode()->getConstructor($this->src)
          : '';

        return $this->getFileCreator()->createFile(
            'template/module/mvc/filter/src.phtml',
            $options,
            $this->src->getName().'.php',
            $location
        );
    }
}
