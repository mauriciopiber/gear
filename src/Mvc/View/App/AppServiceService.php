<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\AppServiceSpecServiceTrait;
use Gear\Mvc\AbstractMvc;
use Gear\Schema\App\App;

class AppServiceService extends AbstractMvc
{

    use AppServiceSpecServiceTrait;


    public function create(App $app)
    {
        $template = 'template/module/app/service/service.phtml';

        $location = $this->getCode()->getLocation($app);

        $class = $this->str('class', $app->getName());
        $varClass = $this->str('var', $class);

        $filename = $class.'.js';

        $options = [
            'class' => $class,
            'varClass' => $varClass
        ***REMOVED***;

        $this->getAppServiceSpecService()->create($app);

        $file = $this->getFileCreator();
        $file->createFile($template, $options, $filename, $location);
    }
}
