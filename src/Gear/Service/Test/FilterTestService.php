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
                'module'  => $this->getModule()->getModuleName()
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

    public function getTestRequiredColumns()
    {
        //test fail without fixture

        //show validation message

        //test pass with fixture
    }

    public function getTestRequired()
    {
        $required = false;

        foreach ($this->db->getTableObject()->getColumns() as $column) {
            $required = true;
            $this->getTestRequiredColumns();
            break;
        }
    }

    public function createDb()
    {

        //caso tenha algum campo obrigatório, criar teste com validação negativa.
        //validar mensagens.

        //criar teste com fixture correta, passando válido.

        return $this->createFileFromTemplate(
            'template/test/unit/filter/db.filter.phtml',
            array(
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'functions' => $this->functions
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestFilterFolder()
        );
    }




}
