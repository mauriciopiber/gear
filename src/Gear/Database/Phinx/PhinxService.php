<?php
namespace Gear\Database\Phinx;

use DateTime;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Database/Phinx
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class PhinxService
{
    private $now;
    
    /**
     * Constructor
     *
     * @return \Gear\Database\Phinx\PhinxService
     */
    public function __construct()
    {
        return $this;
    }

    public function setNow(DateTime $now)
    {
        $this->now = $now;
        return $this;
    }
    
    public function getNow()
    {
        if (!isset($this->now)) {
            $this->now = new DateTime('now');
        }
        return $this->now;
    }
    
    public function createMigration($module = null, $name)
    {
        
        //se módulo não foi passado, utilizar getProjectLocation()
        
        
        //se módulo foi passado, usar $module->getMIgrationFolder()
        return true;
        
    }
}
