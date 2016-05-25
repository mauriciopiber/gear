<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Symfony\Component\Yaml\Parser;
use GearJson\Db\DbServiceTrait as DbSchema;
use GearJson\Src\SrcServiceTrait as SrcSchema;
use GearJson\App\AppServiceTrait as AppSchema;
use GearJson\Controller\ControllerServiceTrait as ControllerSchema;
use GearJson\Action\ActionServiceTrait as ActionSchema;
use GearJson\Src\Src;
use Gear\Constructor\Db\DbServiceTrait as DbService;
use Gear\Constructor\App\AppServiceTrait as AppService;
use Gear\Constructor\Src\SrcServiceTrait as SrcService;
use Gear\Constructor\Controller\ControllerServiceTrait as ControllerService;
use Gear\Constructor\Action\ActionServiceTrait as ActionService;

/**
 * Cria os componentes para o módulo de acordo com o arquivo de configuração gear.
 *
 * Une todas funções de Constructor em um comando único.
 *
 * @category Module
 * @package  Gear
 * @author   Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @license  FreeBds http://www.freebsd.org/copyright/freebsd-license.html
 * @version  Release: 1.0.0
 * @link     http://docs.pibernetwork.com/gear
 *
 */
class ConstructService extends AbstractJsonService
{
    use DbService;

    use AppService;

    use SrcService;

    use ControllerService;

    use ActionService;

    use DbSchema;

    use SrcSchema;

    use AppSchema;

    use ControllerSchema;

    use ActionSchema;

    /** @var $configlocation Localizaçao para encontrar o arquivo de configuração */
    protected $configLocation;

    /**
     * Cria componentes de acordo com o arquivo de configuração yml.
     *
     * @param string  $module     Nome do módulo
     * @param string  $basepath   Localização do módulo
     * @param unknown $fileConfig Localização do arquivo de configuração Gear.
     *
     * @return boolean
     */
    public function construct($module, $basepath, $fileConfig = null)
    {
        $constructList = ['module' => $module, 'created' => null, 'skipped' => null, 'skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED******REMOVED***;

        $data = $this->getGearfileConfig();

        if (isset($data['src'***REMOVED***)) {

            foreach ($data['src'***REMOVED*** as $src) {


                $srcItem = new Src($src);

                if($this->getSrcService()->srcExist($module, $srcItem)) {

                    $constructList['skipped'***REMOVED*** += 1;
                    $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf('Src nome "%s" do tipo "%s" já existe.', $srcItem->getName(), $srcItem->getType());
                    continue;
                }

                $created = $this->getSrcConstructor()->create($src);

                if ($created) {
                    $constructList['created'***REMOVED*** += 1;
                    $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf('Src nome "%s" do tipo "%s" criado.', $srcItem->getName(), $srcItem->getType());
                }
            }
        }



        if (isset($data['db'***REMOVED***)) {


            foreach ($data['db'***REMOVED*** as $db) {

            }


        }



        //pegar arquivo de configuração

        //verificar se existe bd

        //verificar se existe src

        //verificar se existe app

        //verificar se existe controller/action

        var_dump($constructList);

        return $constructList;
    }

    /**
     * Retorna a localização padrão do arquivo gearfile.yml
     *
     * @return string $defaultFile Arquivo padrão
     */
    public function getDefaultLocation()
    {
        $defaultFile = $this->getModule()->getMainFolder().'/gearfile.yml';

        return $defaultFile;
    }

    /**
     * Seta a localização da configuração
     *
     * @param string $configLocation
     * @return \Gear\Module\ConstructService
     */
    public function setConfigLocation($configLocation)
    {
        $this->configLocation = $configLocation;
        return $this;
    }

    /**
     * Retorna a localização da configuração
     *
     * @return string
    */
    public function getConfigLocation()
    {
        return $this->configLocation;
    }

    /**
     * Lê o arquivo gearfile do disco e retorna as configurações que serão usadas.
     *
     * @throws \Gear\Module\Exception\GearfileNotFoundException
     *
     * @return array $config
    */
    public function getGearfileConfig()
    {
        if (empty($this->getConfigLocation())) {
            $this->setConfigLocation($this->getDefaultLocation());
        }

        if (!is_file($this->getConfigLocation())) {
            throw new \Gear\Module\Exception\GearfileNotFoundException();
        }

        $yaml = new Parser();

        $config = $yaml->parse(file_get_contents($this->getConfigLocation()));

        return $config;
    }
}
