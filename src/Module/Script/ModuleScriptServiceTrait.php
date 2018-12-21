<?php
namespace Gear\Module\Script;

use Gear\Module\Script\ModuleScriptService;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Module/Script
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait ModuleScriptServiceTrait
{
    protected $moduleScriptService;

    /**
     * Get Module Script Service
     *
     * @return ModuleScriptService
     */
    public function getModuleScriptService()
    {
        return $this->moduleScriptService;
    }

    /**
     * Set Module Script Service
     *
     * @param ModuleScriptService $moduleScriptService Module Script Service
     *
     * @return ModuleScriptService
     */
    public function setModuleScriptService(
        ModuleScriptService $moduleScriptService
    ) {
        $this->moduleScriptService = $moduleScriptService;
        return $this;
    }
}
