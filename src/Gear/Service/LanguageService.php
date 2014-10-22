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

    public function getWords()
    {
        return array(
            'hello' => ''
        );
    }

    public function create()
    {
        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($this->getWords(), true));
        $translate =  'return ' . $dataArray . ';'.PHP_EOL;

        foreach (LanguageService::getAvaiable() as $language) {
            $this->createFileFromText($translate, $language.'.php', $this->getModule()->getLanguageFolder());
            $this->createFileFromText($translate, $language.'.php', $this->getModule()->getLanguageRouteFolder());
        }

    }


}
