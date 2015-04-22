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
            'method' => $this->tableName.'Service', 'module' => $this->getConfig()->getModule(), 'entityName' => $this->tableName
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



        //verificar se tem coluna de imagem.

        $fileCreator->setView('template/test/unit/service/full.service.phtml');
        $fileCreator->setOptions(array(
            'firstString' => $this->getFirstString(),
            'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 18),
            'serviceNameVar' => substr($this->str('var', $src->getName()), 0, 18),
            'serviceNameClass'   => $src->getName(),
            'class' => $this->str('class', str_replace('Service', '', $src->getName())),
            'module'  => $this->getConfig()->getModule(),
            'injection' => $this->getClassService()->getTestInjections($src),
            'oneBy' => $this->getSelectOneByForUnitTest(),
            'insertArray' => $entityValues->getInsertArray(),
            'updateArray' => $entityValues->getUpdateArray(),
            'insertAssert' => $entityValues->getInsertAssert(),
            'updateAssert' => $entityValues->getUpdateAssert()
        ));
        $fileCreator->setLocation($this->getModule()->getTestServiceFolder());
        $fileCreator->setFileName($src->getName().'Test.php');

        return $fileCreator->render();
    }
}
