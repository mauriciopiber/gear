<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractService;

class RepositoryTestService extends AbstractService
{
    public function introspectFromTable($table)
    {

        $class = $this->str('class', $table->getName());

        $this->createFileFromTemplate(
            'template/test/unit/repository/src.repository.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'Test.php',
            $this->getModule()->getTestRepositoryFolder()
        );

    }

}
