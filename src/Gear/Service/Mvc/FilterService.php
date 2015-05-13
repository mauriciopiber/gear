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
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Common\FilterTestServiceTrait;

class FilterService extends AbstractJsonService
{
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
        foreach ($data as $i => $columnData) {

            if ($columnData instanceof \Gear\Service\Column\Int\PrimaryKey) {
                continue;
            }

            if ($columnData instanceof \Gear\Service\Column\AbstractColumn) {
                $filters[***REMOVED*** = array('element' => $columnData->getFilterFormElement());
            }
        }
        return $filters;
    }

    public function introspectFromTable($table)
    {
        //$this->getAbstract();

        $this->db = $table;

        $src = $this->getGearSchema()->getSrcByDb($table, 'Filter');

        $this->tableName = $table->getTable();
        $this->tableObject = $table->getTableObject();


        $inputValues = $this->getFilterValues();

        $fileCreate = $this->getServiceLocator()->get('fileCreator');

        $fileCreate->addChildView(array(
        	'template' => 'template/src/filter/collection/element.phtml',
            'config' => array('elements' => $inputValues),
            'placeholder' => 'filterElements'
        ));

        $fileCreate->setTemplate('template/src/filter/full.filter.phtml');
        $fileCreate->setOptions(
            array(
                'class'   => $src->getName(),

                'module'  => $this->getModule()->getModuleName(),
            )
        );
        $fileCreate->setFileName($src->getName().'.php');
        $fileCreate->setLocation($this->getModule()->getFilterFolder());



        if ($this->hasUniqueConstraint()) {
            $fileCreate->addChildView(array(
                'template' => 'template/src/filter/full.filter.header.unique.phtml',
                'config' => array('class' => $this->str('class', $this->tableName)),
                'placeholder' => 'header'
            ));
        } else {
            $fileCreate->addChildView(array(
                'template' => 'template/src/filter/full.filter.header.phtml',
                'config' => array(),
                'placeholder' => 'header'
            ));
        }


        return $fileCreate->render();
    }


    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->createFileFromTemplate(
                'template/src/filter/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName()
                ),
                'AbstractFilter.php',
                $this->getModule()->getFilterFolder()
            );

            $this->createFileFromTemplate(
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
        $this->getFilterTestService()->create($src);
        $this->createFileFromTemplate(
            'template/src/filter/src.filter.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'.php',
            $this->getModule()->getFilterFolder()
        );
    }
}
