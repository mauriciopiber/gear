<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\AbstractMvcTest;
use Gear\Schema\App\App;

class AppServiceSpecService extends AbstractMvcTest
{
    public function create(App $app)
    {
        $template = 'template/module/app/service/spec-service.phtml';

        $location = $this->getCodeTest()->getLocation($app);

        $class = $this->str('class', $app->getName());

        $varClass = $this->str('var', $class);

        $var = $this->str('var-length', 'Test'.$class);

        $filename = $class.'Spec.js';

        $options = [
            'class' => $class,
            'varClass' => $varClass,
            'testVar' => $var
        ***REMOVED***;

        $file = $this->getFileCreator();
        $file->createFile($template, $options, $filename, $location);
    }
}
