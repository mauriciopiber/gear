<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Mvc;

use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;

class LanguageService
{
    use ModuleStructureTrait;

    use StringServiceTrait;

    use FileCreatorTrait;

    public function __construct(
        ModuleStructure $module,
        StringService $string,
        FileCreator $fileCreator
    ) {
        $this->setFileCreator($fileCreator);
        $this->setModule($module);
        $this->setStringService($string);
    }

    public static function getAvaiable()
    {

        return ['pt_BR', 'en_US', 'de_DE', 'es_ES'***REMOVED***;
    }

    //public function get

    public function getWords()
    {
        return [
            'hello' => ''
        ***REMOVED***;
    }

    public function mergeLanguageUp()
    {
    }

    public static function localePt()
    {
        return [
            'create' => 'criar',
            'view' => 'visualizar',
            'edit'   => 'editar',
            'list'   => 'listar',
            'delete' => 'excluir',
            'index' => 'inicio',
            'Create' => 'Criar',
            'View' => 'Visualizar',
            'Edit'   => 'Editar',
            'List'   => 'Listar',
            'Delete' => 'Excluir',
            'image' => 'imagem',
            'Image' => 'Imagem',
            'Images' => 'Imagens',
            'Upload Image' => 'Editar Imagens',
            'Edit Images' => 'Editar Imagens',
            'New' => 'Novo',
            'Images of' => 'Imagens de',
            'The input was not found in the haystack' => 'Selecione ao menos uma das opções'
        ***REMOVED***;
    }

    public function getDefaultRouterLanguage($locale)
    {
        $words = [***REMOVED***;

        switch ($locale) {
            case 'pt_BR':
                $words = self::localePt();
                break;
            case 'de_DE':
                $words = [
                    'create' => 'schaffen',
                    'edit'   => 'bearbeiten',
                    'list'   => 'Liste',
                    'delete' => 'löschen',
                    'index' => 'inicio'
                ***REMOVED***;
                break;

            case 'es_ES':
                $words = [
                    'create' => 'crear',
                    'edit'   => 'editar',
                    'list'   => 'borrar',
                    'delete' => 'lista',
                    'index' => 'inicio'
                ***REMOVED***;
                break;

            case 'en_US':
                $words = [
                    'create' => 'create',
                    'edit'   => 'edit',
                    'list'   => 'list',
                    'delete' => 'delete',
                    'index' => 'index'
                ***REMOVED***;
                break;


            default:
                break;
        }

        return $words;
    }

    public function introspectFromTable($db)
    {
        $this->db           = $db;
        $this->tableName    = $this->str('class', $this->db->getTable());

        $languageFolder = $this->getModule()->getLanguageFolder();

        $this->db = $db;

        $tableColumns = $this->getTableService()->getValidColumnsFromTable($db->getTable());

        $labels = [***REMOVED***;

        foreach ($tableColumns as $column) {
            $label = $this->str('label', $column->getName());
            $labels[$label***REMOVED*** = $label;
        }

        foreach ($this->getAvaiable() as $language) {
            $file = sprintf('%s/%s.php', $languageFolder, $language);

            if (is_file($file)) {
                $array = require $file;

                $languageArray = $this->phpArrayToFile(array_merge($labels, $array));

                $this->getFileCreator()->createFileFromText(
                    $languageArray,
                    $language.'.php',
                    $this->getModule()->getLanguageFolder()
                );
                //$this->createPoeditFile($language, $languageArray);
            }
        }

        return true;
    }


    public function phpArrayToFile($phpArray)
    {
        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($phpArray, true));
        $file =  'return ' . $dataArray . ';'.PHP_EOL;
        return $file;
    }



    public function module()
    {
        foreach (LanguageService::getAvaiable() as $language) {
            $dataArray = preg_replace(
                "/[0-9***REMOVED***+ \=\>/i",
                ' ',
                var_export($this->getDefaultRouterLanguage($language), true)
            );
            $translate =  'return ' . $dataArray . ';'.PHP_EOL;

            $this->getFileCreator()->createFileFromText(
                $translate,
                $language.'.php',
                $this->getModule()->getLanguageFolder()
            );

            $this->getFileCreator()->createFileFromText(
                $translate,
                $language.'.php',
                $this->getModule()->getLanguageRouteFolder()
            );
        }
    }
}
