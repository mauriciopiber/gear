<?php
namespace Gear\Service\Module;

use Gear\Service\Module\ScriptService;

trait ScriptServiceTrait
{

    protected $scriptService;

    public function setScriptService(ScriptService $scriptService)
    {
        $this->scriptService = $scriptService;
        return $this;
    }

    public function getScriptService()
    {
        if (!isset($this->scriptService)) {
            $this->scriptService = $this->getServiceLocator()->get('scriptService');
        }
        return $this->scriptService;
    }
}
