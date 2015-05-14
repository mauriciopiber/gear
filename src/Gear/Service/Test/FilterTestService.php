<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class FilterTestService extends AbstractJsonService
{

    public function create($src)
    {
        $this->src = $src;
        if ($this->src->getDb() !== null) {
            $this->db = $this->src->getDb();
            return $this->createDb();
        }

        return $this->createFileFromTemplate(
            'template/test/unit/filter/src.filter.phtml',
            array(
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestFilterFolder()
        );
    }

    public function introspectFromTable($db)
    {

        $this->db = $db;
        $this->src = $this->getGearSchema()->getSrcByDb($this->db, 'Filter');
        $this->createDb();
    }

    public function createDb()
    {

    }




}
