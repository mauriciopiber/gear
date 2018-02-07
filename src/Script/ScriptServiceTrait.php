<?php
namespace Gear\Script;

use Gear\Script\ScriptService;

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
