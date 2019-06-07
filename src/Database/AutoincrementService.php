<?php
namespace Gear\Database;

use Zend\Db\Metadata\Object\TableObject;
use Gear\Database\Connector\DbConnector\DbConnectorTrait;

class AutoincrementService extends DbAbstractService
{
    use DbConnectorTrait;

    /**
     * Executa Truncate em todas tabelas da database descrita em global.php
     */
    public function autoincrementDatabase()
    {
        $schema = $this->getSchema();

        $tables = $schema->getTables();

        foreach ($tables as $table) {
            $this->truncate($table);
        }

        return true;
    }

    /**
     * Executa Truncate na tabela $tableName
     * @param string $tableName
     */
    public function autoincrementTable($tableName)
    {
        $schema = $this->getSchema();
        $table = $schema->getTable($this->str('uline', $tableName));

        return $this->truncate($table);
    }

    public function truncate(TableObject $table)
    {
        if ($table->getName() == 'migrations') {
            return;
        }

        $this->getDbConnector()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getDbConnector()->query(sprintf('TRUNCATE %s;', $table->getName()));
        $this->getDbConnector()->query(sprintf('ALTER TABLE %s AUTO_INCREMENT = 1;', $table->getName()));
        $this->getDbConnector()->query('SET FOREIGN_KEY_CHECKS=1');

        $this->getDbConnector()->disconnect();

        $this->get('console')->writeLine(sprintf('Table truncaded and reseted "%s"', $table->getName()), 3);
    }
}
