<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Mvc\Entity;

use Gear\Script\ScriptService;

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


        $cmd = $this->getDoctrineModule().' ';
        $cmd .= sprintf('orm:convert-mapping --namespace="%s\\\Entity\\\" ', $this->getModule()->getModuleName());
        $cmd .= sprintf('--force  --from-database annotation %s', $entityDir);

        /* echo "\n".$cmd."\n"; */

        return $cmd;

    }

    public function getOrmGenerateEntities()
    {

        $entityDir = $this->getModule()->getSrcFolder().'/';

        $cmd = $this->getDoctrineModule().' ';
        $cmd .= 'orm:generate-entities';
        $cmd .= sprintf(' %s --generate-annotations=true', $entityDir);
/*         echo "\n".$cmd."\n"; */
        return $cmd;
    }

    public function getOrmValidateSchema()
    {
        $cmd = '';
        $cmd .= '../../vendor/bin/doctrine-module orm:validate-schema';
        return $cmd;
    }
}
