<?php
namespace Gear\Edge;

use Gear\Edge\AbstractEdge;
use Exception;

class ComposerEdge extends AbstractEdge
{
    public function getComposerModule($type = 'web')
    {
        $file = $this->getModuleLocation($type).'/composer.yml';

        $common = $this->getModuleLocation('common').'/composer.yml';

        $typeFile = $this->getYamlService()->load($file);
        $commonFile = $this->getYamlService()->load($common);

        $compose = array_merge_recursive($typeFile, $commonFile);


        foreach ($compose as $composeKey) {

            foreach ($composeKey as $package => $version) {
                if (is_array($version)) {
                    throw new Exception(sprintf('2 versions of %s', $package));
                }
            }

        }

        return $compose;
    }
}
