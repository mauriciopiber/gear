<?php
namespace GearTest\Model;

use Gear\Model\MakeGear;

class MakeGearTest extends \PHPUnit_Framework_TestCase
{

    public $testFolder;
    public function setUp()
    {
        $this->test_folder = __DIR__.'/../testFolder';
        $this->entity      = new MakeGear();
        parent::setUp();

    }

    public function toProvider()
    {
        return array(
            array('data_to_provider'),
            array('Data_to_provider'),
            array('DataToProvider'),
            array('dataToProvider'),
            array('DataTo_Provider'),
            array('Data_ToProvider'),
            array('Data_To_provider')
        );
    }

    /**
     * @dataProvider toProvider
     */
    public function testToCode($data)
    {
        $this->assertEquals($this->entity->strBuilder('code',$data),'datatoprovider');
    }
    /**
     * @dataProvider toProvider
     */
    public function testToLabel($data)
    {
        $this->assertEquals($this->entity->strBuilder('label',$data),'Data To Provider');
    }
    /**
     * @dataProvider toProvider
     */
    public function testToUnderline($data)
    {
        $this->assertEquals($this->entity->strBuilder('uline',$data),'data_to_provider');
    }

    /**
     * @dataProvider toProvider
     */
    public function testToClass($data)
    {
        $this->assertEquals($this->entity->strBuilder('class',$data),'DataToProvider');
    }
    /**
    * @dataProvider toProvider
    */
    public function testToUrl($data)
    {

        $this->assertEquals($this->entity->strBuilder('url',$data),'data-to-provider');
    }
    /**
     * @dataProvider toProvider
     */
    public function testToVar($data)
    {
        $this->assertEquals($this->entity->strBuilder('var',$data),'dataToProvider');
    }

    public function providerCheckIterator()
    {
        return array(
            array(array(0,0,0),true),
            array(array(0,0,1),false),
            array(array(0,0,40),false),
            array(array(0,0,0),true)
        );
    }

    /**
     * @dataProvider providerCheckIterator
     */
    public function testCheckIterator($data,$result)
    {
        $this->assertEquals($this->entity->checkIterator($data),$result);
    }

    public function providerBaseToVar()
    {
        return array(
            array('ucfirst',array(0,0),'ucfirst'),
            array('ucfirst',array(0,1),'Ucfirst'),
            array('lcfirst',array(0,0),'lcfirst'),
            array('lcfirst',array(1,0),'Lcfirst'),
            array('Acfirst',array(1,1),'Acfirst'),
            array('Acfirst',array(0,0),'acfirst'),
        );
    }
    /**
     * @dataProvider providerBaseToVar
     */
    public function testBasetoVar($eval,$iterator,$result)
    {
        $this->assertEquals($this->entity->baseToVar($eval,$iterator),$result);
    }

    /**
     * Essa função simula a maneira que os nomes das entidades devem chegar no sistema
     * @return multitype:string
     */
    public function getFixtureCamelCaseNames()
    {
        return array(
            'TabelaNova',
            'NovaTabela',
            'TabelaCompostaComCincoNomes',
            'Tabelasssssssss',
            'TaBeLa',
        );
    }

    /**
     * Essa função simula a maneira que os nomes das tabelas e dos campos devem chegar no sistema
     * @return multitype:string
     */
    public function getFixtureUnderlineNames()
    {
        return array(
            'tabela_nova',
            'nova_tabela',
            'tabela_composta_com_cinco_nomes',
            'tabelasssssssss',
            'ta_be_la',
        );
    }

    public function testOldUrl()
    {
        $tabelas = array();
        foreach ($this->getFixtureCamelCaseNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->controllerToUrl($v);
        }
        $this->assertEquals($tabelas,array(
            'tabela-nova',
            'nova-tabela',
            'tabela-composta-com-cinco-nomes',
            'tabelasssssssss',
            'ta-be-la'
        ));
    }
    public function testOldClass()
    {
        $tabelas = array();
        foreach ($this->getFixtureCamelCaseNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->controllerToClass($v);
        }
        $this->assertEquals($tabelas,array(
            'TabelaNova',
            'NovaTabela',
            'TabelaCompostaComCincoNomes',
            'Tabelasssssssss',
            'TaBeLa'
        ));
    }
    public function testOldLabel()
    {
        $tabelas = array();
        foreach ($this->getFixtureCamelCaseNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->controllerToLabel($v);
        }
        $this->assertEquals($tabelas,array(
            'Tabela Nova',
            'Nova Tabela',
            'Tabela Composta Com Cinco Nomes',
            'Tabelasssssssss',
            'Ta Be La'
        ));
    }
    public function testOldCode()
    {
        $tabelas = array();
        foreach ($this->getFixtureCamelCaseNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->controllerToCode($v);
        }
        $this->assertEquals($tabelas,array(
            'tabelanova',
            'novatabela',
            'tabelacompostacomcinconomes',
            'tabelasssssssss',
            'tabela'
        ));
    }
    public function testOldTable()
    {
        $tabelas = array();
        foreach ($this->getFixtureCamelCaseNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->controllerToEntity($v);
        }
        $this->assertEquals($tabelas,array(
            'TabelaNova',
            'NovaTabela',
            'TabelaCompostaComCincoNomes',
            'Tabelasssssssss',
            'TaBeLa'
        ));
    }

    /*
    public function testShouldtoUrlConvertSuccessfull()
    {
         $tabelas = array();
         foreach ($this->getFixtureCamelCaseNames() as $v) {
         	$tabelas[***REMOVED*** = $this->entity->toUrl($v);
         }
         $this->assertEquals($tabelas,array(
         	'tabela-nova',
            'nova-tabela',
            'tabela-composta-com-cinco-nomes',
            'tabelasssssssss',
            'ta-be-la'
         ));
    }
    */
    public function testShouldtoClassConvertSuccessfull()
    {
         $tabelas = array();
         foreach ($this->getFixtureCamelCaseNames() as $v) {
             $tabelas[***REMOVED*** = $this->entity->toClass($v);
         }
         $this->assertEquals($tabelas,array(
             'TabelaNova',
            'NovaTabela',
            'TabelaCompostaComCincoNomes',
            'Tabelasssssssss',
            'TaBeLa'
         ));
    }

    public function testShouldtoLabelConvertSuccessfull()
    {
         $tabelas = array();
         foreach ($this->getFixtureCamelCaseNames() as $v) {
             $tabelas[***REMOVED*** = $this->entity->toLabel($v);
         }
         $this->assertEquals($tabelas,array(
             'Tabela Nova',
            'Nova Tabela',
            'Tabela Composta Com Cinco Nomes',
            'Tabelasssssssss',
            'Ta Be La'
         ));
    }

    public function testShouldtoCodeConvertSuccessfull()
    {
         $tabelas = array();
         foreach ($this->getFixtureCamelCaseNames() as $v) {
             $tabelas[***REMOVED*** = $this->entity->toCode($v);
         }
         $this->assertEquals($tabelas,array(
             'tabelanova',
            'novatabela',
            'tabelacompostacomcinconomes',
            'tabelasssssssss',
            'tabela'
         ));
    }

    public function testShouldtoTableConvertSuccessfull()
    {
         $tabelas = array();
         foreach ($this->getFixtureCamelCaseNames() as $v) {
             $tabelas[***REMOVED*** = $this->entity->toTable($v);
         }
         $this->assertEquals($tabelas,array(
             'tabela_nova',
            'nova_tabela',
            'tabela_composta_com_cinco_nomes',
            'tabelasssssssss',
            'ta_be_la'
         ));
    }

    /*
    public function testShouldUnderlineToUrlConvertSuccessfull()
    {
        $tabelas = array();
        foreach ($this->getFixtureUnderlineNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->underlineToUrl($v);
        }
        $this->assertEquals($tabelas,array(
            'tabela-nova',
            'nova-tabela',
            'tabela-composta-com-cinco-nomes',
            'tabelasssssssss',
            'ta-be-la'
        ));
    }*/
    public function testShouldUnderlineToClassConvertSuccessfull()
    {
        $tabelas = array();
        foreach ($this->getFixtureUnderlineNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->underlineToClass($v);
        }
        $this->assertEquals($tabelas,array(
            'TabelaNova',
            'NovaTabela',
            'TabelaCompostaComCincoNomes',
            'Tabelasssssssss',
            'TaBeLa'
        ));
    }

    public function testShouldUnderlineToLabelConvertSuccessfull()
    {
        $tabelas = array();
        foreach ($this->getFixtureUnderlineNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->underlineToLabel($v);
        }
        $this->assertEquals($tabelas,array(
            'Tabela Nova',
            'Nova Tabela',
            'Tabela Composta Com Cinco Nomes',
            'Tabelasssssssss',
            'Ta Be La'
        ));
    }

    public function testShouldUnderlineToCodeConvertSuccessfull()
    {
        $tabelas = array();
        foreach ($this->getFixtureUnderlineNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->underlineToCode($v);
        }
        $this->assertEquals($tabelas,array(
            'tabelanova',
            'novatabela',
            'tabelacompostacomcinconomes',
            'tabelasssssssss',
            'tabela'
        ));
    }

    public function testShouldUnderlineToTableConvertSuccessfull()
    {
        $tabelas = array();
        foreach ($this->getFixtureUnderlineNames() as $v) {
            $tabelas[***REMOVED*** = $this->entity->underlineToTable($v);
        }
        $this->assertEquals($tabelas,array(
            'tabela_nova',
            'nova_tabela',
            'tabela_composta_com_cinco_nomes',
            'tabelasssssssss',
            'ta_be_la'
        ));
    }

    public function testGetNamespace()
    {
        $class = $this->entity->getNamespace('ModuleTest');

        $this->assertEquals($class,'namespace ModuleTest;'.PHP_EOL);
    }

    public function testGetEndFile()
    {
        $this->assertEquals($this->entity->getEndArray(),PHP_EOL.');');
    }

    public function testGetEndArray()
    {
        $this->assertEquals($this->entity->getEndFile(),PHP_EOL.'}');
    }

    public function testGetInitArray()
    {
        $this->assertEquals($this->entity->getInitArray(),'return array(' . PHP_EOL);
    }

    public function testGetIndent()
    {
        $this->assertEquals($this->entity->getIndent(1),'    ');
        $this->assertEquals($this->entity->getIndent(2),'        ');
        $this->assertEquals($this->entity->getIndent(3),'            ');
        $this->assertEquals($this->entity->getIndent(4),'                ');
        $this->assertEquals($this->entity->getIndent(5),'                    ');
        $this->assertEquals($this->entity->getIndent(6),'                        ');

    }

    public function testMkDirFailNoName()
    {
        $makeGear = new MakeGear();
        $testFolder = '';
        $results = $makeGear->mkDir($testFolder);
        $this->assertEquals($results,false);
    }

    public function testMkDirSuccessfull()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->mkDir($this->test_folder);
        $this->assertEquals($this->test_folder,$results);
    }

    /**
     * @depends testMkDirSuccessfull
     */
    public function testDirectoryShouldBeEmpty()
    {
        $this->assertEquals($this->entity->is_dir_empty($this->test_folder),true);
    }

    public function testMkPHPDirFail()
    {
        $makeGear = new MakeGear();
        $testFolder = 'DirectoryNotFound';
        $results = $makeGear->mkPHP($testFolder);
        $this->assertEquals($results,false);
    }

    public function testMkXMLDirFail()
    {
        $makeGear = new MakeGear();
        $testFolder = 'DirectoryNotFound';
        $results = $makeGear->mkXML($testFolder);
        $this->assertEquals($results,false);
    }

    public function testMkHTMLDirFail()
    {
        $makeGear = new MakeGear();
        $testFolder = 'DirectoryNotFound';
        $results = $makeGear->mkHTML($testFolder);
        $this->assertEquals($results,false);
    }

    /**
     * @depends testMkDirSuccessfull
     */
    public function testMkPHPSuccessFull()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->mkPHP($this->test_folder, 'main','echo \'piber\';');
        $this->assertTrue(is_file($results));
    }

    /**
     * @depends testMkDirSuccessfull
     */
    public function testMkPHPUnlinkAlreadyCreated()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->mkPHP($this->test_folder, 'main','echo \'piber2\';');
        $this->assertTrue(is_file($results));
    }

    /**
     * @depends testMkDirSuccessfull
     */
    public function testMkXMLSuccessFull()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->mkXML($this->test_folder, 'main','<note></note>');
        $this->assertTrue(is_file($results));
    }

    /**
     * @depends testMkDirSuccessfull
     */
    public function testMkXMLUnlinkAlreadyCreated()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->mkXML($this->test_folder, 'main','<note></note>');
        $this->assertTrue(is_file($results));
    }

    /**
     * @depends testMkDirSuccessfull
     */
    public function testMkHTMLSuccessFull()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->mkHTML($this->test_folder, 'mainhtml','<div></div>');
        $this->assertTrue(is_file($results));
    }

    /**
     * @depends testMkDirSuccessfull
     */
    public function testMkHTMLUnlinkAlreadyCreated()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->mkHTML($this->test_folder, 'mainhtml','<div></div>');
        $this->assertTrue(is_file($results));
    }

    /**
     * @depends testMkPHPSuccessFull
     */
    public function testDirectoryShouldNotBeEmpty()
    {
        $this->assertEquals($this->entity->is_dir_empty($this->test_folder),false);
    }

    public function testRmDirSuccessfull()
    {
        $makeGear = new MakeGear();
        $makeGear->mkDir($this->test_folder);
        $results = $makeGear->rmDir($this->test_folder);
        $this->assertEquals($results,true);
    }

    public function testRmDirFail()
    {
        $makeGear = new MakeGear();
        $results = $makeGear->rmDir($this->test_folder);
        $this->assertEquals($results,false);
    }
}
