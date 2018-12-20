<?php
namespace Gear\Edge\File;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Edge\AbstractEdge;

class FileEdge extends AbstractEdge implements ServiceLocatorAwareInterface
{
    public function getFileModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/file.yml';
        $common = $this->getModuleLocation('common').'/file.yml';

        $typeData = $this->getYamlService()->load($file);
        $commonData = $this->getYamlService()->load($common);


        $all = array_merge(array_values($typeData['files'***REMOVED***), array_values($commonData['files'***REMOVED***));
        $unique = array_unique($all);
        return [
            'files' => $unique
        ***REMOVED***;
    }
}
