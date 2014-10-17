<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractJsonService;

class MigrateService extends AbstractJsonService
{

    public function getProjectService()
    {
        if (!isset($this->projectService)) {
            $this->projectService = $this->getServiceLocator()->get('projectService');
        }
        return $this->projectService;
    }

    public function migrate($dbname)
    {
        $this->projectService()->setUpEnviroment();
        //$this->projectService()->setUpGlobal();
        //$this->projectService()->setUpLocal();

        //$this->projectService()->setUpImport();

        return 'migrate'."\n";

    }
}
