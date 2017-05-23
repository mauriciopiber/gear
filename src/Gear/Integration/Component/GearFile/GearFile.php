<?php
namespace Gear\Integration\Component\GearFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;
use Symfony\Component\Yaml\Yaml;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\Src\SrcMinorSuite;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Util\Numbers\NumberToStringInterface;

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

    public function getSrcMvcDependency($tableName, $type)
    {
        if ($type == 'repository') {
            return [
                'doctrine.entitymanager.orm_default' => '\Doctrine\ORM\EntityManager',
                '\GearBase\Repository\QueryBuilder'
            ***REMOVED***;
        }

        if ($type == 'service') {
            $repositoryDependency = sprintf(
                '%s\Repository\%sRepository',
                $tableName,
                $tableName
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
        if ($type == 'search-form') {
            return 'search-form';
        }

        if ($type == 'form') {
            return 'form-filter';
        }

        throw new Exception('Missing Type');
    }

    public function createSrcMvcGearFile(SrcMvcMinorSuite $srcMvcMinorSuite, $tables)
    {
        $this->suite = $srcMvcMinorSuite;

        $srcs = [***REMOVED***;
        foreach ($tables as $minorSuite) {
            $name = $minorSuite->getType() == 'entity'
                ? $minorSuite->getTableName()
                : sprintf(
                    '%s%s',
                    $minorSuite->getTableName(),
                    $this->stringService->str('class', $minorSuite->getType())
                );

            $src = [
                'db' => $minorSuite->getTableAlias(),
                'type' => $this->stringService->str('class', $minorSuite->getType()),
                'name' => $name,
                'user' => $minorSuite->getUserType(),
                'columns' => $this->factoryGearfileColumns($minorSuite->getColumns())
            ***REMOVED***;

            if (!in_array($minorSuite->getType(), ['fixture', 'entity'***REMOVED***)) {
                $src['service'***REMOVED*** = 'factories';
                $src['namespace'***REMOVED*** = ($minorSuite->getTableName().'\\'.$this->str('class', $minorSuite->getType()));
            }

            if (in_array($minorSuite->getType(), ['repository', 'service'***REMOVED***)) {
                $src['dependency'***REMOVED*** = $this->getSrcMvcDependency($minorSuite->getTableName(), $minorSuite->getType());
            }

            if (in_array($minorSuite->getType(), ['search-form', 'form'***REMOVED***)) {
                $src['template'***REMOVED*** = $this->getSrcMvcTemplate($minorSuite->getType());
            }

            $srcs[***REMOVED*** = $src;

            if (!empty($minorSuite->getForeignKeys())) {
                foreach ($minorSuite->getForeignKeys() as $foreignKey) {
                    if (in_array($foreignKey, $this->history)) {
                        continue;
                    }
                    $srcs = array_merge($srcs, $this->createForeignKeyGearfile($foreignKey, $minorSuite->getType()));
                    $this->history[***REMOVED*** = $foreignKey;
                }
            }

            if (!empty($minorSuite->getTableAssoc()) && !in_array($minorSuite->getTableAssoc(), $this->history)) {
                $srcs = array_merge(
                    $srcs,
                    $this->createForeignKeyGearfile($minorSuite->getTableAssoc(), $minorSuite->getType())
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

            if ($minorSuite->getTableAssoc() == 'upload_image') {
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
                $src = array_merge($src, $this->createForeignKeyGearfile($foreignKey, $mvcMinorSuite->getType()));
            }
        }

        if (!empty($mvcMinorSuite->getTableAssoc())) {
            $src = array_merge(
                $src,
                $this->createForeignKeyGearfile($mvcMinorSuite->getTableAssoc(), $mvcMinorSuite->getType())
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
        foreach ($columns as $columnName => $columnOptions) {
            if (isset($columnOptions['speciality'***REMOVED***)) {
                $gearfileColumns[$columnName***REMOVED*** = $columnOptions['speciality'***REMOVED***;
            }
        }
        return $gearfileColumns;
    }

    private function createForeignKeyGearfile($tableId, $type = null)
    {
        $table = $this->stringService->str('class', str_replace('id_', '', $tableId));

        $data = [
            [
                'name' => $table,
                'type' => 'Entity',
                'db' => $table,
            ***REMOVED***,
        ***REMOVED***;

        if ($type !== 'entity') {
            $data[***REMOVED*** =  [
                'name' => sprintf('%sFixture', $table),
                'type' => 'Fixture',
                'db' => $table,
            ***REMOVED***;
        }

        return $data;
    }

    public function createControllerGearfile(ControllerMinorSuite $suite, $srcOptions)
    {
        $this->suite = $suite;

        $src = [***REMOVED***;

        foreach ($srcOptions['src'***REMOVED*** as $options) {
            $src = array_merge($src, $this->generateGearfiles($options[0***REMOVED***, $options[1***REMOVED***, $options[2***REMOVED***, $options[3***REMOVED***));
        }

        $controller = [***REMOVED***;

        foreach ($srcOptions['controller'***REMOVED*** as $options) {
            $controller = array_merge(
                $controller,
                $this->generateGearfiles($options[0***REMOVED***, $options[1***REMOVED***, $options[2***REMOVED***, $options[3***REMOVED***)
            );
        }

        return $this->createGearfileComponent(['src' => $src, 'controller' => $controller***REMOVED***);
    }


    public function createSrcGearfile(SrcMinorSuite $suite, $srcOptions)
    {
        $this->suite = $suite;

        $data = [***REMOVED***;

        foreach ($srcOptions as $options) {
            $data = array_merge($data, $this->generateGearfiles($options[0***REMOVED***, $options[1***REMOVED***, $options[2***REMOVED***, $options[3***REMOVED***));
        }

        return $this->createGearfileComponent(['src' => $data***REMOVED***);
    }




    private function generateGearfiles($entities, $config, $type, $repeat)
    {
        $invokableFile = [***REMOVED***;

        foreach ($entities as $entity) {
            foreach ($config as $configName) {
                for ($i = 1; $i <= $repeat; $i++) {
                    $invokableFile[***REMOVED*** = $this->generateSource($entity, $configName, $type, $i, $repeat);
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
    public function getEntryConfigName($suite, $configName)
    {
        $config = ($suite->isUsingLongName() ? $configName : substr($configName, 0, 5));

        return (!empty($config))
            ? $this->stringService->str('class', $config)
            : '';
    }

    /**
     * Return the Name that will be used into $entry
     *
     * Will be the conjunction of config
     *
     * Can cut if isUsingLongName is false.
     */
    public function getEntryName($suite, $name, $type, $typeName, $serviceConfig, $numberConfig)
    {
        $typeName = ($suite->isUsingLongName()) ? $typeName : substr($typeName, 0, 5);

        $nameRc = ($type == 'Interface')
            ? sprintf($name, '', $numberConfig)
            : sprintf($name, $typeName, $serviceConfig, $numberConfig);


        $fullname = $this->str('class', $nameRc);

        return $fullname;
    }

    public function getTypeName($suite, $type)
    {
        return ($suite->isUsingLongName()) ? $type : substr($type, 0, 5);
    }

    public function getEntryConfigNumber($suite, $max, $repeat)
    {
        if ($max == 1) {
            return '';
        }

        $config = NumberToStringInterface::NUMBER_MAP[$repeat***REMOVED***;

        return ($suite->isUsingLongName()) ? $config : substr($config, 0, 5);
    }


    private function generateSource($entity, $configName, $type, $repeat, $max)
    {
        $this->entry = [***REMOVED***;

        $numberConfig = $this->getEntryConfigNumber($this->suite, $max, $repeat);

        $serviceConfig = $this->getEntryConfigName($this->suite, $configName);

        $type = $this->str('class', $entity['type'***REMOVED***);
        $typeName = $this->getTypeName($this->suite, $type);

        $name = $this->getEntryName($this->suite, $entity['name'***REMOVED***, $type, $typeName, $serviceConfig, $numberConfig);


        $this->entry['name'***REMOVED*** = $name;
        $this->entry['type'***REMOVED*** = $type;

        if (isset($entity['extends'***REMOVED***)) {
            $namespace = null;

            switch ($type) {
                case 'Action':
                case 'Console':
                    $namespace = 'Controller';
                    break;
                default:
                    $namespace = $type;
            }

            $this->entry['extends'***REMOVED*** = sprintf(
                '%s\\'.$entity['extends'***REMOVED***,
                $namespace,
                $typeName,
                $serviceConfig,
                $numberConfig
            );
        }

        if (isset($entity['namespace'***REMOVED***)) {
            $this->entry['namespace'***REMOVED*** = $this->createNamespace(
                $repeat,
                $typeName,
                $this->suite->isUsingLongName(),
                $max
            );
        }

        if (isset($entity['implements'***REMOVED***)) {
            $this->entry['implements'***REMOVED*** = [***REMOVED***;

            foreach ($entity['implements'***REMOVED*** as $invokDep) {
                $this->entry['implements'***REMOVED***[***REMOVED*** = sprintf($invokDep, $type, $numberConfig);
            }
        }

        if ($configName !== 'abstract' && $entity['type'***REMOVED*** !== 'interface') {
            $this->entry['service'***REMOVED*** = $configName;
        } elseif ($entity['type'***REMOVED*** !== 'interface') {
            $this->entry['abstract'***REMOVED*** = true;
        }


        if (isset($entity['dependency'***REMOVED***)) {
            $typeName = ($this->suite->isUsingLongName()) ? 'Invokables' : substr('Invokables', 0, 5);



            $this->entry['dependency'***REMOVED*** = [***REMOVED***;

            foreach ($entity['dependency'***REMOVED*** as $invokDep) {
                $typeDep = ($this->suite->isUsingLongName())
                    ? $this->str('class', $invokDep[1***REMOVED***)
                    : $this->str('class', substr($invokDep[1***REMOVED***, 0, 5));

                $typeDepType = $this->str('class', $invokDep[1***REMOVED***);


                $dep = sprintf('%s\\'.$invokDep[0***REMOVED***, $typeDepType, $typeDep, $typeName, $numberConfig);
                //var_dump($dep);

                $this->entry['dependency'***REMOVED***[***REMOVED*** = $dep;
            }
        }

        if (isset($entity['actions'***REMOVED***)) {
            $this->entry['actions'***REMOVED*** = $this->createAction($repeat, $serviceConfig);
        }

        return $this->entry;
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


    public function createNamespace($number, $typeId, $longName, $max)
    {
        $typeId = $this->str('class', $typeId);


        $template = ($longName) ? '%s%sNamespace' : '%s%sNames';


        if ($max == 1) {
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

    public function createMultiplesImplements($suite, $type, $repeat, $max, $keyStyle)
    {
        $type = $this->str('class', $type);
        $type = ($suite->isUsingLongName()) ? $type : substr($type, 0, 5);

        $interfaces = [***REMOVED***;

        if ($max == 1) {
            $interfaces[***REMOVED*** = 'Interfaces\\'.sprintf(self::KEYS_BASE['implements'***REMOVED***[$keyStyle***REMOVED***, $type, '');
            return $interfaces;
        }

        for ($z = 1; $z <= $repeat; $z++) {
            $interfaces[***REMOVED*** = 'Interfaces\\'.sprintf(
                self::KEYS_BASE['implements'***REMOVED***[$keyStyle***REMOVED***,
                $type,
                NumberToStringInterface::NUMBER_MAP[$z***REMOVED***
            );
        }

        return $interfaces;
    }


    public function createGearfileComponent($data)
    {
        $suiteName = $this->suite->getSuiteName();

        $name = $this->stringService->str('url', $suiteName);

        $gearfile = sprintf('%s.yml', $name);

        $yaml = Yaml::dump($data);

        $this->persist->save($this->suite, $gearfile, $yaml);

        return $gearfile;
    }
}
