<?php
namespace Gear\Edge\File;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Edge\AbstractEdge;

class FileEdge extends AbstractEdge
{
    public function getFileModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/file.yml';

        $common = $this->getModuleLocation('common').'/file.yml';

        $typeData = $this->getYamlService()->load($file);
        $commonData = $this->getYamlService()->load($common);

        $files = array_merge($commonData, $typeData);
        return $files;

    }
}
