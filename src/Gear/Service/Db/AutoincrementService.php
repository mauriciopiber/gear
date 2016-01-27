<?php
namespace Gear\Service\Db;

use Zend\Db\Metadata\Object\TableObject;

class AutoincrementService extends DbAbstractService
{
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
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        if ($table->getName() == 'migrations') {
            return;
        }

        $this->outputConsole(sprintf('Truncate Table %s', $table->getName()), 3);
        $connection = $em->getConnection();
        $connection->beginTransaction();
        try {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $connection->query(sprintf('TRUNCATE %s;', $table->getName()));
            $connection->query(sprintf('ALTER TABLE %s AUTO_INCREMENT = 1;', $table->getName()));
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        }
        catch (\Exception $e) {
            $connection->rollback();
        }
    }

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

}