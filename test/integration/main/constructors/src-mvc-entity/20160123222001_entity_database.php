
<?php

use Phinx\Migration\AbstractMigration;

class EntityDatabase extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
     **/
    public function change()
    {
        $tables = [
            'entity_one' => [***REMOVED***,
            'entity_two' => [***REMOVED***,
            'entity_three' => ['entity_one'***REMOVED***,
            'entity_four' => ['entity_three', 'entity_two'***REMOVED***
        ***REMOVED***;
        
        $entitys =[***REMOVED***;
        
        foreach ($tables as $tableName => $assoc) {http://192.168.1.100:8080/job/gear/job/master/badge/icon
            
            $entity = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);
            $entity->addColumn(sprintf('%s_name', $tableName), 'string', ['null' => false***REMOVED***);
            
            foreach ($assoc as $dep) {
                
                $entity->addColumn(sprintf('id_%s', $dep), 'integer', ['null' => true***REMOVED***);
                
                
                $entity->addForeignKey(
                    sprintf('id_%s', $dep), 
                    $dep, 
                    sprintf('id_%s', $dep), 
                    ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***
                );
                
            }
            
            $entitys[***REMOVED*** = $entity;
        }
        
        foreach ($entitys as $entity) {
            $entity->create();
        }
    }
}