<?php
namespace GearTest\MvcTest\RepositoryTest;

use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

trait RepositoryDataTrait
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

    public function tables()
    {
        //($columns, $template, $nullable, $tableName, $namespace)
        //($columns, $template, $nullable, $namespace, $service)

        return [
            [
                $this->getAllPossibleColumns(), //columns
                '', //template
                true, //nullable
                'table',
                null, //namespace
               'invokables' //service
            ***REMOVED***,
            [
                $this->getAllPossibleColumns(),
                '-namespace',
                true,
                'table',
                'Custom\CustomNamespace',
                'invokables'
            ***REMOVED***,
            [
                $this->getAllPossibleColumns(),
                '-factory',
                true,
                'table',
                null,
                'factories'
            ***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }
}
