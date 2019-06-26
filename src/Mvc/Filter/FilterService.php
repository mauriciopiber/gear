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
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Schema\Src\SrcTypesInterface;
use Gear\Mvc\AbstractMvcInterface;

class FilterService extends AbstractMvc implements AbstractMvcInterface
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

    public function createFilter($data)
    {
        return parent::create($data, SrcTypesInterface::FILTER);
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
            0 => '\Zend\Db\Adapter\Adapter:ig_t',
            1 => ['aliase' => 'translator', 'class'=> '\Zend\Mvc\I18n\Translator', 'ig_t' => true***REMOVED***
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

        if ($this->getTableService()->hasUniqueConstraint($this->tableName)) {

            $options['header'***REMOVED*** = $this->getFileCreator()
                ->renderPartial(
                    'template/module/mvc/filter/db/full.filter.header.unique.phtml',
                    [
                        'class' => $this->str('class', $this->src->getName()),
                        'var'     => $this->str('var-length', 'id'.$this->tableName),
                    ***REMOVED***
                );
        } else {
            $options['header'***REMOVED*** = $this->getFileCreator()
                ->renderPartial(
                    'template/module/mvc/filter/db/full.filter.header.phtml',
                    [
                        'class' => $this->str('class', $this->src->getName()),
                        'var'     => $this->str('var-length', 'id'.$this->tableName),
                    ***REMOVED***
                );
        }

        $this->file = $this->getFileCreator();
        $this->file->setTemplate('template/module/mvc/filter/full.filter.phtml');
        $this->file->setFileName($this->src->getName().'.php');
        $this->file->setLocation($location);
        $this->file->setOptions($options);

        return $this->file->render();
    }

    public function createSrc()
    {
        $this->className = $this->src->getName();

        if ($this->src->getDb() !== null) {
            $this->db = $this->src->getDb();

            return $this->createDb();
        }

        if (empty($this->src->getExtends())) {
            $this->src->setExtends(static::$extends);
        }

        $location = $this->getCode()->getLocation($this->src);

        // $this->getTraitService()->createTrait($this->src);
        // $this->getInterfaceService()->createInterface($this->src, $location);

        // $this->getFilterTestService()->createFilterTest($this->src);

        // if ($this->src->isFactory()) {
        //     $this->getFactoryService()->createFactory($this->src, $location);
        // }

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
