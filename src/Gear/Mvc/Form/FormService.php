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
namespace Gear\Mvc\Form;

use Gear\Mvc\AbstractMvc;
use GearJson\Schema\SchemaServiceTrait;

class FormService extends AbstractMvc
{
    static protected $defaultNamespace = 'Form';

    static protected $defaultFolder = null;

    use SchemaServiceTrait;

    public function hasAbstract()
    {
        if (is_file($this->getModule()->getFormFolder().'/AbstractForm.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function getSpecialityService()
    {
        if (!isset($this->specialityService)) {
            $this->specialityService = $this->getServiceLocator()->get('specialityService');
        }
        return $this->specialityService;
    }

    public function getFormInputValues($table)
    {
        $inputs = [***REMOVED***;

        $data = $this->getTableData();

        foreach ($data as $i => $columnData) {

            if ($columnData instanceof \Gear\Column\Varchar\UniqueId) {
                continue;
            }

            $inputs[***REMOVED*** = $columnData->getFormElement();
        }

        return $inputs;
    }


    public function introspectFromTable($db)
    {
        $this->db = $db;



        $this->loadTable($this->db);
        $columns = $this->db->getTableColumns();


        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Form');

        $inputValues = $this->getFormInputValues($this->db);

        $this->createFileFromTemplate(
            'template/src/form/full.form.phtml',
            array(
                'var' => $this->str('var', $this->src->getName()),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'elements' => $inputValues
            ),
            $this->src->getName().'.php',
            $this->getModule()->getFormFolder()
        );

        $this->getFactoryService()->createFactory($this->src, $this->getModule()->getFormFolder());
        $this->getTraitService()->createTrait($this->src, $this->getModule()->getFormFolder());
    }

    public function create($src)
    {
        $this->src = $src;
        $this->className = $this->src->getName();

        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        $this->createFileFromTemplate(
            'template/test/unit/form/src.form.phtml',
            array(
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'mock' => $mock
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestFormFolder()
        );

        $this->getTraitService()->createTrait($this->src, $this->getModule()->getFormFolder());
        $this->getInterfaceService()->createInterface($this->src,  $this->getModule()->getFormFolder());

        $this->createFileFromTemplate(
            'template/src/form/src.form.phtml',
            array(
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'.php',
            $this->getModule()->getFormFolder()
        );
    }
}
