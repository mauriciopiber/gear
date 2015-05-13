<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;
use Gear\Metadata\Table;

class ServiceTestService extends AbstractFixtureService
{
    public function getFirstString()
    {
        $validColumn = null;

        foreach ($this->tableColumns as $a => $b) {
            if ($b->getDataType() == 'varchar') {
                $validColumn = $this->str('var', $b->getName());
                break;
            }
        }

        if ($validColumn === null) {
            $validColumn = 'id.'.$this->str('class', $this->tableName);
        }

        return $validColumn;
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $src = $this->getGearSchema()->getSrcByDb($table, 'Service');

        $this->setBaseArray(array(
            'method' => $this->tableName.'Service', 'module' => $this->getModule()->getModuleName(), 'entityName' => $this->tableName
        ));

        $primaryKeyColumn   = $this->table->getPrimaryKeyColumns();
        $this->usePrimaryKey = true;

        $entityValues = $this->getValuesForUnitTest();

        $fileCreator = $this->getServiceLocator()->get('fileCreator');


        if ($this->db->getUser() == 'strict' || $this->db->getUser() == 'low-strict') {
            $fileCreator->addChildView(array(
            	'template' => 'template/test/unit/service/setmockauthadapter',
                'placeholder' => 'mockauthadapter',
                'config' => array('var' => substr($this->str('var', $src->getName()), 0, 18))
            ));

            $fileCreator->addChildView(array(
                'template' => 'template/test/unit/service/selectbyidnull',
                'placeholder' => 'selectbyidnull',
                'config' => array(
                    'var' => substr($this->str('var', $src->getName()), 0, 18),
                    'class' => $this->str('class', $src->getName())
                )
            ));
        }

        $specialities = $this->getGearSchema()->getSpecialityArray($table);

        if (in_array('upload-image', $specialities)) {
            $fileCreator->addChildView(array(
                'template' => 'template/test/unit/mock-upload-image.phtml',
                'placeholder' => 'extraColumns',
                'config' => array('module' => $this->getModule()->getModuleName())
            ));
        }


        $selectOneBy = $this->getSelectOneByForUnitTest();

        $this->oneBy = '';
        foreach ($selectOneBy as $select) {

            $this->oneBy .= <<<EOS
    public function testSelectOneBy{$select['class'***REMOVED***}()
    {
        \$resultSet = \$this->get{$select['method'***REMOVED***}()->selectOneBy(
            array(
                '{$select['var'***REMOVED***}' =>
                    {$select['value'***REMOVED***}
            )
        );
        \$this->assertInstanceOf('{$select['module'***REMOVED***}\Entity\\{$select['entityName'***REMOVED***}', \$resultSet);
        \$this->assertEquals(
            {$select['value'***REMOVED***},
            \$resultSet->get{$select['class'***REMOVED***}()
        );
    }

EOS;

        }
        //verificar se tem coluna de imagem.

        $fileCreator->setView('template/test/unit/service/full.service.phtml');
        $fileCreator->setOptions(array(
            'static' => $this->static,
            'firstString' => $this->getFirstString(),
            'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 18),
            'serviceNameVar' => substr($this->str('var', $src->getName()), 0, 18),
            'serviceNameClass'   => $src->getName(),
            'class' => $this->str('class', str_replace('Service', '', $src->getName())),
            'module'  => $this->getModule()->getModuleName(),
            'injection' => $this->getClassService()->getTestInjections($src),
            'oneBy' => $this->oneBy,
            'insertArray' => $entityValues->getInsertArray(),
            'updateArray' => $entityValues->getUpdateArray(),
            'insertAssert' => $entityValues->getInsertAssert(),
            'updateAssert' => $entityValues->getUpdateAssert()
        ));
        $fileCreator->setLocation($this->getModule()->getTestServiceFolder());
        $fileCreator->setFileName($src->getName().'Test.php');

        return $fileCreator->render();
    }

    public function create($src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null) {
            return $this->introspectFromTable($this->src->getDb());
        }

        $this->dependency = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());

        $this->functions  = $this->dependency->getTests();

        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        $this->createFileFromTemplate(
            'template/test/unit/service/src.service.phtml',
            array(
                'functions' => $this->functions,
                'var' => $this->str('var-lenght', $this->src->getName()),
                'mock' => $mock,
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestServiceFolder()
        );
    }
}
