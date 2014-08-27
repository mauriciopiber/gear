<?php

namespace Gear\Model;
use Zend\Db\Adapter\Adapter;
use Gear\Model\MakeGear;
use Gear\Model\TestGear;
use Doctrine\ORM\Mapping\Entity;


/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class ProjectGear extends MakeGear
{

    public function isProject($post)
    {
        return true;

    }
    public function createModuleInProject($post) {

        if($this->isProject($post))
        {
            $module = new \Gear\Model\ModuleGear($post['project'***REMOVED***,$post['path'***REMOVED***);
            $module->createModule($post['module'***REMOVED***);
        }
        else
        {
        	return false;
        }
    }

    public function createModuleNewProject($post)
    {
        if($this->createProject($post))
        {
            $module = new \Gear\Model\ModuleGear($post['project'***REMOVED***,$post['path'***REMOVED***);
            $module->createModule($post['module'***REMOVED***);die('aki');
        }
    }

    public function executeShellScript()
    {
        $output = shell_exec('ls -lart');
        echo "<pre>$output</pre>";
    }

    public function create() {

        if(!$this->is_dir($this->getConfig()->getPath())) {
            return false;
        } elseif($this->is_dir($this->getConfig()->getPath().'/'.$this->getConfig()->getProject())) {
            return $this->getConfig()->getProject();
        } else {
            $path = $this->getConfig()->getPath().'/'.$this->getConfig()->getProject();
            $repository = \Gitonomy\Git\Admin::cloneTo($path,'https://github.com/mauriciopiber/gear-skeleton.git',false);
            chmod($path, 0777);
            return true;
        }
    }

}