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
        return $this->scriptService;
    }
}
