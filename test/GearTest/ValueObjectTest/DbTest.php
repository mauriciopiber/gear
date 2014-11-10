<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class DbTest extends AbstractGearTest
{
    public function dbData()
    {
        return array(
        	array('Module', 'module'),
            array('PrincipalTabela', 'principal_tabela')
        );
    }

    /**
     * @dataProvider dbData
     * @param unknown $table
     */
    public function testCreateDbFromArray($table, $underscore)
    {
        $data = array(
            'table' => $table,
        );

        $db = new \Gear\ValueObject\Db($data);
        $this->assertInstanceOf('Gear\ValueObject\AbstractHydrator', $db);
        $this->assertEquals($db->getTable(), $table);
        $this->assertEquals($db->getTableUnderscore(), $underscore);


        try {
            $exchangeArray = $db->extract();
        } catch (\Exception $exception) {
            $this->setExpectedException('Exception');
            throw new $exception;
        }


        //$this->assertEquals($exchangeArray['table'***REMOVED***,array('table' => $table, 'columns' => array() ));

    }


    /**
     * @dataProvider dbData
     * @param unknown $table
     * @param unknown $underscore
     */

    public function testDbExport($table, $underscore)
    {
        $data = array(
            'table' => $table,
        );

        $db = new \Gear\ValueObject\Db($data);

        $this->assertEquals(array('table' => $table, 'columns' => array()), $db->export());
    }



}
