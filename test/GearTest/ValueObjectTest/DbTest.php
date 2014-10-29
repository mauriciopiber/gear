<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class DbTest extends AbstractGearTest
{
    public function dbData()
    {
        return array(
        	array('Module')
        );
    }

    /**
     * @dataProvider dbData
     * @param unknown $table
     */
    public function testCreateDbFromArray($table)
    {
        $data = array(
            'table' => $table,
        );

        $db = new \Gear\ValueObject\Db($data);

        $this->assertEquals($db->getTable(), $table);


        $exchangeArray = $db->extract();

        $this->assertEquals($exchangeArray['table'***REMOVED***,$table );
    }



}
