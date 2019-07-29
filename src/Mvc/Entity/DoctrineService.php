<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Mvc\Entity;

use Gear\Util\Script\ScriptService;
use Gear\Mvc\AbstractMvcInterface;

/**
 * Classe Responsável pelos comandos relacionados ao DoctrineModule.
 */
class DoctrineService extends ScriptService implements AbstractMvcInterface
{
    /**
     * Retorna a localização do doctrine-module
     *
     * @return string
     */
    public function getDoctrineModule()
    {
        $fromModule = $this->getModule()->getMainFolder().'/vendor/bin/doctrine-module';

        if (is_file($fromModule) || is_link($fromModule)) {
            return $fromModule;
        }

        return \GearBase\Module::getProjectFolder().'/vendor/bin/doctrine-module';
    }

    /**
     * Cria o comando para mapear o banco de dados para as entidades
     *
     * @return string $cmd Comando pronto para ser executado
     */
    public function getOrmConvertMapping()
    {
        $entityDir = $this->getModule()->getSrcFolder().'/';
        $cmd = $this->getDoctrineModule().' ';
        $cmd .= sprintf('orm:convert-mapping --namespace="%s\\\Entity\\\" ', $this->getModule()->getModuleName());
        $cmd .= sprintf('--force  --from-database annotation %s', $entityDir);

        echo "\n";
        echo $cmd;
        echo "\n";
        return $cmd;
    }

    /**
     * Cria o comando que lê o mapeamento e cria as entidade
     *
     * @return string
     */
    public function getOrmGenerateEntities()
    {
        $entityDir = $this->getModule()->getSrcFolder().'/';
        $cmd = $this->getDoctrineModule().' ';
        $cmd .= 'orm:generate-entities';
        $cmd .= sprintf(' %s --generate-annotations=true --generate-methods=true', $entityDir);

        echo "\n";
        echo $cmd;
        echo "\n";
        return $cmd;
    }
}
