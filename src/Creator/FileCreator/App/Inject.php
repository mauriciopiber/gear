<?php
namespace Gear\Creator\FileCreator\App;

use Gear\Creator\FileCreator\AbstractFileCreator;
use Gear\Schema\App\App;

class Inject extends AbstractFileCreator
{
    public function render(App $app, array $options)
    {
        $template = 'template/module/creator/file-creator/app/inject.phtml';

        if (empty($app->getDependency())) {
            return '';
        }

        $dependencyNames = $this->getDependencyNames($app->getDependency());

        $dependencyParams = '';

        foreach ($dependencyNames as $i => $dependencyName) {
            $varName = '\''.$this->str('var', $dependencyName).'\'';

            $dependencyParams .= $varName;

            if (isset($app->getDependency()[$i+1***REMOVED***)) {
                $dependencyParams .= ', ';
            }
        }

        $options['dependency'***REMOVED*** = $dependencyParams;

        return $this->getFileCreator()->renderPartial($template, $options);
    }
}
