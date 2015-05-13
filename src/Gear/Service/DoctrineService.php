<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\Module\ScriptService;

class DoctrineService extends ScriptService
{
    /**
     * Função responsável por gerar o comando de atualização do banco de dados
     * @return multitype:
     */
    public function getOrmSchemaToolUpdate()
    {
        return  '../../vendor/bin/doctrine-module orm:schema-tool:update --force';
    }

    public function getDoctrineModule()
    {
        return \GearBase\Module::getProjectFolder().'/vendor/bin/doctrine-module';
    }

    public function getOrmConvertMapping()
    {
        $entityDir = $this->getModule()->getSrcFolder().'/';


        $b = $this->getDoctrineModule().' ';
        $b .= sprintf('orm:convert-mapping --namespace="%s\\\Entity\\\" ', $this->getModule()->getModuleName());
        $b .= sprintf('--force  --from-database annotation %s', $entityDir);

        /* echo "\n".$b."\n"; */

        return $b;

    }

    public function getOrmGenerateEntities()
    {

        $entityDir = $this->getModule()->getSrcFolder().'/';

        $b = $this->getDoctrineModule().' ';
        $b .= 'orm:generate-entities';
        $b .= sprintf(' %s --generate-annotations=true', $entityDir);
/*         echo "\n".$b."\n"; */
        return $b;
    }

    public function getOrmValidateSchema()
    {
        $b = '';
        $b .= '../../vendor/bin/doctrine-module orm:validate-schema';
        return $b;
    }
}
