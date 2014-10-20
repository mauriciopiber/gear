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
    protected $projectService;

    public function getProjectService()
    {
        if (!isset($this->projectService)) {
            $this->projectService = $this->getServiceLocator()->get('projectService');
        }
        return $this->projectService;
    }

    public function migrate($environment, $username, $password, $dbms, $dbname)
    {
        $this->getProjectService()->setEnvironment($environment);
        $this->getProjectService()->setUpLocal($username, $password);
        $this->getProjectService()->setUpGlobal($environment, $dbms, $dbname);
        $this->getProjectService()->setUpDatabase($dbname, $username, $password);
        return sprintf('Project is now running on %s'."\n", $environment);

    }

    public function setEnvironment($environment)
    {
        $this->getProjectService()->setUpEnvironment($environment);
        return sprintf('Project is now running on %s'."\n", $environment);
    }
}
