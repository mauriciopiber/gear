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
    use SchemaServiceTrait;

    use FilterTestServiceTrait;

    public function hasAbstract()
    {
        if (is_file($this->getModule()->getFilterFolder().'/AbstractFilter.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function getFilterValues()
    {
        $data = $this->getTableData();

        $filters = [***REMOVED***;
        foreach ($data as $columnData) {
            if (
                $columnData instanceof \Gear\Column\Int\PrimaryKey
                || $columnData instanceof \Gear\Column\Varchar\UniqueId
            ) {
                continue;
            }

            if ($columnData instanceof \Gear\Column\AbstractColumn) {
                $filters[***REMOVED*** = array('element' => $columnData->getFilterFormElement());
            }
        }
        return $filters;
    }

    public function introspectFromTable($table)
    {
        //$this->getAbstract();

        $this->db = $table;

        $this->src = $this->getSchemaService()->getSrcByDb($table, 'Filter');

        $this->createDb();
    }

    public function createDb()
    {
        $this->tableName   = $this->db->getTable();
        $this->tableObject = $this->db->getTableObject();


        $inputValues = $this->getFilterValues();


        $fileCreate = $this->getFileCreator();

        $fileCreate->addChildView(array(
            'template' => 'template/src/filter/collection/element.phtml',
            'config' => array('elements' => $inputValues),
            'placeholder' => 'filterElements'
        ));

        $fileCreate->setTemplate('template/src/filter/full.filter.phtml');
        $fileCreate->setOptions(
            array(
                'var'     => $this->str('var-lenght', 'id'.$this->src->getName()),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
            )
        );
        $fileCreate->setFileName($this->src->getName().'.php');
        $fileCreate->setLocation($this->getModule()->getFilterFolder());

        if ($this->getTableService()->hasUniqueConstraint($this->tableName)) {
            $fileCreate->addChildView(array(
                'template' => 'template/src/filter/full.filter.header.unique.phtml',
                'config' => array(
                    'class' => $this->str('class', $this->tableName),
                    'var'     => $this->str('var-lenght', 'id'.$this->tableName),
                ),
                'placeholder' => 'header'
            ));
        } else {
            $fileCreate->addChildView(array(
                'template' => 'template/src/filter/full.filter.header.phtml',
                'config' => array(),
                'placeholder' => 'header'
            ));
        }

        $this->getFilterTestService()->introspectFromTable($this->db);


        return $fileCreate->render();
    }


    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->getFileCreator()->createFile(
                'template/src/filter/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName()
                ),
                'AbstractFilter.php',
                $this->getModule()->getFilterFolder()
            );

            $this->getFileCreator()->createFile(
                'template/test/unit/filter/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName()
                ),
                'AbstractFilterTest.php',
                $this->getModule()->getTestFilterFolder()
            );
        }
    }

    public function create($src)
    {
        $this->src = $src;
        $this->className = $this->src->getName();

        if ($this->src->getDb() !== null) {
            $this->db = $this->src->getDb();

            return $this->createDb();
        }

        $location = $this->getCode()->getLocation($this->src);

        $this->getTraitService()->createTrait($this->src, $location);
        $this->getInterfaceService()->createInterface($this->src, $location);

        $this->getFilterTestService()->create($this->src);

        if ($this->src->getService() == 'factories') {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $this->getFileCreator()->createFile(
            'template/module/mvc/filter/src.phtml',
            array(
                'namespace' => $this->getCode()->getNamespace($this->src),
                'extends'    => $this->getCode()->getExtends($this->src),
                'uses'       => $this->getCode()->getUse($this->src),
                'attributes' => $this->getCode()->getUseAttribute($this->src),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'.php',
            $location
        );
    }
}
