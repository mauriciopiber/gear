<?php
namespace Gear\Creator\FileCreator\AppTest;

use Gear\Creator\FileCreator\AbstractFileCreator;
use GearJson\App\App;

class Vars extends AbstractFileCreator
{
    public function render(App $app, array $options)
    {
        unset($app);
        $template = 'template/creator/file-creator/app-test/vars.phtml';
        return $this->getFileCreator()->renderPartial($template, $options);
    }
}
