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

    static public $extends = '\Zend\Form\Form';

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

        $data = $this->getColumnService()->getColumns($this->db);

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
        $this->tableName    = $this->str('class', $this->db->getTable());

        $this->getFormTestService()->introspectFromTable($this->db);

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Form');

        $inputValues = $this->getFormInputValues($this->db);

        $this->getFactoryService()->createFactory($this->src, $this->getModule()->getFormFolder());
        $this->getTraitService()->createTrait($this->src, $this->getModule()->getFormFolder());

        return $this->getFileCreator()->createFile(
            'template/module/mvc/form/full.form.phtml',
            array(
                'namespace' => $this->getCode()->getNamespace($this->src),
                'package' => $this->getCode()->getClassDocsPackage($this->src),
                'tableLabel' => $this->str('label', $this->db->getTable()),
                'var' => $this->str('var', $this->src->getName()),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'elements' => $inputValues
            ),
            $this->src->getName().'.php',
            $this->getModule()->getFormFolder()
        );
    }

    public function create($src)
    {
        if ($src->getDb() instanceof \GearJson\Db\Db) {
            return $this->introspectFromTable($src->getDb());
        }

        $this->src = $src;

        if (empty($this->src->getExtends())) {
            $this->src->setExtends(static::$extends);
        }

        $this->className = $this->src->getName();

        $location = $this->getCode()->getLocation($this->src);

        if ($this->src->getService() == 'factories') {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $this->getTraitService()->createTrait($this->src, $location);
        $this->getInterfaceService()->createInterface($this->src, $location);

        $this->getFormTestService()->createFromSrc($this->src);

        return $this->getFileCreator()->createFile(
            'template/module/mvc/form/src.phtml',
            array(
                'classDocs' => $this->getCode()->getClassDocs($this->src),
                'namespace' => $this->getCode()->getNamespace($this->src),
                'class'   => $this->className,
                'classUrl' => $this->str('url', $this->className),
                'extends'    => $this->getCode()->getExtends($this->src),
                'use'       => $this->getCode()->getUse($this->src),
                'attributes' => $this->getCode()->getUseAttribute($this->src),
                'module'  => $this->getModule()->getModuleName()
            ),
            $this->src->getName().'.php',
            $location
        );
    }
}
