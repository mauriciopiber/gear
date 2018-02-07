<?php
namespace Gear\Mvc\Entity\EntityObjectFixer;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Mvc/Entity/EntityObjectFixer
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class EntityObject
{
    private $tableName;

    /**
     * Constructor
     *
     * @return \Gear\Mvc\Entity\EntityObjectFixer\EntityObject
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->content = file_get_contents($this->file);
        preg_match('#class ([A-Za-z***REMOVED****)#', $this->content, $matches);
        $this->tableName = $matches[1***REMOVED***;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
}
