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

class FilterService extends AbstractJsonService
{
    public function hasAbstract()
    {
        if (is_file($this->getModule()->getFilterFolder().'/AbstractFilter.php')) {
            return true;
        } else {
            return false;
        }
    }

   /*  public function getFilterInputValues($table)
    {
        $columns = $table->getTableColumns();

        $primaryKey = $table->getPrimaryKeyColumnName();

        $inputs = [***REMOVED***;
        foreach ($columns as $i => $column) {

            if ($column->getName() == $primaryKey) {
                continue;
            }

            $speciality = $this->getGearSchema()->getSpecialityByColumnName($column->getName(), $this->str('class', $column->getTableName()));

            if ($speciality == 'uploadimagem') {
                $inputs[***REMOVED*** = array(
                	'speciality' => 'uploadimagem',
                    'name' => $this->str('var', $column->getName()),
                    'label' => $this->str('label', $column->getName()),
                    'required' => ($column->isNullable() == false) ? 'true' : 'false'
                );
            } else {

                if ($column->getDataType() == 'varchar') {

                    $lenght = array(
                        'stringLenght' => true,
                        'stringLenghtMax' => $column->getCharacterMaximumLength(),
                    );

                } else {
                    $lenght = array('stringLenght' => false);
                }

                $inputs[***REMOVED*** = array_merge(
                    $lenght,
                    array(
                        'speciality' => false,
                        'name' => $this->str('var', $column->getName()),
                        'label' => $this->str('label', $column->getName()),
                        'required' => ($column->isNullable() == false) ? 'true' : 'false'
                    )
                );
            }
        }

        return $inputs;
    } */

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
        $this->getAbstract();

        $src = $this->getGearSchema()->getSrcByDb($table, 'Filter');

        $this->tableName = $table->getTable();


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
                'module'  => $this->getConfig()->getModule(),
            )
        );
        $fileCreate->setFileName($src->getName().'.php');
        $fileCreate->setLocation($this->getModule()->getFilterFolder());


        return $fileCreate->render();
    }

    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->createFileFromTemplate(
                'template/src/filter/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractFilter.php',
                $this->getModule()->getFilterFolder()
            );

            $this->createFileFromTemplate(
                'template/test/unit/filter/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractFilterTest.php',
                $this->getModule()->getTestFilterFolder()
            );
        }
    }

    public function create($src)
    {
        $this->getAbstract();

        $this->createFileFromTemplate(
            'template/test/unit/filter/src.filter.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestFilterFolder()
        );

        $this->createFileFromTemplate(
            'template/src/filter/src.filter.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFilterFolder()
        );
    }
}
