<?php
namespace GearTest\ServiceTest\MvcServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;

/**
 * @group Mapping
 */
class MappingServiceTest extends AbstractServiceTest
{
    public function testMappingForBasicTable()
    {
        $mappingService = $this->bootstrap->getServiceLocator()->get('RepositoryService\MappingService');

        $expected = 'Gear\Service\Mvc\RepositoryService\MappingService';

        $this->assertInstanceOf($expected, $mappingService);

        $emailTable = array(
            'tableName' => 'piber',
            'columns' => array(
                'id_email' => array(
                    'dataType' => 'int',
                    'constraints' => array('type' => 'PRIMARY KEY'),
                ),
                'remetente' => array(
                    'dataType' => 'varchar',
                ),
                'destino' => array(
                    'dataType' => 'varchar',
                ),
                'assunto' => array(
                    'dataType' => 'varchar',
                ),
                'mensagem' => array(
                    'dataType' => 'longtext',
                ),
            ),
        );

        $db = $this->getMockSingleClass('\Gear\ValueObject\Db', array('getTable', 'getColumns', 'getTableObject'));
        $db->expects($this->any())->method('getTable')->willReturn('piber');
        $db->expects($this->any())->method('getColumns')->willReturn(array());
        $db->expects($this->any())->method('getTableObject')->willReturn($this->getMockTableByArray($emailTable));
        $mappingService->setInstance($db);

        $schema = $this->getMockSingleClass('\Gear\Schema', array('getSpecialityByColumnName'));
        $schema->expects($this->any())->method('getSpecialityByColumnName')->willReturn(null);
        $mappingService->setGearSchema($schema);
        //$mappingService->getRepositoryMapping()->toString();

        $expected = file_get_contents(__DIR__.'/texttocompare.txt');

        $this->assertEquals($expected, $mappingService->getRepositoryMapping()->toString());

        $expected = 5;

        $this->assertEquals($expected, $mappingService->getCountTableHead());

    }

    /**
     * Entrada:
     *
     * 1 tabela com:
     *
     * 1 campo id
     * 4 campos varchar
     * 1 campo text
     */
}
