<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\AbstractMvcTest;
use GearJson\App\App;

class AppControllerSpecService extends AbstractMvcTest
{

    public function create(App $app)
    {
        $template = 'template/module/app/controller/spec-controller.phtml';

        $location = $this->getCodeTest()->getLocation($app);

        $class = $this->str('class', $app->getName());
        $var = $this->str('var-lenght', 'Test'.$class);

        $filename = $class.'Spec.js';

        //params on function.
        //inject on footer.

        $options = [
            'class' => $class,
            'testVar' => $var
        ***REMOVED***;


        $file = $this->getFileCreator();
        $file->createFile($template, $options, $filename, $location);
    }
}
