<?php
namespace Gear\Service\Db;

use Gear\Service\AbstractJsonService;
use Zend\Console\ColorInterface;

class SchemaToolService extends AbstractJsonService
{

    protected $schema;

    public function getSchema()
    {
        if (!isset($this->schema)) {
            $schema = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
            $this->schema = $schema;
        }

        return $this->schema;
    }

    public function fixDatabase()
    {
        echo 'fixDatabase';
    }

    public function validatePrimaryKey($db)
    {

        $actualPrimaryKey = $db->getPrimaryKeyColumnName();
        $namePrimaryToCompare = 'id_'.$this->str('uline', $db->getTable());

        if ($actualPrimaryKey == $namePrimaryToCompare) {
            $statusPrimary =  true;
        } else {
            $statusPrimary = false;
        }

        return $statusPrimary;
    }



    public function fixTable($tableName)
    {

        $schema = $this->getSchema();


        $table = $schema->getTable($this->str('uline', $tableName));

        $tableValidation = new \Gear\Service\Db\TableValidation($table);

        if (!$tableValidation->getCreated()) {
            echo 'Ajustando campo Created'."\n";
        }
        if (!$tableValidation->getUpdated()) {
            echo 'Ajustando campo Updated'."\n";
        }
        if (!$tableValidation->getCreatedBy()) {
            echo 'Ajustando campo CreatedBy'."\n";
        }
        if (!$tableValidation->getUpdatedBy()) {
            echo 'Ajustando campo UpdatedBy'."\n";
        }

        $db = $this->injectDbWithTable($table);

        if (!$this->validatePrimaryKey($db)) {
             echo 'Ajustando Primary Key'."\n";
        }
        //var_dump($tableValidation);

        //var_dump($table);
        //verificar se a chave primaria está ok, se não está ajustar e criá-la.
        //formar created
        //formar createdBy
        //formar updated
        //formar updatedBy


    }

    public function injectDbWithTable($table)
    {
        $data = array(
            'table' => $this->str('uline', $table->getName()),
            'tableObject' => $table,
            'columns' => array()
        );

        $db = new \Gear\ValueObject\Db($data);
        return $db;
    }

    public function doAnalyse()
    {

        $schema = $this->getSchema();

        $tables = $schema->getTables();

        $tableScreen = new \Zend\Text\Table\Table(array('columnWidths' => array(10, 20, 30, 15, 20, 20, 20, 20)));

        // Either simple
        $tableScreen->appendRow(array('Id', 'Name', 'PrimaryKeyName', 'PrimaryStatus', 'Created Time', 'Created By', 'Updated Time', 'Updated By'));


        foreach ($tables as $i => $table) {


            $tableValidation = new \Gear\Service\Db\TableValidation($table);

            $text = "".($i+1);


            $db = $this->injectDbWithTable($table);

            if ($this->validatePrimaryKey($db)) {
                $statusPrimary = 'ok';
            } else {
                $statusPrimary = 'fix';
            }

            // Or verbose
            $row = new \Zend\Text\Table\Row();
            $row->appendColumn(new \Zend\Text\Table\Column($text));
            $row->appendColumn(new \Zend\Text\Table\Column($this->str('label', $table->getName())));
            $row->appendColumn(new \Zend\Text\Table\Column($db->getPrimaryKeyColumnName()));
            $row->appendColumn(new \Zend\Text\Table\Column($statusPrimary));
            $row->appendColumn(new \Zend\Text\Table\Column(($tableValidation->getCreated()===true) ? 'ok' : 'fix'));
            $row->appendColumn(new \Zend\Text\Table\Column(($tableValidation->getCreatedBy()===true) ? 'ok' : 'fix'));
            $row->appendColumn(new \Zend\Text\Table\Column(($tableValidation->getUpdated()===true) ? 'ok' : 'fix'));
            $row->appendColumn(new \Zend\Text\Table\Column(($tableValidation->getUpdatedBy()===true) ? 'ok' : 'fix'));
            $tableScreen->appendRow($row);

        }

        echo $tableScreen;


    }

}
