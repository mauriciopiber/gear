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

    public function getOrmConvertMapping()
    {
        $b = '../../vendor/bin/doctrine-module ';
        $b .= sprintf('orm:convert-mapping --namespace="%s\\\Entity\\\" ', $this->getConfig()->getModule());
        $b .= sprintf('--force  --from-database annotation module/%s/src/', $this->getConfig()->getModule(), $this->getConfig()->getModule());

        return $b;

    }

    public function getOrmGenerateEntities()
    {
        $b = '../../vendor/bin/doctrine-module orm:generate-entities';
        $b .= sprintf(' module/%s/src/ --generate-annotations=true', $this->getConfig()->getModule());

        return $b;
    }

    public function getOrmValidateSchema()
    {
        $b = '';
        $b .= '../../vendor/bin/doctrine-module orm:validate-schema';
        return $b;
    }
}
