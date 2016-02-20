<?php
namespace Gear\Mvc\Form;

use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;

class FormTestService extends AbstractJsonService
{
    use ServiceManagerTrait;
    use SchemaServiceTrait;

    public function introspectFromTable($table)
    {
        $src = $this->getSchemaService()->getSrcByDb($table, 'Form');

        $template = 'template/module/mvc/form/test-db.phtml';

        //$template = 'template/test/unit/form/full.form.phtml';

        $options = array(
            'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 17),
            'callable' => $this->getServiceManager()->getServiceName($src),
            'service' => $this->getServiceManager()->getServiceName($src),
            'serviceNameClass'   => $src->getName(),
            'module'  => $this->getModule()->getModuleName()
        );

        $filename = $src->getName().'Test.php';
        $location = $this->getModule()->getTestFormFolder();


        $file = $this->getFileCreator();
        return $file->createFile($template, $options, $filename, $location);
    }
}
