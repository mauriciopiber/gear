<?php
namespace Gear\Model;

use Zend\Db\Adapter\Adapter;

/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class FilterGear extends MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Filter';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if (is_array($entities) && count($entities)>0) {
            foreach ($entities as $table) {
                $this->createFilter($table);
            }
        } else {
            return false;
        }
    }

    public function createFilter($table)
    {

        $module  = $this->getModule();

        $class = $this->str('class', $table);
        $uline = $this->str('uline', $table);

        //$tableService = $this->getConfig()->getServiceLocator()->get('tableService');
        //$table = $tableService->getTable($uline);

        $schema  = new Schema($this->getAdapter());
        $columns = $schema->getColumns($uline);

        $aaa = '';
        $aaa .= $this->getNamespace($module.'\\Filter');
        $aaa .= $this->getUse();
        $aaa .= $this->getClass($this->getFileName($class));
        $aaa .= $this->getConstruct($uline);
        $aaa .= $this->getInputFilter($class, $columns, $table);
        $aaa .= $this->getEndFile();

        $this->mkPHP($this->getFinalPath(), $this->getFileName($table).'Filter',$aaa);

        $fileService = $this->getConfig()->getServiceLocator()->get('fileService');

        $namespace = $module.'\\Filter';
        $use = $this->getUseArray();
        $class = 'InputFilter';
        $extends = $class.'Filter';
        $methods = null;

        $fileService->createFile($namespace,$use,$class,$extends,null,$methods);

        //echo sprintf('Filtro %s criado com sucesso',$class);
    }

    private function getAllFilters($tableName,$inputs)
    {
        $tableService = $this->getConfig()->getServiceLocator()->get('tableService');

        $uline = $this->str('uline',$tableName);

        $aaa = '';
        $schema = new Schema($this->getAdapter());
        //$constraints = $tableService->getTab


        $table = $tableService->getTable($uline);

        $constraints = $table->getConstraints();

        $inputs = $table->getColumns();

        $key = $table->getPrimaryKeyColumnName();

        foreach ($inputs as $v) {

            if ($v->getName()==$key || in_array($v->getName(),array('created_date','updated_date','created','updated'))) {
                continue;
            }
            $binput = '';

            if ($v->getIsNullable()===false && $key!=$v->getName()) {
                //var_dump($v);
                $binput .= $this->getIndent(4).'\'required\' => true,'.PHP_EOL;;
            } else {
                $binput .= $this->getIndent(4).'\'required\' => false,'.PHP_EOL;;
            }

            if ($v->getDataType()=='varchar') {
                $binput .= $this->powerLine(4, '\'filters\'  => array(');
                $binput .= $this->powerLine(5, '    array(\'name\' => \'StripTags\'),');
                $binput .= $this->powerLine(5, '    array(\'name\' => \'StringTrim\'),');
                $binput .= $this->powerLine(4, '),');
            } elseif ($v->getDataType()=='int') {
                $binput .= $this->getIndent(4).trim('\'filters\'  => array(').PHP_EOL;
                $binput .= $this->getIndent(5).trim('array(\'name\' => \'Int\'),').PHP_EOL;
                $binput .= $this->getIndent(4).trim('),').PHP_EOL;
            }
            //filtros

            //validador
            $binput .= $this->powerLine(4, '\'validators\' => array(');
            if ($v->getDataType()=='varchar') {
                $binput .= $this->powerLine(5, '    array(');
                $binput .= $this->powerLine(6, '        \'name\'    => \'StringLength\',');
                $binput .= $this->powerLine(6, '        \'options\' => array(');
                $binput .= $this->powerLine(7, '            \'encoding\' => \'UTF-8\',');
                $binput .= $this->powerLine(7, '            \'min\'      => 1,');
                $binput .= $this->powerLine(7,'             \'max\'      => %d',array($v->getCharacterMaximumLength()));
                $binput .= $this->powerLine(6, '        ),').PHP_EOL;
                $binput .= $this->powerLine(5, '    ),').PHP_EOL;
            }
                //add norecord Validator.

            $unique = $schema->getUnique($this->str('uline',$tableName), $v);

            if ($unique !== false) {
                $binput .= $this->powerLine(5,'    $noRecord%s',$this->str('class',$v->getName()));
            }

            if ($v->getSpecialites()->first()=='email') {
                $binput .= $this->powerLine(5, '    array(');
                $binput .= $this->powerLine(6, '        \'name\'    => \'Email\',');
                $binput .= $this->powerLine(5, '    ),');
            }

            $binput .= $this->getIndent(4).trim('),').PHP_EOL;
            //var_dump($v->getSpecialites()->first());


            $aaa .= $this->getIndent(2).trim('$this->add(').PHP_EOL;
            $aaa .= $this->getIndent(3).trim('array(').PHP_EOL;
            $aaa .= $this->getIndent(4).trim('\'name\' => \''.$this->str('var',$v->getName()).'\',').PHP_EOL;
            $aaa .= $binput;
            $aaa .= $this->getIndent(3).')'.PHP_EOL;
            $aaa .= $this->getIndent(2).');'.PHP_EOL;

        }

        return $aaa;
    }

    private function getFunctionGetAdapter()
    {
        $aaa = $this->powerLine(1,'public function getAdapter()');
        $aaa .= $this->powerLine(1,'{');
        $aaa .= $this->powerLine(2,'    return $this->adapter;');
        $aaa .= $this->powerLine(1,'}',array(),true);

        return $aaa;
    }

    private function getFunctionSetAdapter()
    {
        $aaa = $this->powerLine(1,'public function setAdapter($dbAdapter)');
        $aaa .= $this->powerLine(1,'{');
        $aaa .= $this->powerLine(2,'    $this->adapter = $dbAdapter;');
        $aaa .= $this->powerLine(1,'}',array(),true);

        return $aaa;
    }

    public function generateSetAdapter()
    {

    }

    public function generateGetAdapter()
    {

    }

    public function generateConstruct()
    {

    }

    public function getConstruct($tableName)
    {
        $uline = $this->str('uline', $tableName);
        $tableService = $this->getConfig()->getServiceLocator()->get('tableService');
        $table = $tableService->getTable($uline);

        $aaa = '';

        if ($table->getHasUnique()) {

            $aaa .= $this->powerLine(1, 'private $adapter;',array(),true);

            $aaa .= $this->getFunctionGetAdapter();
            $aaa .= $this->getFunctionSetAdapter();

            $aaa .= $this->getIndent(1).'public function __construct($dbAdapter)'.PHP_EOL;
            $aaa .= $this->getIndent(1).'{'.PHP_EOL;
            $aaa .= $this->getIndent(2).'$this->setAdapter($dbAdapter);'.PHP_EOL;
            $aaa .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;
        } else {
            $aaa .= $this->getIndent(1).'public function __construct()'.PHP_EOL;
            $aaa .= $this->getIndent(1).'{'.PHP_EOL.PHP_EOL;
            $aaa .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;
        }

        return $aaa;
    }

    private function getInputFilter($class, $inputs, $tableName)
    {
        $uline = $this->str('uline', $tableName);
        $tableService = $this->getConfig()->getServiceLocator()->get('tableService');
        $table = $tableService->getTable($uline);

        $schema = new \Gear\Model\Schema($this->getConfig()->getDriver());

        foreach ($inputs as  $v) {
            $unique = $schema->getUnique($this->str('uline', $class), $v);
            if ($unique) {
                break;
            }
        }

        $aaa = '';

        $aaa .= $this->powerLine(1, '/**');
        $aaa .= $this->powerLine(1, '* @SuppressWarnings(PHPMD.ExcessiveMethodLength)');
        $aaa .= $this->powerLine(1, '*/');

        if ($unique) {
            $aaa .= $this->powerLine(1,'public function getInputFilter($id%s = null)',array($class));
            $aaa .= $this->powerLine(1,'{');
            $uniqueKeys = $table->getUnique();
            foreach ($uniqueKeys as $i => $v) {

                $columns = $v->getColumns();
                $name = array_pop($columns);

                $aaa .= $this->powerLine(2,'$noRecord%s = new \Zend\Validator\Db\NoRecordExists(',array($this->str('class',$name)));
                $aaa .= $this->powerLine(3,'    array(');
                $aaa .= $this->powerLine(4,'        \'table\' => \'%s\',',array($this->str('uline',$table->getName())));
                $aaa .= $this->powerLine(4,'        \'field\' => \'%s\',',array($name));
                $aaa .= $this->powerLine(4,'        \'adapter\' => $this->getAdapter(),');
                $aaa .= $this->powerLine(3,'    )');
                $aaa .= $this->powerLine(2,');');
                $aaa .= $this->powerLine(2,'$noRecord%s->setMessage(\'%s já existe relacionado a um %s\');',array($this->str('class',$name),$this->str('label',$name),$table->getName()),true);
            }

            $aaa .= $this->powerLine(2,'if (!is_null($id%s) && $id%s > 0) {',array($class,$class));

            foreach ($uniqueKeys as $i => $v) {
                $aaa .= $this->powerLine(3,'$noRecord%s->setExclude(\'%s != \' . $id%s);',array($this->str('class',$name),$table->getPrimaryKeyColumnName(),$class));
            }

            $aaa .= $this->powerLine(2,'}');

        } else {
            $aaa .= $this->powerLine(1,'public function getInputFilter()');
            $aaa .= $this->powerLine(1,'{');
        }

        $aaa .= $this->getAllFilters($tableName, $inputs);

        $aaa .= $this->powerLine(2,'return $this;');
        $aaa .= $this->powerLine(1,'}');

        $aaa .= '';

        return $aaa;
    }

    public function getUseArray()
    {
        return array(
            'Zend\InputFilter\InputFilter',
            'Zend\InputFilter\InputFilterAwareInterface',
            'Zend\InputFilter\InputFilterInterface'
        );
    }

    private function getUse()
    {
        $aaa = 'use Zend\InputFilter\InputFilter;'.PHP_EOL;
        $aaa .= 'use Zend\InputFilter\InputFilterAwareInterface;'.PHP_EOL;
        $aaa .= 'use Zend\InputFilter\InputFilterInterface;'.PHP_EOL.PHP_EOL;

        return $aaa;
    }

    private function getClass($table)
    {
        return 'class '.$table.'Filter extends InputFilter'.PHP_EOL.'{'.PHP_EOL;
    }

}
