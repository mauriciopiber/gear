<?php
namespace Gear\Creator\FileCreator\App;

use Gear\Creator\FileCreator\AbstractFileCreator;
use Gear\Schema\App\App;

class ConstructorArgs extends AbstractFileCreator
{
    public function render(App $app, array $options)
    {
        $options['args'***REMOVED*** = '';

        if (empty($app->getDependency())) {
            return '';
        }

        $dependencyNames = $this->getDependencyNames($app->getDependency());

        $dependencyParams = '';

        foreach ($dependencyNames as $i => $dependencyName) {
            $varName = $this->str('var', $dependencyName);

            $dependencyParams .= $varName;

            if (isset($app->getDependency()[$i+1***REMOVED***)) {
                $dependencyParams .= ', ';
            }
        }

        return $dependencyParams;
    }
}
