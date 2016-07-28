<?php
namespace Gear\Column;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use GearJson\Db\Db;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Column\UniqueInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\ModuleAwareTrait;
use Gear\Column\Exception\UndevelopedColumn;
use Gear\Column\Exception\UndevelopedColumnPart;
use Gear\Column\Exception\UnfoundColumnRender;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Int\ForeignKey;
use Gear\Column\AbstractDateTime;
use Gear\Column\Decimal\Decimal;
use Gear\Column\Int\Int;
use Gear\Column\TinyInt\TinyInt;
use Gear\Column\Varchar\Varchar;
use Gear\Column\Varchar\UniqueId;
use Gear\Column\Varchar\PasswordVerify;
use Gear\Column\Varchar\UploadImage;
use Gear\Creator\FileCreatorTrait;
use Gear\Column\Exception\UnfoundReference;
use Zend\Db\Metadata\Object\ConstraintObject;

/**
 *
 * Classe que trabalha com as colunas para exibir os valores para o Mvc.
 *
 * @category   Column
 * @package    Gear
 * @subpackage Column
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class ColumnService implements ServiceLocatorAwareInterface
{
    use FileCreatorTrait;
    use ModuleAwareTrait;
    use StringServiceTrait;
    use MetadataTrait;
    use TableServiceTrait;
    use ServiceLocatorAwareTrait;

    protected $columns = [***REMOVED***;

    protected $cache;

    /**
     * Pega o cache para utilizar
     *
     * @return void
     */
    public function getCache()
    {
        if (!isset($this->cache)) {
            $this->cache = $this->getServiceLocator()->get('memcached');
        }
        return $this->cache;
    }

    /**
     * Adiciona a referência de uma coluna ao cache.
     *
     * @param string $columnName  Nome da Coluna
     * @param string $valueAssert Valor
     *
     * @return boolean
     */
    public function addValue($columnName, $valueAssert)
    {
        if ($this->getCache()->hasItem($columnName)) {
            return $this->getCache()->replaceItem($columnName, $valueAssert);
        }

        $this->getCache()->addItem($columnName, $valueAssert);

        return true;
    }

    /**
     * Remove a referência a uma coluna no cache.
     *
     * @param string $columnName Nome da Coluna
     *
     * @return boolean
     */
    public function removeValue($columnName)
    {
        if ($this->getCache()->hasItem($columnName)) {
            $this->getCache()->removeItem($columnName);
            return true;
        }
        return false;
    }

    /**
     * Pega o valor de uma determinada Coluna
     *
     * @param string $columnName Nome da Coluna
     *
     * @return boolean
     */
    public function getValue($columnName)
    {
        if ($this->getCache()->hasItem($columnName)) {
            return $this->getCache()->getItem($columnName);
        }

        return false;
    }


    /**
     * Extrai todos Gear\Column de um GearJson\Db\Db.
     *
     * @param Db $db Mvc
     *
     * @throws \Gear\Exception\PrimaryKeyNotFoundException
     *
     * @return array
     */
    public function getColumns(Db $db = null)
    {
        if (empty($this->columns) && $db == null) {
            throw new \Exception('Missing config');
        }

        unset($this->columns);

        $metadata = $this->getMetadata();

        $this->tableName    = $this->str('class', $db->getTable());
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        //var_dump($this->tableName);
        //var_dump(count($this->tableColumns));
        $this->tablePrimaryKey = $this->getTableService()->getPrimaryKey($db->getTable());

        if (!$this->tablePrimaryKey) {
            throw new \Gear\Exception\PrimaryKeyNotFoundException();
        }

        foreach ($this->tableColumns as $column) {
            if (in_array($column->getName(), Db::excludeList())) {
                continue;
            }

            $instance = $this->factory($column, $db);

            $this->columns[***REMOVED***  = $instance;
        }

        return $this->columns;
    }

    /**
     * Transforma uma metadata de coluna simples em Gear\Column.
     *
     * @param Zend\Db\Metadata\Object\ColumnObject $column Coluna que será transformada em Gear\Column
     * @param GearJson\Db\Db                       $db     Mvc
     *
     * @return \Gear\Column\UniqueInterface|unknown
     */
    private function factory($column, $db)
    {
        $defaultNamespace = 'Gear\\Column';

        $dataType = $this->str('class', $column->getDataType());
        $specialityName = $db->getColumnSpeciality($column->getName());
        $columnConstraint = $this->getTableService()->getConstraintForeignKeyFromColumn($db->getTable(), $column);

        //primary key
        if (in_array($column->getName(), $this->tablePrimaryKey->getColumns())) {
            $class = $defaultNamespace.'\\'.$dataType.'\\PrimaryKey';
            $instance = new $class($column, $this->tablePrimaryKey);
            //foreign key
        } elseif ($columnConstraint != null) {
            $class = $defaultNamespace.'\\'.$dataType.'\\ForeignKey';
            $instance = new $class($column, $columnConstraint);
            $instance->setModuleName($this->getModule()->getModuleName());

            //standard
        } elseif ($specialityName == null) {
            $class = $defaultNamespace.'\\'.$dataType.'\\'.$dataType;

            if (class_exists($class) === false) {
                throw new UndevelopedColumn($class);
            }

            $instance = new $class($column);

            //speciality
        } else {
            $className = $this->str('class', str_replace(' ', '', $specialityName));
            $class = $defaultNamespace.'\\'.$dataType.'\\'.$className;
            if (class_exists($class) === false) {
                throw new UndevelopedColumn($class);
            }
            $instance = new $class($column);
        }

        $instance->setServiceLocator($this->getServiceLocator());
        $instance->setModule($this->getModule());


        if ($instance instanceof UniqueInterface) {
            $uniqueConstraint = $this->getTableService()->getUniqueConstraintFromColumn($db->getTable(), $column);

            if ($uniqueConstraint instanceof ConstraintObject) {
                $instance->setUniqueConstraint($uniqueConstraint);
            }
        }

        return $instance;
    }

    /**
     * Verifica se determinado tipo de Coluna está relacionado ao DB.
     *
     * @param GearJson\Db\Db $db         Mvc
     * @param string         $columnName Nome da Coluna
     * @return boolean
     */
    public function verifyColumnAssociation($db, $columnName)
    {
        $has = false;

        foreach ($this->getColumns($db) as $column) {
            if ($columnName === get_class($column)) {
                $has = true;
            }
        }

        return $has;
    }

    /**
     * Pega as colunas de determinado tipo
     *
     * @param GearJson\Db\Db $db         Mvc
     * @param string         $columnName Nome da Coluna
     * @return unknown[***REMOVED***
     */
    public function getSpecifiedColumns($db, $columnName)
    {
        $columns = $this->getColumns($db);


        $specified = [***REMOVED***;

        foreach ($columns as $column) {
            if ($this->isClass($column, $columnName)) {
                $specified[***REMOVED*** = $column;
            }
        }

        return $specified;
    }

    /**
     * Verifica se determinado objeto é de determinada classe
     *
     * @param AbstractColumn $columnData Coluna
     * @param string         $class      Nome da Classe
     *
     * @return boolean
     */
    private function isClass($columnData, $class)
    {
        return in_array(
            get_class($columnData),
            array($class)
        );
    }

    /**
     * Verifica se coluna pertence a um conjunto de classes
     *
     * @param AbstractColumn $columnData Objeto da Coluna
     * @param array          $class      Array com o nome das classes
     *
     * @return boolean
     */
    public function filter($columnData, array $class)
    {
        return in_array(
            get_class($columnData),
            $class
        );
    }

    /**
     * Adiciona os atributos estáticos para o teste de imagens
     *
     * @return code
     */
    private function staticTest()
    {
        $code = '';

        foreach ($this->columns as $columnData) {
            if ($this->isClass($columnData, 'Gear\Column\Varchar\UploadImage')) {
                $code .= $this->getFileCreator()->renderPartial(
                    'template/module/column/abstract/test/static-attribute.phtml',
                    [
                        'attribute' => $this->str('var-lenght', $columnData->getColumn()->getName()),
                        'value' => $columnData->getUploadDir()
                    ***REMOVED***
                );
            }
        }

        $code = $this->formatCode($code);

        return $code;
    }

    /**
     * Formata o código para adicionar identação
     *
     * @param string $code   Código que será identado
     * @param number $indent Identação
     *
     * @return string
     */
    private function formatCode($code, $indent = 0)
    {
        $indentSize = 4;

        $lines = explode(PHP_EOL, $code);

        $indentCode = str_repeat(' ', $indent*$indentSize);

        $dataFormat = [***REMOVED***;

        foreach ($lines as $item) {
            $dataFormat[***REMOVED*** = $indentCode.$item;
        }

        $code = implode(PHP_EOL, $lines);

        return $code;
    }

    /**
     * Cria os valores no padrão de inserção no banco por meio do Post do Controller/Service/Repository
     *
     * @param string $repository Repository
     *
     * @return string
     */
    private function insertArray($repository = false)
    {
        $code = '';

        foreach ($this->columns as $columnData) {
            if ($columnData instanceof PrimaryKey
            ) {
                continue;
            }

            if ($this->isClass($columnData, 'Gear\Column\Varchar\UploadImage')) {
                if ($repository) {
                    $code .= $columnData->getInsertDataRepositoryTest();
                    continue;
                }
            }
            $this->createReference($columnData);

            $code .= $columnData->getInsertArrayByColumn();
        }


        $code = $this->formatCode($code);

        return $code;
    }

    /**
     * Cria os valores no padrão de selecionar no banco nos testes unitários de Controller/Service/Repository
     *
     * @param string  $repository Repository
     * @param boolean $delete     Deletar
     *
     * @return string
     */
    private function insertSelect($repository = false, $delete = false)
    {
        $code = '';

        foreach ($this->columns as $columnData) {
            if ($columnData instanceof PrimaryKey
                || $columnData instanceof UniqueId
                || $columnData instanceof PasswordVerify
            ) {
                continue;
            }

            if ($this->isClass($columnData, 'Gear\Column\Varchar\UploadImage')) {
                if ($repository) {
                    $code .= $columnData->getInsertDataRepositoryTest();
                    continue;
                }
            }
            $this->loadReference($columnData, $delete);

            $code .= $columnData->getInsertSelectByColumn();
        }


        $code = $this->formatCode($code);

        return $code;
    }

    /**
     * Cria os valores esperados na hora de ler os dados do banco de dados e testar em Controller\Service\Repository
     *
     * @param string $repository Repositório
     * @param string $delete     Deletar
     *
     * @return string
     */
    private function insertAssert($repository = false, $delete = false)
    {
        $code = '';

        foreach ($this->columns as $columnData) {
            if ($columnData instanceof PrimaryKey
                || $columnData instanceof UniqueId
                || $columnData instanceof PasswordVerify) {
                continue;
            }

            if ($this->isClass($columnData, 'Gear\Column\Varchar\UploadImage')) {
                if ($repository) {
                    $code .= $columnData->getInsertAssertRepositoryTest();
                    continue;
                }
            }


            $this->loadReference($columnData, $delete);

            $code .= $columnData->getInsertAssertByColumn();
        }

        $code = $this->formatCode($code);

        return $code;
    }

    /**
     * Carrega uma referência para uma coluna
     *
     * @param AbstractColumn $columnData Coluna
     * @param string         $delete     Deletar
     *
     * @throws UnfoundReference
     *
     * @return null
     */
    private function loadReference(&$columnData, $delete = false)
    {

        if ($columnData instanceof ForeignKey) {
            $values = $this->getValue($columnData->getColumn()->getName());

            if ($values === false) {
                throw new UnfoundReference();
            }

            $columnData->setHelperStack($values);

            return;
        }

        if ($columnData instanceof AbstractDateTime) {
            $values = $this->getValue($columnData->getColumn()->getName());

            if ($values === false) {
                throw new UnfoundReference();
            }

            $columnData->setInsertTime($values);
            $values->add(new \DateInterval('P1M'));
            $columnData->setUpdateTime($values);

            return;
        }

        if ($columnData instanceof Decimal) {
            $values = $this->getValue($columnData->getColumn()->getName());

            if ($values === false) {
                throw new UnfoundReference();
            }

            $columnData->setReference($values);

            return;
        }

        if ($columnData instanceof Int || $columnData instanceof TinyInt) {
            $values = $this->getValue($columnData->getColumn()->getName());

            if ($values === false) {
                throw new UnfoundReference();
            }

            $columnData->setReference($values);

            return;
        }

        if ($columnData instanceof Varchar) {
            $values = $this->getValue($columnData->getColumn()->getName());

            if ($values === false) {
                throw new UnfoundReference($values);
            }



            $columnData->setReference($values);

            return;
        }

        if (isset($values) && $values !== false && $delete) {
            $this->removeValue($columnData->getColumn()->getName());
        }

        return;
    }

    /**
     * Adiciona a referência padrão à Coluna
     *
     * @param ColumnObject $columnData Coluna
     *
     * @return null
     */
    private function createReference(&$columnData)
    {

        if ($columnData instanceof ForeignKey) {
            $options = [
                'insert' => rand(1, 30),
                'update' => rand(1, 30)
            ***REMOVED***;

            $this->addValue($columnData->getColumn()->getName(), $options);

            $columnData->setHelperStack($options);
            return;
        }

        if ($columnData instanceof AbstractDateTime) {
            $options = new \DateTime('now');
            $options->add(new \DateInterval(sprintf('P%dD', rand(1, 9999))));

            $this->addValue($columnData->getColumn()->getName(), $options);

            $timeUpdate = clone $options;

            $columnData->setInsertTime($timeUpdate);
            $timeUpdate->add(new \DateInterval('P1M'));
            $columnData->setUpdateTime($timeUpdate);
            return;
        }

        if ($columnData instanceof Decimal) {
            $options = rand(50, 5000);
            $this->addValue($columnData->getColumn()->getName(), $options);
            $columnData->setReference($options);
            return;
        }

        if ($columnData instanceof Int || $columnData instanceof TinyInt) {
            $options = rand(1, 99999);
            $this->addValue($columnData->getColumn()->getName(), $options);
            $columnData->setReference($options);
            return;
        }


        if ($columnData instanceof Varchar) {
            $options = rand(50, 99);


            $this->addValue($columnData->getColumn()->getName(), $options);
            $columnData->setReference($options);
        }

        return;
    }

    /**
     * Verifica as opções de testes unitários para serem utilizadas em Controller, Service e Repository
     *
     * @param string $key Nome da Chave.
     *
     * @throws UndevelopedColumnPart
     *
     * @return boolean
     */
    private function enableColumnParts($key)
    {
        $enableParts = [
            'updateArray',
            'updateAssert',
            'insertSelect',
            'insertAssert',
            'insertArray',
            'staticTest',
        ***REMOVED***;

        if (!in_array($key, $enableParts)) {
            throw new UndevelopedColumnPart($key);
        }

        return true;
    }

    /**
     * Renderiza os testes para determinado ítem
     *
     * @param string $renderId   Nome do Ítem a ser renderizado
     * @param string $repository Repositório
     * @param string $delete     Deletar
     *
     * @throws UnfoundColumnRender
     *
     * @return void|string
     */
    public function renderColumnPart($renderId, $repository = false, $delete = false)
    {

        if ($this->enableColumnParts($renderId) !== true) {
            return;
        }


        switch ($renderId) {
            case 'insertArray':
                $html = $this->insertArray($repository, $delete);

                break;

            case 'insertAssert':
                $html = $this->insertAssert($repository, $delete);

                break;

            case 'insertSelect':
                $html = $this->insertSelect($repository, $delete);

                break;

            case 'updateArray':
                $html = $this->insertArray($repository, $delete);

                break;

            case 'updateAssert':
                $html = $this->insertAssert($repository, $delete);

                break;



            case 'staticTest':
                $html = $this->staticTest();

                break;
            default:
                throw new UnfoundColumnRender($renderId);
                break;
        }

        return $html;
    }
}
