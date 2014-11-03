<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class ServiceTestService extends AbstractJsonService
{
    public function introspectFromTable($table)
    {
        $src = $this->getGearSchema()->getSrcByDb($table, 'Service');

        $this->createFileFromTemplate(
            'template/test/unit/service/full.service.phtml',
            array(
                'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 18),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule(),
                'injection' => $this->getClassService()->getTestInjections($src),
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestServiceFolder()
        );

    }
}
