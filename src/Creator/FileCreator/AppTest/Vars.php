<?php
namespace Gear\Creator\FileCreator\AppTest;

use Gear\Creator\FileCreator\AbstractFileCreator;
use Gear\Schema\App\App;

class Vars extends AbstractFileCreator
{
    public function render(App $app, array $options)
    {
        unset($app);
        $template = 'template/module/creator/file-creator/app-test/vars.phtml';
        return $this->getFileCreator()->renderPartial($template, $options);
    }
}
