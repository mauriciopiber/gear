<?php
namespace Gear\ContinuousIntegration;

use Gear\Service\AbstractJsonService;
use GearBase\Module;

class Jenkins extends AbstractJsonService
{

    protected $job;

    public function getJobConfig()
    {
        $configFile = file_get_contents('http://modules.gear.dev:8080/job/gear-teste/config.xml');
        return $configFile;
    }

    /**
     *  $search =  Module::getProjectFolder().'/module/Teste';
        $replace = Module::getProjectFolder().'/module/'.$this->getRequest()->getParam('module');


        if (strpos($configFile, Module::getProjectFolder().'/module/Teste') == false) {
            throw new \Exception('Config file is not valid for replace');
        }


        $config = str_replace($search, $replace, $configFile);
        var_dump($configFile);

        die();
     */

    public function createItem()
    {
        $url = <<<EOS
curl -X POST -H "Content-Type:application/xml" -d @{$this->job->getFile()} "http://modules.gear.dev:8080/createItem?name={$this->job->getName()}"
EOS;

        exec($url);

        unlink($this->job->getFile());
    }

    public function deleteItem($name)
    {
        $url = <<<EOS
curl -X POST "http://modules.gear.dev:8080/job/$name/doDelete"
EOS;
        exec($url);
    }


    public function createJobProject()
    {

    }



    public function deleteJobProject()
    {

    }

    public function deleteJobModule()
    {
        $module = $this->getRequest()->getParam('module');
        $buildName = $this->str('url', $module);
        $this->deleteItem($buildName);

        return true;
    }

    public function createTempFile()
    {

    }

    public function deleteTempFile()
    {

    }

    public function createJobConfig()
    {
        $config = str_replace('${workspace}', $this->job->getPath(), file_get_contents($this->job->getStandard()));
        $file = $this->getJobConfigFolder().'/temp/'.$this->job->getName().'.xml';
        file_put_contents($file, $config);
        $this->job->setFile($file);
    }

    public function createJobModule($buildName = false)
    {
        $module = $this->getRequest()->getParam('module');

        $path = $this->getRequest()->getParam('path');

        if (!is_dir($path)) {
            throw new \Exception(sprintf('Path "%s" no exist', $path));
        }

        $buildType = $this->getRequest()->getParam('job-template', $buildName);

        $this->job = new \Gear\ContinuousIntegration\Jenkins\Job();
        $this->job->setPath(realpath($path));
        $this->job->setName($this->str('url', $module));
        $this->job->setStandard($this->jobConfigMap($buildType));
        $this->createJobConfig();
        $this->createItem();

        return true;
    }

    public function createJob(\Gear\ContinuousIntegration\Jenkins\Job $job)
    {
        $this->job = $job;
        $this->createJobConfig();
        $this->createItem();
    }

    public function jobConfigMap($jobName)
    {

        switch ($jobName) {
        	case 'module-codeception':
        	    $name = 'config-module-codeception.xml';
        	    break;

        	case 'module-phpunit':
        	    $name = 'config-module-phpunit.xml';
        	    break;

        	case 'project-codeception':

        	    $name = 'config-project-codeception.xml';

        	    break;
        	default:
        	    $name = null;
        	    break;

        }

        if (empty($name)) {
            throw new \Exception(sprintf('Job with key "%s" not found', $jobName));
        }

        if (!is_file($this->getJobConfigFolder().'/'.$name)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        return $this->getJobConfigFolder().'/'.$name;
    }

    public function getJobConfigFolder()
    {
        $dirbase = dirname(dirname(__FILE__));

        $file = realpath($dirbase.'/../../ci/');

        if (!is_dir($file)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        return $file;
    }
}
