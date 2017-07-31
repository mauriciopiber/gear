<?php
namespace Gear\Integration\Component\GearFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;
use Symfony\Component\Yaml\Yaml;
use Gear\Integration\Suite\AbstractMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\Src\SrcMinorSuite;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Util\Numbers\NumberToStringInterface;
use Gear\Table\UploadImage as UploadImageTable;
use GearJson\Src\SrcTypesInterface;
use Exception;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Component/GearFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class GearFile
{
    use PersistTrait;

    use StringServiceTrait;

    protected $history = [***REMOVED***;

    protected $count;

    protected $longname = false;

    protected $suite;

    const KEYS_BASE = [
        'implements' => [
            'short' => '%sInter%s',
            'long'  => '%sInterface%s'
        ***REMOVED***,
        'extends' => [
            'short' => '%sExtes%s%s',
            'long'  => '%sExtesible%s%s'
        ***REMOVED***
    ***REMOVED***;

    const KEYS_INTERFACE_DEPS = [
        'default' => [
            'short' => '%sBase%s%s',
            'long'  => '%sBase%s%s'
        ***REMOVED***,
    ***REMOVED***;

    const KEYS_INTERFACE = [
        'default' => [
            'short' => '%sInter%s',
            'long'  => '%sInterface%s'
        ***REMOVED***,
        'namespace' => [
            'short' => '%sInterNames%s',
            'long'  => '%sInterfaceNamespace%s'
        ***REMOVED***,
        'extends' => [
            'short' => '%sInterExtends%s',
            'long'  => '%sInterfaceExtends%s'
        ***REMOVED***,
        'dependency' => [
            'short' => '%sInterDepen%s',
            'long'  => '%sInterfaceDependency%s',
        ***REMOVED***,
        'dependency-many' => [
            'short' => '%sInterDepenMany%s',
            'long'  => '%sInterfaceDependencyMany%s',
        ***REMOVED***,
        'full' => [
            'short' => '%sInterFull%s',
            'long'  => '%sInterfaceFull%s',
        ***REMOVED***,
    ***REMOVED***;

    const KEYS = [
        'implements' => [
            'short' => '%sImple%s%s',
            'long'  => '%sImplements%s%s'
        ***REMOVED***,
        'implements-many' => [
            'short' => '%sImpleMany%s%s',
            'long'  => '%sImplementsMany%s%s'
        ***REMOVED***,
        'extends' => [
            'short' => '%sExted%s%s',
            'long'  => '%sExtends%s%s'
        ***REMOVED***,
        'namespace' => [
            'short' => '%sNames%s%s',
            'long'  => '%sNamespace%s%s'
        ***REMOVED***,
        'dependency' => [
            'short' => '%sDepen%s%s',
            'long'  => '%sDependency%s%s',
        ***REMOVED***,
        'dependency-many' => [
            'short' => '%sDepenMany%s%s',
            'long'  => '%sDependencyMany%s%s',
        ***REMOVED***,
        'dependency-full' => [
            'short' => '%sDepenFull%s%s',
            'long'  => '%sDependencyFull%s%s',
        ***REMOVED***,
        'dependency-many-full' => [
            'short' => '%sDepenManyFul%s%s',
            'long'  => '%sDependenciesManyFull%s%s',
        ***REMOVED***,
        'default' => [
            'short' => '%s%s%s',
            'long'  => '%s%s%s'
        ***REMOVED***,
        'full' => [
            'short' => '%sFull%s%s',
            'long'  => '%sFull%s%s'
        ***REMOVED***
    ***REMOVED***;

    /**
     * Constructor
     *
     * @param Persist       $persist       Persist
     * @param StringService $stringService String Service
     *
     * @return \Gear\Integration\Component\GearFile\GearFile
     */
    public function __construct(
        Persist $persist,
        StringService $stringService
    ) {
        $this->persist = $persist;
        $this->stringService = $stringService;

        return $this;
    }

    public function setSuite(AbstractMinorSuite $suite)
    {
        $this->suite = $suite;
        return $this;
    }

    public function getSrcMvcDependency($tableName, $tableAlias, $type)
    {
        if ($type == SrcTypesInterface::REPOSITORY) {
            return [
                'doctrine.entitymanager.orm_default' => '\Doctrine\ORM\EntityManager',
                '\GearBase\Repository\QueryBuilder'
            ***REMOVED***;
        }

        if ($type == SrcTypesInterface::SERVICE) {
            $repositoryDependency = sprintf(
                '%s\Repository\%sRepository',
                $tableName,
                $tableAlias
            );


            return [
                $repositoryDependency,
                'memcached' => '\Zend\Cache\Storage\Adapter\Memcached',
                [
                    'class' => '\Zend\Authentication\AuthenticationService',
                    'aliase' => 'zfcuser_auth_service',
                    'ig_t' => true
                ***REMOVED***,
            ***REMOVED***;
        }

        throw new Exception('Missing Type');
    }

    public function getSrcMvcTemplate($type)
    {
        if ($type == SrcTypesInterface::SEARCH_FORM) {
            return 'search-form';
        }

        if ($type == SrcTypesInterface::FORM) {
            return 'form-filter';
        }

        throw new Exception('Missing Type');
    }

    public function srcMvcOptions($src)
    {
        if (!in_array($this->minorSuite->getType(), [SrcTypesInterface::FIXTURE, SrcTypesInterface::ENTITY***REMOVED***)) {
            $src['service'***REMOVED*** = 'factories';
            $src['namespace'***REMOVED*** = ($this->minorSuite->getTableName().'\\'.$this->str('class', $this->minorSuite->getType()));
        }

        if (in_array($this->minorSuite->getType(), [SrcTypesInterface::REPOSITORY, SrcTypesInterface::SERVICE***REMOVED***)) {
            $src['dependency'***REMOVED*** = $this->getSrcMvcDependency(
                $this->minorSuite->getTableName(),
                $this->minorSuite->getTableAlias(),
                $this->minorSuite->getType()
            );
        }

        if (in_array($this->minorSuite->getType(), [SrcTypesInterface::SEARCH_FORM, SrcTypesInterface::FORM***REMOVED***)) {
            $src['template'***REMOVED*** = $this->getSrcMvcTemplate($this->minorSuite->getType());
        }
        return $src;
    }

    public function createSrcMvcGearFile(SrcMvcMinorSuite $srcMvcMinorSuite, $tables)
    {
        $this->suite = $srcMvcMinorSuite;

        $this->history = [***REMOVED***;

        $srcs = [***REMOVED***;
        foreach ($tables as $minorSuite) {

            $this->minorSuite = $minorSuite;
            $name = $minorSuite->getType() == SrcTypesInterface::ENTITY
                ? $minorSuite->getTableAlias()
                : sprintf(
                    '%s%s',
                    $minorSuite->getTableAlias(),
                    $this->str('class', $minorSuite->getType())
                );

            $src = [
                'db' => $minorSuite->getTableAlias(),
                'type' => $this->str('class', $minorSuite->getType()),
                'name' => $name,
                'user' => $minorSuite->getUserType(),
                'columns' => $this->factoryGearfileColumns($minorSuite->getColumns())
            ***REMOVED***;

            $src = $this->srcMvcOptions($src);

            $srcs[***REMOVED*** = $src;

            if (!empty($minorSuite->getForeignKeys()) && in_array($srcMvcMinorSuite->getType(), [SrcTypesInterface::ENTITY, SrcTypesInterface::FIXTURE***REMOVED***)) {
                foreach ($minorSuite->getForeignKeys() as $foreignKey) {
                    if (in_array($foreignKey, $this->history)) {
                        continue;
                    }
                    $srcs = array_merge($srcs, $this->createForeignKeyGearfile($foreignKey, $minorSuite));
                    $this->history[***REMOVED*** = $foreignKey;
                }
            }

            if (
                !empty($minorSuite->getTableAssoc())
                && !in_array($minorSuite->getTableAssoc(), $this->history)
                && in_array($srcMvcMinorSuite->getType(), [SrcTypesInterface::ENTITY, SrcTypesInterface::FIXTURE***REMOVED***)
            ) {
                $srcs = array_merge(
                    $srcs,
                    $this->createForeignKeyGearfile($minorSuite->getTableAssoc(), $minorSuite)
                );
                $this->history[***REMOVED*** = $minorSuite->getTableAssoc();
            }
        }

        return $this->createGearfileComponent(['src' => $srcs***REMOVED***);
    }

    public function createControllerMvcGearFile(ControllerMvcMinorSuite $suite, $tables)
    {
        $this->suite = $suite;
        $controller = [***REMOVED***;
        foreach ($tables as $minorSuite) {
            $name = sprintf('%s%s', $minorSuite->getTableName(), 'Controller');

            $controllerItem = [
                'db' => $minorSuite->getTableAlias(),
                'type' => 'Action',
                'name' => $name,
                'user' => $minorSuite->getUserType(),
                'columns' => $this->factoryGearfileColumns($minorSuite->getColumns()),
                'service' => 'factories',
                'namespace' => ($minorSuite->getTableName().'\\Controller'),
                'dependency' => [
                    ($minorSuite->getTableName().'\\Service\\'.$minorSuite->getTableName().'Service'),
                    ($minorSuite->getTableName().'\\Form\\'.$minorSuite->getTableName().'Form'),
                    ($minorSuite->getTableName().'\\SearchForm\\'.$minorSuite->getTableName().'SearchForm'),
                ***REMOVED***,
                'actions' => [
                    [
                        'name' => 'create',
                        'role' => 'admin'
                    ***REMOVED***,
                    [
                        'name' => 'edit',
                        'role' => 'admin'
                    ***REMOVED***,
                    [
                        'name' => 'list',
                        'role' => 'admin'
                    ***REMOVED***,
                    [
                        'name' => 'view',
                        'role' => 'admin'
                    ***REMOVED***,
                    [
                        'name' => 'delete',
                        'role' => 'admin'
                    ***REMOVED***,
                ***REMOVED***
            ***REMOVED***;

            if ($minorSuite->getTableAssoc() == UploadImageTable::NAME) {
                $controllerItem['dependency'***REMOVED***[***REMOVED*** = '\GearImage\Service\ImageService';
                $controllerItem['actions'***REMOVED***[***REMOVED*** = ['name' => 'upload-image', 'role' => 'admin'***REMOVED***;
            }

            $controller[***REMOVED*** = $controllerItem;
        }

        return $this->createGearfileComponent(['controller' => $controller***REMOVED***);
    }


    public function createMvcGearfile(MvcMinorSuite $mvcMinorSuite)
    {
        $this->suite = $mvcMinorSuite;

        $db = [
            'table' => $mvcMinorSuite->getTableAlias(),
            'user' => $mvcMinorSuite->getUserType(),
            'namespace' => $mvcMinorSuite->getTableAlias(),
            'service' => 'factories',
            'columns' => $this->factoryGearfileColumns($mvcMinorSuite->getColumns())
        ***REMOVED***;

        $src = [***REMOVED***;

        if (!empty($mvcMinorSuite->getForeignKeys())) {
            foreach ($mvcMinorSuite->getForeignKeys() as $foreignKey) {
                $src = array_merge($src, $this->createForeignKeyGearfile($foreignKey, $mvcMinorSuite));
            }
        }
        if (!empty($mvcMinorSuite->getTableAssoc())) {
            $src = array_merge(
                $src,
                $this->createForeignKeyGearfile($mvcMinorSuite->getTableAssoc(), $mvcMinorSuite)
            );
        }

        return $this->createGearfileComponent(['db' => [$db***REMOVED***, 'src' => $src***REMOVED***);
    }


    /**
     * Gearfile
     */
    private function factoryGearfileColumns($columns)
    {
        $gearfileColumns = [***REMOVED***;

        if (empty($columns)) {
            return $gearfileColumns;
        }

        foreach ($columns as $columnName => $columnOptions) {
            if (isset($columnOptions['speciality'***REMOVED***)) {
                $gearfileColumns[$columnName***REMOVED*** = $columnOptions['speciality'***REMOVED***;
            }
        }
        return $gearfileColumns;
    }

    private function createForeignKeyGearfile($tableId, $minorSuite)
    {
        $table = $this->str('class', str_replace('id_', '', $tableId));

        if ($minorSuite instanceof SrcMvcMinorSuite) {

            if ($minorSuite->getType() === SrcTypesInterface::ENTITY) {
                $data = [
                    [
                        'name' => $table,
                        'type' => 'Entity',
                        'db' => $table,
                    ***REMOVED***,
                ***REMOVED***;
                return $data;
            }

            if ($minorSuite->getType() === SrcTypesInterface::FIXTURE && $table !== 'UploadImage') {
                $data =  [
                    [
                        'name' => sprintf('%sFixture', $table),
                        'type' => 'Fixture',
                        'db' => $table,
                    ***REMOVED***
                ***REMOVED***;
                return $data;
            }

            return [***REMOVED***;
        }

        //var_dump($tableId);
        $data = [
            [
                'name' => $table,
                'type' => 'Entity',
                'db' => $table,
            ***REMOVED***,
        ***REMOVED***;

        //var_dump($type !== SrcTypesInterface::ENTITY && $tableId !== 'upload_image');

        if ($minorSuite->getType() !== SrcTypesInterface::ENTITY && $tableId !== 'upload_image') {
            $data[***REMOVED*** =  [
                'name' => sprintf('%sFixture', $table),
                'type' => 'Fixture',
                'db' => $table,
            ***REMOVED***;
        }

        return $data;
    }

    public function runGenerate($suite, $options)
    {
        $gen = [***REMOVED***;

        if (empty($options[$suite***REMOVED***)) {
            return $gen;
        }

        foreach ($options[$suite***REMOVED*** as $options) {
            $gen = array_merge($gen, $this->generateGearfiles($options[0***REMOVED***, $options[1***REMOVED***, $options[3***REMOVED***));
        }

        return $gen;
    }

    public function createControllerGearFile(ControllerMinorSuite $suite, $srcOptions)
    {
        $this->suite = $suite;

        $src = $this->runGenerate('src', $srcOptions);

        $controller = $this->runGenerate('controller', $srcOptions);

        return $this->createGearfileComponent(['src' => $src, 'controller' => $controller***REMOVED***);
    }


    public function createSrcGearfile(SrcMinorSuite $suite, $options)
    {
        $this->suite = $suite;

        $src = $this->runGenerate('src', $options);
        if (isset($options['controller'***REMOVED***)) {
            $controller = $this->runGenerate('controller', $options);
        }

        $data = ['src' => $src***REMOVED***;

        if (isset($options['controller'***REMOVED***)) {
            $data['controller'***REMOVED*** = $controller;
        }

        return $this->createGearfileComponent($data);
    }




    private function generateGearfiles($entities, $config, $repeat)
    {
        $invokableFile = [***REMOVED***;

        foreach ($entities as $entity) {
            foreach ($config as $configName) {
                for ($i = 1; $i <= $repeat; $i++) {
                    $invokableFile[***REMOVED*** = $this->generateSource($entity, $configName, $i, $repeat);
                }
            }
        }

        return $invokableFile;
    }

    /**
     * Return the Service Config Name of Class.
     *
     * Could be Invokables, Factories or Abstract.
     *
     * Can cut if isUsingLongName is false.
     */
    public function getEntryConfigName()
    {
        $config = ($this->suite->isUsingLongName() ? $this->service : substr($this->service, 0, 5));

        return (!empty($config))
            ? $this->str('class', $config)
            : '';
    }

    /**
     * Return the Name that will be used into $entry
     *
     * Will be the conjunction of config
     *
     * Can cut if isUsingLongName is false.
     */
    public function getEntryName($name)
    {
        $nameRc = ($this->str('class', $this->type) == SrcTypesInterface::INTERFACE)
            ? sprintf($name, '', $this->numberLabel)
            : sprintf($name, $this->typeLabel, $this->serviceLabel, $this->numberLabel);


        $fullname = $this->str('class', $nameRc);

        return $fullname;
    }

    public function getTypeName($suite)
    {
        return ($suite->isUsingLongName()) ? $this->type : substr($this->type, 0, 5);
    }

    public function getEntryConfigNumber($suite, $max, $repeat)
    {
        if ($max == 1) {
            return '';
        }

        $config = NumberToStringInterface::NUMBER_MAP[$repeat***REMOVED***;

        return ($suite->isUsingLongName()) ? $config : substr($config, 0, 5);
    }

    public function createExtends($entity)
    {
        $namespace = null;

        switch ($this->type) {
            case 'Interface':
                $namespace = 'Interfaces';
                break;
            case 'Action':
            case 'Console':
                $namespace = 'Controller';
                break;
            default:
                $namespace = $this->type;
        }

        return sprintf(
            '%s\\'.$entity['extends'***REMOVED***,
            $namespace,
            $this->typeLabel,
            $this->serviceLabel,
            $this->numberLabel
        );
    }


    public function configOptions()
    {
    }

    public function createImplements()
    {
        $implements = [***REMOVED***;

        foreach ($this->entity['implements'***REMOVED*** as $invokDep) {

            $implements[***REMOVED*** = (strpos($invokDep, 'Interfaces') !== false)
                ? sprintf($invokDep, '', $this->numberLabel)
                : sprintf($invokDep, $this->type, $this->numberLabel);

        }

        return $implements;
    }

    private function generateSource($entity, $configName, $repeat, $max)
    {
        $this->entity = $entity;
        $this->entry = [***REMOVED***;

        $this->max = $max;

        $this->repeat = $repeat;
        $this->service = $configName;

        $this->numberLabel = $this->getEntryConfigNumber($this->suite, $this->max, $this->repeat);

        $this->serviceLabel = $this->getEntryConfigName();

        $this->type = $this->str('class', $entity['type'***REMOVED***);
        $this->typeLabel = $this->getTypeName($this->suite);

        $this->name = $this->getEntryName($entity['name'***REMOVED***);

        $this->entry['name'***REMOVED*** = $this->name;
        $this->entry['type'***REMOVED*** = $this->type;

        if (isset($entity['extends'***REMOVED***)) {
            $this->entry['extends'***REMOVED*** = $this->createExtends($entity);
        }

        if (isset($entity['namespace'***REMOVED***)) {
            $this->entry['namespace'***REMOVED*** = $this->createNamespace(
                $repeat,
                $this->suite->isUsingLongName()
            );
        }

        if (isset($entity['implements'***REMOVED***)) {
            $this->entry['implements'***REMOVED*** = $this->createImplements();
        }

        if ($configName !== 'abstract' && $entity['type'***REMOVED*** !== SrcTypesInterface::INTERFACE) {
            $this->entry['service'***REMOVED*** = $configName;
        } elseif ($entity['type'***REMOVED*** !== SrcTypesInterface::INTERFACE) {
            $this->entry['abstract'***REMOVED*** = true;
        }


        if (isset($entity['dependency'***REMOVED***)) {
            $this->entry['dependency'***REMOVED*** = $this->createDependencies($entity);
        }

        if (isset($entity['actions'***REMOVED***)) {
            $this->entry['actions'***REMOVED*** = $this->createAction($repeat);
        }

        return $this->entry;
    }

    public function createDependencies($entity)
    {
        $typeName = ($this->suite->isUsingLongName()) ? 'Invokables' : substr('Invokables', 0, 5);

        $dependencies = [***REMOVED***;

        foreach ($entity['dependency'***REMOVED*** as $invokDep) {

            $typeDep = ($this->suite->isUsingLongName())
                ? $this->str('class', $invokDep[1***REMOVED***)
                : $this->str('class', substr($invokDep[1***REMOVED***, 0, 5));

            $namespace = $this->str('class', $invokDep[1***REMOVED***);

            if ($this->type === SrcTypesInterface::INTERFACE) {
                $namespace = 'Interfaces';
            }


            $dep = ($this->type === SrcTypesInterface::INTERFACE)
                ? sprintf('%s\\'.$invokDep[0***REMOVED***, $namespace, '', $this->numberLabel)
                : sprintf('%s\\'.$invokDep[0***REMOVED***, $namespace, $typeDep, $typeName, $this->numberLabel);
                //var_dump($dep);

            $dependencies[***REMOVED*** = $dep;
        }

        return $dependencies;
    }

    public function createAction($repeat)
    {
        $actions = [***REMOVED***;

        if ($repeat == 1) {
            $actions[***REMOVED*** = ['name' => sprintf('%s', 'Index'), 'role' => 'guest'***REMOVED***;
            return $actions;
        }


        for ($i = 1; $i <= $repeat; $i++) {
            $numberConfig = $this->getEntryConfigNumber($this->suite, $repeat, $i);

            $actions[***REMOVED*** = ['name' => sprintf('%s', $numberConfig), 'role' => 'guest'***REMOVED***;
        }


        return $actions;
    }

    public function createNamespace($number, $longName)
    {
        $typeId = $this->str('class', $this->typeLabel);


        $template = ($longName) ? '%s%sNamespace' : '%s%sNames';


        if ($this->max == 1) {
            return sprintf($template, $typeId, '');
        }

        $textName = '';

        for ($x = 1; $x <= $number; $x++) {
            if (!empty($textName)) {
                $textName .= '\\';
            }
            $textName .= sprintf($template, $typeId, NumberToStringInterface::NUMBER_MAP[$x***REMOVED***);
        }


        return $textName;
    }

    /**
     * To be used externally on Src and Controller.
     */
    public function createMultiplesImplements($suite, $type, $repeat, $max, $keyStyle)
    {
        $type = $this->str('class', $type);
        $type = ($suite->isUsingLongName()) ? $type : substr($type, 0, 5);

        $interfaces = [***REMOVED***;

        if ($max == 1) {
            $interfaces[***REMOVED*** = sprintf('Interfaces\\'.self::KEYS_BASE['implements'***REMOVED***[$keyStyle***REMOVED***, $type, '');
            return $interfaces;
        }

        for ($z = 1; $z <= $repeat; $z++) {
            $interfaces[***REMOVED*** = sprintf(
                'Interfaces\\'.self::KEYS_BASE['implements'***REMOVED***[$keyStyle***REMOVED***,
                $type,
                NumberToStringInterface::NUMBER_MAP[$z***REMOVED***
            );
        }

        return $interfaces;
    }

    /**
     * Return the Code Template Generated
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    public function createGearfileComponent($data)
    {
        $suiteName = $this->suite->getSuiteName();

        $name = $this->str('url', $suiteName);

        $gearfile = sprintf('%s.yml', $name);

        $this->code = Yaml::dump($data, 4);

        //echo $this->code; die();

        $this->persist->save($this->suite, $gearfile, $this->code);

        return $gearfile;
    }
}
