<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\AbstractMvc;
use GearJson\App\App;


class AppControllerService extends AbstractMvc
{
    use AppControllerSpecServiceTrait;


    public function create(App $app)
    {
        $template = 'template/module/app/controller/controller.phtml';

        $location = $this->getCode()->getLocation($app);

        $class = $this->str('class', $app->getName());
        $var = $this->str('var-lenght', $class);

        $filename = $class.'.js';

        $options = [
            'class' => $class,
            'var' => $var
        ***REMOVED***;


        $options['constructorArgs'***REMOVED*** = $this->getConstructorArgs()->render($app, $options);
        $options['inject'***REMOVED*** = $this->getInject()->render($app, $options);


        $this->getAppControllerSpecService()->create($app);
        $file = $this->getFileCreator();
        $file->createFile($template, $options, $filename, $location);
    }
}
