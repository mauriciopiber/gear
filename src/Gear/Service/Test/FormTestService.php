<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class FormTestService extends AbstractJsonService
{
    public function introspectFromTable($table)
    {
        $src = $this->getGearSchema()->getSrcByDb($table, 'Form');

        $factoryCallable = str_replace('Form', 'Factory', $src->getName());

        $this->createFileFromTemplate(
            'template/test/unit/form/full.form.phtml',
            array(
                'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 17),
                'callable' => $factoryCallable,
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestFormFolder()
        );
    }
}
