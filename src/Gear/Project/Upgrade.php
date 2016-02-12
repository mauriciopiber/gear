<?php
namespace Gear\Project;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Console\Prompt;

class Upgrade implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function upgrade()
    {

        $this->base = \GearBase\Module::getProjectFolder();



        $this->project = $this->getServiceLocator()->get('config')['gear'***REMOVED***['name'***REMOVED***;

        if (empty($this->project)) {
            throw new \Exception('Need Gear Project Name');
        }

        $this->git = $this->getServiceLocator()->get('config')['gear'***REMOVED***['git'***REMOVED***;

        if (empty($this->git)) {
            throw new \Exception('Need Gear Project Git');
        }

       // $this->outputTest();die();
        (new \Gear\Project\Upgrade\Package($this->serviceLocator))->upgrade();
        (new \Gear\Project\Upgrade\Gulp($this->serviceLocator))->upgrade();
        //(new \Gear\Project\Upgrade\Help($this->serviceLocator))->upgrade();
        //(new \Gear\Project\Upgrade\Karma($this->serviceLocator))->upgrade();
        //(new \Gear\Project\Upgrade\Protractor($this->serviceLocator))->upgrade();
        //(new \Gear\Project\Upgrade\Environment($this->serviceLocator))->upgrade();
        //(new \Gear\Project\Upgrade\Deploy($this->serviceLocator))->upgrade();





        //is gulp file.

        //is end2end.conf.js

        //is karma.conf.js

        //is config autoload development
        //is config autoload testing
        //is config autoload staging
        //is config autoload prodution

        //is composer packages on composer.json

        //is gear_help.sh


        //is build.xml build correcty?
    }


    public function outputTest()
    {
        for ($i = 1; $i < 17; $i++) {

            echo 'i = '.$i."\n";

            //for ($j = 1; $j < 17; $j++) {
                $j = 1;
                echo 'j = '.$j."\n";

                $this->console->writeLine('Create Gulp file', $i, $j);
            //}
        }
    }


    public function getRequest()
    {
        if (!isset($this->request)) {
            $this->request = $this->getServiceLocator()->get('application')->getMvcEvent()->getRequest();
        }
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
}
