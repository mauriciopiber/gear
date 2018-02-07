<?php
namespace Gear\Database\Phinx;

use DateTime;
use Gear\Project\ProjectLocationTrait;
use GearBase\Util\String\StringService;
use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;

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

    use ProjectLocationTrait;

    use StringServiceTrait;

    use FileCreatorTrait;

    /**
     * Constructor
     *
     * @return \Gear\Database\Phinx\PhinxService
     */
    public function __construct(StringService $stringService, FileCreator $fileCreator)
    {
        $this->stringService = $stringService;
        $this->fileCreator = $fileCreator;
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

    public function createClassName($name)
    {
        $string = $this->str('class', $name);
        return $string;
    }

    public function createFileName($name)
    {
        $uline = $this->str('uline', $name);
        $string = sprintf('%s_%s.php', $this->getNow()->format('YmdHis'), $uline);

        return $string;
    }


    public function createMigration($name)
    {

        $this->file = $this->getFileCreator();
        $this->file->setTemplate('template/database/migration.phtml');
        $this->file->setFileName($this->createFileName($name));
        $this->file->setLocation($this->getProject().'/data/migrations');
        $this->file->setOptions(
            ['name' => $this->createClassName($name)***REMOVED***
        );

        return $this->file->render();
    }
}
