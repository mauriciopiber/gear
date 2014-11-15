<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractJsonService;

class LanguageService extends AbstractService
{
    public static function getAvaiable()
    {

        return array('pt_BR', 'en_US', 'de_DE', 'es_ES');
    }

    //public function get

    public function getWords()
    {
        return array(
            'hello' => ''
        );
    }

    public function mergeLanguageUp()
    {

    }

    public static function localePt()
    {
        return array(
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
            'The input was not found in the haystack' => 'Selecione ao menos uma das opções'
        );
    }

    public function getDefaultRouterLanguage($locale)
    {
        $words = array();

        switch ($locale) {
            case 'pt_BR':
                $words = self::localePt();
                break;
            case 'de_DE':

                $words = array(
                    'create' => 'schaffen',
                    'edit'   => 'bearbeiten',
                    'list'   => 'Liste',
                    'delete' => 'löschen',
                    'index' => 'inicio'
                );
                break;

            case 'es_ES':
                $words = array(
                    'create' => 'crear',
                    'edit'   => 'editar',
                    'list'   => 'borrar',
                    'delete' => 'lista',
                    'index' => 'inicio'
                );
                break;

            case 'en_US':
                $words = array(
                'create' => 'create',
                'edit'   => 'edit',
                'list'   => 'list',
                'delete' => 'delete',
                    'index' => 'index'
                    );
                    break;


            default:

                break;
        }

        return $words;

    }



    public function create()
    {
        foreach (LanguageService::getAvaiable() as $language) {

            $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($this->getDefaultRouterLanguage($language), true));
            $translate =  'return ' . $dataArray . ';'.PHP_EOL;

            $this->createFileFromText($translate, $language.'.php', $this->getModule()->getLanguageFolder());
            $this->createFileFromText($translate, $language.'.php', $this->getModule()->getLanguageRouteFolder());
        }

    }


}
