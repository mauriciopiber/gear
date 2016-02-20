<?php
namespace Gear\Mvc\Filter;

use Gear\Mvc\AbstractMvcTest;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Varchar\UniqueId;
use GearJson\Schema\SchemaServiceTrait;

class FilterTestService extends AbstractMvcTest
{
    use SchemaServiceTrait;

    public function create($src)
    {
        $this->src = $src;
        if ($this->src->getDb() !== null) {
            $this->db = $this->src->getDb();
            return $this->createDb();
        }
        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());


        return $this->getFileCreator()->createFile(
            'template/test/unit/filter/src.filter.phtml',
            array(
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'mock'  => $mock
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestFilterFolder()
        );
    }

    public function introspectFromTable($db)
    {

        $this->db = $db;
        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Filter');
        $this->createDb();
    }

    public function getTestRequiredColumns()
    {
        //test fail without fixture

        //show validation message

        $filterMessage = '';

        foreach ($this->getTableData() as $columnData) {

            if ($columnData instanceof UniqueId) {
                continue;
            }

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
     * @group {$this->getModule()->getModuleName()}
     * @group {$this->class}
     */
    public function testGetRequiredInvalidPost()
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
        $this->required = false;

        foreach ($this->getTableData() as $columnData) {

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData->getColumn()->isNullable() == false) {
                $this->required = true;
                $this->getTestRequiredColumns();
                break;
            }
            continue;

        }


       /*  if ($required === false) {
            $this->getTestNoRequired();
        } */
    }

    public function getTestColumns()
    {
        $this->customFilterTest = false;

        if (empty($this->getTableData())) {
            return null;
        }

        foreach ($this->getTableData() as $columnData) {

            if (method_exists($columnData, 'getFilterTest')) {
                $this->customFilterTest = true;
                $this->functions .= $columnData->getFilterTest();
            }
        }
    }

    public function getTestNoRequired()
    {
        if ($this->customFilterTest || $this->required) {
            return null;
        }

        $this->functions .= <<<EOS
    /**
     * @group {$this->getModule()->getModuleName()}
     * @group {$this->class}
     */
    public function testNoRequired()
    {
        \${$this->var} = \$this->get{$this->class}();
        \$inputFilter = \${$this->var}->getInputFilter();
        \$inputFilter->setData(array());
        \$this->assertTrue(\$inputFilter->isValid());
    }

EOS;

    }

    public function getTestValidReturnTrue()
    {

        $inputValues = $this->getValuesForUnitTest();

        $insertArray = $inputValues->getInsertArray();

        $fixture = implode('        ', $insertArray);

        $this->functions .= <<<EOS

    public function validPost()
    {
        return array(
            array(
                array(
$fixture
                ),
            ),
        );
    }

    /**
     * @group {$this->getModule()->getModuleName()}
     * @group {$this->class}
     * @dataProvider validPost
     */
    public function testReturnTrueWithValidPost(\$data)
    {
        \${$this->var} = \$this->get{$this->class}();
        \$inputFilter = \${$this->var}->getInputFilter();
        \$inputFilter->setData(\$data);
        \$this->assertTrue(\$inputFilter->isValid());
    }

EOS;
    }

    public function createDb()
    {

        $this->tableName = $this->db->getTable();
        $this->class     = $this->str('class', $this->src->getName());
        $this->var       = $this->str('var-lenght', $this->src->getName());

        $this->functions = '';

        $this->getTestRequired();
        $this->getTestColumns();
        $this->getTestNoRequired();
        $this->getTestValidReturnTrue();

        $module = $this->getModule()->getModuleName();
        //caso tenha algum campo obrigatório, criar teste com validação negativa.
        //validar mensagens.

        $specialities = $this->getSchemaService()->getSpecialityArray($this->db);

        if (in_array('upload-image', $specialities)) {
            $this->functions .= <<<EOS
    public function mockUploadImage()
    {
        \$maker = new \GearBaseTest\UploadImageMock();
        return \$maker->mockUploadFile(\\{$module}\Module::getLocation());
    }

EOS;
        }

        //criar teste com fixture correta, passando válido.

        return $this->getFileCreator()->createFile(
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
