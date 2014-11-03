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

class FormService extends AbstractJsonService
{
    public function getLocation()
    {
        return $this->getModule()->getSrcModuleFolder().'/Form';
    }

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractForm.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function getFormInputValues($table)
    {
        $columns = $table->getTableColumns();

        $primaryKey = $table->getPrimaryKeyColumnName();

        $inputs = [***REMOVED***;

        foreach ($columns as $i => $column) {

            switch ($column->getDataType()) {
            	case 'text':
            	    $dataType = 'textarea';
            	    break;
            	case 'varchar':
            	    $dataType = 'text';
            	    break;
            	case 'int':
            	    if ($primaryKey == $column->getName()) {
            	        $dataType = 'hidden';
            	    }
            	default:
            	    break;
            }

            if (!isset($dataType) || empty($dataType)) {
                throw new \Exception(sprintf('Column type not found for %s %s', $column->getName(), $column->getDataType()));
            }


            $inputs[***REMOVED*** = array(
            	'name' => $this->str('var', $column->getName()),
                'id' => $this->str('var', $column->getName()),
                'type' => $column->getDataType(),
                'label' => $this->str('label', $column->getName()),
            );
        }

        return $inputs;



    }

    public function introspectFromTable($table)
    {
        $this->getAbstract();

        $src = $this->getGearSchema()->getSrcByDb($table, 'Form');

        $inputValues = $this->getFormInputValues($table);


        $this->createFileFromTemplate(
            'template/src/form/full.form.phtml',
            array(
                'var' => $this->str('var', $src->getName()),
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule(),
                'elements' => $inputValues
            ),
            $src->getName().'.php',
            $this->getModule()->getFormFolder()
        );
    }

    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->createFileFromTemplate(
                'template/src/form/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractForm.php',
                $this->getModule()->getFormFolder()
            );
        }
    }

    public function create($src)
    {
        $this->getAbstract();

        $this->createFileFromTemplate(
            'template/test/unit/form/src.form.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestFormFolder()
        );

        $this->createFileFromTemplate(
            'template/src/form/src.form.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFormFolder()
        );
    }
}
