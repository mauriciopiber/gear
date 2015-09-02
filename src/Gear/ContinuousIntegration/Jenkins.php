<?php
namespace Gear\ContinuousIntegration;

use Gear\Service\AbstractJsonService;
use GearBase\Module;

class Jenkins extends AbstractJsonService
{
    static $jenkinsUrl = 'http://gear:jenkins@188.166.119.178:8080';

    static $jenkinsWorkspace = '/var/lib/jenkins/jobs/';

    static $jenkinsCreateProject = 'curl -X POST -H "Content-Type:application/xml" -d @%s "%s/createItem?name=%s" >> /dev/null';

    static $jenkinsDeleteProject = 'curl -X POST "%s/job/%s/doDelete" >> /dev/null';

    protected $job;

    public function getJenkinsCreateProject()
    {
        return self::$jenkinsCreateProject;
    }

    public function getJenkinsDeleteProject()
    {
        return self::$jenkinsDeleteProject;
    }


    public function getJenkinsWorkspace()
    {
        return self::$jenkinsWorkspace;
    }

    public function setJenkinsWorkspace()
    {
        self::$jenkinsWorkspace;
        return $this;
    }

    public function getJenkinsUrl()
    {
        return self::$jenkinsUrl;
    }

    public function setJenkinsUrl($url)
    {
        self::$jenkinsUrl = $url;
        return true;
    }

    public function getJobConfig()
    {
        $configFile = file_get_contents(sprintf('%s/job/gear-teste/config.xml', $this->getJenkinsUrl()));
        return $configFile;
    }


    public function createItem()
    {
        $url = sprintf($this->getJenkinsCreateProject(), $this->job->getFile(), $this->getJenkinsUrl(), $this->job->getName());



        exec($url);

        unlink($this->job->getFile());
    }

    public function deleteItem($name)
    {
        $url = sprintf($this->getJenkinsDeleteProject(), $this->getJenkinsUrl(), $name);
        exec($url);
    }

    public function deleteJobProject()
    {
        $this->deleteItem($this->getProjectName());
    }

    public function deleteJobModule()
    {
        $module = $this->getRequest()->getParam('module');
        $buildName = $this->str('url', $module);
        $this->deleteItem($buildName);

        return true;
    }


    public function saveTemp($template, $name)
    {
        $file = $this->getJobConfigFolder().'/temp/'.$name.'.xml';
        file_put_contents($file, $template);
        return $file;
    }

    public function createJobConfig()
    {
        $config = str_replace('${workspace}', $this->job->getPath(), file_get_contents($this->job->getStandard()));

        $file = $this->saveTemp($config, $this->job->getName());

        $this->job->setFile($file);
    }

    public function getProjectName()
    {
        $fullname = \GearBase\Module::getProjectFolder();

        $names = explode('/', $fullname);
        $name = end($names);
        return $this->str('url', $name);
    }

    public function createJobProject()
    {
        $this->job = new \Gear\ContinuousIntegration\Jenkins\Job();
        $this->job->setName($this->getProjectName());
        $this->job->setPath($this->getJenkinsWorkspace());
        $this->job->setStandard($this->jobConfigMap('project-codeception'));
        $this->createJobConfig();
        $this->createItem();

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

    public function getConfigMap($jobName)
    {
        return $this->jobConfigMap($jobName);
    }

    public function templateByName($jobName)
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

        return $name;
    }

    public function jobConfigMap($jobName)
    {
        $name = $this->templateByName($jobName);
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
