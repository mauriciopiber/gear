<?php
namespace Gear\Integration\Component\GearFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;
use Symfony\Component\Yaml\Yaml;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;

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

    private function createGearfileComponent($suite, $data)
    {
        $suiteName = $suite->getSuiteName();

        $name = $this->stringService->str('url', $suiteName);

        $gearfile = sprintf('%s.yml', $name);

        $yaml = Yaml::dump($data);

        $this->persist->save($suite, $gearfile, $yaml);

        echo "Criado com sucesso"."\n";
        return $gearfile;
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
                $src = array_merge($src, $this->createForeignKeyGearfile($foreignKey));
            }
        }

        if (!empty($mvcMinorSuite->getTableAssoc())) {
            $src = array_merge($src, $this->createForeignKeyGearfile($mvcMinorSuite->getTableAssoc()));
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

    private function createForeignKeyGearfile($tableId)
    {
        $table = $this->stringService->str('class', str_replace('id_', '', $tableId));

        return [
            [
                'name' => $table,
                'type' => 'Entity',
                'db' => $table,
            ***REMOVED***,
            [
                'name' => sprintf('%sFixture', $table),
                'type' => 'Fixture',
                'db' => $table,
            ***REMOVED***,
        ***REMOVED***;
    }


    public function createSrcGearfile(SrcMinorSuite $suite)
    {

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
