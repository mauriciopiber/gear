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

    public function createControllerMvcGearFile(ControllerMvcMinorSuite $controllerMvcMinorSuite, $tables)
    {
        //echo 'Create Controller Mvc GearFile'."\n";

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
        $srcs = [***REMOVED***;
        foreach ($tables as $minorSuite) {

            $name = $minorSuite->getType() == 'entity'
                ? $minorSuite->getTableName()
                : sprintf('%s%s', $minorSuite->getTableName(), $this->stringService->str('class', $minorSuite->getType()));

            $src = [
                'db' => $minorSuite->getTableName(),
                'type' => $this->stringService->str('class', $minorSuite->getType()),
                'name' => $name,
                'user' => $minorSuite->getUserType(),
                'columns' => $this->factoryGearfileColumns($minorSuite->getColumns())
            ***REMOVED***;

            if (!in_array($minorSuite->getType(), ['fixture', 'entity'***REMOVED***)) {
                $src['service'***REMOVED*** = 'factories';
                $src['namespace'***REMOVED*** = $minorSuite->getTableName();
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
               $srcs = array_merge($srcs, $this->createForeignKeyGearfile($minorSuite->getTableAssoc(), $minorSuite->getType()));
               $this->history[***REMOVED*** = $minorSuite->getTableAssoc();
            }
        }

        return $this->createGearfileComponent($srcMvcMinorSuite, ['src' => $srcs***REMOVED***);

    }

    public function createMvcGearfile(MvcMinorSuite $mvcMinorSuite)
    {
        $db = [
            'table' => $mvcMinorSuite->getTableName(),
            'user' => $mvcMinorSuite->getUserType(),
            'namespace' => $mvcMinorSuite->getTableName(),
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
            $src = array_merge($src, $this->createForeignKeyGearfile($mvcMinorSuite->getTableAssoc(), $mvcMinorSuite->getType()));
        }

        return $this->createGearfileComponent($mvcMinorSuite, ['db' => [$db***REMOVED***, 'src' => $src***REMOVED***);
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

    public function createGearfileComponent($suite, $data)
    {
        $suiteName = $suite->getSuiteName();

        $name = $this->stringService->str('url', $suiteName);

        $gearfile = sprintf('%s.yml', $name);

        $yaml = Yaml::dump($data);

        $this->persist->save($suite, $gearfile, $yaml);

        return $gearfile;
    }


    public function createControllerGearfile(ControllerMinorSuite $suite, $srcOptions)
    {
        $src = [***REMOVED***;

        foreach ($srcOptions['src'***REMOVED*** as $options) {
            $src = array_merge($src, $this->generateGearfiles($options[0***REMOVED***, $options[1***REMOVED***, $options[2***REMOVED***, $options[3***REMOVED***));
        }

        $controller = [***REMOVED***;

        foreach ($srcOptions['controller'***REMOVED*** as $options) {
            $controller = array_merge($controller, $this->generateGearfiles($options[0***REMOVED***, $options[1***REMOVED***, $options[2***REMOVED***, $options[3***REMOVED***));
        }

        return $this->createGearfileComponent($suite, ['src' => $src, 'controller' => $controller***REMOVED***);
    }


    public function createSrcGearfile(SrcMinorSuite $suite, $srcOptions)
    {
        $data = [***REMOVED***;

        foreach ($srcOptions as $options) {
            $data = array_merge($data, $this->generateGearfiles($options[0***REMOVED***, $options[1***REMOVED***, $options[2***REMOVED***, $options[3***REMOVED***));
        }

        return $this->createGearfileComponent($suite, ['src' => $data***REMOVED***);
    }




    private function generateGearfiles($invokables, $config, $type, $repeat)
    {
        $invokableFile = [***REMOVED***;

        foreach ($invokables as $invokable) {

            foreach ($config as $configName) {

                for ($i = 1; $i <= $repeat; $i++) {

                    $invokableFile[***REMOVED*** = $this->generateSource($invokable, $configName, $type, $i);
                }
            }
        }

        return $invokableFile;


    }

    private function generateSource($invokable, $configName, $type, $repeat)
    {

        $numberString = NumberToStringInterface::NUMBER_MAP[$repeat***REMOVED***;

        $name = sprintf($invokable['name'***REMOVED***, $type, $this->stringService->str('class', substr($configName, 0, 5)), $numberString);

        $entry = ['name' => $name, 'type' => $invokable['type'***REMOVED******REMOVED***;

        if (isset($invokable['extends'***REMOVED***)) {
            $entry['extends'***REMOVED*** = sprintf($invokable['extends'***REMOVED***, $type, $type, $this->stringService->str('class', substr($configName, 0, 5)), $numberString);
        }

        if (isset($invokable['namespace'***REMOVED***)) {
            $entry['namespace'***REMOVED*** = $this->createNamespace($type, $repeat);

        }

        if (isset($invokable['implements'***REMOVED***)) {

            if (is_array($invokable['implements'***REMOVED***)) {

               $entry['implements'***REMOVED*** = [***REMOVED***;

               foreach ($invokable['implements'***REMOVED*** as $invokDep) {
                   $entry['implements'***REMOVED***[***REMOVED*** = sprintf($invokDep, $type, $numberString);
               }

            } else {
                $entry['implements'***REMOVED*** = sprintf($invokable['implements'***REMOVED***, $type, $numberString);
            }
        }

        if ($configName !== 'abstract' && $invokable['type'***REMOVED*** !== 'Interface') {
            $entry['service'***REMOVED*** = $configName;
        } elseif ($invokable['type'***REMOVED*** !== 'Interface') {
            $entry['abstract'***REMOVED*** = true;
        }


        if (isset($invokable['dependency'***REMOVED***)) {
            if (is_array($invokable['dependency'***REMOVED***)) {

               $entry['dependency'***REMOVED*** = [***REMOVED***;

               foreach ($invokable['dependency'***REMOVED*** as $invokDep) {
                   $entry['dependency'***REMOVED***[***REMOVED*** = sprintf($invokDep, $type, $type, $numberString);
               }

            } else {
                $entry['dependency'***REMOVED*** = sprintf($invokable['dependency'***REMOVED***, $type, $type, $numberString);
            }
        }

        return $entry;
    }

    public function createNamespace($type, $number)
    {
        $textName = '';

        for ($x = 1; $x <= $number; $x++) {

            if (!empty($textName)) {
                $textName .= '\\';
            }
            $textName .= sprintf('%s%s', substr($type, 0, 5), NumberToStringInterface::NUMBER_MAP[$x***REMOVED***);

        }


        return $textName;
    }

    public function createMultiplesInterfaces($type, $repeat)
    {
        $interfaceString = 'Interfaces\%sImpl%s';

        if ($repeat == 1) {
            return sprintf($interfaceString, $type, NumberToStringInterface::NUMBER_MAP[1***REMOVED***);
        }

        $interfaces = [***REMOVED***;

        for ($z = 1; $z <= $repeat; $z++) {
            $interfaces[***REMOVED*** = sprintf($interfaceString, $type, NumberToStringInterface::NUMBER_MAP[$z***REMOVED***);
        }

        return $interfaces;
    }


    /**
    public function createSrcMvcGearfile(SrcMvcMinorSuite $suite)
    {


    }

    public function createMvcGearfile(MvcMinorSuite $suite)
    {

    }
    */
}
