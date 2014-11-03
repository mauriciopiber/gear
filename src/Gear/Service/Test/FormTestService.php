<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class FormTestService extends AbstractJsonService
{
    public function introspectFromTable($table)
    {
        $src = $this->getGearSchema()->getSrcByDb($table, 'Form');

        $this->createFileFromTemplate(
            'template/test/unit/form/full.form.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestFormFolder()
        );
    }
}
