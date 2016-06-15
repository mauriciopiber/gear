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
use Gear\Mvc\Form\FormTestServiceTrait;

class FormService extends AbstractMvc
{
    static protected $defaultNamespace = 'Form';

    static protected $defaultFolder = null;

    use FormTestServiceTrait;

    use SchemaServiceTrait;

    public function hasAbstract()
    {
        if (is_file($this->getModule()->getFormFolder().'/AbstractForm.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function getFormInputValues()
    {
        $inputs = [***REMOVED***;

        $data = $this->getTableData();

        foreach ($data as $columnData) {
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

        $this->getFormTestService()->introspectFromTable($this->db);

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Form');

        $inputValues = $this->getFormInputValues($this->db);

        $this->getFileCreator()->createFile(
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

        $location = $this->getCode()->getLocation($this->src);

        if ($this->src->getService() == 'factories') {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $this->getTraitService()->createTrait($this->src, $location);
        $this->getInterfaceService()->createInterface($this->src, $location);

        $this->getFormTestService()->createFromSrc($this->src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/form/src.phtml',
            array(
                'namespace' => $this->getCode()->getNamespace($this->src),
                'class'   => $this->className,
                'extends'    => $this->getCode()->getExtends($this->src),
                'uses'       => $this->getCode()->getUse($this->src),
                'attributes' => $this->getCode()->getUseAttribute($this->src),
                'module'  => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'.php',
            $location
        );
    }
}
