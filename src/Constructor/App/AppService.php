<?php
namespace Gear\Constructor\App;

use Gear\Mvc\View\App\AppServiceServiceTrait;
use Gear\Mvc\View\App\AppControllerServiceTrait;
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Schema\App\AppServiceTrait as SchemaApp;
use Gear\Constructor\AbstractConstructor;

class AppService extends AbstractConstructor
{

    use AppServiceServiceTrait;
    use AppControllerServiceTrait;
    use SchemaApp;
    use SchemaServiceTrait;

    public function create(array $data)
    {
        $module = $this->getModule()->getModuleName();

        $this->app = $this->getAppService()->create(
            $module,
            $data['name'***REMOVED***,
            $data['type'***REMOVED***,
            $data['dependency'***REMOVED***,
            $data['namespace'***REMOVED***,
            $data['db'***REMOVED***
        );

        if ($this->str('class', $this->app->getType()) == 'Service') {
            $this->getAppServiceService()->create($this->app);
            return;
        }

        if ($this->str('class', $this->app->getType()) == 'Controller') {
            $this->getAppControllerService()->create($this->app);
            return;
        }
    }
}
