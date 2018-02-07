<?php
namespace Gear\Creator\FileCreator\AppTest;

use Gear\Creator\FileCreator\AbstractFileCreator;
use GearJson\App\App;

class BeforeEach extends AbstractFileCreator
{
    public function render(App $app, array $options)
    {
        $template = 'template/module/creator/file-creator/app-test/before-each.phtml';

        $options['dependencyParams'***REMOVED*** = '';

        if (!empty($app->getDependency())) {
            $dependencyNames = $this->getDependencyNames($app->getDependency());

            $dependencyParams = ', ';

            foreach ($dependencyNames as $i => $dependencyName) {
                $varName = $this->str('var', $dependencyName);

                $dependencyParams .= $varName;

                if (isset($app->getDependency()[$i+1***REMOVED***)) {
                    $dependencyParams .= ', ';
                }
            }

            $options['dependencyParams'***REMOVED*** = $dependencyParams;
        }

        return $this->getFileCreator()->renderPartial($template, $options);
    }
}
