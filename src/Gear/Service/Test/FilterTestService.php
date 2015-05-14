<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;
use Gear\Service\Column\Int\PrimaryKey;

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

        $this->className = $this->db->getTable();
        $this->class     = $this->str('class', $this->className);
        $this->var       = $this->str('var', $this->className);

        $filterMessage = '';

        foreach ($this->getTableData() as $columnData) {

            if ($columnData->getColumn()->isNullable() == false) {

                if ($columnData instanceof PrimaryKey) {
                    continue;
                }

                $filterMessage .= <<<EOS
        \$this->assertFilterHasMessage(
            '{$this->str('var', $columnData->getColumn()->getName())}',
            'isEmpty',
            'O valor é obrigatório e não pode estar vazio'
        );

EOS;
            }

        }



        $this->functions .= <<<EOS
    /**
     * @group FreeMind
     * @group ColumnsNotNull
     */
    public function testGetRequired()
    {
        \${$this->var} = \$this->get{$this->class}();
        \$inputFilter = \${$this->var}->getInputFilter();
        \$inputFilter->setData(array());
        \$this->assertFalse(\$inputFilter->isValid());
        \$this->messages = \$inputFilter->getMessages();
$filterMessage
    }



EOS;
        //test pass with fixture
    }

    public function getTestRequired()
    {
        $required = false;

        foreach ($this->db->getTableObject()->getColumns() as $column) {

            if ($column->isNullable() == false) {
                $required = true;
                $this->getTestRequiredColumns();
                break;
            }
            continue;

        }
    }

    public function createDb()
    {

        $this->tableName = $this->db->getTable();
        $this->functions = '';
        $this->getTestRequired();
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
