<?php
namespace Gear\Edge;

use Gear\Edge\AbstractEdge;

class ComposerEdge extends AbstractEdge
{

    public function getComposerFileModule()
    {

    }

    public function getComposerFileProject()
    {

    }


    public function getComposerModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/composer.yml';

        return $this->getYamlService()->load($file);

    }

    public function getComposerProject($type = 'web')
    {
        $file = $this->getProjectLocation($type).'/composer.yml';

        return $this->getYamlService()->load($file);

    }
}
